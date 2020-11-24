<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'CDD' => 'CDD',
                'CDI' => 'CDI',
                'Freelance' => 'Freelance',
            ],
        ]);
    }

    public function __toString(){
        return $this->getType();
    }

    public function getParent()
    {
        return ChoiceType::class;
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="Contrat")
     */
    private $Offres;

    public function __construct()
    {
        $this->Offres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->Offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->Offres->contains($offre)) {
            $this->Offres[] = $offre;
            $offre->setContrat($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->Offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getContrat() === $this) {
                $offre->setContrat(null);
            }
        }

        return $this;
    }
}
