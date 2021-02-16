<?php

namespace App\Entity;

use App\Repository\ModelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelsRepository::class)
 */
class Models
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Listings::class, mappedBy="model")
     */
    private $listings;

    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="models")
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="models")
     */
    private $category;

    public function __construct()
    {
        $this->listings = new ArrayCollection();
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
     * @return Collection|Listings[]
     */
    public function getListings(): Collection
    {
        return $this->listings;
    }

    public function addListing(Listings $listing): self
    {
        if (!$this->listings->contains($listing)) {
            $this->listings[] = $listing;
            $listing->setModel($this);
        }

        return $this;
    }

    public function removeListing(Listings $listing): self
    {
        if ($this->listings->removeElement($listing)) {
            // set the owning side to null (unless already changed)
            if ($listing->getModel() === $this) {
                $listing->setModel(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }
}
