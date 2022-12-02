<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Plant;
use App\Entity\User;
use App\Entity\Family;
use app\Repository\FamilyRepository;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $options = [
            'cost' => 13,
            'time_cost'=> 3, # Lowest possible value for argon
            'memory_cost'=> 10 # Lowest possible value for argon
        ];
        $encrypted = password_hash("admin", PASSWORD_BCRYPT, $options);
        $tableauplante = ["coquelicot","Pavot somnifère","Lys"];
        $tableauImages = ["la chevre.jpg", "pavot-somnifere.jpg", "MyLogo.PNG"];
        $i = 0;

        $roles =[];
        $superAdmin = new user();
        $superAdmin -> setName("Admin");
        $superAdmin -> setPassword($encrypted);
        $superAdmin -> setProfilePicture("imageParDefaut.png");
        $superAdmin -> setIsAdmin("1");
        $superAdmin -> setRoles($roles);
        $manager->persist($superAdmin);
        $manager->flush();

        $family = new Family();
        $family -> setName("solanaceae");
        $manager->persist($family);
        $manager->flush();

        foreach($tableauplante as $plantName) {
            $plante = new Plant();
            $plante->setName($plantName);
            $plante->setImage($tableauImages[$i]);
            $plante->setLevel(mt_rand(1 , 20));
            $plante->setDisplay(1);
            $plante->setFamily($family);
            $manager->persist($plante);
            $manager->flush();
            $i++;
        }
    }
}
