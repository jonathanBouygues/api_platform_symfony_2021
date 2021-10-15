<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VillageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      security="is_granted('ROLE_USER')"
 * )
 * @ORM\Entity(repositoryClass=VillageRepository::class)
 */
class Village
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read:Ninja")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read:Ninja")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $symbol;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Ninja::class, mappedBy="village")
     */
    private $ninjas;

    public function __construct()
    {
        $this->ninjas = new ArrayCollection();
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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Ninja[]
     */
    public function getNinjas(): Collection
    {
        return $this->ninjas;
    }

    public function addNinja(Ninja $ninja): self
    {
        if (!$this->ninjas->contains($ninja)) {
            $this->ninjas[] = $ninja;
            $ninja->setVillage($this);
        }

        return $this;
    }

    public function removeNinja(Ninja $ninja): self
    {
        if ($this->ninjas->removeElement($ninja)) {
            // set the owning side to null (unless already changed)
            if ($ninja->getVillage() === $this) {
                $ninja->setVillage(null);
            }
        }

        return $this;
    }
}
