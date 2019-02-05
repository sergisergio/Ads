<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Application;
use App\Entity\User;
use App\Form\AccountType;
use App\Repository\ApplicationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account/cv", name="add_cv")
     */
    public function curriculum()
    {
        return $this->render('account/cv.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/account/{id}", name="account")
     */
    public function view($id, Request $request, ObjectManager $manager)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if (null === $user) {
            throw new NotFoundHttpException("L'utilisateur ".$id." n'existe pas");
        }
        //dump($this->getUser()->getEmail());die();
        if ($user->getEmail() === $this->getUser()->getEmail()) {
            $form = $this->createForm(AccountType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user->setEmail($this->getUser()->getEmail());
                $manager->persist($user);
                $manager->flush();
                $this->addFlash(
                    'notice',
                    'Votre compte a bien été modifié!'
                );
                dump($request); die();
                return $this->redirectToRoute('account', ['id' => $user->getId()]);
            }
            return $this->render('account/index.html.twig', [
                'user' => $user,
                'formAccount' => $form->createView()
            ]);
        } else {
            $this->addFlash('warning', 'Vous ne pouvez pas accéder à cette page !');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/account/myadverts/{id}", name="my_adverts")
     */
    public function myAdverts($id)
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $this->getDoctrine()->getRepository(Advert::class)->findByAuthor($this->getUser());

        return $this->render('account/myadverts.html.twig', [
            'adverts' => $adverts
        ]);
    }

    /**
     * @Route("/account/myadvert/applications/{id}", name="list_applications")
     */
    public function ApplicationsByAdvert($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $this->getDoctrine()->getRepository(Advert::class)->find($id);

        $listApplications = $em
            ->getRepository(Application::class)
            ->findBy(['advert' => $advert])
        ;

        return $this->render('account/applications.html.twig', [
            'advert' => $advert,
            'listApplications' => $listApplications
        ]);
    }
}
