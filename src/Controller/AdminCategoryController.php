<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_categories")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Cette catégorie a bien été ajoutée');
            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin_category/index.html.twig', [
            'categories' => $categories,
            'formCategory' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/category/delete/{id}", name="delete_category")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'Cette catégorie a bien été supprimée');
        return $this->redirectToRoute('admin_categories');
    }

}
