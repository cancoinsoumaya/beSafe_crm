<?php

namespace App\Entity;

use App\Repository\ContactTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactTypeRepository::class)
 */
class ContactType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity=CompanyContact::class, inversedBy="contactTypes")
     */
    private $companyContact;

    /**
     * @ORM\ManyToMany(targetEntity=IndevidualContact::class, inversedBy="contactTypes")
     */
    private $indevidualContact;

    public function __construct()
    {
        $this->companyContact = new ArrayCollection();
        $this->indevidualContact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, CompanyContact>
     */
    public function getCompanyContact(): Collection
    {
        return $this->companyContact;
    }

    public function addCompanyContact(CompanyContact $companyContact): self
    {
        if (!$this->companyContact->contains($companyContact)) {
            $this->companyContact[] = $companyContact;
        }

        return $this;
    }

    public function removeCompanyContact(CompanyContact $companyContact): self
    {
        $this->companyContact->removeElement($companyContact);

        return $this;
    }

    /**
     * @return Collection<int, IndevidualContact>
     */
    public function getIndevidualContact(): Collection
    {
        return $this->indevidualContact;
    }

    public function addIndevidualContact(IndevidualContact $indevidualContact): self
    {
        if (!$this->indevidualContact->contains($indevidualContact)) {
            $this->indevidualContact[] = $indevidualContact;
        }

        return $this;
    }

    public function removeIndevidualContact(IndevidualContact $indevidualContact): self
    {
        $this->indevidualContact->removeElement($indevidualContact);

        return $this;
    }
}
