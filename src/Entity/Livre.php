<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
    private $titre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $editeur;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $resume;

    /**
     * @ORM\OneToMany(targetEntity=CodeBarre::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $codesBarre;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $tousLesAvis;

    /**
     * @ORM\OneToMany(targetEntity=Citation::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $Citations;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $Evenements;

    /**
     * @ORM\OneToMany(targetEntity=Film::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity=Conseil::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $conseils;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity=Son::class, mappedBy="idLivre", orphanRemoval=true,cascade={"persist"}))
     */
    private $sons;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="idLivre", orphanRemoval=true)
     */
    private $questions;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    public function __construct()
    {
        $this->codesBarre = new ArrayCollection();
        $this->tousLesAvis = new ArrayCollection();
        $this->Citations = new ArrayCollection();
        $this->Evenements = new ArrayCollection();
        $this->films = new ArrayCollection();
        $this->conseils = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->sons = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(?string $editeur): self
    {
        $this->editeur = $editeur;

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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection|CodeBarre[]
     */
    public function getCodesBarre(): Collection
    {
        return $this->codesBarre;
    }

    public function addCodesBarre(CodeBarre $codesBarre): self
    {
        if (!$this->codesBarre->contains($codesBarre)) {
            $this->codesBarre[] = $codesBarre;
            $codesBarre->setIdLivre($this);
        }

        return $this;
    }

    public function removeCodesBarre(CodeBarre $codesBarre): self
    {
        if ($this->codesBarre->contains($codesBarre)) {
            $this->codesBarre->removeElement($codesBarre);
            // set the owning side to null (unless already changed)
            if ($codesBarre->getIdLivre() === $this) {
                $codesBarre->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getTousLesAvis(): Collection
    {
        return $this->tousLesAvis;
    }

    public function addTousLesAvi(Avis $tousLesAvi): self
    {
        if (!$this->tousLesAvis->contains($tousLesAvi)) {
            $this->tousLesAvis[] = $tousLesAvi;
            $tousLesAvi->setIdLivre($this);
        }

        return $this;
    }

    public function removeTousLesAvi(Avis $tousLesAvi): self
    {
        if ($this->tousLesAvis->contains($tousLesAvi)) {
            $this->tousLesAvis->removeElement($tousLesAvi);
            // set the owning side to null (unless already changed)
            if ($tousLesAvi->getIdLivre() === $this) {
                $tousLesAvi->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Citation[]
     */
    public function getCitations(): Collection
    {
        return $this->Citations;
    }

    public function addCitation(Citation $citation): self
    {
        if (!$this->Citations->contains($citation)) {
            $this->Citations[] = $citation;
            $citation->setIdLivre($this);
        }

        return $this;
    }

    public function removeCitation(Citation $citation): self
    {
        if ($this->Citations->contains($citation)) {
            $this->Citations->removeElement($citation);
            // set the owning side to null (unless already changed)
            if ($citation->getIdLivre() === $this) {
                $citation->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->Evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->Evenements->contains($evenement)) {
            $this->Evenements[] = $evenement;
            $evenement->setIdLivre($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->Evenements->contains($evenement)) {
            $this->Evenements->removeElement($evenement);
            // set the owning side to null (unless already changed)
            if ($evenement->getIdLivre() === $this) {
                $evenement->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->setIdLivre($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->films->contains($film)) {
            $this->films->removeElement($film);
            // set the owning side to null (unless already changed)
            if ($film->getIdLivre() === $this) {
                $film->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conseil[]
     */
    public function getConseils(): Collection
    {
        return $this->conseils;
    }

    public function addConseil(Conseil $conseil): self
    {
        if (!$this->conseils->contains($conseil)) {
            $this->conseils[] = $conseil;
            $conseil->setIdLivre($this);
        }

        return $this;
    }

    public function removeConseil(Conseil $conseil): self
    {
        if ($this->conseils->contains($conseil)) {
            $this->conseils->removeElement($conseil);
            // set the owning side to null (unless already changed)
            if ($conseil->getIdLivre() === $this) {
                $conseil->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setIdLivre($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getIdLivre() === $this) {
                $image->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setIdLivre($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getIdLivre() === $this) {
                $document->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Son[]
     */
    public function getSons(): Collection
    {
        return $this->sons;
    }

    public function addSon(Son $son): self
    {
        if (!$this->sons->contains($son)) {
            $this->sons[] = $son;
            $son->setIdLivre($this);
        }

        return $this;
    }

    public function removeSon(Son $son): self
    {
        if ($this->sons->contains($son)) {
            $this->sons->removeElement($son);
            // set the owning side to null (unless already changed)
            if ($son->getIdLivre() === $this) {
                $son->setIdLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setIdLivre($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getIdLivre() === $this) {
                $question->setIdLivre(null);
            }
        }

        return $this;
    }
}
