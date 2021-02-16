<?php

namespace App\Entity;

use App\Repository\ListingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListingsRepository::class)
 */
class Listings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $creationYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $km;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishAt;

    /**
     * @ORM\ManyToOne(targetEntity=Models::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Models;

    /**
     * @ORM\ManyToOne(targetEntity=Sellers::class, inversedBy="Listings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sellers;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationYear(): ?\DateTimeInterface
    {
        return $this->creationYear;
    }

    public function setCreationYear(\DateTimeInterface $creationYear): self
    {
        $this->creationYear = $creationYear;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->publishAt;
    }

    public function setPublishAt(\DateTimeInterface $publishAt): self
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getModels(): ?Models
    {
        return $this->Models;
    }

    public function setModels(?Models $Models): self
    {
        $this->Models = $Models;

        return $this;
    }

    public function getSellers(): ?Sellers
    {
        return $this->sellers;
    }

    public function setSellers(?Sellers $sellers): self
    {
        $this->sellers = $sellers;

        return $this;
    }

}
