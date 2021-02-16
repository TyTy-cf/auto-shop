<?php

namespace App\Entity;

use App\Repository\SellersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SellersRepository::class)
 */
class Sellers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=127)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity=Listings::class, mappedBy="sellers", orphanRemoval=true)
     */
    private $Listings;

    public function __construct()
    {
        $this->Listings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|Listings[]
     */
    public function getListings(): Collection
    {
        return $this->Listings;
    }

    public function addListing(Listings $listing): self
    {
        if (!$this->Listings->contains($listing)) {
            $this->Listings[] = $listing;
            $listing->setSellers($this);
        }

        return $this;
    }

    public function removeListing(Listings $listing): self
    {
        if ($this->Listings->removeElement($listing)) {
            // set the owning side to null (unless already changed)
            if ($listing->getSellers() === $this) {
                $listing->setSellers(null);
            }
        }

        return $this;
    }
}
