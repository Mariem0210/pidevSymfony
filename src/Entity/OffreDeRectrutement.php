<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\OffreDeRectrutementRepository;

#[ORM\Entity(repositoryClass: OffreDeRectrutementRepository::class)]
#[ORM\Table(name: 'offre_de_rectrutement')]
class OffreDeRectrutement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $ido = null;

    public function getIdo(): ?int
    {
        return $this->ido;
    }

    public function setIdo(int $ido): self
    {
        $this->ido = $ido;
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

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $poste_recherche = null;

    public function getPoste_recherche(): ?string
    {
        return $this->poste_recherche;
    }

    public function setPoste_recherche(string $poste_recherche): self
    {
        $this->poste_recherche = $poste_recherche;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $niveu_requis = null;

    public function getNiveu_requis(): ?string
    {
        return $this->niveu_requis;
    }

    public function setNiveu_requis(string $niveu_requis): self
    {
        $this->niveu_requis = $niveu_requis;
        return $this;
    }

    #[ORM\Column(type: 'float', nullable: false)]
    private ?float $salaire_propose = null;

    public function getSalaire_propose(): ?float
    {
        return $this->salaire_propose;
    }

    public function setSalaire_propose(float $salaire_propose): self
    {
        $this->salaire_propose = $salaire_propose;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $status = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $contrat = null;

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        $this->contrat = $contrat;
        return $this;
    }

}
