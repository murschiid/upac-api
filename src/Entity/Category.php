<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Advertise::class, mappedBy: 'category')]
    private Collection $advertise;

    public function __construct()
    {
        $this->advertise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Advertise>
     */
    public function getAdvertise(): Collection
    {
        return $this->advertise;
    }

    public function addAdvertise(Advertise $advertise): static
    {
        if (!$this->advertise->contains($advertise)) {
            $this->advertise->add($advertise);
            $advertise->setCategory($this);
        }

        return $this;
    }

    public function removeAdvertise(Advertise $advertise): static
    {
        if ($this->advertise->removeElement($advertise)) {
            // set the owning side to null (unless already changed)
            if ($advertise->getCategory() === $this) {
                $advertise->setCategory(null);
            }
        }

        return $this;
    }
}
