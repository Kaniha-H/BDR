<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
        // lastname
        ->add('lastname', TextType::class, [
            // Texte et Attributs de la balise <label>
            'label' => "Nom",
            'label_attr' => [
                'class' => 'sr-only'
            ],

            // Definir si le champ est obligatoire ou non
            'required' => true,

            // Attributs du champ <input>
            'attr' => [
                // 'class' => "form-control",
                'placeholder' => "Nom"
            ],

            // Texte d'aide
            'help' => "Saisir votre Nom",
            'help_attr' => [
                'class' => "form-text text-muted"
            ],

            // Contraintes
            'constraints' => [
                new NotBlank([
                    'message' => "Vous devez saisir votre Nom"
                ])
            ],

        ])
        
        // Firstname
        ->add('firstname', TextType::class, [
            // Texte et Attributs de la balise <label>
            'label' => "Prénom",
            'label_attr' => [
                'class' => 'sr-only'
            ],

            // Definir si le champ est obligatoire ou non
            'required' => true,

            // Attributs du champ <input>
            'attr' => [
                // 'class' => "form-control",
                'placeholder' => "Prénom"
            ],

            // 'mapped' => true,

            // Texte d'aide
            'help' => "Saisir votre prénom",
            'help_attr' => [
                'class' => "form-text text-muted"
            ],

            // Contraintes
            'constraints' => [
                new NotBlank([
                    'message' => "Vous devez saisir votre prénom"
                ])
            ],
        ])
        // Screnname
        // ->add('screenname',TextType::class)
        
        // Email
        
        ->add('email', RepeatedType::class, [
            'type' => EmailType::class,
            'required' => true,
            
            'first_options' => [
                'label' => "Email",
                'label_attr' => [
                    'class' => "sr-only",
                ],

                // Attributs du champ <input>
                'attr' => [
                    // 'class' => "form-control",
                    'placeholder' => "Email",
                ],

                // Texte d'aide
                'help' => "Saisir votre adresse email",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],

                // Contraintes
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous devez saisir votre adresse email"
                    ]),
                    new Email([
                        'message' => "L'adresse email n'est pas valide"
                    ]),
                ],
            ],
            'second_options' => [
                'label' => "Repéter votre Email",
                'label_attr' => [
                    'class' => "sr-only",
                ],

                // Attributs du champ <input>
                'attr' => [
                    // 'class' => "form-control",
                    'placeholder' => "Repéter votre Email",
                ],

                // Texte d'aide
                'help' => "Saisir votre adresse email",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],

                // Contraintes
                'constraints' => [],
            ],

            'invalid_message' => "Les adresses email saisies ne correspondent pas."
        ])
        
        // Password

        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => [
                'label' => "Votre nouveau mot de passe",
                'label_attr' => [
                    'class' => "sr-only",
                ],
                'attr' => [
                    'placeholder' => "Votre nouveau mot de passe",
                ],
                'help' => "Saisir votre nouveau mot de passe",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous devez saisir votre nouveau mot de passe"
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => "Votre nouveau mot de passe doit avoir {{ limit }} caractères minimum",
                        'max' => 40,
                        'maxMessage' => "Votre nouveau mot de passe doit avoir {{ limit }} caractères maximum",
                    ]),
                ]
            ],
            'second_options' => [
                'label' => "Répéter votre mot de passe",
                'label_attr' => [
                    'class' => "sr-only",
                ],
                'attr' => [
                    'placeholder' => "Répéter votre mot de passe",
                ],
                'help' => "Répéter votre mot de passe",
                'help_attr' => [
                    'class' => "form-text text-muted",
                ],
            ],

            'invalid_message' => "Les mots de passe saisies ne correspondent pas."
        ])
        
        // Address
        ->add('address', TextType::class)
        // Phone
        ->add('phone', TelType::class, [
            // Texte et Attributs de la balise <label>
            'label' => "Téléphone",
            'label_attr' => [
                'class' => 'sr-only'
            ],

            // Definir si le champ est obligatoire ou non
            'required' => true,

            // Attributs du champ <input>
            'attr' => [
                // 'class' => "form-control",
                'placeholder' => "Téléphone"
            ],

            // Texte d'aide
            'help' => "Merci de saisir votre numéro de téléphone",
            'help_attr' => [
                'class' => "form-text text-muted"
            ],

            // Contraintes
            'constraints' => [
                new NotBlank([
                    'message' => "Vous devez saisir votre numéro de téléphone"
                ])
            ],

        ])
        // Birthday
        ->add('birthday', TextType::class, [
            // Texte et Attributs de la balise <label>
            'label' => "Date de naissance",
            'label_attr' => [
                'class' => 'sr-only'
            ],

            // Definir si le champ est obligatoire ou non
            'required' => true,

            // Attributs du champ <input>
            'attr' => [
                // 'class' => "form-control",
                'placeholder' => "Date de naissance"
            ],

            // Texte d'aide
            'help' => "Merci de renseigner votre date de naissance",
            'help_attr' => [
                'class' => "form-text text-muted"
            ],

            // Contraintes
            'constraints' => [
                new NotBlank([
                    'message' => "Vous devez saisir votre date de naissance"
                ])
            ],

        ])
        // Agree Terms
        ->add('agreeTerms', CheckboxType::class, [
            // Texte et Attributs de la balise <label>
            'label' => null,
            'label_attr' => [
                'class' => 'sr-only'
            ],

            // Definir si le champ est obligatoire ou non
            'required' => true,

            // Attributs du champ <input>
            'attr' => [
            ],


            'mapped' => false,
            
            // Contraintes
            'constraints' => [
                new IsTrue([
                    'message' => "Vous devez accepter les CGU",
                ]),
            ],
            

        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
