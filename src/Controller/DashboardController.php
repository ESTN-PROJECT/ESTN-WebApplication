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
     * @Route("/stats", name="stats")
     */
    public function stat(Categorie $categorie , CategorieRepository  $repository,\Symfony\Component\HttpFoundation\Request $request)
    {


        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repository->findAll();

        $em = $this->getDoctrine()->getManager();

        $cat1=0;
        $cat2=0;
        $cat3=0;
        $cat4=0;



        if ( $categorie->getQuantite()=="test"): {

            $cat1+=1;
        }
        else:{

            $cat2+=1 ;
        } endif;



        $data=array_map(function (Categorie $item){
            return [$item->getNomCategorie(),$item->getQuantite()->count()];
        },$repository->findAll());


        array_unshift($data,['Task', 'Hours per Day']);



        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Listes categorie ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('dashboard/stats.html.twig', array('piechart' => $pieChart));
    }

}
