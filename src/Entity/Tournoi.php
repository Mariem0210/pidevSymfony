<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\TournoiRepository;

#[ORM\Entity(repositoryClass: TournoiRepository::class)]
#[ORM\Table(name: 'tournois')]
class Tournoi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idt = null;

    public function getIdt(): ?int
    {
        return $this->idt;
    }

    public function setIdt(int $idt): self
    {
        $this->idt = $idt;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nomt = null;

    public function getNomt(): ?string
    {
        return $this->nomt;
    }

    public function setNomt(string $nomt): self
    {
        $this->nomt = $nomt;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $descriptiont = null;

    public function getDescriptiont(): ?string
    {
        return $this->descriptiont;
    }

    public function setDescriptiont(string $descriptiont): self
    {
        $this->descriptiont = $descriptiont;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_debutt = null;

    public function getDate_debutt(): ?\DateTimeInterface
    {
        return $this->date_debutt;
    }

    public function setDate_debutt(\DateTimeInterface $date_debutt): self
    {
        $this->date_debutt = $date_debutt;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_fint = null;

    public function getDate_fint(): ?\DateTimeInterface
    {
        return $this->date_fint;
    }

    public function setDate_fint(\DateTimeInterface $date_fint): self
    {
        $this->date_fint = $date_fint;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $nbr_equipes = null;

    public function getNbr_equipes(): ?int
    {
        return $this->nbr_equipes;
    }

    public function setNbr_equipes(int $nbr_equipes): self
    {
        $this->nbr_equipes = $nbr_equipes;
        return $this;
    }

    #[ORM\Column(type: 'float', nullable: false)]
    private ?float $prixt = null;

    public function getPrixt(): ?float
    {
        return $this->prixt;
    }

    public function setPrixt(float $prixt): self
    {
        $this->prixt = $prixt;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $statutt = null;

    public function getStatutt(): ?string
    {
        return $this->statutt;
    }

    public function setStatutt(string $statutt): self
    {
        $this->statutt = $statutt;
        return $this;
    }

    public function getDateDebutt(): ?\DateTimeInterface
    {
        return $this->date_debutt;
    }

    public function setDateDebutt(\DateTimeInterface $date_debutt): static
    {
        $this->date_debutt = $date_debutt;

        return $this;
    }

    public function getDateFint(): ?\DateTimeInterface
    {
        return $this->date_fint;
    }

    public function setDateFint(\DateTimeInterface $date_fint): static
    {
        $this->date_fint = $date_fint;

        return $this;
    }

    public function getNbrEquipes(): ?int
    {
        return $this->nbr_equipes;
    }

    public function setNbrEquipes(int $nbr_equipes): static
    {
        $this->nbr_equipes = $nbr_equipes;

        return $this;
    }

}