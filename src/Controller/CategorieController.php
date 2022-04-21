<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use http\Env\Request;
use Knp\Component\Pager\PaginatorInterface;



class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categorie")
     */
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    /**
     * param CategorieRepository $repository
     * @return Response
     * @Route("afficherc", name="afficherc")
     */
    public function afficher(CategorieRepository  $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator)
    {
        $categorie = $paginator->paginate(
            $categorie = $repository->findAll(),
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('Categorie/afficherc.html.twig',
            ['Categorie' => $categorie]);

    }
    /**
     * @Route("/supp {idCategorie}", name="delete")
     */
    public function Delete($idCategorie , CategorieRepository $repository)
    {

        $categorie = $repository->find($idCategorie);
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        $this->addFlash('success','Categorie Deleted successfully');
        return $this->redirectToRoute('afficherc');

    }
    /**
     * @Route("addc",  methods={"GET", "POST"})
     */
    public function Add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $this->addFlash('success','Categorie ADED successfully');

            return $this->redirectToRoute('afficherc');

        }
        return $this->render('categorie/addc.html.twig', [
            'formc' => $form->createView()
        ]);

    }
    /**
     * @Route("updatecat/{idCategorie}",  name="updatecat")
     */
    function update(CategorieRepository $repository, $idCategorie,\Symfony\Component\HttpFoundation\Request $request)
    {
        $categorie = $repository->find($idCategorie);
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Categorie UPDATED successfully');

            return $this->redirectToRoute('afficherc');

        }
        return $this->render('categorie/updatec.html.twig', [
            'formcat' => $form->createView()
        ]);
    }

}
