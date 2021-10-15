<?php

namespace App\Controller;

// use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{

    // public function __construct(Security $security)
    // {
    // }

    public function __invoke()
    {
        // $user = $this->security->getUser();
        $user = $this->getUser();
        return $user;
    }
}
