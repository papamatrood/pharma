<?php

namespace App\Entity;

use App\Repository\VentesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VentesRepository::class)
 */
class Ventes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valider;

    /**
     * @ORM\Column(type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateVenteAt;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class, inversedBy="ventes")
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="array")
     */
    private $produits = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(bool $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDateVenteAt(): ?\DateTimeInterface
    {
        return $this->dateVenteAt;
    }

    public function setDateVenteAt(\DateTimeInterface $dateVenteAt): self
    {
        $this->dateVenteAt = $dateVenteAt;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateurs
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateurs $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getProduits(): ?array
    {
        return $this->produits;
    }

    public function setProduits(array $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
