<?php

namespace App\Form;

use App\Entity\Universe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UniverseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
             'label'=>"Nom de l'univers",
             'label_attr'=>['class'=>'col-sm-3 col-form-label'
            ],
              'required' => true,
               'attr' => ['class' => "form-control"
            ],

               'help' => "Saisir le nom de l'univers",
                'help_attr' => ['class' => "form-text text-muted"
                ]
            ])
           
            ->add('description', TextareaType::class,[
                'label' => "Description de l'univers",
                'label_attr' => ['class' => 'col-sm-3 col-form-label'
                ],

                'required' => true,

                'attr' => ['class' => "form-control",      
                ],
                
                'help' => "Saisir une description brève de l'univers",
                'help_attr' => [
                    'class' => "form-text text-muted"
                ]
                
            ])


            // ->add('icon')
            // ->add('createdAt')
            // ->add('isArchived')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Universe::class,
        ]);
    }
}
