<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="display_evenement")
     */
    public function index(): Response
    {
        $evenements = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->findAll();
        return $this->render('evenement/index.html.twig', [
            'e'=>$evenements


        ]);
    }

    /**
     * @Route("/addEvenement", name="addEvenement")
     */
    public function addEvenement(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class,$evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute("display_evenement");
        }
        return $this->render('evenement/createEvenement.html.twig',['event'=>$form->createView()]);



    }
    /**
     * @Route("/removeEvenement/{id}", name="supp_evenement")
     */
    public function suppressionEvenement(Evenement  $evenement): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();

        return $this->redirectToRoute('display_evenement');


    }
    /**
     * @Route("/modifEvenement/{id}", name="modifEvenement")
     */
    public function modifEvenement(Request $request,$id): Response
    {
        $evenement = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->find($id);

        $form = $this->createForm(EvenementType::class,$evenement);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_evenement');
        }
        return $this->render('Evenement/updateEvenement.html.twig',['event'=>$form->createView()]);

    }







}
