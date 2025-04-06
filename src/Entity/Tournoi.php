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

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nomt = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $descriptiont = null;

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_debutt = null;

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_fint = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $nbr_equipes = null;

    #[ORM\Column(type: 'float', nullable: false)]
    private ?float $prixt = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $statutt = null;

    #[ORM\OneToMany(mappedBy: 'tournoi', targetEntity: Matches::class)]
    private Collection $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getIdt(): ?int
    {
        return $this->idt;
    }

    public function setIdt(int $idt): self
    {
        $this->idt = $idt;
        return $this;
    }

    public function getNomt(): ?string
    {
        return $this->nomt;
    }

    public function setNomt(string $nomt): self
    {
        $this->nomt = $nomt;
        return $this;
    }

    public function getDescriptiont(): ?string
    {
        return $this->descriptiont;
    }

    public function setDescriptiont(string $descriptiont): self
    {
        $this->descriptiont = $descriptiont;
        return $this;
    }

    public function getDateDebutt(): ?\DateTimeInterface
    {
        return $this->date_debutt;
    }

    public function setDateDebutt(\DateTimeInterface $date_debutt): self
    {
        $this->date_debutt = $date_debutt;
        return $this;
    }

    public function getDateFint(): ?\DateTimeInterface
    {
        return $this->date_fint;
    }

    public function setDateFint(\DateTimeInterface $date_fint): self
    {
        $this->date_fint = $date_fint;
        return $this;
    }

    public function getNbrEquipes(): ?int
    {
        return $this->nbr_equipes;
    }

    public function setNbrEquipes(int $nbr_equipes): self
    {
        $this->nbr_equipes = $nbr_equipes;
        return $this;
    }

    public function getPrixt(): ?float
    {
        return $this->prixt;
    }

    public function setPrixt(float $prixt): self
    {
        $this->prixt = $prixt;
        return $this;
    }

    public function getStatutt(): ?string
    {
        return $this->statutt;
    }

    public function setStatutt(string $statutt): self
    {
        $this->statutt = $statutt;
        return $this;
    }

    /**
     * @return Collection<int, Matches>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matches $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches->add($match);
            $match->setTournoi($this);
        }
        return $this;
    }

    public function removeMatch(Matches $match): self
    {
        if ($this->matches->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getTournoi() === $this) {
                $match->setTournoi(null);
            }
        }
        return $this;
    }
}