<?php

namespace App\Controller;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Form\ProduitType;
use App\Entity\Produit;
use ContainerDutMyCx\PaginatorInterface_82dac15;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Options;
use Dompdf\Dompdf;

class ProduitController extends Controller
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/product.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    /**
     * param ProduitRepository $repository
     * @return Response
     * @Route("afficher", name="afficher")
     */
    public function afficher(ProduitRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator)
    {
        // $repo=$this->getDoctrine()->getRepository(produit::class);
        $produit = $paginator->paginate(
            $produit = $repository->findAll(),
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('produit/afficher.html.twig',
            ['produit' => $produit]);

    }


    /**
     * @Route("/supp/{id}", name="d")
     */
    public function Delete($id , ProduitRepository  $repository)
    {
        $produit = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        $this->addFlash('success','Product Deleted successfully');
        return $this->redirectToRoute('afficher');

    }

    /**
     * @Route("addp",  methods={"GET", "POST"})
     */
    public function Add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $produit = new produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $produit=$form->getData();
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
                $produit->setPhoto($newFilename);
            }
            $em = $this->getDoctrine()->getManager();

            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('afficher');
        }
        return $this->render('produit/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("update/{id}",  name="update")
     */
    function update(ProduitRepository $repository, $id,\Symfony\Component\HttpFoundation\Request $request )
    {
        $produit = $repository->find($id);
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit=$form->getData();
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
                $produit->setPhoto($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->addFlash('success','Product UPDATED successfully');

            return $this->redirectToRoute('afficher');
        }
        return $this->render('produit/update.html.twig', [
            'formf' => $form->createView()
        ]);

    }
    /**
     * param ProduitRepository $repository
     * @return Response
     * @Route("afficherF", name="afficherF")
     */
    public function afficherF(ProduitRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator)
    {
        // $repo=$this->getDoctrine()->getRepository(produit::class);
        $produit = $paginator->paginate(
            $produit = $repository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('produit/afficherF.html.twig',
            ['produit' => $produit]);

    }
    /**
     * @Route("detail/{id}", name="produit_detail")
     */
    public function detailP(Produit $produit): Response
    {

        return $this->render('produit/detailspro.html.twig', [
            'produit' => $produit,
        ]);
    }
    /**
     * @Route("/DownloadProduitsData", name="DownloadProduitsData")
     */
    public function DownloadProduitsData(ProduitRepository $repository)
    {
        $produits=$repository->findAll();

        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('produit/download.html.twig',
            ['produits'=>$produits ]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Tableau des Produits.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }

}
