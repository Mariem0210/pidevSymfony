<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\EquipeRepository;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
#[ORM\Table(name: 'equipe')]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $ideq = null;

    public function getIdeq(): ?int
    {
        return $this->ideq;
    }

    public function setIdeq(int $ideq): self
    {
        $this->ideq = $ideq;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_equipe = null;

    public function getNom_equipe(): ?string
    {
        return $this->nom_equipe;
    }

    public function setNom_equipe(string $nom_equipe): self
    {
        $this->nom_equipe = $nom_equipe;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_creation = null;

    public function getDate_creation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDate_creation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idu = null;

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function setIdu(?int $idu): self
    {
        $this->idu = $idu;
        return $this;
    }

}
