<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;

use App\Repository\ScrimmsRepository;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\AggregatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class EquipeController extends AbstractController
{
    /**
     * @Route("/back", name="app_equipe")
     */
    public function index(EquipeRepository  $repository): Response
    {
        $equipes = $repository->findAll();
        return $this->render('equipe/index.html.twig',
            ['equipes' => $equipes]);

    }

    /**
     * param EquipeRepository $repository
     * @return Response
     * @Route("affichere", name="affichere")
     */
    public function affichere(EquipeRepository $repository ,\Symfony\Component\HttpFoundation\ Request $request, PaginatorInterface $paginator)
    {
        $donnees = $repository->findAll();
        /* $repo=$this->getDoctrine()->getRepository(equipe::class);*/
        $equipe = $paginator->paginate(
            $donnees ,
            $request->query->getInt('page', 1),3);

        return $this->render('equipe/affichere.html.twig',
            ['equipe' => $equipe]);

    }/*
    /**
     * @Route("/supp{id}", name="delete")
     */

         /*public function Delete($id , EquipeRepository $repository)
    {

        $equipe = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();
        $this->addFlash('success','Equipe Deleted successfully');
        return $this->redirectToRoute('affichere');

    }*/

    /**
     * @Route("addeq",  methods={"GET", "POST"})
     */
    public function Add(Request $request)
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipe=$form->getData();
            $imageFile = $form->get('photo')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'uploads/images',
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $equipe->setPhoto($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();
            $this->addFlash('success','Equipe ADDED successfully');

            return $this->redirectToRoute('affichere');

        }
        return $this->render('equipe/addeq.html.twig', [
            'forme' => $form->createView()
        ]);

    }

    /**
     * @Route("updateeq/{id}",  name="updateeq")
     */

    function update(EquipeRepository $repository,$id,Request $request)
    {
        $equipe = $repository->find($id);
        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipe=$form->getData();
            $imageFile = $form->get('photo')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'uploads/images',
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $equipe->setPhoto($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Equipe UPDATED successfully');

            return $this->redirectToRoute('affichere');

        }
        return $this->render('equipe/updateeq.html.twig', array(
            'forme' => $form->createView(),'equipe'=>$equipe));

    }




}