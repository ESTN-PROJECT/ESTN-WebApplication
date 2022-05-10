<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\User;
use App\Form\Discussion1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disc2")
 */
class Disc2Controller extends AbstractController
{
    public $idUser = 1;

    /**
     * @Route("/disc2", name="app_disc2_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $discussions = $entityManager
            ->getRepository(Discussion::class)
            ->findAll();
        $repo=$this->getDoctrine()->getRepository(Discussion::class);

        return $this->render('disc2/index.html.twig', [
            'discussions' => $repo->badWord($discussions),
        ]);
    }

    /**
     * @Route("/new", name="app_disc2_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $discussion = new Discussion();
        $User = $this->getDoctrine()->getRepository(User::class)->find($this->idUser);

        $form = $this->createForm(Discussion1Type::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussion->setIduser($User);
            $entityManager->persist($discussion);
            $entityManager->flush();

            return $this->redirectToRoute('app_disc2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('disc2/new.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_disc2_show", methods={"GET"})
     */
    public function show(Discussion $discussion): Response
    {
        return $this->render('disc2/show.html.twig', [
            'discussion' => $discussion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_disc2_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Discussion $discussion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Discussion1Type::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_disc2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('disc2/edit.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_disc2_delete", methods={"POST"})
     */
    public function delete(Request $request, Discussion $discussion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discussion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($discussion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_disc2_index', [], Response::HTTP_SEE_OTHER);
    }
}
