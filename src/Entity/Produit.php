<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Panier;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id_produit = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private string $nom;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(min: 10, minMessage: "La description doit faire au moins {{ limit }} caractères")]
    private string $description;

    #[ORM\Column(type: "float")]
    #[Assert\NotBlank(message: "Le prix est obligatoire")]
    #[Assert\Positive(message: "Le prix doit être positif")]
    private float $prix;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Le stock est obligatoire")]
    #[Assert\PositiveOrZero(message: "Le stock ne peut pas être négatif")]
    private int $stock;

    #[ORM\Column(type: "date")]
    #[Assert\NotNull(message: "La date de création est obligatoire")]
    private \DateTimeInterface $date_creation;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank(message: "La catégorie est obligatoire")]
    private string $categorie;

    #[ORM\OneToMany(mappedBy: "produit", targetEntity: Panier::class)]
    private Collection $paniers;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    public function getDateCreation(): \DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getImageProduit(): string
    {
        return $this->image_produit;
    }

    public function setImageProduit(string $image_produit): self
    {
        $this->image_produit = $image_produit;
        return $this;
    }

    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setProduit($this);
        }
        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            if ($panier->getProduit() === $this) {
                $panier->setProduit(null);
            }
        }
        return $this;
    }
}