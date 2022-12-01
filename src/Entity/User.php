<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'There is already an account with this name')]
#[UniqueEntity(fields: ['name'], message: 'There is already an account with this name')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $name = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_picture = null;

    #[ORM\Column]
    private ?bool $is_admin = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserHasDiscovered::class, orphanRemoval: true)]
    private Collection $userHasDiscovered;

    #[ORM\Column]
    private ?int $XP = 1;

    #[ORM\Column]
    private ?int $level = 1;

    public function __construct()
    {
        $this->userHasDiscovered = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->name;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * @return Collection<int, UserHasDiscovered>
     */
    public function getUserHasDiscovered(): Collection
    {
        return $this->userHasDiscovered;
    }

    public function discoveredCount(){
        return count($this->getUserHasDiscovered());
    }
    
    public function addUserHasDiscovered(UserHasDiscovered $userHasDiscovered): self
    {
        if (!$this->userHasDiscovered->contains($userHasDiscovered)) {
            $this->userHasDiscovered->add($userHasDiscovered);
            $userHasDiscovered->setUser($this);
        }

        return $this;
    }

    public function removeUserHasDiscovered(UserHasDiscovered $userHasDiscovered): self
    {
        if ($this->userHasDiscovered->removeElement($userHasDiscovered)) {
            // set the owning side to null (unless already changed)
            if ($userHasDiscovered->getUser() === $this) {
                $userHasDiscovered->setUser(null);
            }
        }

        return $this;
    }

    public function getXP(): ?int
    {
        return $this->XP;
    }

    public function setXP(int $XP): self
    {
        $this->XP = $XP;

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
}
