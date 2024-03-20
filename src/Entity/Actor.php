<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]
    private Collection $age;

    public function __construct()
    {
        $this->age = new ArrayCollection();
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

    /**
     * @return Collection<int, Movie>
     */
    public function getAge(): Collection
    {
        return $this->age;
    }

    public function addAge(Movie $age): static
    {
        if (!$this->age->contains($age)) {
            $this->age->add($age);
            $age->addActor($this);
        }

        return $this;
    }

    public function removeAge(Movie $age): static
    {
        if ($this->age->removeElement($age)) {
            $age->removeActor($this);
        }

        return $this;
    }
}
