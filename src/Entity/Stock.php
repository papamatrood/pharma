<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
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
    private $situation;

    /**
     * @ORM\Column(type="string")
     */
    private $dateAt;

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

    public function getSituation(): ?int
    {
        return $this->situation;
    }

    public function setSituation(?int $situation): self
    {
        $this->situation = $situation;

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
