<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_before = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_after = null;

    #[ORM\OneToMany(mappedBy: 'plant', targetEntity: UserHasDiscovered::class, orphanRemoval: true)]
    private Collection $usersHasDiscovered;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Family $family = null;

    public function __construct()
    {
        $this->usersHasDiscovered = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getDescriptionBefore(): ?string
    {
        return $this->description_before;
    }

    public function setDescriptionBefore(string $description_before): self
    {
        $this->description_before = $description_before;

        return $this;
    }

    public function getDescriptionAfter(): ?string
    {
        return $this->description_after;
    }

    public function setDescriptionAfter(string $description_after): self
    {
        $this->description_after = $description_after;

        return $this;
    }

    /**
     * @return Collection<int, UserHasDiscovered>
     */
    public function getUsersHasDiscovered(): Collection
    {
        return $this->usersHasDiscovered;
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
}
