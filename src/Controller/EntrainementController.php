<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Form\EntrainementType;
use App\Repository\EntrainementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;
use Symfony\Component\Routing\Annotation\Route;


class EntrainementController extends AbstractController
{
    /**
     * @Route("/entrainement", name="app_entrainement")
     */
    public function index(): Response
    {
        return $this->render('entrainement/index.html.twig', [
            'controller_name' => 'EntrainementController',
        ]);
    }

    /**
     * param EntrainementRepository $repository
     * @return Response
     * @Route("afficheEntrainement", name="afficherE")
     */
    public function afficher(EntrainementRepository $repository)
    {
        // $repo=$this->getDoctrine()->getRepository(jeu::class);
        $entrainement = $repository->findAll();
        return $this->render('entrainement/afficher.html.twig',
            ['entrainement' => $entrainement]);

    }

    /**
     * @Route("addentrainement", name="addentrainement", methods={"GET", "POST"})
     */
    public function Add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $entrainement = new entrainement();
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sid    = "ACb5635ae19626917dc7354fd3f8798bab";
            $token  = "16df83985b099f0ea84637fa674e5bd5";
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create("+21623918957", // to
                    array(
                        "messagingServiceSid" => "MGee0097c5869c24d303e9df532f793c5d",
                        "body" => "An Request Training id Added . Please Check Your List "
                    )
                );

            print($message->sid);

            $em = $this->getDoctrine()->getManager();

            $em->persist($entrainement);
            $em->flush();
            $this->addFlash('success','Training Added successfully');

            return $this->redirectToRoute('addentrainement');
        }
        return $this->render('entrainement/add.html.twig', [
            'formE' => $form->createView()
        ]);

    }

    /**
     * @Route("/supp/{id}", name="delete")
     */
    public function Delete($id , EntrainementRepository  $repository)
    {
        $entrainement = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($entrainement);
        $em->flush();
        $this->addFlash('success','Training Deleted successfully');
        return $this->redirectToRoute('afficherE');


    }

}
