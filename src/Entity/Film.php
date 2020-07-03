<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $resume;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $RapporteurNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $RapporteurPrenom;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(?string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getRapporteurNom(): ?string
    {
        return $this->RapporteurNom;
    }

    public function setRapporteurNom(string $RapporteurNom): self
    {
        $this->RapporteurNom = $RapporteurNom;

        return $this;
    }

    public function getRapporteurPrenom(): ?string
    {
        return $this->RapporteurPrenom;
    }

    public function setRapporteurPrenom(string $RapporteurPrenom): self
    {
        $this->RapporteurPrenom = $RapporteurPrenom;

        return $this;
    }
}
