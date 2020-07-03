<?php

namespace App\Entity;

use App\Repository\ConseilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConseilRepository::class)
 */
class Conseil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="conseils")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $conseilText;

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

    public function getConseilText(): ?string
    {
        return $this->conseilText;
    }

    public function setConseilText(string $conseilText): self
    {
        $this->conseilText = $conseilText;

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
