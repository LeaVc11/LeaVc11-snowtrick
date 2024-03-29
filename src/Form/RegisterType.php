<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class,
                [
                    'label' => 'Votre username',
                    'attr' => [
                        'class' => 'form-control-lg',
                    ],
                    'constraints' =>
                            new Length([
                                'min' => 4,
                                'max' => 30
                            ]),
                ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'constraints' => new Length
                (
                    [
                        'min' => 15,
                        'max' => 60,
                    ]
                ),
                'attr' =>
                    [
                        'class' => 'form-control-lg',
                    ]
            ])
            ->add('file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo de profil'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'constraints' => new Length
                (
                    [
                        'min' => 2,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                        'max' => 60,
                    ]
                ),
                'attr' => [
                    'class' => 'form-control-lg'
                ],
                'required' => true,

            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
