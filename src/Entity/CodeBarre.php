<?php

namespace App\Entity;

use App\Repository\CodeBarreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodeBarreRepository::class)
 */
class CodeBarre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="codesBarre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idLivre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $code;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $RapporteurNom;

    /**
     * @return mixed
     */
    public function getRapporteurPrenom()
    {
        return $this->RapporteurPrenom;
    }

    /**
     * @param mixed $RapporteurPrenom
     */
    public function setRapporteurPrenom($RapporteurPrenom): void
    {
        $this->RapporteurPrenom = $RapporteurPrenom;
    }

    /**
     * @return mixed
     */
    public function getRapporteurNom()
    {
        return $this->RapporteurNom;
    }

    /**
     * @param mixed $RapporteurNom
     */
    public function setRapporteurNom($RapporteurNom): void
    {
        $this->RapporteurNom = $RapporteurNom;
    }

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
