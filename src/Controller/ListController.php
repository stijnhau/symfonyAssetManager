<?php

namespace App\Controller;

use App\Entity\AssetType;
use App\Entity\MarketingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index()
    {
        $assetTypes = $this->getDoctrine()
            ->getRepository(AssetType::class)
            ->findAll();
        $marketingTypes = $this->getDoctrine()
            ->getRepository(MarketingType::class)
            ->findAll();

        return $this->render('list/index.html.twig', [
            'assetTypes' => $assetTypes,
            'marketingTypes' => $marketingTypes,
        ]);
    }
}
