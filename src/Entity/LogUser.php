<?php

namespace App\Entity;

use App\Repository\LogUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogUserRepository::class)
 */
class LogUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $targetEntity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $targetEntityType;

    /**
     * @ORM\Column(type="datetime")
     */
    private $logAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $details = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTargetEntity(): ?int
    {
        return $this->targetEntity;
    }

    public function setTargetEntity(int $targetEntity): self
    {
        $this->targetEntity = $targetEntity;

        return $this;
    }

    public function getTargetEntityType(): ?string
    {
        return $this->targetEntityType;
    }

    public function setTargetEntityType(string $targetEntityType): self
    {
        $this->targetEntityType = $targetEntityType;

        return $this;
    }

    public function getLogAt(): ?\DateTimeInterface
    {
        return $this->logAt;
    }

    public function setLogAt(\DateTimeInterface $logAt): self
    {
        $this->logAt = $logAt;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getDetails(): ?array
    {
        return $this->details;
    }

    public function setDetails(?array $details): self
    {
        $this->details = $details;

        return $this;
    }
}
