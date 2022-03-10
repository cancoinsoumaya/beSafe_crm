<?php

namespace App\Entity;

use App\Repository\IndevidualContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IndevidualContactRepository::class)
 */
class IndevidualContact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="datetime", options={"default": "2022-01-01 00:00:00"})
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=ContactType::class, mappedBy="indevidualContact")
     */
    private $contactTypes;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="indevidualContact")
     */
    private $users;



    public function __construct()
    {
        $this->contactTypes = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, ContactType>
     */
    public function getContactTypes(): Collection
    {
        return $this->contactTypes;
    }

    public function addContactType(ContactType $contactType): self
    {
        if (!$this->contactTypes->contains($contactType)) {
            $this->contactTypes[] = $contactType;
            $contactType->addIndevidualContact($this);
        }

        return $this;
    }

    public function removeContactType(ContactType $contactType): self
    {
        if ($this->contactTypes->removeElement($contactType)) {
            $contactType->removeIndevidualContact($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addIndevidualContact($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeIndevidualContact($this);
        }

        return $this;
    }
}
