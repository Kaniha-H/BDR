<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du produit",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label"
                ],

                'required' => true,
                'attr' => [
                    'class' => "form-control",
                ],
                'help' => "Saisir le nom du produit",
                'help_attr' => [
                    'class' => "form-text text-muted"
                ]
            ])

            ->add('description', TextareaType::class, [
                'label' => "Description du produit",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label"
                ],

                'required' => true,
                'attr' => [
                    'class' => "form-control"
                ],
                'help' => "Saisir la description du produit",
                'help_attr' => [
                    'class' => "form-text text-muted"
                ]
            ])


            ->add('release_in', TextType::class, [
                'label' => "Date de parution",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label"
                ],

                'required' => true,
                'attr' => [
                    'class' => "form-control"
                ],
                'help' => "ex : 12/09/2004",
                'help_attr' => [
                    'class' => "form-text text-muted"
                ],

                // 'days' => range(1,31),
                // 'months' => range(1,12),
                // 'years' => range(1990,2050),
                // 'widget' => 'single_text',
                // 'format' => 'dd-MM-yyyy',
            ])

            ->add('page_number')
            ->add('price')

            ->add('illustration', FileType::class, [
                'label' => "Choisir une image",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => "2048k",
                        'mimeTypesMessage' => "Veuillez choisir une image valide"
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
