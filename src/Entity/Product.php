<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $productomschrijving;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $productbtw;

    /**
     * @ORM\Column(type="float")
     */
    private $productprijs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Factuurregel", mappedBy="productcode")
     */
    private $Productcd;

    public function __construct()
    {
        $this->Productcd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductomschrijving(): ?string
    {
        return $this->productomschrijving;
    }

    public function setProductomschrijving(string $productomschrijving): self
    {
        $this->productomschrijving = $productomschrijving;

        return $this;
    }

    public function getProductbtw(): ?string
    {
        return $this->productbtw;
    }

    public function setProductbtw(string $productbtw): self
    {
        $this->productbtw = $productbtw;

        return $this;
    }

    public function getProductprijs(): ?float
    {
        return $this->productprijs;
    }

    public function setProductprijs(float $productprijs): self
    {
        $this->productprijs = $productprijs;

        return $this;
    }

    /**
     * @return Collection|Factuurregel[]
     */
    public function getProductcd(): Collection
    {
        return $this->Productcd;
    }

    public function addProductcd(Factuurregel $productcd): self
    {
        if (!$this->Productcd->contains($productcd)) {
            $this->Productcd[] = $productcd;
            $productcd->setProductcode($this);
        }

        return $this;
    }

    public function removeProductcd(Factuurregel $productcd): self
    {
        if ($this->Productcd->contains($productcd)) {
            $this->Productcd->removeElement($productcd);
            // set the owning side to null (unless already changed)
            if ($productcd->getProductcode() === $this) {
                $productcd->setProductcode(null);
            }
        }

        return $this;
    }
}
