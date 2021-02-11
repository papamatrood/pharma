<?php

namespace App\Entity;

use App\Repository\FournisseursRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseursRepository::class)
 * @UniqueEntity("numero")
 */
class Fournisseurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}([-. ]?[0-9]{2}){3}$/",
     *     match=true,
     *     message="Veuillez entrer un numéro de téléphone valide"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $telephone;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}
