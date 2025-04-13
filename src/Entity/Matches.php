<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\MatchesRepository;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
#[ORM\Table(name: '`match`')]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idm = null;

    #[ORM\ManyToOne(targetEntity: Tournoi::class, inversedBy: 'matches')]
    #[ORM\JoinColumn(name: 'idt', referencedColumnName: 'idt')]
    private ?Tournoi $tournoi = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $equipe1 = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $equipe2 = null;

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_debutm = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $status = null;

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $score = null;

    public function getIdm(): ?int
    {
        return $this->idm;
    }

    public function setIdm(int $idm): self
    {
        $this->idm = $idm;
        return $this;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): self
    {
        $this->tournoi = $tournoi;
        return $this;
    }

    public function getEquipe1(): ?string
    {
        return $this->equipe1;
    }

    public function setEquipe1(string $equipe1): self
    {
        $this->equipe1 = $equipe1;
        return $this;
    }

    public function getEquipe2(): ?string
    {
        return $this->equipe2;
    }

    public function setEquipe2(string $equipe2): self
    {
        $this->equipe2 = $equipe2;
        return $this;
    }

    public function getDateDebutm(): ?\DateTimeInterface
    {
        return $this->date_debutm;
    }

    public function setDateDebutm(\DateTimeInterface $date_debutm): self
    {
        $this->date_debutm = $date_debutm;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;
        return $this;
    }
}