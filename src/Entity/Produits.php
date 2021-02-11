<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $designation;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePeremptionAt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomFabricant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $forme;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Familles::class)
     */
    private $famille;

    public function __construct()
    {
        $this->datePeremptionAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrixUnitaire(): ?int
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(int $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getDatePeremptionAt(): ?\DateTimeInterface
    {
        return $this->datePeremptionAt;
    }

    public function setDatePeremptionAt(\DateTimeInterface $datePeremptionAt): self
    {
        $this->datePeremptionAt = $datePeremptionAt;

        return $this;
    }

    public function getNomFabricant(): ?string
    {
        return $this->nomFabricant;
    }

    public function setNomFabricant(string $nomFabricant): self
    {
        $this->nomFabricant = $nomFabricant;

        return $this;
    }

    public function getForme(): ?string
    {
        return $this->forme;
    }

    public function setForme(string $forme): self
    {
        $this->forme = $forme;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getFamille(): ?Familles
    {
        return $this->famille;
    }

    public function setFamille(?Familles $famille): self
    {
        $this->famille = $famille;

        return $this;
    }
}
