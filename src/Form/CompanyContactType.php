<?php

namespace App\Form;

use App\Entity\CompanyContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CompanyContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez entrer un nom de contact valid'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit au moins contenir {{ limit }} charactères.',
                        'max' => 50,
                        'maxMessage' => 'Le nom ne doit pas contenir plus de {{ limit }} charactères.',
                    ]),
                ],
            ])

            ->add('siren_number')
            ->add('email', EmailType::class, [
                "invalid_message" => "Le format d'email n'est pas valide",
                'constraints' => [
                    new Email([
                        'message' => "Cet email n'est pas valide",
                    ])
                ],
            ])
            ->add('phone_number', TelType::class)
            ->add('postcode')
            ->add('adress')
            ->add('city');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompanyContact::class,
        ]);
    }
}
