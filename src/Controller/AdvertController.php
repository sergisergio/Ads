<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Category;
use App\Form\AddAdvertType;
use App\Form\DepartmentType;
use App\Repository\AdvertRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdvertController extends AbstractController
{
    /**
     * @Route("/adverts", name="adverts")
     */
    public function index(AdvertRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository(Advert::class)->findAll();

        $q = $request->query->get('q');
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        $form = $this->createForm(DepartmentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $q = $request->query->get('q');
            $queryBuilder = $repository->getByDepartmentQueryBuilder($q);

            $pagination = $paginator->paginate(
                $queryBuilder, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );
            /*return $this->render('advert/index.html.twig', [
                //'listAdverts' => $listAdverts,
                'pagination' => $pagination,
                'formSearch' => $form->createView(),
            ]);*/

        }

        return $this->render('advert/index.html.twig', [
            //'listAdverts' => $listAdverts,
            'pagination' => $pagination,
            'formSearch' => $form->createView(),
        ]);
    }

    /**
     * @Route("/advert/add", name="add_advert")
     */
    public function add(Request $request, ObjectManager $manager)
    {
        $advert = new Advert();
        $form = $this->createForm(AddAdvertType::class, $advert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $advert->setDate(new \DateTime());
            $advert->setAuthor($this->getUser());

            $manager->persist($advert);
            $manager->flush();

            $this->addFlash('success', 'Votre annonce a bien été ajoutée');
            return $this->redirectToRoute('advert', ['id' => $advert->getId()]);
        }
        return $this->render('advert/add.html.twig', [
            'formAddAdvert' => $form->createView(),
        ]);
    }

    /**
     * @Route("/advert/{id}", name="advert")
     */
    public function view($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        if (null == $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas");
        }
        return $this->render('advert/view.html.twig', [
            'advert' => $advert,
        ]);
    }

    /**
     * @Route("/advert/edit/{id}", name="edit_advert")
     *
     */
    public function edit(Advert $advert, Request $request, ObjectManager $manager)
    {
        //$advert = $this->getDoctrine()->getRepository(Advert::class)->find($id);
        if (null == $advert) {
            throw new NotFoundHttpException("Pas d\'annonce avec cet identifiant");
        }
        if ($advert->getAuthor() === $this->getUser()) {
            $form = $this->createForm(AddAdvertType::class, $advert);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $advert->setAuthor($this->getUser());

                $advert->setPublished(false);

                $categories = $advert->getCategories();

                // On boucle sur les catégories pour les lier à l'annonce
                foreach ($categories as $category) {
                    $advert->addCategory($category);
                }

                //$manager->persist($advert);
                $manager->flush();
                $this->addFlash(
                    'notice',
                    'L\'annonce a bien été modifiée! En attente de validation par l\'administrateur'
                );
                return $this->redirectToRoute('advert', ['id' => $advert->getId()]);
            }
            return $this->render('advert/edit.html.twig', [
                'advert' => $advert,
                'formEditAdvert' => $form->createView()
            ]);
        } else {
            $this->addFlash('warning', 'Vous devez être l\'auteur pour modifier cette annonce !');
            return $this->redirectToRoute('advert', ['id' => $advert->getId()]);
        }
    }

    /**
     * Supprimer une annonce
     *
     * @Route("/advert/delete/{id}", name="delete_advert")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository(Advert::class)->find($id);
        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." nexiste pas");
        }
        if ($advert->getAuthor() === $this->getUser()) {
            $em->remove($advert);
            $em->flush();
            $this->addFlash(
                'notice',
                'L\'annonce a bien été supprimée!'
            );
        } else {
            $this->addFlash('notice', 'Vous devez être l\'auteur pour supprimer cette annonce !');
            return $this->redirectToRoute('view', ['id' => $advert->getId()]);
        }
        return $this->redirectToRoute('home');
    }
}
