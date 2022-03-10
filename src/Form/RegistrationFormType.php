<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit au moins contenir {{ limit }} charactères.',
                        'max' => 70,
                        'maxMessage' => 'Le prénom ne doit pas contenir plus de {{ limit }} charactères.',
                    ]),
                    new NotNull([
                        'message' => 'Le prénom ne peut pas être vide.'
                    ])
                ],
            ])
            ->add('last_name', TextType::class, [
                'constraints' =>  [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit au moins contenir {{ limit }} charactères.',
                        'max' => 70,
                        'maxMessage' => 'Le nom ne doit pas contenir plus de {{ limit }} charactères.',
                    ]),
                    new NotNull([
                        'message' => 'Le nom ne peut pas être vide.'

                    ])
                ],
            ])
            ->add('email')

            ->add('phone', TelType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => "/(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/",
                        'message' => "Le numéro de téléphone n'est pas valide ",
                    ])
                ],
            ])
            ->add('title')
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,

            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe  {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
