<?php

namespace App\Controller;

use App\Repository\ElementRepository;
use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accueil')]
class AccueilController extends AbstractController
{   
    #[Route('/', name: 'app_index')]
    public function index(PlantRepository $repository,ElementRepository $elementRepository): Response
    {
        $plantsALaUne=[];
        $plants=$repository->findBy(['display'=>'1']);
        for ($i=0;$i<3;$i++){
            $plantsALaUne[]=array_splice($plants,random_int(0,count($plants)-1),1)[0];
        }

        foreach( $plantsALaUne as $plant){
            $plant->setDescriptionBefore($elementRepository);

        }
        return $this->render('accueil/index.html.twig', [
            'plants'=> $plantsALaUne,
        ]);
    }

}