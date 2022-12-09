<?php

namespace App\DataFixtures;

use App\Entity\Element;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Plant;
use App\Entity\User;
use App\Entity\Family;
use App\Entity\PlantImages;
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

    $roles =[/*"ROLE_ADMIN"*/];
        $superAdmin = new user();
        $superAdmin -> setName("Admin");
        $superAdmin -> setPassword($encrypted);
        $superAdmin -> setProfilePicture("imageParDefaut.png");
        $superAdmin -> setIsAdmin("1");
        $superAdmin -> setRoles($roles);
        $manager->persist($superAdmin);
        $manager->flush();



        $json = file_get_contents(dirname(__FILE__).'\Resources\Models\data.json');
        $plantsJson = json_decode($json,true);





        $tableauplant = ["coquelicot","Pavot somnifère","Lys","Erythroxylum coca"];
        $tableauImages = [
            "coquelicot"=>["coquelicot.jpg"],
            "Pavot somnifère"=>["pavot-somnifere.jpg"],
            "Lys"=>["lys.jpg"],
            "Erythroxylum coca"=>["Erythroxylum_coca.jpg"],
        ];
        $tableauDescriptionsBefore = [
            "coquelicot"=>[
                [
                "text"=>"Le Coquelicot (Papaver rhoeas) est une espèce de plants dicotylédones de la famille des Papaveraceae, originaire d'Eurasie. \r\n C'est une plant herbacée annuelle, très abondante dans les terrains fraîchement remués à partir du printemps, qui se distingue par la couleur rouge de ses fleurs et par le fait qu'elle forme souvent de grands tapis colorés visibles de très loin. Elle appartient au groupe des plants dites messicoles car elle est associée à l'agriculture depuis des temps très anciens, grâce à son cycle biologique adapté aux cultures de céréales, la floraison et la mise à graines intervenant avant la moisson. Très commune dans différents pays d'Europe, elle a beaucoup régressé du fait de l'emploi généralisé des herbicides et de l'amélioration du tri des semences de céréales."                
                ]
            ],
            "Pavot somnifère"=>[
                [
                    "text"=>"Le pavot somnifère ou pavot à opium (Papaver somniferum), appelé également « pavot des jardins », est une espèce de plant herbacée annuelle de la famille des Papaveraceae originaire d'Europe méridionale et d'Afrique du Nord. Connue pour ses propriétés psychotropes sédatives, elle est aussi cultivée à des fins ornementales ou alimentaires."
                ],
                [
                    "logo"=>"fixtures/histoire.png",
                    "title"=>"Histoire",
                    "text"=>"Jadis, le Papaver somniferum, était considéré comme une plant magique associée à la magie noire. Le pavot somnifère a vraisemblablement été domestiqué dans l'ouest du pourtour méditerranéen au néolithique. \r\n                    Au xiiie siècle, Sainte Hildegarde indique que « manger la graine apporte le sommeil ». Toujours vers cette époque, le pavot somnifère faisait partie des herbes des vierges prescrites par les matrones pour avorter discrètement et sauver les apparences."
                ]
            ],
            "Lys"=>[
                [
                    "text"=>"Ces plants à bulbe sont originellement présentes dans les zones tempérées de l'hémisphère nord.\r\n On les trouve principalement en Europe, mais aussi en Asie, de l'Inde jusqu'au Japon et aux Philippines.\r\nLeur aire de répartition couvre également les États-Unis et le Sud du Canada.\r\nLes espèces du genre Lilium poussent généralement dans les zones humides des milieux forestiers, souvent montagneux, ou plus rarement dans les milieux dégagés (prairies). Quelques-unes poussent dans les zones marécageuses. Deux espèces (Lilium arboricola, Lilium eupetes) vivent en épiphyte, une autre (Lilium procumbens) en épilithe.\r\nDe nombreuses variétés hybrides sont cultivées et ornent les jardins du monde entier."
                ]
            ],
            "Erythroxylum coca"=>[
                [
                    "text"=>"La coca est une plant d'Amérique du Sud de la famille des Érythroxylacées. Elle joue un rôle important dans la culture andine, à travers ses utilisations rituelles ou médicinales.\r\nLa cocaïne utilise la feuille de coca comme ingrédient actif mais il ne faut pas les confondre.\r\nLes dictionnaires sont partagés sur le genre du nom de l'arbuste mais s'entendent pour dénommer « la » coca la substance à mâcher qu'il fournit. Elle est appelée mama kuka en langue quechua."
                ]
            ],
        ];
        $tableauDescriptionsAfter = [
            "coquelicot"=>[
                [
                    "title"=>"Usage Alimentaire",
                    "text"=>"Les jeunes feuilles de pavot sont traditionnellement consommés crues (hachées, elles servent à aromatiser soupes, légumes et céréales), ou cuites comme les épinards, et utilisées pour aromatiser soupes et salades24. Dans le Salento (Italie), on prépare les paparene nfucate en faisant cuire les jeunes feuilles, cueillies avant la floraison, à feu doux dans un peu d'eau avec de l'huile d'olive et des olives noires.\r\nLes boutons floraux peuvent être conservés dans du vinaigre comme les câpres. Le jeune ovaire encore tendre peut être croqué tel quel pour sa saveur de noisette.\r\nLes pétales rouges du coquelicot décorent les plats mais servent aussi à préparer un sirop coloré utilisé contre la toux, les coliques des enfants. À Nemours, on prépare depuis 1870 des bonbons aux coquelicots et depuis 1996 un sirop et une liqueur de coquelicot.\r\nMême si elles sont moins grosses que celles de certains pavots, les graines du coquelicot sont également comestibles. Recueillies en se servant de la capsule comme d'un poivrier, elles sont utilisées comme telles en pâtisserie, pour confectionner des pains aromatisés ou, cuites avec du lait et du miel, pour fourrer des gâteaux. Jadis on extrayait de ces graines très oléagineuses une huile servant de substitut à l'huile d'olive29.",
                ]
            ],
            "Pavot somnifère"=>[
                [
                    "title"=>"L'histoire de l'opium, produit par le pavot somnifère",
                    "text"=>"Les Sumériens connaissaient déjà les effets de l'opium comme en témoignent des tablettes gravées datant de 3 000 ans av. J.-C. et des vestiges du néolithique suggèrent déjà des cultures de pavot somnifère à proximité des villages.\r\nL'image de la capsule du pavot, un enthéogène, fut un attribut des dieux, bien avant que l'opium soit extrait de son latex laiteux. À la galerie des reliefs assyriens au Metropolitan Museum de New York, une divinité ailée d'un palais d'Assurnazirpal II à Nimroud, datée de -879, porte un bouquet de capsules de pavot (néanmoins décrites par le musée comme des grenades).\r\nL'opium a été un objet de commerce pendant des siècles pour ses effets sédatifs. Il était bien connu dans la Grèce antique sous le nom d'opion (« jus de pavot ») duquel le nom latinisé actuel est dérivé et déjà à l'époque les médecins mettaient en garde contre les abus potentiels.\r\nLe pavot est introduit en Inde dès le ixe siècle par l'invasion des Arabes et des Perses islamisés et sous le règne des Moghols (1527 à 1707), le commerce d'opium est un monopole d'État.\r\nSon usage se poursuit au Moyen Âge via diverses préparations médicamenteuses dont le laudanum (connu comme « teinture d'opium »), une solution d'opium en alcool à partir du xviiie siècle."
                ]
            ],
            "Lys"=>[
                [
                    "logo"=>"fixtures/Fleur_de_lys.png",
                    "title"=>"Fleur de lys",
                    "text"=>"La fleur de lys (dont l'ancienne orthographe est « fleur de lis ») est une fleur mythique d'origine gauloise3. Elle proviendrait en réalité pour certains de l'iris (« lis » en néerlandais), pour d'autres du glaïeul et pour d'autres encore, ce symbole considéré comme une fleur (un meuble) héraldique n'a pas de réalité botanique. Cette marque d'origine gauloise s'est répandue dans le reste de l'Occident à partir du haut Moyen Âge, est en jaune ou or celui de la famille royale en France, il est aussi le symbole monarchique (sceptres) à la même époque dans l'espace occupé par des descendants des peuples germaniques du Saint-Empire romain germanique.\r\nAvec le développement de la marine à voile, la fleur de lys fait son apparition sur les cartes, adjointe à la rose des vents, pour indiquer la direction du Nord.\r\nAu XXe siècle, la fleur de lys devient un emblème du scoutisme, repris à la cartographie, comme symbole de droiture, de connaissance du monde et de la capacité à s'orienter qui sont transmises aux jeunes dans leurs activités. Elle est depuis présente sur la plupart des emblèmes des associations scoutes du monde entier.\r\nLe lys blanc a été l'emblème floral du Québec de 1963 à 1999, bien qu'il n'y soit pas indigène. Il a été remplacé par l'iris versicolore en 1999."
                ]
            ],
            "Erythroxylum coca"=>[
                [
                    "logo"=>"fixtures/pablo.jpeg",
                    "title"=>"Usages détournés",
                    "text"=>"Hors d'Amérique latine, elle est surtout utilisée pour la cocaïne. La coca est donc connue à travers le monde pour son utilisation sous forme de drogue et les trafics qui en sont la conséquence. C'est en raison de cet usage que les États-Unis souhaitent éradiquer sa culture en Amérique latine."
                ]
            ],
        ];

        foreach ($plantsJson as $plant){
            $tableauplant[]=$plant["name"];
            $tableauImages[$plant["name"]]=$plant["photos"];
            $tableauDescriptionsBefore[$plant["name"]]=$plant["before"];
            $tableauDescriptionsAfter[$plant["name"]]=$plant["after"];
        }
        
        $familiesName=[
        "Hors-categorie",
        "Liliaceae",
        "Papaveraceae",
        "Solanaceae",
        "Erythroxylaceae",
        "Plantaginaceae",
        "Urticaceae",
        "Boraginaceae",
        "Rosaceae",
        "Asteraceae",
        "Lamiaceae",
        "Polygonaceae",
        "Crassulaceae"
    ];
        $families=array();
        foreach($familiesName as $familyName) {
            $family = new Family();
            $family -> setName($familyName);
            $manager->persist($family);
            $manager->flush();
            $families[$family->getName()]=$family;
        }
        foreach($tableauplant as $plantName) {
            $plant = new Plant();
            $plant->setName($plantName);
            $plant->setLevel(mt_rand(1 , 2));//a changer
            $plant->setDisplay(1);
            switch($plantName) {
                case "Pavot somnifère":
                case "coquelicot":
                    $plant->setFamily($families["Papaveraceae"]);
                    break;
                case "Lys":
                case "Le muguet":
                    $plant->setFamily($families["Liliaceae"]);
                    break;
                case "Erythroxylum coca":
                    $plant->setFamily($families["Erythroxylaceae"]);
                    break;
                case "L'ortie":
                    $plant->setFamily($families["Urticaceae"]);
                    break;
                case "Le plantain":
                    $plant->setFamily($families["Plantaginaceae"]);
                    break;
                case "La consoude";
                    $plant->setFamily($families["Boraginaceae"]);
                    break;
                case "La ronce";
                    $plant->setFamily($families["Rosaceae"]);
                    break;
                case "Le pissenlit";
                    $plant->setFamily($families["Asteraceae"]);
                    break;
                case "La menthe";
                    $plant->setFamily($families["Lamiaceae"]);
                    break;
                case "L'oseille";
                    $plant->setFamily($families["Polygonaceae"]);
                    break;
                case "Le nombril de venus";
                    $plant->setFamily($families["Crassulaceae"]);
                    break;
                default:
                    $plant->setFamily($families["Hors-categorie"]);
                    break;
            }
            $manager->persist($plant);
            $manager->flush();
            $j=0;
            foreach($tableauImages[$plantName] as $image){
                $j+=1;
                $plantImage=new PlantImages();
                $plantImage->setPlant($plant);
                $plantImage->setImage("fixtures/".$image);
                $manager->persist($plantImage);
                $manager->flush();
            }
            $i=0;
            foreach($tableauDescriptionsBefore[$plantName] as $infoElement){
                $element= new Element();
                $element->setOrdre($i);
                $element->setSide(0);
                $element->setIdplant($plant);
                $element->setContent($infoElement["text"]);
                if (isset($infoElement["title"])){
                    $element->setTitle($infoElement["title"]);
                }
                if (isset($infoElement["logo"])){
                    $element->setLogo($infoElement["logo"]);
                }
                $manager->persist($element);
                $manager->flush();
                $i++;
            }
            foreach($tableauDescriptionsAfter[$plantName] as $infoElement){
                $element= new Element();
                $element->setOrdre($i);
                $element->setSide(1);
                $element->setIdplant($plant);
                $element->setContent($infoElement["text"]);
                if (isset($infoElement["title"])){
                    $element->setTitle($infoElement["title"]);
                }
                if (isset($infoElement["logo"])){
                    $element->setLogo($infoElement["logo"]);
                }
                $manager->persist($element);
                $manager->flush();
                $i++;
            }
        }
    }
}
