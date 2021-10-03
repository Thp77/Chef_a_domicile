<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class MenuController extends AbstractController
{  
    public function listAction(MenuRepository $menuRepository): Response
    {
        // dd($menuRepository->findAll());
        return $this->render('menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    public function showAction(Menu $menu): Response
    {   
       
       
        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
                  
        ]);
    }
}