<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminAdvertController extends AbstractController
{
    /**
     * @Route("/admin/advert", name="admin_adverts")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository(Advert::class)->findAll();
        return $this->render('admin_advert/index.html.twig', [
            'adverts' => $listAdverts,
        ]);
    }

    /**
     * @Route("/admin/advert/unpublish/{id}", name="unpublish_advert")
     */
    public function unpublish($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        $advert->setPublished(false);
        $em->flush();

        $this->addFlash('success', 'Cette annonce a été dépubliée');
        return $this->redirectToRoute('admin_adverts');
    }

    /**
     * @Route("/admin/advert/publish/{id}", name="publish_advert")
     */
    public function publish($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        $advert->setPublished(true);
        $em->flush();

        $this->addFlash('success', 'Cette annonce a été validée');
        return $this->redirectToRoute('admin_adverts');
    }
}
