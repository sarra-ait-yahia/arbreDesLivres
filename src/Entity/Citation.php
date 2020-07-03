<?php

namespace App\Entity;

use App\Repository\CitationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitationRepository::class)
 */
class Citation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEcriture;

    /**
     * @return mixed
     */
    public function getDateEcriture()
    {
        return $this->dateEcriture;
    }

    /**
     * @param mixed $dateEcriture
     */
    public function setDateEcriture($dateEcriture): void
    {
        $this->dateEcriture = $dateEcriture;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rapporteurNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rapporteurPrenom;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="Citations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getRapporteurNom(): ?string
    {
        return $this->rapporteurNom;
    }

    public function setRapporteurNom(string $rapporteurNom): self
    {
        $this->rapporteurNom = $rapporteurNom;

        return $this;
    }

    public function getRapporteurPrenom(): ?string
    {
        return $this->rapporteurPrenom;
    }

    public function setRapporteurPrenom(string $rapporteurPrenom): self
    {
        $this->rapporteurPrenom = $rapporteurPrenom;

        return $this;
    }

    public function getIdLivre(): ?Livre
    {
        return $this->idLivre;
    }

    public function setIdLivre(?Livre $idLivre): self
    {
        $this->idLivre = $idLivre;

        return $this;
    }
}
