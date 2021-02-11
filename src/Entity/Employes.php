<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployesRepository::class)
 */
class Employes
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissanceAt;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $civilite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEmbaucheAt;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroAssuranceMaladie;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateContratAt;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $situationFamiliale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreEnfant;

    /**
     * @ORM\OneToMany(targetEntity=Salaires::class, mappedBy="employe")
     */
    private $salaires;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateurs::class, cascade={"persist", "remove"})
     */
    private $utilisateur;

    public function __construct()
    {
        $this->salaires = new ArrayCollection();
        $this->dateNaissanceAt = new DateTime('1990-01-01');
        $this->dateEmbaucheAt = new DateTime();
        $this->dateContratAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissanceAt(): ?\DateTimeInterface
    {
        return $this->dateNaissanceAt;
    }

    public function setDateNaissanceAt(\DateTimeInterface $dateNaissanceAt): self
    {
        $this->dateNaissanceAt = $dateNaissanceAt;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

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

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getDateEmbaucheAt(): ?\DateTimeInterface
    {
        return $this->dateEmbaucheAt;
    }

    public function setDateEmbaucheAt(\DateTimeInterface $dateEmbaucheAt): self
    {
        $this->dateEmbaucheAt = $dateEmbaucheAt;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNumeroAssuranceMaladie(): ?int
    {
        return $this->numeroAssuranceMaladie;
    }

    public function setNumeroAssuranceMaladie(?int $numeroAssuranceMaladie): self
    {
        $this->numeroAssuranceMaladie = $numeroAssuranceMaladie;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDateContratAt(): ?\DateTimeInterface
    {
        return $this->dateContratAt;
    }

    public function setDateContratAt(\DateTimeInterface $dateContratAt): self
    {
        $this->dateContratAt = $dateContratAt;

        return $this;
    }

    public function getSituationFamiliale(): ?string
    {
        return $this->situationFamiliale;
    }

    public function setSituationFamiliale(string $situationFamiliale): self
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
    }

    public function getNombreEnfant(): ?int
    {
        return $this->nombreEnfant;
    }

    public function setNombreEnfant(?int $nombreEnfant): self
    {
        $this->nombreEnfant = $nombreEnfant;

        return $this;
    }

    /**
     * @return Collection|Salaires[]
     */
    public function getSalaires(): Collection
    {
        return $this->salaires;
    }

    public function addSalaire(Salaires $salaire): self
    {
        if (!$this->salaires->contains($salaire)) {
            $this->salaires[] = $salaire;
            $salaire->setEmploye($this);
        }

        return $this;
    }

    public function removeSalaire(Salaires $salaire): self
    {
        if ($this->salaires->contains($salaire)) {
            $this->salaires->removeElement($salaire);
            // set the owning side to null (unless already changed)
            if ($salaire->getEmploye() === $this) {
                $salaire->setEmploye(null);
            }
        }

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
}
