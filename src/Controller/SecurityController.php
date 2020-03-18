<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
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
    public function logout()
    {
    }

    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request,
                             EntityManagerInterface $om,
                             UserPasswordEncoderInterface $encoder,
                             \Swift_Mailer $mailer,
                             TokenGeneratorInterface $generator)
    {

        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($hash);

            $token = $generator->generateToken();
            $user->setToken($token);

            $user->setValidation(false);

            $mode = $form->getData()->getMode();
            //dump($request);dump($mode); dump($form->getData()->getMode()); die();

            if ($mode == 1) {
                $user->setRoles(['ROLE_RECRUITER']);
            } else {
                $user->setRoles(['ROLE_CANDIDATE']);
            }
            $om->persist($user);
            $om->flush();

            $message = (new \Swift_Message('Votre inscription sur SnowTricks'))
                ->setFrom('ptraon@gmail.com')
                ->setTo($user->getEmail())
                ->setBody('Validez votre compte en cliquant sur ce <a href="http://localhost:8000/confirm?user=' . $user->getId() . '&token=' . $token . '">LIEN</a>', 'text/html');

            $mailer->send($message);

            $this->addFlash('success', 'Un mail de confirmation vous a été envoyé, cliquez sur le lien pour activer votre compte.');
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/register.html.twig', [
            'formRegister' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/confirm", name="security_confirm")
     */
    public function registerConfirm(Request $request, User $user)
    {
        $token = $request->get('token');
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }

        if (!$user) {
            throw $this->createNotFoundException();
        }

        if ($user->getToken() === $token) {
            $user->setValidation(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre compte a bien été activé');
        }
        return $this->redirecttoRoute('security_login');
    }

    /**
     * @Route("/forgotpassword", name="security_forgot")
     */
    public function forgotPassword(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $generator)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $form->getData();
            $email = $user->getEmail();


            $repository = $this->getDoctrine()->getRepository(User::class);
            $userMail = $repository->findOneBy(['email' => $email]);
            //dd($userMail);


            $token = $generator->generateToken();
            $userMail->setToken($token);

            $this->getDoctrine()->getManager()->flush();

            if ($userMail){

                $message = (new \Swift_Message('Réinitialisation de votre mot de passe'))
                    ->setFrom('ptraon@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody('<a href="http://localhost:8000/resetpassword?user=' . $userMail->getId() . '&token=' . $token . '">Réinitialiser votre mot de passe</a>', 'text/html');
                $mailer->send($message);
                $this->addFlash(
                    'success',
                    'Un mail vous a été envoyé, cliquez sur le lien pour réinitialiser votre mot de passe.'
                );
            }
            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'security/forgotpassword.html.twig', [
                'formForgotPassword' => $form->createView(),
            ]
        );
    }

    /**
     * Page pour réinitialiser son mot de passe
     *
     * @Route("/resetpassword", name="security_reset")
     */
    function resetPasswordPage(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $token = $request->get('token');
        if (!$token) {
            return new Response(new InvalidCsrfTokenException());
        }

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['token' => $request->get('token')]);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        if ($user->getToken() !== $token) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->getData();
            $hash = $encoder->encodePassword($password, $user->getPlainPassword());
            $user->setPassword($hash);
            $user->setResetToken('');
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre mot de passe a bien été réinitialisé !');
            return $this->redirectToRoute('security_login');
        }
        return $this->render(
            'security/resetpasswordpage.html.twig', [
                'formResetPassword' => $form->createView(),
            ]
        );
    }
}
