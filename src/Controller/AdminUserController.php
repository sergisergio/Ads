<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $listUsers = $em->getRepository(User::class)->findAll();
        return $this->render('admin_user/index.html.twig', [
            'users' => $listUsers,
        ]);
    }

    /**
     * @Route("/admin/users/adminOn/{id}", name="admin_on")
     */
    public function adminOn($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        $user->setRoles(['ROLE_ADMIN']);
        $em->flush();

        $this->addFlash('success', 'Ce membre est désormais administrateur');
        return $this->redirectToRoute('admin_users');
    }

    /**
     * @Route("/admin/users/adminOff/{id}", name="admin_off")
     */
    public function adminOff($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        $user->setRoles(['ROLE_USER']);
        $em->flush();

        $this->addFlash('success', 'Ce membre n\'est plus administrateur');
        return $this->redirectToRoute('admin_users');
    }
}
