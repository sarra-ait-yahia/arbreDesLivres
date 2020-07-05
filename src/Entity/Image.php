<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\File( mimeTypes = {"image/jpeg", "image/png", "image/gif", "image/jpg"},
     *  mimeTypesMessage = "Ce fichier doit être une image ")
     */
    private $image;

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
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="images")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

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
