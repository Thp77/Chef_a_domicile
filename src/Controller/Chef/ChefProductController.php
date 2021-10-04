<?php

namespace App\Controller\Chef;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\FileService;
use App\Form\ProductEditType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChefProductController extends AbstractController
{
	public function listAction(ProductRepository $productRepository, User $id)
	{
		return $this->render('chef/list.product.html.twig', [
			'products' => $productRepository->findByChief($id),
		]);
	}

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

			return $this->redirectToRoute('chef_list_products', ['id' => $product->getChief()->getId()]);
		}

		return $this->render('chef/new.product.html.twig', [
			'product' => $product,
			'form' => $form->createView(),
		]);
	}

	public function editAction(Request $request, Product $product, FileService $fileService): Response
	{
		$chef = $product->getChief()->getId();
		
		$form = $this->createForm(ProductEditType::class, $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			/** @var Product $film */
			$product = $form->getData();

			/** @var UploadedFile $file */
			$file = $form->get('file')->getData();

			if ($file) {
				$fileService->upload($file, $product, 'photo');
			}

			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('chef_list_products', ['id' => $chef]);
		}

		return $this->renderForm('chef/product.edit.html.twig', [
		'product' => $product,
		'form' => $form,
		]);
	}

	public function deleteAction($id, FileService $fileService) {
		$product = $this->getDoctrine()->getRepository(Product::class)->find($id);
		//remove the image file
		$fileService->remove($product, 'photo');
		$manager = $this->getDoctrine()->getManager();
		$manager->remove($product);
		$manager->flush();
		return $this->redirectToRoute('chef_list_products', ['id' => $product->getChief()->getId()]);
	}

}