<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom du met'] )
            ->add('description', null, ['label' => 'Description du met (max 255 caractères)'] )
            ->add('file',FileType::class, [
                'mapped' => false,
                'label' => 'Photo du met',
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1500k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Votre fichier n\'est pas une image',
                    ])
                ],
                ])
            ->add('type', EntityType::class, ['class' => Type::class, 'choice_label' => 'type', 'multiple' => false, 'expanded' => false])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer',
            'attr' => ['class' => 'btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
