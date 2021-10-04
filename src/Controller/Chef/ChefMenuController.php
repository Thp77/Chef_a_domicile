<?php

namespace App\Controller\Chef;

use App\Entity\Menu;
use App\Entity\User;
use App\Form\MenuType;
use App\Entity\Product;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChefMenuController extends AbstractController
{
	public function newAction(Request $request, User $user): Response
	{
	    $menu = new Menu();
	    $form = $this->createForm(MenuType::class, $menu, ['user'=>$user]);
	    $form->handleRequest($request);
    
	    if ($form->isSubmitted() && $form->isValid()) {
		//     dd($form['aperitif']->getData()->toString());
		// $menu->addProduct($form['aperitif'])
		// ->addProduct($form['entree'])
		// ->addProduct($form['plat'])
		// ->addProduct($form['dessert']);
		
		$menu->setChief($user);
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($menu);
		$entityManager->flush();
    
		return $this->redirectToRoute('menu_list', [], Response::HTTP_SEE_OTHER);
	    }
    
	    return $this->renderForm('menu/new.html.twig', [
		'menu' => $menu,
		'form' => $form,
	    ]);
	}
    
       
    
	public function editAction(Request $request, Menu $menu): Response
	{
	    $form = $this->createForm(MenuType::class, $menu);
	    $form->handleRequest($request);
    
	    if ($form->isSubmitted() && $form->isValid()) {
		$this->getDoctrine()->getManager()->flush();
    
		return $this->redirectToRoute('menu_list', [], Response::HTTP_SEE_OTHER);
	    }
    
	    return $this->renderForm('menu/edit.html.twig', [
		'menu' => $menu,
		'form' => $form,
	    ]);
	}
    
	public function deleteAction(Request $request, Menu $menu): Response
	{
	    if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($menu);
		$entityManager->flush();
	    }
    
	    return $this->redirectToRoute('menu_list', [], Response::HTTP_SEE_OTHER);
	}
    }
    
