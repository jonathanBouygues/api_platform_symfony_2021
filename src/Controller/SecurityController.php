<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{

    /**
     * @Route("/api/login", name="api_login", methods={"GET","POST"})
     */
    public function login()
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getEmail(),
            'roles' => $user->getRoles()
        ]);
    }
}
