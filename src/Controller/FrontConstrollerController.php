<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontConstrollerController extends AbstractController
{
    /**
     * @Route("/front/constroller", name="app_front_constroller")
     */
    public function index(): Response
    {
        return $this->render('front_constroller/index.html.twig', [
            'controller_name' => 'FrontConstrollerController',
        ]);
    }
}
