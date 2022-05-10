<?php

namespace App\Controller;

use App\Entity\Forum;
use App\Form\Forum1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum2")
 */
class Forum2Controller extends AbstractController
{
    /**
     * @Route("/forum2", name="app_forum2_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $forums = $entityManager
            ->getRepository(Forum::class)
            ->findAll();

        return $this->render('forum2/index.html.twig', [
            'forums' => $forums,
        ]);
    }

    /**
     * @Route("/new", name="app_forum2_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $forum = new Forum();
        $form = $this->createForm(Forum1Type::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($forum);
            $entityManager->flush();

            return $this->redirectToRoute('app_forum2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum2/new.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_forum2_show", methods={"GET"})
     */
    public function show(Forum $forum): Response
    {
        return $this->render('forum2/show.html.twig', [
            'forum' => $forum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_forum2_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Forum1Type::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_forum2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum2/edit.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_forum2_delete", methods={"POST"})
     */
    public function delete(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($forum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum2_index', [], Response::HTTP_SEE_OTHER);
    }
}
