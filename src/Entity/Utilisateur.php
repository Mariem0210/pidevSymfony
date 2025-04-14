<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['mailu'], message: 'There is already an account with this Mail')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $idu = null;

    #[ORM\Column(type: "string", length: 30)]
    private ?string $nomu = null;

    #[ORM\Column(type: "string", length: 30)]
    private ?string $prenomu = null;

    #[ORM\Column(type: "string", length: 30)]
    private ?string $typeu = null;

    #[ORM\Column(type: "string", length: 40, unique: true)]
    private ?string $mailu = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $mdpu = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $datenaissanceu = null;

    #[ORM\Column(type: "date", options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $dateinscriu = null;

    #[ORM\Column(type: "integer")]
    private ?int $numtelu = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $photo_profilu = null;

    #[ORM\Column(type: "string", length: 4, nullable: true)]
    private ?string $reset_code = null;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP", "onUpdate" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $code_expiration = null;

    #[ORM\Column(type: "json")]
    private array $roles = [];

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function getNomu(): ?string
    {
        return $this->nomu;
    }

    public function setNomu(string $nomu): self
    {
        $this->nomu = $nomu;
        return $this;
    }

    public function getPrenomu(): ?string
    {
        return $this->prenomu;
    }

    public function setPrenomu(string $prenomu): self
    {
        $this->prenomu = $prenomu;
        return $this;
    }

    public function getTypeu(): ?string
    {
        return $this->typeu;
    }

    public function setTypeu(string $typeu): self
    {
        $this->typeu = $typeu;
        return $this;
    }

    public function getMailu(): ?string
    {
        return $this->mailu;
    }       

    public function setMailu(string $mailu): self
    {
        $this->mailu = $mailu;
        return $this;
    }

    public function getMdpu(): ?string
    {
        return $this->mdpu;
    }

    public function setMdpu(string $mdpu): self
    {
        $this->mdpu = $mdpu;
        return $this;
    }

    public function getDatenaissanceu(): ?\DateTimeInterface
    {
        return $this->datenaissanceu;
    }

    public function setDatenaissanceu(\DateTimeInterface $datenaissanceu): self
    {
        $this->datenaissanceu = $datenaissanceu;
        return $this;
    }

    public function getDateinscriu(): ?\DateTimeInterface
    {
        return $this->dateinscriu;
    }

    public function setDateinscriu(\DateTimeInterface $dateinscriu): self
    {
        $this->dateinscriu = $dateinscriu;
        return $this;
    }

    public function getNumtelu(): ?int
    {
        return $this->numtelu;
    }

    public function setNumtelu(int $numtelu): self
    {
        $this->numtelu = $numtelu;
        return $this;
    }

    public function getPhotoProfilu(): ?string
    {
        return $this->photo_profilu;
    }

    public function setPhotoProfilu(?string $photo_profilu): self
    {
        $this->photo_profilu = $photo_profilu;
        return $this;
    }

    public function getResetCode(): ?string
    {
        return $this->reset_code;
    }

    public function setResetCode(?string $reset_code): self
    {
        $this->reset_code = $reset_code;
        return $this;
    }

    public function getCodeExpiration(): ?\DateTimeInterface
    {
        return $this->code_expiration;
    }

    public function setCodeExpiration(\DateTimeInterface $code_expiration): self
    {
        $this->code_expiration = $code_expiration;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->mailu;
    }
    public function getUsername(): string
{
    return $this->getUserIdentifier();
}

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdpu;
    }

    public function setPassword(string $mdpu): self
    {
        $this->mdpu = $mdpu;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }
    public function __construct()
    {
        $this->dateinscriu = new \DateTime(); // Date/heure actuelle par défaut
    }
    public function synchronizeTypeAndRoles(): void
{
    switch ($this->typeu) {
        case 'ADMIN':
            $this->roles = ['ROLE_ADMIN'];
            break;
        case 'COACH':
            $this->roles = ['ROLE_COACH'];
            break;
        case 'JOUEUR':
            $this->roles = ['ROLE_JOUEUR'];
            break;
        default:
            $this->roles = ['ROLE_USER'];
    }
}}
