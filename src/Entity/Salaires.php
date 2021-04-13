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
