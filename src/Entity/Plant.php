<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use App\Repository\FamilyRepository;
use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;

trait FromArrayTrait {
    public static function fromArray(array $data = []): self {
        foreach (get_object_vars($obj = new self) as $property => $default) {
            $obj->$property = $data[$property] ?? $default;
        }
        return $obj;
    }
}

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    use FromArrayTrait;

    #xp de base
    const XP_BASE = 10;
    # Coefficient définissant l'xp donnée par une plante
    const COEFF = 1.5;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $level = null;

    private ?string $description_before = null;

    private ?string $description_after = null;

    #[ORM\OneToMany(mappedBy: 'plant', targetEntity: UserHasDiscovered::class, orphanRemoval: true)]
    private Collection $usersHasDiscovered;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Family $family = null;

    #[ORM\Column]
    private ?bool $display = null;

    #[ORM\OneToMany(mappedBy: 'plant', targetEntity: PlantImages::class)]
    private Collection $plantImages;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latinName = null;

    public function __construct()
    {
        $this->usersHasDiscovered = new ArrayCollection();
        $this->plantImages = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
 
    public function xpgiven(): ?float
    {
        $plantLevel = $this->getLevel();
        $xpgiven = ($this->XP_base*(1+0.2*($plantLevel/$this->COEFF)));
        return $xpgiven;

    }
    public function getDescriptionBefore(): ?array
    {
        return $this->descriptionBefore;
    }

    public function setDescriptionBefore(ElementRepository $elementRepository): ?self
    {
        $this->descriptionBefore= $elementRepository->findBy([
            'idplant'=>$this->getId(),//symfony a fait fort sur ce coup là
            'side'=>'0'
        ],
        [
            'ordre'=>'ASC'
        ]);
        return $this;
    }
    public function getFullRawDescriptionBefore(): ?string
    {
        $html="";
        foreach($this->descriptionBefore as $element){
            if ($element->getLogo()!=null){
                $html=$html."<img class='logo-illustration' src='/images/illustration_description/".$element->getLogo()."'/> \r\n";
            }
            if ($element->getTitle()!=null){
                $html=$html."<h3 class='titre-description-plante'>".$element->getTitle()."</h3> \r\n";
            }
            $html=$html."<p class='description-plante'>".$element->getContent()."</p><br/> \r\n";
        }
        return $html;

    }
    public function getDescriptionAfter(): ?array
    {
        return $this->descriptionBefore;
    }
    public function setDescriptionAfter(ElementRepository $elementRepository): ?self
    {
        $this->descriptionAfter= $elementRepository->findBy([
            'idplant'=>$this->getId(),//symfony a fait fort sur ce coup là
            'side'=>'1'
        ],
        [
            'ordre'=>'ASC'
        ]);
        return $this;
    }
    public function getFullRawDescriptionAfter(): ?string
    {
        $html="";
        foreach($this->descriptionAfter as $elements){
            foreach($elements as $element){
                if ($element["logo"]!=null){
                    $html+='<img class="logo-illustration" src="'.$element["logo"].'"/> \r\n';
                }
                if ($element["title"]!=null){
                    $html+='<h3 class="titre-description-plante">'.$element["title"].'</h3> \r\n';
                }
                $html+='<p class="titre-description-plante">'.$element["content"].'</p><br/> \r\n';
            }
        }
        return $html;
    }

    /**
     * @return Collection<int, UserHasDiscovered>
     */
    public function getUsersHasDiscovered(): Collection
    {
        return $this->usersHasDiscovered;
    }
    public function getUHD($id): int
    {
        return $id;
    }

    public function addUsersHasDiscovered(UserHasDiscovered $usersHasDiscovered): self
    {
        if (!$this->usersHasDiscovered->contains($usersHasDiscovered)) {
            $this->usersHasDiscovered->add($usersHasDiscovered);
            $usersHasDiscovered->setPlant($this);
        }

        return $this;
    }

    public function removeUsersHasDiscovered(UserHasDiscovered $usersHasDiscovered): self
    {
        if ($this->usersHasDiscovered->removeElement($usersHasDiscovered)) {
            // set the owning side to null (unless already changed)
            if ($usersHasDiscovered->getPlant() === $this) {
                $usersHasDiscovered->setPlant(null);
            }
        }

        return $this;
    }

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function isDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): self
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @return Collection<int, PlantImages>
     */
    public function getImage()
    {
        $images=$this->plantImages;
        return $images[random_int(0,count($images)-1)]->getImage();
    }
    public function getPlantImages(): Collection
    {
        return $this->plantImages;
    }

    public function addPlantImage(PlantImages $plantImage): self
    {
        if (!$this->plantImages->contains($plantImage)) {
            $this->plantImages->add($plantImage);
            $plantImage->setPlant($this);
        }

        return $this;
    }

    public function removePlantImage(PlantImages $plantImage): self
    {
        if ($this->plantImages->removeElement($plantImage)) {
            // set the owning side to null (unless already changed)
            if ($plantImage->getPlant() === $this) {
                $plantImage->setPlant(null);
            }
        }

        return $this;
    }
}
