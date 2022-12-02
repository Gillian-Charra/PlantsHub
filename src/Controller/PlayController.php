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

#[Route('/play')]
class PlayController extends AbstractController
{   
    #[Route('/', name: 'app_play')]
    public function index(PlantRepository $repository,ElementRepository $elementRepository): Response
    {
        return $this->render('play/play.html.twig', [
            //'var'=>$repository->find(1)
        ]);
    }
    #[Route('/apiphoto', name: 'app_api_photo')]
    public function savePhoto(PlantRepository $plantrepository,UserRepository $userrepository,UserHasDiscoveredRepository $UHDrepository):Response
    {
        $UHDentity= new UserHasDiscovered; 
        $data = $_POST['image'];
        $user= $userrepository->find($_POST['user']);
        $plant = $plantrepository->find($_POST['plant']);
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $date=date('Y-m-d');
        $image = explode('base64,',$data);
        $filename=$user->getName().'_'.$date.'_'.$plant->getName().'.png';
        $fic=fopen('images/photo/'.$filename,"wb");//
        fwrite($fic,base64_decode($image[1]));
        fclose($fic);
        $date=new DateTime();
        $UHDentity->setUser($user);
        $UHDentity->setPlant($plant);
        $UHDentity->setLatitude($latitude);
        $UHDentity->setLongitude($longitude);
        $UHDentity->setDate($date);
        $UHDentity->setPhoto($filename);
        $UHDrepository->save($UHDentity,True);
        $response=new Response();
        return $response;
    }

}