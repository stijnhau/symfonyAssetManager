<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\UploadFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return RedirectResponse|Response
     */
    public function index(Request $request, SluggerInterface $slugger)
    {
        $asset = new Asset();
        $form = $this->createForm(UploadFormType::class, $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $file = $form->get('location')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('asset_directory'),
                        $newFilename
                    );
                    $asset->setLocation($newFilename);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($asset);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'Your asset is saved!'
                    );

                    return $this->redirectToRoute('app_list');
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }
        }


        return $this->render('upload/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
