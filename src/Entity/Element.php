<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $side = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $idtype = null;

    #[ORM\ManyToMany(targetEntity: Plant::class)]
    private Collection $plant;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plant $idplant = null;

    public function __construct()
    {
        $this->plant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isSide(): ?bool
    {
        return $this->side;
    }

    public function setSide(bool $side): self
    {
        $this->side = $side;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getIdtype(): ?Type
    {
        return $this->idtype;
    }

    public function setIdtype(?Type $idtype): self
    {
        $this->idtype = $idtype;

        return $this;
    }

    /**
     * @return Collection<int, Plant>
     */
    public function getPlant(): Collection
    {
        return $this->plant;
    }

    public function addPlant(Plant $plant): self
    {
        if (!$this->plant->contains($plant)) {
            $this->plant->add($plant);
        }

        return $this;
    }

    public function removePlant(Plant $plant): self
    {
        $this->plant->removeElement($plant);

        return $this;
    }

    public function getIdplant(): ?Plant
    {
        return $this->idplant;
    }

    public function setIdplant(?Plant $idplant): self
    {
        $this->idplant = $idplant;

        return $this;
    }
}
