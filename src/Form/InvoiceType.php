<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Invoice;
use App\Entity\Product;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', TextType::class, [
                'label' => "Numéro",
                'label_attr' => [
                    'class' => "col-sm-3 col-form-label"
                ],
            ])
            // ->add('createAt')
            // ->add('isArchived')

            ->add('products', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Product::class,
                    'choice_label' => 'name',
                    'placeholder' => "",
                ],
                "allow_add" => true,
                "allow_delete" => true,
                'by_reference' => false,
            ])

            ->add('user', EntityType::class,[
                'label'=> "Client",
                'label_attr' => ['class' => 'col-sm-3 col-form-label'
               ],
                'class' => User::class,
                'choice_label'=> function($user){
                    // $output = $user->getUserName()." ";
                    $output = $user->getFirstname()." ";
                    $output.= $user->getLastname()." ";
                    return $output;
                },
                // 'choice_label' => 'username',
                'placeholder'=> "Choisir un client",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
