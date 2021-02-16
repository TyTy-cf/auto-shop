<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
     * @ORM\OneToMany(targetEntity=Models::class, mappedBy="categories", orphanRemoval=true)
     */
    private $Models;

    public function __construct()
    {
        $this->Models = new ArrayCollection();
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
     * @return Collection|Models[]
     */
    public function getModels(): Collection
    {
        return $this->Models;
    }

    public function addModel(Models $model): self
    {
        if (!$this->Models->contains($model)) {
            $this->Models[] = $model;
            $model->setCategories($this);
        }

        return $this;
    }

    public function removeModel(Models $model): self
    {
        if ($this->Models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getCategories() === $this) {
                $model->setCategories(null);
            }
        }

        return $this;
    }
}
