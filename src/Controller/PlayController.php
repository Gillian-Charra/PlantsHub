<?php

namespace App\Controller;

use App\Entity\UserHasDiscovered;
use App\Repository\ElementRepository;
use App\Repository\FamilyRepository;
use App\Repository\PlantRepository;
use App\Repository\UserHasDiscoveredRepository;
use App\Repository\UserRepository;
use DateTime;
use phpDocumentor\Reflection\PseudoTypes\True_;
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
            'plant'=>$repository->getRandomPlants(1,true,$this->getUser())[0]
        ]);
    }
    #[Route('/apiphoto', name: 'app_api_photo')]
    public function savePhoto(PlantRepository $plantrepository,ElementRepository $elementRepository,UserHasDiscoveredRepository $UHDrepository,UserRepository $userrepository):Response
    {
        $UHDentity= new UserHasDiscovered; 
        $data = $_POST['image'];
        $user= $this->getUser();
        $plant = $plantrepository->findOneBy(["name"=>$_POST['plant']]);
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
        $plant->setDescriptionAfter($elementRepository);

        $user->setXP($user->getXP()+$plant->xpgiven());
        $user->XPmanager();
        $userrepository->save($user,true);
        $response=new Response(json_encode(["filename"=>$filename,"fichePlanteAfter"=>$plant->getFichePlante(),"plantName"=>$plant->getName()]));
        return $response;
    }
}