<?php

namespace App\Entity;

use App\Repository\SalairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalairesRepository::class)
 */
class Salaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreHeure;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tauxHoraire;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaireBase;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avantage;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaireBrut;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaireNet;

    /**
     * @ORM\Column(type="integer")
     */
    private $cotisationSocial;

    /**
     * @ORM\ManyToOne(targetEntity=Employes::class, inversedBy="salaires")
     */
    private $employe;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mois;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreHeure(): ?int
    {
        return $this->nombreHeure;
    }

    public function setNombreHeure(?int $nombreHeure): self
    {
        $this->nombreHeure = $nombreHeure;

        return $this;
    }

    public function getTauxHoraire(): ?float
    {
        return $this->tauxHoraire;
    }

    public function setTauxHoraire(?float $tauxHoraire): self
    {
        $this->tauxHoraire = $tauxHoraire;

        return $this;
    }

    public function getSalaireBase(): ?int
    {
        return $this->salaireBase;
    }

    public function setSalaireBase(int $salaireBase): self
    {
        $this->salaireBase = $salaireBase;

        return $this;
    }

    public function getPrime(): ?int
    {
        return $this->prime;
    }

    public function setPrime(?int $prime): self
    {
        $this->prime = $prime;

        return $this;
    }

    public function getAvantage(): ?int
    {
        return $this->avantage;
    }

    public function setAvantage(?int $avantage): self
    {
        $this->avantage = $avantage;

        return $this;
    }

    public function getSalaireBrut(): ?int
    {
        return $this->salaireBrut;
    }

    public function setSalaireBrut(int $salaireBrut): self
    {
        $this->salaireBrut = $salaireBrut;

        return $this;
    }

    public function getSalaireNet(): ?int
    {
        return $this->salaireNet;
    }

    public function setSalaireNet(int $salaireNet): self
    {
        $this->salaireNet = $salaireNet;

        return $this;
    }

    public function getCotisationSocial(): ?int
    {
        return $this->cotisationSocial;
    }

    public function setCotisationSocial(int $cotisationSocial): self
    {
        $this->cotisationSocial = $cotisationSocial;

        return $this;
    }

    public function getEmploye(): ?Employes
    {
        return $this->employe;
    }

    public function setEmploye(?Employes $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }
}
