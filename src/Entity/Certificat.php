<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CertificatRepository;

#[ORM\Entity(repositoryClass: CertificatRepository::class)]
class Certificat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idc', type: 'integer')]
    private ?int $idc = null;

 
    #[ORM\Column(name: 'idf', type: 'integer')]
    private ?int $idf = null; // Changé de formationId à idf pour cohérence

    #[ORM\Column(name: 'idu', type: 'integer')]
    private ?int $idu = null; // Changé de userId à idu pour cohérence

    #[ORM\Column(name: 'nomc', type: 'string', length: 255)]
    private ?string $nomc = null;

    #[ORM\Column(name: 'typec', type: 'string', length: 50)]
    private ?string $typec = null;

    #[ORM\Column(name: 'scorec', type: 'float')]
    private ?float $scorec = null;

    #[ORM\Column(name: 'etatc', type: 'string', length: 20)]
    private ?string $etatc = null;

    #[ORM\Column(name: 'dateExpirationc', type: 'date')]
    private ?\DateTimeInterface $dateExpirationc = null; // Nom corrigé pour cohérence

    // Getters and setters...
    public function getIdc(): ?int { return $this->idc; }
    
    public function getIdf(): ?int { return $this->idf; }
    public function setIdf(int $idf): self { $this->idf = $idf; return $this; }

    public function getIdu(): ?int { return $this->idu; }
    public function setIdu(int $idu): self { $this->idu = $idu; return $this; }
    
    // Corrigé pour utiliser nomc partout
    public function getNomc(): ?string { return $this->nomc; }
    public function setNomc(string $nomc): self { $this->nomc = $nomc; return $this; }
    
    // Corrigé pour utiliser typec partout
    public function getTypec(): ?string { return $this->typec; }
    public function setTypec(string $typec): self { $this->typec = $typec; return $this; }
    
    // Corrigé pour utiliser scorec partout
    public function getScorec(): ?float { return $this->scorec; }
    public function setScorec(float $scorec): self { $this->scorec = $scorec; return $this; }
    
    // Corrigé pour utiliser etatc partout
    public function getEtatc(): ?string { return $this->etatc; }
    public function setEtatc(string $etatc): self { $this->etatc = $etatc; return $this; }
    
    // Corrigé pour utiliser dateExpirationc partout
    public function getDateExpirationc(): ?\DateTimeInterface { return $this->dateExpirationc; }
    public function setDateExpirationc(\DateTimeInterface $dateExpirationc): self { 
        $this->dateExpirationc = $dateExpirationc; 
        return $this; 
    }
}