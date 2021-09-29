<?php

namespace App\Controller\Chef;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChefProductController extends AbstractController
{
	public function newAction(Request $request, FileService $fileService, User $id): Response
	{
		$product = new Product();
		$form = $this->createForm(ProductType::class, $product);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			/** @var Product $product */
			$product = $form->getData();

			/** @var UploadedFile $file */
			$file = $form->get('file')->getData();

			if ($file) {
			    $fileService->upload($file, $product, 'photo');
			}

			$product->setChief($id);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($product);
			$entityManager->flush();

			return $this->redirectToRoute('home');
		}

		return $this->render('chef/new.product.html.twig', [
			'product' => $product,
			'form' => $form->createView(),
		]);
	}
}