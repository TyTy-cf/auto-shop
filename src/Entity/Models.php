<?php

namespace App\Entity;

use App\Repository\ModelsRepository;
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
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="Models")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Brands;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="Models")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

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

    public function getBrands(): ?Brands
    {
        return $this->Brands;
    }

    public function setBrands(?Brands $Brands): self
    {
        $this->Brands = $Brands;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
