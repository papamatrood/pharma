<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaisseRepository::class)
 */
class Caisse
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
    private $motif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $entre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sortie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $dateAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getEntre(): ?int
    {
        return $this->entre;
    }

    public function setEntre(?int $entre): self
    {
        $this->entre = $entre;

        return $this;
    }

    public function getSortie(): ?int
    {
        return $this->sortie;
    }

    public function setSortie(?int $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateAt(): ?string
    {
        return $this->dateAt;
    }

    public function setDateAt(string $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }
}
