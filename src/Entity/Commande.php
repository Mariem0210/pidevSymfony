<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Utilisateur;

#[ORM\Entity]
class Commande
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id_commande;

        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "commandes")]
    #[ORM\JoinColumn(name: 'idu', referencedColumnName: 'idu', onDelete: 'CASCADE')]
    private Utilisateur $idu;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date_commande;

    #[ORM\Column(type: "float")]
    private float $montant_total;

    public function getId_commande()
    {
        return $this->id_commande;
    }

    public function setId_commande($value)
    {
        $this->id_commande = $value;
    }

    public function getIdu()
    {
        return $this->idu;
    }

    public function setIdu($value)
    {
        $this->idu = $value;
    }

    public function getDate_commande()
    {
        return $this->date_commande;
    }

    public function setDate_commande($value)
    {
        $this->date_commande = $value;
    }

    public function getMontant_total()
    {
        return $this->montant_total;
    }

    public function setMontant_total($value)
    {
        $this->montant_total = $value;
    }
}
