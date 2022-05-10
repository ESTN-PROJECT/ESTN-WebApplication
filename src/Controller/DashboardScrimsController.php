<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardScrimsController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig', [
            'controller_name' => 'DashboardScrimsController',
        ]);
    }
    /**
     * @Route("/aziz", name="front")
     */
    public function front(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'DashboardScrimsController',
        ]);
    }
}
