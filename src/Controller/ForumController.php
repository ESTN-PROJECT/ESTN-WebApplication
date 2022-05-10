<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\Forum;
use App\Entity\User;
use App\Form\ForumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum")
 */
class ForumController extends AbstractController
{
    public $idUser= 1;
    /**
     * @Route("/forum", name="app_forum_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $forums = $entityManager
            ->getRepository(Forum::class)
            ->findAll();

        return $this->render('forum/index.html.twig', [
            'forums' => $forums,
        ]);
    }

    /**
     * @Route("/new", name="app_forum_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $forum = new Forum();
        $discussion = new Discussion();
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);
        $User=$this->getDoctrine()->getRepository(User::class)->find($this->idUser);


        if ($form->isSubmitted() && $form->isValid()) {
            $forum->setIduser($User);
            $discussion->setIdforum($forum);
            $discussion->setContenu("");
            $entityManager->persist($forum);
            $entityManager->flush();


            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum/new.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_forum_show", methods={"GET"})
     */
    public function show(Forum $forum): Response
    {
        return $this->render('forum/show.html.twig', [
            'forum' => $forum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_forum_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum/edit.html.twig', [
            'forum' => $forum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_forum_delete", methods={"POST"})
     */
    public function delete(Request $request, Forum $forum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($forum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
