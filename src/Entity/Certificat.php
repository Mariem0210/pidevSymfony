<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\CertificatRepository;

#[ORM\Entity(repositoryClass: CertificatRepository::class)]
#[ORM\Table(name: 'certificat')]
class Certificat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idc = null;

    public function getIdc(): ?int
    {
        return $this->idc;
    }

    public function setIdc(int $idc): self
    {
        $this->idc = $idc;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
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
    private ?string $nomc = null;

    public function getNomc(): ?string
    {
        return $this->nomc;
    }

    public function setNomc(string $nomc): self
    {
        $this->nomc = $nomc;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $typec = null;

    public function getTypec(): ?string
    {
        return $this->typec;
    }

    public function setTypec(string $typec): self
    {
        $this->typec = $typec;
        return $this;
    }

    #[ORM\Column(type: 'float', nullable: false)]
    private ?float $scorec = null;

    public function getScorec(): ?float
    {
        return $this->scorec;
    }

    public function setScorec(float $scorec): self
    {
        $this->scorec = $scorec;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $etatc = null;

    public function getEtatc(): ?string
    {
        return $this->etatc;
    }

    public function setEtatc(string $etatc): self
    {
        $this->etatc = $etatc;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateExpirationc = null;

    public function getDateExpirationc(): ?\DateTimeInterface
    {
        return $this->dateExpirationc;
    }

    public function setDateExpirationc(\DateTimeInterface $dateExpirationc): self
    {
        $this->dateExpirationc = $dateExpirationc;
        return $this;
    }

}
