<?php

namespace App\Controller;

use App\Entity\Ninja;
use App\Repository\NinjaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CountNinjasController extends AbstractController
{

    public function __invoke(NinjaRepository $ninjaRepository): int
    {
        $count = $ninjaRepository->countNinja();
        return $count;
    }
}
