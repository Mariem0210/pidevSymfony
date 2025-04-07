<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Panier;

#[ORM\Entity]
class Utilisateur
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $idu;

    #[ORM\Column(type: "string", length: 100)]
    private string $nom;

    #[ORM\Column(type: "string", length: 255)]
    private string $email;

    #[ORM\Column(type: "string", length: 255)]
    private string $mot_de_passe;

    public function getIdu()
    {
        return $this->idu;
    }

    public function setIdu($value)
    {
        $this->idu = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getMot_de_passe()
    {
        return $this->mot_de_passe;
    }

    public function setMot_de_passe($value)
    {
        $this->mot_de_passe = $value;
    }

    #[ORM\OneToMany(mappedBy: "idu", targetEntity: Commande::class)]
    private Collection $commandes;

        public function getCommandes(): Collection
        {
            return $this->commandes;
        }
    
        public function addCommande(Commande $commande): self
        {
            if (!$this->commandes->contains($commande)) {
                $this->commandes[] = $commande;
                $commande->setIdu($this);
            }
    
            return $this;
        }
    
        public function removeCommande(Commande $commande): self
        {
            if ($this->commandes->removeElement($commande)) {
                // set the owning side to null (unless already changed)
                if ($commande->getIdu() === $this) {
                    $commande->setIdu(null);
                }
            }
    
            return $this;
        }

    #[ORM\OneToMany(mappedBy: "idu", targetEntity: Panier::class)]
    private Collection $paniers;
}
