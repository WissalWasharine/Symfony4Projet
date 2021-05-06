<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Electromenager::class, mappedBy="marque")
     */
    private $electros;

    public function __construct()
    {
        $this->electros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    /**
     * @return Collection|Electromenager[]
     */
    public function getElectros(): Collection
    {
        return $this->electros;
    }

    public function addElectro(Electromenager $electro): self
    {
        if (!$this->electros->contains($electro)) {
            $this->electros[] = $electro;
            $electro->setMarque($this);
        }

        return $this;
    }

    public function removeElectro(Electromenager $electro): self
    {
        if ($this->electros->removeElement($electro)) {
            // set the owning side to null (unless already changed)
            if ($electro->getMarque() === $this) {
                $electro->setMarque(null);
            }
        }

        return $this;
    }
}
