<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, ['label' => 'Pseudonyme'])
            ->add('firstname', null, ['label' => 'Prénom'])
            ->add('name', null, ['label' => 'Nom'])
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe',
                                     'attr' => ['class' => 'form-control'],
                                     'constraints' => [
                                          new NotBlank([
                                            'message' => 'Entrez un mot de passe',
                                              ]),
                                             new Length([
                                                'min' => 6,
                                                'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                                                // max length allowed by Symfony for security reasons
                                                'max' => 255,
                                            ]),
                                        ]
                                    ],
                                    'second_options' => [
                                        'label' => 'Confirmez votre mot de passe',
                                        'attr' => ['class' => 'form-control']
                                    ],
                                ])
            ->add('phone', null, ['label' => 'Téléphone'])
            ->add('birthday', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
            ])
            ->add('roles', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Cochez si vous proposez vos services de cuisinier ',
                'attr' => ['class' => 'checkbox_user_rol '],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Décrivez vous en quelques mots ! ',
                'label_attr' => ['class' => 'd-none label_user_descript'],
                'attr' => [
                    'class' => 'd-none textarea_user_descript',
                    'rows' => '10',
                    'cols' => '25',
                ],
            ])
            ->add('file', FileType::class, [
                'mapped' => false,
                'label' => 'Photo de profil',
                'required' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Accepter les termes',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn text-white mt-2',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
