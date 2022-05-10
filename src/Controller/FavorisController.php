<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FavorisController extends AbstractController
{
    /**
     * @Route("/fav", name="app_fav")
     */
    public function index(SessionInterface $sessions, ProduitRepository $productsRepository)
    {
        $favoris = $sessions->get("favoris", []);



        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
        ]);
    }


    /**
     * @Route("/addfav/{id}", name="addfav")
     */
    public function add(Produit $product, SessionInterface $sessions)
    {
        // On récupère le panier actuel
        $favoris = $sessions->get("favoris", []);
        $id = $product->getId();

        if(!empty($favoris[$id])){
            $favoris[$id]++;
        }else{
            $favoris[$id] = 1;
        }

        // On sauvegarde dans la session
        $sessions->set("favoris", $favoris);

dd($sessions);    }
}
