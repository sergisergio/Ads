<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Application;
use App\Form\ApplicationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    /**
     * @Route("/application/annonce_{id}", name="application")
     */
    public function index(Request $request, ObjectManager $manager, $id)
    {
        $advert = $manager->getRepository(Advert::class)->find($id);
        $application = new Application();

        //if ($advert->getAuthor() === $this->getUser()) {
            $form = $this->createForm(ApplicationType::class, $application);
            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $application->setAdvert($advert);
            $application->setAuthor($this->getUser());
            $manager->persist($application);
            $manager->flush();

            $this->addFlash('success', 'Votre inscription a bien été prise en compte');
            return $this->redirectToRoute('advert', ['id' => $advert->getId()]);
        }
        //}
        //else {
        //    $this->addFlash('danger', 'Vous devez être connecté pour postuler à cette annonce !');
        //    return $this->redirectToRoute('advert', ['id' => $advert->getId()]);
        //}
        return $this->render('application/index.html.twig', [
            'formApplication' => $form->createView(),
            'advert' => $advert,
        ]);
    }
}
