<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
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
    #[Route("/edit" , name:"user_edit")]
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            if ($form->getData() != getPassword())
            {
                $user = $form->get("Password")->getData();
            }
        }
        return $this->render('registration/editPassword.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

}