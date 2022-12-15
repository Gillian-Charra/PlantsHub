<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Form\EditProfileFormType;
use App\Repository\UserRepository;
use App\Repository\ElementRepository;
use App\Repository\PlantRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

#[Route('/accueil')]
class AccueilController extends AbstractController
{   
    #[Route('/', name: 'app_index')]
    public function index(PlantRepository $repository,ElementRepository $elementRepository): Response
    {
        $plantsALaUne=$repository->getRandomPlants(3);
        foreach( $plantsALaUne as $plant){
            $plant->setDescriptionBefore($elementRepository);

        }
        return $this->render('accueil/index.html.twig', [
            'plants'=> $plantsALaUne,
        ]);
    }
    #[Route("/profile-settings" , name:"user_edit")]
    public function edit(Request $request,EntityManagerInterface $entityManager,UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher,  UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator,): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileFormType::class, $user);
        $form->get('password')->setData("");
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            //$filename=date('Y-m-d').'_'.$user->getName().'_'.$form['name']->getData();//['test'];
            //$file = $form['profile_picture']->getData();
            //$file->move('images/avatar/', $filename);
            //$user->setProfilePicture($filename);
            $entityManager->persist($user);
            $entityManager->flush();
            $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
            return $this->redirect("/accueil");
        }
        return $this->render('accueil/editPassword.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

}