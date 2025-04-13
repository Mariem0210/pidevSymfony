<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\GiveawayRepository;

#[ORM\Entity(repositoryClass: GiveawayRepository::class)]
#[ORM\Table(name: 'giveaway')]
class Giveaway
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idg = null;

    public function getIdg(): ?int
    {
        return $this->idg;
    }

    public function setIdg(int $idg): self
    {
        $this->idg = $idg;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $titreg = null;

    public function getTitreg(): ?string
    {
        return $this->titreg;
    }

    public function setTitreg(string $titreg): self
    {
        $this->titreg = $titreg;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $descg = null;

    public function getDescg(): ?string
    {
        return $this->descg;
    }

    public function setDescg(string $descg): self
    {
        $this->descg = $descg;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $datedg = null;

    public function getDatedg(): ?\DateTimeInterface
    {
        return $this->datedg;
    }

    public function setDatedg(\DateTimeInterface $datedg): self
    {
        $this->datedg = $datedg;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $datefg = null;

    public function getDatefg(): ?\DateTimeInterface
    {
        return $this->datefg;
    }

    public function setDatefg(\DateTimeInterface $datefg): self
    {
        $this->datefg = $datefg;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $statusg = null;

    public function getStatusg(): ?string
    {
        return $this->statusg;
    }

    public function setStatusg(string $statusg): self
    {
        $this->statusg = $statusg;
        return $this;
    }

}
