<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Discussion;
use App\Entity\User;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/actualite")
 */
class ActualiteController extends AbstractController
{

    public $idUser = 1;


    /**
     * @Route("/actualite", name="app_actualite_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $actualites = $entityManager
            ->getRepository(Actualite::class)
            ->findAll();

        return $this->render('actualite/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    /**
     * @Route("/new", name="app_actualite_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $User = $this->getDoctrine()->getRepository(User::class)->find($this->idUser);
        $actualite = new Actualite();
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actualite->setIduser($User);
            $imageFile = $form->get('photo')->getData();
            if($imageFile != null){
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move('uploads/images',
                        $newFilename
                    );
                }

                catch
                (FileException $e) {
                }
                $actualite->setPhoto($newFilename);

            }
            $entityManager->persist($actualite);
            $entityManager->flush();

            return $this->redirectToRoute('app_actualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actualite/new.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_actualite_show", methods={"GET"})
     */
    public function show(Actualite $actualite): Response
    {
        return $this->render('actualite/show.html.twig', [
            'actualite' => $actualite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_actualite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Actualite $actualite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_actualite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actualite/edit.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_actualite_delete", methods={"POST"})
     */
    public function delete(Request $request, Actualite $actualite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actualite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($actualite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_actualite_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/triH/", name="tri")
     */
    public function Tri(Request $request, ActualiteRepository $repository): Response
    {
        // Retrieve the entity manager of Doctrine
        $order = $request->get('types');
        if ($order == "Décroissant") {
            $actualites = $repository->tri_asc();
        } else {

            $actualites = $repository->tri_desc();
        }
        // Render the twig view
        return $this->render('actualite/index.html.twig', ['actualites' => $actualites
        ]);
    }

    public function img(){
        $imageFile ="";

        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
        try {
            $imageFile->move('uploads/images',
                $newFilename
            );
        }

        catch
        (FileException $e) {
        }
    }
    /**
     * @Route("/ind/ind", name="front_index", methods={"GET"})
     */
    public function frontindex(Request $request,EntityManagerInterface $entityManager,PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Actualite::class)->findBy([], ['id' => 'desc']);

        $actualites = $entityManager
            ->getRepository(Actualite::class)
            ->findAll();
        $actualites= $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par pagech
        );
        return $this->render('actualite/frontactualite.html.twig', [
            'actualites' => $actualites,
        ]);
    }
}
