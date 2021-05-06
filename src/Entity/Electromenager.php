<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

use Doctrine\ORM\Mapping\JoinColumn;
use App\Repository\ElectromenagerRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ElectromenagerRepository::class)
 */
class Electromenager
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    
    private $id;

 /**
 * @ORM\Column(type="string", length=255)
 * @Assert\Length(
 *          min = 7,
 *          max = 50,
 * minMessage = "Le nom d'un electromenager doit comporter au moins {{ limit }} caractères",
 * maxMessage = "Le nom d'un electromenager doit comporter au plus {{ limit }} caractères"
 * )
 */

    private $nom;

/**
* @ORM\Column(type="decimal", precision=10, scale=0)
* @Assert\NotEqualTo(
* value = 0,
* message = "le prix d'un electromenager ne doit pas etre egal a 0"
* )
*/

    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="electros")
     */
    private $marque;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }
}
