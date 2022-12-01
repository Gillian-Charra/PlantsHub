<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Plant;
use App\Entity\User;

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
        $tableauImages = ["la chevre.jpg", "la chevre.webp", "MyLogo.PNG"];
        $i = 0;
        // créé 3 plantes
        foreach($tableauplante as $plantName) {
            $plante = new Plant();
            $plante->setName($plantName);
            $plante->setImage($tableauImages[$i]);
            $plante->setLevel(mt_rand(1 , 20));
            $plante->setDescriptionBefore("blabla");
            $plante->setDescriptionAfter("blabla");
            $manager->persist($plante);
            $i++;
        }
        $roles =[];
        $superAdmin = new user();
        $superAdmin -> setName("Admin");
        $superAdmin -> setPassword($encrypted);
        $superAdmin -> setProfilePicture("imageParDefaut.png");
        $superAdmin -> setIsAdmin("1");
        $superAdmin -> setRoles($roles);
        $manager->persist($superAdmin);

        $manager->flush();
    }
}
