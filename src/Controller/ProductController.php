<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
	public function showProductsAction(ProductRepository $productRepository, Product $chief)
	{				
		return $this->render('cook/show.product.html.twig',
		 ['products' => $productRepository->findByChief($chief)]);
	}
}