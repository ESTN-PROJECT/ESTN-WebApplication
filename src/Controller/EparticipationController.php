<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EparticipationController extends AbstractController
{
    /**
     * @Route("/eparticipation", name="app_eparticipation")
     */
    public function index(EvenementRepository $repository): Response

    {
        $e = $repository->findAll();

        return $this->render('eparticipation/index.html.twig', ['e' => $e,

        ]);

    }

    /**
     * @Route("/qrcode", name="app_eparticipation")
     */
    public function show(EvenementRepository $repository, $id): Response

    {
        $e = $repository->find($id);
        $events = $e->getTitreEvent();
        return $this->render('qrcode.html.twig', [
            'e' => $e,
            'e' => $events,
        ]);

    }

    /**
     * @Route("/particip", name="app_eparticipation")
     */
    public function indexFront(EvenementRepository $repository): Response

    {
        $e = $repository->findAll();

        return $this->render('participe.html.twig', ['e' => $e,

        ]);

    }

    /**
     * @Route("/participateEvenement/{id}", name="prtevenement")
     */

    public function participationEvenement(Evenement $evenement, $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        //$evenement= $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        $evenement->setIdEvent($evenement->getIdEvent());
      //  dump(  $evenement); die();
       // $user->addEvent($evenement);

        //You can use both of them at same time but using one over another is more logical as cascade={"persist"} will handle it for us.
        $evenement->addUser($this->getUser());
        $em->persist($evenement);


        $em->flush();
        $this->addFlash('notice', 'Done!');

        return $this->redirectToRoute('app_eparticipation');

    }


}
