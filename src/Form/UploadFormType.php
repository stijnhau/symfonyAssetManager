<?php

namespace App\Form;

use App\Entity\Asset;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('location', FileType::class, [
                'label' => 'Asset (JPG file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                'required' => true,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('asset_type', EntityType::class, [
                'class'     => 'App\Entity\AssetType',
                'choice_label' => 'name',
                /*
                'query_builder' => function (SecurityGroupRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                },
                */
                'label'     => 'Asset Type',
                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('marketing_type', EntityType::class, [
                'class'     => 'App\Entity\MarketingType',
                'choice_label' => 'name',
                /*
                'query_builder' => function (SecurityGroupRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                },
                */
                'label'     => 'Marketing Type',
                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('game', EntityType::class, [
                'class'     => 'App\Entity\Game',
                'choice_label' => 'name',
                /*
                'query_builder' => function (SecurityGroupRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                },
                */
                'label'     => 'Game',
                'expanded'  => false,
                'multiple'  => false,
            ])

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}
