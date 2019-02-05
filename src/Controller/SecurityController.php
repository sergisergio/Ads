<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $auth): Response
    {
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();
        return $this->render('security/login.html.twig', [
           'last_username' => $lastUsername,
           'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout() {}

    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request, ObjectManager $om, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($hash);
            $user->setRoles(['ROLE_USER']);
            $om->persist($user);
            $om->flush();

            $this->addFlash('success', 'Votre inscription a bien été prise en compte');
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/register.html.twig', [
            'formRegister' => $form->createView(),
        ]);
    }
}
