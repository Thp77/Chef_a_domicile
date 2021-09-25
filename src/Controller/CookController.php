<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CookController extends AbstractController
{
	public function listAction(UserRepository $userRepository)
	{			
		return $this->render('cook/index.html.twig',
		 ['cooks' => $userRepository->findByRole('ROLE_CHEF')]);
	}
}