<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdvertController extends AbstractController
{
    /**
     * @Route("/admin/advert", name="admin_advert")
     */
    public function index()
    {
        return $this->render('admin_advert/index.html.twig', [
            'controller_name' => 'AdminAdvertController',
        ]);
    }
}
