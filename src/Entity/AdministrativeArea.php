<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdministrativeAreaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdministrativeAreaRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"read:admin_area"}}
 * )
 */
class AdministrativeArea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:admin_area"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:admin_area"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $parentCode;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"read:admin_area"})
     */
    private $type;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $details = [];

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getParentCode(): ?string
    {
        return $this->parentCode;
    }

    public function setParentCode(string $parentCode): self
    {
        $this->parentCode = $parentCode;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
