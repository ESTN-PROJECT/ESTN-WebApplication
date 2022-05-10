<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="display_evenement")
     */
    public function index(EvenementRepository $repository): Response
    {

        $e = $repository
            ->findAll();


        return $this->render('evenement/index.html.twig', [
            'e'=>$e,


        ]);
    }
    /**
     * @Route("/liste", name="evenement_list", methods={"GET"})
     */
    public function liste(EvenementRepository $repository): Response
    {

        $pdfOptions =new Options();
        $pdfOptions ->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $e = $repository
            ->findAll();


        $html =$this->renderView('evenement/liste.html.twig', [
            'e'=>$e,
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false]);
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
            $this->addFlash('notice','Evenement ajouter avec succèes!') ;

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
        $this->addFlash('notice','Evenement supprimer avec succèes!') ;

        return $this->redirectToRoute('display_evenement');
        /*$em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setId(20);
        $user->addEvent($evenement);

// You can use both of them at same time but using one over another is more logical as cascade={"persist"} will handle it for us.
        $evenement->addUser($user);
        $em->persist($user);


        $em->flush();
        return $this->redirectToRoute('display_evenement');*/

    }
    /**
     * @Route("/modifEvenement/{id}", name="modifEvenement")
     */
    public function modifEvenement(Request $request,$id,EvenementRepository $repository): Response
    {
        $evenement = $repository->find($id);

        $form = $this->createForm(EvenementType::class,$evenement);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('notice','Evenement modifier avec succèes!') ;

            return $this->redirectToRoute('display_evenement');
        }
        return $this->render('evenement/updateEvenement.html.twig',['event'=>$form->createView()]);

    }

    /**
     * @Route("/event/tri", name="tri")
     */
    public function orderByTitle(EvenementRepository  $repository){
        $evenement=$repository->OrderBy();
        return $this->render('evenement/index.html.twig',['e'=>$evenement]);
    }









}


