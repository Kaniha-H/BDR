<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Master;
use App\Entity\Universe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'label'=>"Nom du jeu",
            'label_attr'=>['class'=>'col-sm-3 col-form-label'
           ],
             'required' => true,
              'attr' => ['class' => "form-control"
           ],

              'help' => "Saisir le nom du jeu",
               'help_attr' => ['class' => "form-text text-muted"
               ]
           ])
          
           ->add('description', TextareaType::class,[
               'label' => "Description du jeu",
               'label_attr' => ['class' => 'col-sm-3 col-form-label'
               ],

               'required' => true,

               'attr' => ['class' => "form-control",      
               ],
               
               'help' => "Saisir une description du jeu",
               'help_attr' => [
                   'class' => "form-text text-muted"
               ]
            ])
            
            // ->add('illustration')
            ->add('universe', EntityType::class,[
                'label'=> "Univers du jeu",
                'label_attr' => ['class' => 'col-sm-3 col-form-label'
               ],

                'class' => Universe::class,
                'choice_label'=> function($universe){
                    $output = $universe->getname()." ";
                    return $output;
                },
                
            ])
            ->add('masters', CollectionType::class,[
                'entry_type' => EntityType::class,
                'entry_options' => ['class'=> Master::class,
                'choice_label'=> 'pseudo',
                ],
                
                "allow_add" => true,
                "allow_delete" => true,
                
            ])
         ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
