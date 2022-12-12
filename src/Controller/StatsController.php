<?php

namespace App\Controller;

use App\Entity\UserHasDiscovered;
use App\Repository\ElementRepository;
use App\Repository\FamilyRepository;
use App\Repository\PlantRepository;
use App\Repository\UserHasDiscoveredRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stats')]
class StatsController extends AbstractController
{   
    #[Route('/', name: 'app_stats')]
    public function index(PlantRepository $plantRepository,FamilyRepository $familyRepository,UserHasDiscoveredRepository $UHDRepository): Response
    {
        $plantes=$plantRepository->findAll();
        foreach ($plantes as $plante){
            $familles[$familyRepository->find($plante->getFamily())->getName()][]=$plante;

            $matchs[$plante->getName()]=$UHDRepository->findMatch($this->getUser()->getId(),$plante->getId());
        }
        return $this->render('stats/stats.html.twig', [
                'familles'=>$familles,
                'matchs'=>$matchs
        ]);
    }

}