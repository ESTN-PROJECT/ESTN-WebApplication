<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class EquipeFrontController extends AbstractController
{

    /**
     * @Route("addeqF",  methods={"GET", "POST"})
     */
    public function AddF(Request $request)
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

            return $this->redirectToRoute('afficherF');

        }
        return $this->render('equipe_front/addeqF.html.twig', [
            'forme' => $form->createView()
        ]);

    }
    /**
     * param EquipeRepository $repository
     * @return Response
     * @Route("allteams", name="allteams")
     */
    public function allteams(EquipeRepository $repository ,\Symfony\Component\HttpFoundation\Request $request)
    {
        /*  $repo=$this->getDoctrine()->getRepository(equipe::class);
         $equipe = $paginator->paginate(*/
        $equipe = $repository->findAll();
        /*  $request->query->getInt('page', 1),
          3
      );*/

        return $this->render('equipe_front/afficherF.html.twig',
            ['equipe' => $equipe]);

    }
    /**
     * param EquipeRepository $repository
     * @return Response
     * @Route("afficherF", name="afficherF")
     */
    public function afficherF(EquipeRepository $repository ,\Symfony\Component\HttpFoundation\Request $request)
    {
        /*  $repo=$this->getDoctrine()->getRepository(equipe::class);
         $equipe = $paginator->paginate(*/
        $equipe = $repository->findAll();
        /*  $request->query->getInt('page', 1),
          3
      );*/

        return $this->render('equipe_front/afficherF.html.twig',
            ['equipe' => $equipe]);

    }
    /**
     * @Route("/supprimer/{id}", name="delete")
     */

    public function Delete($id , EquipeRepository $repository)
{

   $equipe = $repository->find($id);
   $em = $this->getDoctrine()->getManager();
   $em->remove($equipe);
   $em->flush();
   $this->addFlash('success','Equipe Deleted successfully');
   return $this->redirectToRoute('afficherF');

}
    /**
     * @Route("updateeqF/{id}",  name="updateeqF")
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

            return $this->redirectToRoute('afficherF');

        }
        return $this->render('equipe_front/updateeqF.html.twig', array(
            'formeq' => $form->createView(),'equipe'=>$equipe));

    }
    public function searchAction(Request $request ,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Equipe::class);
        $requestString= $request->get('searchValue');
        $equipe = $repository->findBystring($requestString);
        $jsonContent = $Normalizer->normalize($equipe, 'json',['groups'=>'Equipe']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }
}
