<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CguController extends AbstractController
{
	public function indexAction() {
		return $this->render('cgu.html.twig');
	}
}