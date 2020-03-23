<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KlantRepository")
 */
class Klant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $klantnaam;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $btwnummer;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=1555)
     */
    private $plaats;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $postcode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Factuur", mappedBy="Klantnummer")
     */
    private $factuurs;

    public function __construct()
    {
        $this->factuurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKlantnaam(): ?string
    {
        return $this->klantnaam;
    }

    public function setKlantnaam(string $klantnaam): self
    {
        $this->klantnaam = $klantnaam;

        return $this;
    }

    public function getBtwnummer(): ?string
    {
        return $this->btwnummer;
    }

    public function setBtwnummer(string $btwnummer): self
    {
        $this->btwnummer = $btwnummer;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    public function setPlaats(string $plaats): self
    {
        $this->plaats = $plaats;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return Collection|Factuur[]
     */
    public function getFactuurs(): Collection
    {
        return $this->factuurs;
    }

    public function addFactuur(Factuur $factuur): self
    {
        if (!$this->factuurs->contains($factuur)) {
            $this->factuurs[] = $factuur;
            $factuur->setKlantnummer($this);
        }

        return $this;
    }

    public function removeFactuur(Factuur $factuur): self
    {
        if ($this->factuurs->contains($factuur)) {
            $this->factuurs->removeElement($factuur);
            // set the owning side to null (unless already changed)
            if ($factuur->getKlantnummer() === $this) {
                $factuur->setKlantnummer(null);
            }
        }

        return $this;
    }
}
