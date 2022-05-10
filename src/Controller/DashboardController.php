<?php

namespace App\Controller;

use App\Entity\Categorie;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
    /**
     * @Route("/admin", name="app_admin")
     */
    public function cat_stat(CategorieRepository   $categorieRepository): Response
    {
        $nbrs[] = array();

        $e1 = $categorieRepository->find_Nb_Rec_Par_Status("70");
        dump($e1);
        $nbrs[] = $e1[0][1];


        $e2 = $categorieRepository->find_Nb_Rec_Par_Status("1");
        dump($e2);
        $nbrs[] = $e2[0][1];

        $e3 = $categorieRepository->find_Nb_Rec_Par_Status("40");
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

        return $this->render('dashboard/stat.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }


}
