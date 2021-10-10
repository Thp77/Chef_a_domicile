<?php

namespace App\Controller\Chef;

use App\Entity\Menu;
use App\Entity\User;
use App\Form\MenuType;
use App\Entity\Product;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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
		$aperitifs = $form['aperitif']->getData();
		foreach ($aperitifs as $aperitif) {
		    $menu->addProduct($aperitif);
		}

		$entrees = $form['entree']->getData();
		foreach ($entrees as $entree) {
			$menu->addProduct($entree);
		}

		$plats = $form['plat']->getData();
		foreach ($plats as $plat) {
			$menu->addProduct($plat);
		}

		$desserts = $form['dessert']->getData();
		foreach ($desserts as $dessert) {
			$menu->addProduct($dessert);
		}
		
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
	    $user = $this->getUser();

	    $form = $this->createForm(MenuType::class, $menu, ['user' => $user]);
	    $form->handleRequest($request);
    
	    if ($form->isSubmitted() && $form->isValid()) {

            $menu->clearProducts();

            $aperitifs = $form['aperitif']->getData();
            foreach ($aperitifs as $aperitif) {
                $menu->addProduct($aperitif);
            }

            $entrees = $form['entree']->getData();
            foreach ($entrees as $entree) {
                $menu->addProduct($entree);
            }

            $plats = $form['plat']->getData();
            foreach ($plats as $plat) {
                $menu->addProduct($plat);
            }

            $desserts = $form['dessert']->getData();
            foreach ($desserts as $dessert) {
                $menu->addProduct($dessert);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_list', [], Response::HTTP_SEE_OTHER);
	    }
    
	    return $this->renderForm('menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
	    ]);
	}
    
	public function deleteAction(Request $request, Menu $menu, EntityManagerInterface $em): Response
	{
        $em->remove($menu);
        $em->flush();

	    return $this->redirectToRoute('menu_list', [], Response::HTTP_SEE_OTHER);
	}
}
    
    
