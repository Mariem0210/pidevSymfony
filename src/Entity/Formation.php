<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\FormationRepository;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
#[ORM\Table(name: 'formation')]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idf = null;

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: "Le nom de la formation est obligatoire.")]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom ne doit pas dépasser {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/",
        message: "Le nom ne peut contenir que des lettres et des espaces."
    )]
    private ?string $nomf = null;

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    #[Assert\Regex(
        pattern: "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/",
        message: "La description ne peut contenir que des lettres et des espaces."
    )]
    private ?string $descriptionf = null;

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: "Le niveau est obligatoire.")]
    private ?string $niveauf = null;

    #[ORM\Column(name: 'dateDebutf', type: 'date', nullable: false)]
    #[Assert\NotNull(message: "La date de début est obligatoire.")]
    #[Assert\Type(type: "DateTimeInterface", message: "La date de début doit être valide.")]
    #[Assert\GreaterThan("today", message: "La date de début doit être ultérieure à aujourd'hui.")]
    private ?\DateTimeInterface $dateDebut = null;
    
    #[ORM\Column(name: 'dateFinf', type: 'date', nullable: false)]
    #[Assert\NotNull(message: "La date de fin est obligatoire.")]
    #[Assert\Type(type: "DateTimeInterface", message: "La date de fin doit être valide.")]
    #[Assert\GreaterThan(propertyPath: "dateDebut", message: "La date de fin doit être après la date de début.")]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotNull(message: "La capacité est obligatoire.")]
    #[Assert\Positive(message: "La capacité doit être un nombre positif.")]
    private ?int $capacitef = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotNull(message: "Le prix est obligatoire.")]
    #[Assert\PositiveOrZero(message: "Le prix ne peut pas être négatif.")]
    private ?int $prixf = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotNull(message: "L'ID utilisateur est obligatoire.")]
    #[Assert\Positive(message: "L'ID utilisateur doit être un nombre positif.")]
    private ?int $idu = null;

    public function getIdf(): ?int
    {
        return $this->idf;
    }

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;
        return $this;
    }

    public function getDescriptionf(): ?string
    {
        return $this->descriptionf;
    }

    public function setDescriptionf(string $descriptionf): self
    {
        $this->descriptionf = $descriptionf;
        return $this;
    }

    public function getNiveauf(): ?string
    {
        return $this->niveauf;
    }

    public function setNiveauf(string $niveauf): self
    {
        $this->niveauf = $niveauf;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getCapacitef(): ?int
    {
        return $this->capacitef;
    }

    public function setCapacitef(int $capacitef): self
    {
        $this->capacitef = $capacitef;
        return $this;
    }

    public function getPrixf(): ?int
    {
        return $this->prixf;
    }

    public function setPrixf(int $prixf): self
    {
        $this->prixf = $prixf;
        return $this;
    }

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function setIdu(int $idu): self
    {
        $this->idu = $idu;
        return $this;
    }
}
