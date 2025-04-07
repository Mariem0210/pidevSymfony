<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Produit;

#[ORM\Entity]
class Panier
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id_panier;

        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "paniers")]
    #[ORM\JoinColumn(name: 'idu', referencedColumnName: 'idu', onDelete: 'CASCADE')]
    private Utilisateur $idu;

        #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: "paniers")]
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'id_produit', onDelete: 'CASCADE')]
    private Produit $id_produit;

    #[ORM\Column(type: "integer")]
    private int $quantite;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $date_ajout;

    public function getId_panier()
    {
        return $this->id_panier;
    }

    public function setId_panier($value)
    {
        $this->id_panier = $value;
    }

    public function getIdu()
    {
        return $this->idu;
    }

    public function setIdu($value)
    {
        $this->idu = $value;
    }

    public function getId_produit()
    {
        return $this->id_produit;
    }

    public function setId_produit($value)
    {
        $this->id_produit = $value;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($value)
    {
        $this->quantite = $value;
    }

    public function getDate_ajout()
    {
        return $this->date_ajout;
    }

    public function setDate_ajout($value)
    {
        $this->date_ajout = $value;
    }
}
