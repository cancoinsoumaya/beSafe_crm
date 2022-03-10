<?php

namespace App\Entity;

use App\Repository\CompanyContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyContactRepository::class)
 */
class CompanyContact
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
    private $name;


    /**
     * @ORM\Column(type="string", length=100,unique=true)
     */
    private $siren_number;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=ContactType::class, mappedBy="companyContact")
     */
    private $contactTypes;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="companyContact")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="companyContact")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getSirenNumber(): ?string
    {
        return $this->siren_number;
    }

    public function setSirenNumber(string $siren_number): self
    {
        $this->siren_number = $siren_number;

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

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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
            $contactType->addCompanyContact($this);
        }

        return $this;
    }

    public function removeContactType(ContactType $contactType): self
    {
        if ($this->contactTypes->removeElement($contactType)) {
            $contactType->removeCompanyContact($this);
        }

        return $this;
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
            $user->addCompanyContact($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCompanyContact($this);
        }

        return $this;
    }
}
