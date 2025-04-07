<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\TransfertRepository;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: TransfertRepository::class)]
#[ORM\Table(name: 'transfert')]
class Transfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idtr = null;

    public function getIdtr(): ?int
    {
        return $this->idtr;
    }

    public function setIdtr(int $idtr): self
    {
        $this->idtr = $idtr;
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
    private ?string $ancienne_equipe = null;

    public function getAncienne_equipe(): ?string
    {
        return $this->ancienne_equipe;
    }

    public function setAncienne_equipe(string $ancienne_equipe): self
    {
        $this->ancienne_equipe = $ancienne_equipe;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nouvelle_equipe = null;

    public function getNouvelle_equipe(): ?string
    {
        return $this->nouvelle_equipe;
    }

    public function setNouvelle_equipe(string $nouvelle_equipe): self
    {
        $this->nouvelle_equipe = $nouvelle_equipe;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $montantt = null;

    public function getMontantt(): ?int
    {
        return $this->montantt;
    }

    public function setMontantt(int $montantt): self
    {
        $this->montantt = $montantt;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $datet = null;

    public function getDatet(): ?\DateTimeInterface
    {
        return $this->datet;
    }

    public function setDatet(\DateTimeInterface $datet): self
    {
        $this->datet = $datet;
        return $this;
    }

    public function getAncienneEquipe(): ?string
    {
        return $this->ancienne_equipe;
    }

    public function setAncienneEquipe(string $ancienne_equipe): static
    {
        $this->ancienne_equipe = $ancienne_equipe;

        return $this;
    }

    public function getNouvelleEquipe(): ?string
    {
        return $this->nouvelle_equipe;
    }

    public function setNouvelleEquipe(string $nouvelle_equipe): static
    {
        $this->nouvelle_equipe = $nouvelle_equipe;

        return $this;
    }

}
