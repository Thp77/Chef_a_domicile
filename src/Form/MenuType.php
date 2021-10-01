<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Genre;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price', IntegerType::class)
            ->add('genre', EntityType::class, ['class' => Genre::class, 'choice_label' => 'genre', 'multiple' => false, 'expanded' => false])
            ->add('products', EntityType::class, ['class' => Product::class, 'choice_label' => 'name', 'multiple' => true, 'expanded' => false])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
