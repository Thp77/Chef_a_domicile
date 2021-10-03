<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Product;
use App\Repository\ProductRepository;
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
        $user = $options['user'];
        $builder
            ->add('name')
            ->add('price', IntegerType::class)
            ->add('genre', EntityType::class, ['class' => Genre::class, 'choice_label' => 'genre', 'multiple' => false, 'expanded' => false])
            ->add('products', EntityType::class, [
                'class' => Product::class, 
                'choice_label' => 'name', 
                'label' => 'Apéritifs',
                'multiple' => true, 
                'placeholder' => 'Choisissez vos apéritifs',
                'expanded' => false,
                'query_builder' => function (ProductRepository $productRepo) use ($user) {
                    return $productRepo->createQueryBuilder('p')
                    ->join('p.type', 't')
                    ->join('p.chief', 'c')
                    ->andWhere('t.id = 1')
                    ->andWhere('c.id = :chiefId')
                    ->setParameter('chiefId', $user->getId());
                },])
            ->add('products', EntityType::class, [
                'class' => Product::class, 
                'choice_label' => 'name', 
                'label' => 'Entrées',
                'multiple' => true, 
                'placeholder' => 'Choisissez vos entrées',
                'expanded' => false,
                'query_builder' => function (ProductRepository $productRepo) use ($user) {
                    return $productRepo->createQueryBuilder('p')
                    ->join('p.type', 't')
                    ->join('p.chief', 'c')
                    ->andWhere('t.id = 2')
                    ->andWhere('c.id = :chiefId')
                    ->setParameter('chiefId', $user->getId());
                },])
                ->add('products', EntityType::class, [
                    'class' => Product::class, 
                    'choice_label' => 'name', 
                    'label' => 'Plats',
                    'multiple' => true, 
                    'placeholder' => 'Choisissez vos plats',
                    'expanded' => false,
                    'query_builder' => function (ProductRepository $productRepo) use ($user) {
                        return $productRepo->createQueryBuilder('p')
                        ->join('p.type', 't')
                        ->join('p.chief', 'c')
                        ->andWhere('t.id = 3')
                        ->andWhere('c.id = :chiefId')
                        ->setParameter('chiefId', $user->getId());
                    },])
                ->add('products', EntityType::class, [
                    'class' => Product::class, 
                    'choice_label' => 'name', 
                    'label' => 'Desserts',
                    'multiple' => true, 
                    'placeholder' => 'Choisissez vos desserts',
                    'expanded' => false,
                    'query_builder' => function (ProductRepository $productRepo) use ($user) {
                        return $productRepo->createQueryBuilder('p')
                        ->join('p.type', 't')
                        ->join('p.chief', 'c')
                        ->andWhere('t.id = 4')
                        ->andWhere('c.id = :chiefId')
                        ->setParameter('chiefId', $user->getId());
                    },])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
            'user' => User::class,
        ]);
    }
}
