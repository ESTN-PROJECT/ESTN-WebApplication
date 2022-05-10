<?php

namespace App\Controller;

use App\Entity\Jeu;
use http\Env\Request;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\JeuType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\JeuRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    /**
     * @Route("/jeu", name="app_jeu")
     */
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }


    /**
     * param JeuRepository $repository
     * @return Response
     * @Route("affichejeu", name="afficherJ")
     */
    public function afficher(JeuRepository $repository)
    {
        // $repo=$this->getDoctrine()->getRepository(jeu::class);
        $jeu = $repository->findAll();
        return $this->render('jeu/afficherj.html.twig',
            ['jeu' => $jeu]);

    }

    /**
     * param JeuRepository $repository
     * @return Response
     * @Route("affichejeuF", name="affichejeuF")
     */
    public function afficherFrontPs4(JeuRepository $repository, \Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        // $repo=$this->getDoctrine()->getRepository(jeu::class);
        $jeu=$paginator->paginate(
        $jeu = $repository->findPs4(),
        $request->query->getInt('page',1),
        6);
        return $this->render('jeu/afficherFront.html.twig',
            ['jeu' => $jeu]);

    }
    /**
     * param JeuRepository $repository
     * @return Response
     * @Route("affichejeuPc", name="affichejeuPc")
     */
    public function afficherFrontPc(JeuRepository $repository, \Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        // $repo=$this->getDoctrine()->getRepository(jeu::class);
        $jeu=$paginator->paginate(
            $jeu = $repository->findPc(),
            $request->query->getInt('page',1),
            6);
        return $this->render('jeu/afficherFrontPc.html.twig',
            ['jeu' => $jeu]);

    }
    /**
     * param JeuRepository $repository
     * @return Response
     * @Route("affichejeuXbox", name="affichejeuXbox")
     */
    public function afficherFrontXbox(JeuRepository $repository, \Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        // $repo=$this->getDoctrine()->getRepository(jeu::class);
        $jeu=$paginator->paginate(
            $jeu = $repository->findXbox(),
            $request->query->getInt('page',1),
            6);
        return $this->render('jeu/afficherFrontXbox.html.twig',
            ['jeu' => $jeu]);

    }
    /**
     * @Route("addjeu", name="addjeu" ,methods={"GET", "POST"})
     */
    public function Add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $jeu = new jeu();
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $new=$form->getData();
            $imageFile = $form->get('image')->getData();
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
                $jeu->setImage($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush();
            $this->addFlash('success','Game Added successfully');

            return $this->redirectToRoute('afficherJ');
        }
        return $this->render('jeu/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/supp/{id}", name="deletej")
     */
    public function Delete($id , JeuRepository  $repository)
    {
        $jeu = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($jeu);
        $em->flush();
        $this->addFlash('success','Game Deleted successfully');
        return $this->redirectToRoute('afficherJ');

    }


    /**
     * @Route("update/{id}",  name="updatej")
     */
    function update(JeuRepository $repository, $id,\Symfony\Component\HttpFoundation\Request $request )
    {
        $jeu = $repository->find($id);
        $form = $this->createForm(JeuType::class, $jeu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $new=$form->getData();
            $imageFile = $form->get('image')->getData();
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
                $jeu->setImage($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush();

            $this->addFlash('success','Game UPDATED successfully');

            return $this->redirectToRoute('afficherJ');
        }
        return $this->render('jeu/update.html.twig', [
            'formj' => $form->createView()
        ]);

    }

    /**
     * @IsGranted("ROLE_Jeu")
     * @Route("/jeu/", name="recherche", methods={"GET", "POST"})
     */
    public function Recherche(JeuRepository $jeuRepository,\Symfony\Component\HttpFoundation\Request  $request,PaginatorInterface $paginator): Response
    {
        $back = null;
        if ( $request->isMethod('POST')) {

            if ( $request->request->get('optionsRadios')){
                $SortKey = $request->request->get('optionsRadios');
                switch ($SortKey){
                    case 'nom':
                        $jeu = $jeuRepository->SortByNom();
                        break;
                }
            }
            else
            {
                $type = $request->request->get('optionsearch');
                $value = $request->request->get('Search');
                switch ($type){
                    case 'nom':
                        $jeu = $jeuRepository->findByNom($value);
                        break;


                }
            }


            if ( $jeu){
                $back = "success";
            }else{
                $back = "failure";
            }

            $jeuPaginator = $paginator->paginate(
                $jeu, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
            );

            return $this->render('user/afficherFront.html.twig', [
                'jeu' => $jeuPaginator,
                'back' => $back,
            ]);
        }

        $jeu = $jeuRepository->findAll();
        $jeuPaginator = $paginator->paginate(
            $jeu, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('user/afficherFront.html.twig', [
            'jeu' => $jeuPaginator,
            'back' => $back,
        ]);
    }

    /**
     * @Route("detail/{id}", name="jeu_detail")
     */
    public function detailP(Jeu $jeu): Response
    {

        return $this->render('jeu/detail.html.twig', [
            'jeu' => $jeu,
        ]);
    }

    /**
     * @Route("statjeu", name="statjeu")
     */
    public function jeu_stat(JeuRepository  $jeuRepository): Response
    {
        $nbrs[] = array();

        $e1 = $jeuRepository->find_Nb_Rec_Par_Status("ps4");
        dump($e1);
        $nbrs[] = $e1[0][1];


        $e2 = $jeuRepository->find_Nb_Rec_Par_Status("xbox");
        dump($e2);
        $nbrs[] = $e2[0][1];


        $e3 = $jeuRepository->find_Nb_Rec_Par_Status("pc");
        dump($e3);
        $nbrs[] = $e3[0][1];



        /*
                $e3=$activiteRepository->find_Nb_Rec_Par_Status("Diffence");
                dump($e3);
                $nbrs[]=$e3[0][1];
        */

        dump($nbrs);
        reset($nbrs);
        dump(reset($nbrs));
        $key = key($nbrs);
        dump($key);
        dump($nbrs[$key]);

        unset($nbrs[$key]);

        $nbrss = array_values($nbrs);
        dump(json_encode($nbrss));

        return $this->render('jeu/statjeu.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }



}
