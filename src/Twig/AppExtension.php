<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
	public function getFilters()
	{
		return [
			new TwigFilter('resizeList', [$this, 'resizeList'],),
			new TwigFilter('resizeForMenu', [$this, 'resizeForMenu'],)
		];
	}

	public function resizeList(string $imagePath, string $alt='', string $class=''): string
	{
	return '<img src="' . $imagePath .'" alt="' . $alt .'" class="img-fitt py-2 ' . $class .'"/>';
	}

	public function resizeForMenu(string $imagePath, string $alt='', string $class=''): string
	{
	return '<img src="' . $imagePath .'" alt="' . $alt .'" class="img-menu d-block img-fluid' . $class .'"/>';
	}

	
}

