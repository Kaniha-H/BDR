<?php

namespace App\Form;

use App\Entity\Master;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MasterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pseudo', TextType::class, [
            'label'=>"Pseudo du maître de jeu",
            'label_attr'=>['class'=>'col-sm-3 col-form-label'
           ],
             'required' => true,
              'attr' => ['class' => "form-control"
           ],

              'help' => "Saisir un pseudo pour le maître de jeu",
               'help_attr' => ['class' => "form-text text-muted"
               ]
           ])
          
           ->add('description', TextareaType::class,[
               'label' => "Présentation du maître de jeu",
               'label_attr' => ['class' => 'col-sm-3 col-form-label'
               ],

               'required' => true,

               'attr' => ['class' => "form-control",      
               ],
               
               'help' => "Ecrire une brève présentation du maître de jeu",
               'help_attr' => [
                   'class' => "form-text text-muted"
               ]
               
           ]) 
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            ->add('illustration')
            ->add('games')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Master::class,
        ]);
    }
}
