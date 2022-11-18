<?php

namespace App\Controller;

use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accueil')]
class AccueilController extends AbstractController
{   
    //#[Route('/', name: 'app_index', methods: ['GET'])]
    #[Route('/', name: 'app_acc')]
    public function index(PlantRepository $repository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'plants'=>$repository->findAll(),
        ]);
    }

}