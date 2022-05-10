<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Repository\EquipeRepository;
use App\Repository\ScrimmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Scrimms;
use App\Form\ScrimmsType;
class ScrimmsController extends AbstractController
{

    /**
     * @Route("/scrimms", name="scrimms")
     */
    public function index(ScrimmsRepository $repository): Response
    {
        $scrimmss = $repository->findAll();


        return $this->render('scrimms/afficher.html.twig',
            ['scrimms' => $scrimmss]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function addScrimms(Request $request)
    {
        $scrimms = new Scrimms();/*$user2 = $this->getUser()*/;

        $form = $this->createForm(ScrimmsType::class, $scrimms);
        /* $scrimms->setOrganisteur($user2);*/
        $form->handleRequest($request);
        $type = "ajouter";
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            /* $uploadedFile = $form['imageFile']->getData();
             $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
             $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
             $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
             $uploadedFile->move(
                 $destination,
                 $newFilename
             );
             $scrimms->setImage($newFilename);*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($scrimms);
            $em->flush();


            return $this->redirectToRoute("scrimms");

        }
        return $this->render("scrimms/add.html.twig", array("forms" => $form->createView(), "type" => $type));
    }


    /**
     * @Route("/deletes{id}", name="deletes")
     */

    public function deletes($id, ScrimmsRepository $repository)
    {

        $scrimms = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($scrimms);
        $em->flush();
        $this->addFlash('success', 'MATCH Deleted successfully');
        return $this->redirectToRoute('scrimms');

    }


    /**
     * @Route("/update/{id}",name="update")
     */
    public function updateScrimms(ScrimmsRepository $s, $id, Request $request)
    {
        $scrimms = $s->find($id);
        $formScrimms = $this->createForm(ScrimmsType::class, $scrimms);
        $formScrimms->handleRequest($request);
        $type = "modifier";
        if ($formScrimms->isSubmitted() && $formScrimms->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("scrimmss");
        }
        return $this->render("scrimms/update.html.twig", array("forms" => $formScrimms->createView(), "type" => $type, "scrimms" => $scrimms));
    }

    /**
     * @Route("/calendar",name="calendar")
     */
    public function calendar(ScrimmsRepository $repository): Response
    {
        $events = $repository->findAll();
        $srimms = [];
  /*      dd($events);*/
        foreach ($events as $event) {
            $srimms[] = [
                'id' => $event->getId(),
                'title' => $event->getNomEq1()." VS ".$event->getNomEq2(),
                'start' => $event->getDateDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'backgroundColor' => "#6B2F34",
                'borderColor' => "#65727B",
                'textColor' => "#65727B"
            ];


        }
        $data= json_encode($srimms);
        return $this->render('scrimms/calendar.html.twig'
            ,compact('data'));
    }
    /**
     * @Route("/calendar/{id}/edit", name="calendar_tournoi_edit", methods={"PUT"})
     */
    public function majEvent(?Scrimms $scrimms, Request $request)
    {

        $donnees = json_decode($request->getContent());


            // On hydrate l'objet avec les données

        $scrimms->setDateDebut(new \DateTime($donnees->start));

        $scrimms->setDateFin(new \DateTime($donnees->end));


        $em = $this->getDoctrine()->getManager();
        $em->persist($scrimms);
        $em->flush();

        return new Response('Ok');

    }
}



