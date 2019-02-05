<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function index()
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/account/cv", name="add_cv")
     */
    public function curriculum()
    {
        return $this->render('account/cv.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
