<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pseudo', TextType::class, [
            'label'=>"Pseudo du joueur",
            'label_attr'=>['class'=>'col-sm-3 col-form-label'
           ],
             'required' => true,
              'attr' => ['class' => "form-control"
           ],

              'help' => "Saisir un pseudo pour le joueur",
               'help_attr' => ['class' => "form-text text-muted"
               ]
           ])
          
           ->add('description', TextareaType::class,[
               'label' => "Présentation du joueur",
               'label_attr' => ['class' => 'col-sm-3 col-form-label'
               ],

               'required' => true,

               'attr' => ['class' => "form-control",      
               ],
               
               'help' => "Ecrire une brève présentation du joueur",
               'help_attr' => [
                   'class' => "form-text text-muted"
               ]
               
           ])
            
            
            
            // ->add('illustration')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
