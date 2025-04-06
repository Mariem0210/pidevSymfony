<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\UtilisateurRepository;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\Table(name: 'utilisateur')]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
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
    private ?string $nomu = null;

    public function getNomu(): ?string
    {
        return $this->nomu;
    }

    public function setNomu(string $nomu): self
    {
        $this->nomu = $nomu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenomu = null;

    public function getPrenomu(): ?string
    {
        return $this->prenomu;
    }

    public function setPrenomu(string $prenomu): self
    {
        $this->prenomu = $prenomu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $typeu = null;

    public function getTypeu(): ?string
    {
        return $this->typeu;
    }

    public function setTypeu(string $typeu): self
    {
        $this->typeu = $typeu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $mailu = null;

    public function getMailu(): ?string
    {
        return $this->mailu;
    }

    public function setMailu(string $mailu): self
    {
        $this->mailu = $mailu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $mdpu = null;

    public function getMdpu(): ?string
    {
        return $this->mdpu;
    }

    public function setMdpu(string $mdpu): self
    {
        $this->mdpu = $mdpu;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $datenaissanceu = null;

    public function getDatenaissanceu(): ?\DateTimeInterface
    {
        return $this->datenaissanceu;
    }

    public function setDatenaissanceu(\DateTimeInterface $datenaissanceu): self
    {
        $this->datenaissanceu = $datenaissanceu;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateinscriu = null;

    public function getDateinscriu(): ?\DateTimeInterface
    {
        return $this->dateinscriu;
    }

    public function setDateinscriu(\DateTimeInterface $dateinscriu): self
    {
        $this->dateinscriu = $dateinscriu;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $numtelu = null;

    public function getNumtelu(): ?int
    {
        return $this->numtelu;
    }

    public function setNumtelu(int $numtelu): self
    {
        $this->numtelu = $numtelu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $photo_profilu = null;

    public function getPhoto_profilu(): ?string
    {
        return $this->photo_profilu;
    }

    public function setPhoto_profilu(?string $photo_profilu): self
    {
        $this->photo_profilu = $photo_profilu;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $reset_code = null;

    public function getReset_code(): ?string
    {
        return $this->reset_code;
    }

    public function setReset_code(?string $reset_code): self
    {
        $this->reset_code = $reset_code;
        return $this;
    }

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $code_expiration = null;

    public function getCode_expiration(): ?\DateTimeInterface
    {
        return $this->code_expiration;
    }

    public function setCode_expiration(?\DateTimeInterface $code_expiration): self
    {
        $this->code_expiration = $code_expiration;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'utilisateur')]
    private Collection $commandes;

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        if (!$this->commandes instanceof Collection) {
            $this->commandes = new ArrayCollection();
        }
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->getCommandes()->contains($commande)) {
            $this->getCommandes()->add($commande);
        }
        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        $this->getCommandes()->removeElement($commande);
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Panier::class, mappedBy: 'utilisateur')]
    private Collection $paniers;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        if (!$this->paniers instanceof Collection) {
            $this->paniers = new ArrayCollection();
        }
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->getPaniers()->contains($panier)) {
            $this->getPaniers()->add($panier);
        }
        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        $this->getPaniers()->removeElement($panier);
        return $this;
    }

    public function getPhotoProfilu(): ?string
    {
        return $this->photo_profilu;
    }

    public function setPhotoProfilu(?string $photo_profilu): static
    {
        $this->photo_profilu = $photo_profilu;

        return $this;
    }

    public function getResetCode(): ?string
    {
        return $this->reset_code;
    }

    public function setResetCode(?string $reset_code): static
    {
        $this->reset_code = $reset_code;

        return $this;
    }

    public function getCodeExpiration(): ?\DateTimeInterface
    {
        return $this->code_expiration;
    }

    public function setCodeExpiration(?\DateTimeInterface $code_expiration): static
    {
        $this->code_expiration = $code_expiration;

        return $this;
    }

}
