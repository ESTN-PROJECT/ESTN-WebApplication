<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\Forum;
use App\Entity\User;
use App\Form\DiscussionType;
use App\Repository\DiscussionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discussion")
 */
class DiscussionController extends AbstractController
{

    public $idUser = 1;
    /**
     * @Route("/discussion", name="app_discussion_index", methods={"Get"})
     */
    public function index(Request $request,EntityManagerInterface $entityManager,PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Discussion::class)->findBy([], ['id' => 'desc']);
        $repo = $this->getDoctrine()
            ->getRepository(Discussion::class);
        $discussions = $entityManager
            ->getRepository(Discussion::class)
            ->findAll();
        $discussions = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            2 // Nombre de résultats par pagech
        );
        return $this->render('discussion/index.html.twig', [
            'discussions' => $discussions
        ]);
    }

    /**
     * @Route("/new", name="app_discussion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $f1=new Forum();
        $sujet=$request->get('types');

        $discussion = new Discussion();
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);
        $User=$this->getDoctrine()->getRepository(User::class)->find($this->idUser);
        $f1=$this->getDoctrine()->getRepository(Forum::class)->findBy(['sujet'=>$sujet]);
        $fourms=$this->getDoctrine()->getRepository(Forum::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $discussion->setIduser($User);
            $discussion->setForum($f1);
            $entityManager->persist($discussion);
            $entityManager->flush();

            return $this->redirectToRoute('app_discussion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('discussion/new.html.twig', [
            'discussion' => $discussion,
            'forums'=>$fourms,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_discussion_show", methods={"GET"})
     */
    public function show(Discussion $discussion): Response
    {
        return $this->render('discussion/show.html.twig', [
            'discussion' => $discussion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_discussion_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Discussion $discussion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_discussion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('discussion/edit.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_discussion_delete", methods={"POST"})
     */
    public function delete(Request $request, Discussion $discussion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discussion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($discussion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_discussion_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/disc/dis", name="app_discussion", methods={"Get"})
     */
    public function getDiscussion(Request $request,EntityManagerInterface $entityManager): Response
    {

        $idForum=$request->get('idforum');
        $repo= $this->getDoctrine()
            ->getRepository(Discussion::class);
        $discussions = $entityManager
            ->getRepository(Discussion::class)
            ->findBy(['idforum'=>$idForum]);

        return $this->render('discussion/discussion.html.twig', [
            'discussions' => $repo->badWord($discussions)
        ]);
    }
}
