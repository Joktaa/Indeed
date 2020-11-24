<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_MAJ;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_fin;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="Offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Contrat;

    /**
     * @ORM\ManyToOne(targetEntity=TypeContrat::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeContrat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->Code_postal;
    }

    public function setCodePostal(string $Code_postal): self
    {
        $this->Code_postal = $Code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->Date_creation;
    }

    public function setDateCreation(\DateTimeInterface $Date_creation): self
    {
        $this->Date_creation = $Date_creation;

        return $this;
    }

    public function getDateMAJ(): ?\DateTimeInterface
    {
        return $this->Date_MAJ;
    }

    public function setDateMAJ(?\DateTimeInterface $Date_MAJ): self
    {
        $this->Date_MAJ = $Date_MAJ;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(?\DateTimeInterface $Date_fin): self
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->Contrat;
    }

    public function setContrat(?Contrat $Contrat): self
    {
        $this->Contrat = $Contrat;

        return $this;
    }

    public function getTypeContrat(): ?TypeContrat
    {
        return $this->TypeContrat;
    }

    public function setTypeContrat(?TypeContrat $TypeContrat): self
    {
        $this->TypeContrat = $TypeContrat;

        return $this;
    }
}
