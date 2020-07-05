<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;
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
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteurNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteurPrenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez achrger un fichier pdf ou word.")
     * @Assert\File(
     *     mimeTypes = {"application/pdf"  , "application/msword" , "application/vnd.openxmlformats-officedocument.wordprocessingml.document "},
     *     mimeTypesMessage = "Le fichier choisi ne correspond pas à un fichier valide, vous devriez charger un fichier pdf ou word",
     *     notFoundMessage = "Le fichier n'a pas été trouvé sur le disque",
     *     uploadErrorMessage = "Erreur dans l'upload du fichier"
     * )
     */
    private $fichier;

    public function getFichier()
    {
        return $this->fichier;
    }


    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
