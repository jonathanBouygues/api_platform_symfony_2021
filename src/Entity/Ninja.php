<?php

namespace App\Entity;

use App\Repository\NinjaRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\CountNinjasController;
use Symfony\Component\String\Slugger\SluggerInterface;



/**
 * @ORM\Entity(repositoryClass=NinjaRepository::class)
 * @ApiResource(
 *      security="is_granted('ROLE_USER')",
 *      collectionOperations={
 *              "get" = {
 *                     "normalization_context"={"groups"={"read:ninja:collection"}}
 *                      },
 *              "post" = {"denormalization_context"={"groups"={"write:ninja:collection"}}},
 *              "count" = {
 *                      "method"="get",
 *                      "path"="/ninjas/count",
 *                      "controller"= CountNinjasController::class,
 *                      "filters" = {},
 *                      "openapi_context"= {
 *                          "summary"= "Retourne le nombre de Ninjas"
 *                      }
 *              }
 *      },
 *      itemOperations={
 *              "get",
 *              "put" =  {"denormalization_context"={"groups"={"put:ninja:item"}}}
 *      },
 *      paginationItemsPerPage = 3
 * )
 * @ApiFilter(SearchFilter::class, properties={"name" = "partial"})
 */
class Ninja
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read:ninja:collection")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:ninja:collection", "write:ninja:collection", "put:ninja:item"})
     * @Assert\Length(min =2)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:ninja:collection", "write:ninja:collection", "put:ninja:item"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"write:ninja:collection", "put:ninja:item"})
     */
    private $surname;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("read:ninja:item")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read:ninja:item")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"write:ninja:collection", "put:ninja:item"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Village::class, inversedBy="ninjas")
     * @Groups({"write:ninja:collection", "put:ninja:item"})
     */
    private $village;

    public function __construct()

    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
        dump($this->updatedAt);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function computeSlug(SluggerInterface $slugger)
    {
        $this->slug = (string) $slugger->slug($this->getName())->lower();
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getVillage(): ?Village
    {
        return $this->village;
    }

    public function setVillage(?Village $village): self
    {
        $this->village = $village;

        return $this;
    }
}
