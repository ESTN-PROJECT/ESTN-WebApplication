<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="app_cart")
     */
    public function index(SessionInterface $session, ProduitRepository $ProduitRepository)
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];
        if (is_array($panier) || is_object($panier)){
            foreach ($panier as $id => $quantity) {
                $panierWithData[] = [
                    'produit' => $ProduitRepository->find($id),
                    'quantity' => $quantity
                ];

            }
        }
        $total = 0;
        foreach ($panierWithData as $item) {
            $totalItem = $item['produit']->getPrix() * $item ['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}" , name="cart_add")
     */
    public function add($id, SessionInterface $session , Produit $produit )
    {
        $panier = $session->get('panier', []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set('panier', $panier);

        return $this->redirectToRoute("app_cart");
    }


    /**
     * @Route("/panier/remove/{id}" , name="cart_remove")
     */
    public function remove(Produit $produit, $id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        $id = $produit->getId();
        if (!empty($panier[$id] > 1)) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);

        }

        $session->set('panier', $panier);
        return $this->redirectToRoute("app_cart");
    }

    /**
     * @Route("/panier/delete/{id}" , name="cart_delete")
     */
    public function delete(Produit $produit, $id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        $id = $produit->getId();
        if (!empty($panier[$id])) {

            unset($panier[$id]);


            $session->set('panier', $panier);
            return $this->redirectToRoute("app_cart");
        }
    }

    /**
     * @Route("/deleteall" , name="cart_deleteall")
     */
    public function deleteall( SessionInterface $session)
    {

        $session->remove("panier");


        return $this->redirectToRoute("app_cart");
    }


}
