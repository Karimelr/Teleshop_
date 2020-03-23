<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactuurRepository")
 */
class Factuur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Klant", inversedBy="factuurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Klantnummer;

    /**
     * @ORM\Column(type="date")
     */
    private $factuurdatum;

    /**
     * @ORM\Column(type="date")
     */
    private $vervaldatum;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $inzakeopdracht;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $korting;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Factuurregel", mappedBy="factuurnummer")
     */
    private $factuurnr;

    public function __construct()
    {
        $this->factuurnr = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlantnummer(): ?Klant
    {
        return $this->Klantnummer;
    }

    public function setKlantnummer(?Klant $Klantnummer): self
    {
        $this->Klantnummer = $Klantnummer;

        return $this;
    }

    public function getFactuurdatum(): ?\DateTimeInterface
    {
        return $this->factuurdatum;
    }

    public function setFactuurdatum(\DateTimeInterface $factuurdatum): self
    {
        $this->factuurdatum = $factuurdatum;

        return $this;
    }

    public function getVervaldatum(): ?\DateTimeInterface
    {
        return $this->vervaldatum;
    }

    public function setVervaldatum(\DateTimeInterface $vervaldatum): self
    {
        $this->vervaldatum = $vervaldatum;

        return $this;
    }

    public function getInzakeopdracht(): ?string
    {
        return $this->inzakeopdracht;
    }

    public function setInzakeopdracht(string $inzakeopdracht): self
    {
        $this->inzakeopdracht = $inzakeopdracht;

        return $this;
    }

    public function getKorting(): ?string
    {
        return $this->korting;
    }

    public function setKorting(string $korting): self
    {
        $this->korting = $korting;

        return $this;
    }

    /**
     * @return Collection|Factuurregel[]
     */
    public function getFactuurnr(): Collection
    {
        return $this->factuurnr;
    }

    public function addFactuurnr(Factuurregel $factuurnr): self
    {
        if (!$this->factuurnr->contains($factuurnr)) {
            $this->factuurnr[] = $factuurnr;
            $factuurnr->setFactuurnummer($this);
        }

        return $this;
    }

    public function removeFactuurnr(Factuurregel $factuurnr): self
    {
        if ($this->factuurnr->contains($factuurnr)) {
            $this->factuurnr->removeElement($factuurnr);
            // set the owning side to null (unless already changed)
            if ($factuurnr->getFactuurnummer() === $this) {
                $factuurnr->setFactuurnummer(null);
            }
        }

        return $this;
    }
}
