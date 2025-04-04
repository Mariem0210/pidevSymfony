<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\FormationRepository;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
#[ORM\Table(name: 'formation')]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idf = null;

    public function getIdf(): ?int
    {
        return $this->idf;
    }

    public function setIdf(int $idf): self
    {
        $this->idf = $idf;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nomf = null;

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $descriptionf = null;

    public function getDescriptionf(): ?string
    {
        return $this->descriptionf;
    }

    public function setDescriptionf(string $descriptionf): self
    {
        $this->descriptionf = $descriptionf;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $niveauf = null;

    public function getNiveauf(): ?string
    {
        return $this->niveauf;
    }

    public function setNiveauf(string $niveauf): self
    {
        $this->niveauf = $niveauf;
        return $this;
    }

    #[ORM\Column(name: 'dateDebutf', type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateDebut = null;
    
    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }
    
    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }
    
    #[ORM\Column(name: 'dateFinf', type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateFin = null;
    
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }
    
    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $capacitef = null;

    public function getCapacitef(): ?int
    {
        return $this->capacitef;
    }

    public function setCapacitef(int $capacitef): self
    {
        $this->capacitef = $capacitef;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $prixf = null;

    public function getPrixf(): ?int
    {
        return $this->prixf;
    }

    public function setPrixf(int $prixf): self
    {
        $this->prixf = $prixf;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $idu = null;

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
