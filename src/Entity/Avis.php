<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $avisText;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;
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
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="tousLesAvis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteurNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteurPrenom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvisText(): ?string
    {
        return $this->avisText;
    }

    public function setAvisText(string $avisText): self
    {
        $this->avisText = $avisText;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

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

    public function getAuteurNom(): ?string
    {
        return $this->auteurNom;
    }

    public function setAuteurNom(string $auteurNom): self
    {
        $this->auteurNom = $auteurNom;

        return $this;
    }

    public function getAuteurPrenom(): ?string
    {
        return $this->auteurPrenom;
    }

    public function setAuteurPrenom(string $auteurPrenom): self
    {
        $this->auteurPrenom = $auteurPrenom;

        return $this;
    }
}
