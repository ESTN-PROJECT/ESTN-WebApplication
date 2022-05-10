<?php

namespace App\Controller;

use App\Repository\ScrimmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScrimmsBackController extends AbstractController
{
    /**
     * @Route("/scrimmsback", name="scrimmsback")
     */
    public function index(ScrimmsRepository  $repository): Response
    {
        $scrimmss = $repository->findAll();
        return $this->render('scrimms_back/index.html.twig',
            ['scrimmss' => $scrimmss]);

    }
    /**
     * param ScrimmsRepository $repository
     * @return Response
     * @Route("index", name="index")
     */
    public function showsb(ScrimmsRepository $repository ,\Symfony\Component\HttpFoundation\Request $request)
    {
        /*  $repo=$this->getDoctrine()->getRepository(scrimms::class);
         $scrimms = $paginator->paginate(*/
        $scrimms = $repository->findAll();
        /*  $request->query->getInt('page', 1),
          3
      );*/

        return $this->render('scrimms_back/index.html.twig',
            ['scrimms' => $scrimms]);

    }
    /*/**
     * @Route("/supp{id}", name="delete")
     */

    /*public function Delete($id , ScrimmsRepository $repository)
{

   $scrimms = $repository->find($id);
   $em = $this->getDoctrine()->getManager();
   $em->remove($scrimms);
   $em->flush();
   $this->addFlash('success','Scrimms Deleted successfully');
   return $this->redirectToRoute('index');

}*/
}
