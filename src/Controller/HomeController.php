<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
	public function indexAction() {
		return $this->render('home.html.twig');
	}
}