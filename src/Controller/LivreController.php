<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Citation;
use App\Entity\CodeBarre;
use App\Entity\Conseil;
use App\Entity\Document;
use App\Entity\Evenement;
use App\Entity\Film;
use App\Entity\Image;
use App\Entity\Livre;
use App\Entity\Question;
use App\Entity\Son;
use App\Form\AvisType;
use App\Form\CitationType;
use App\Form\CodeBarreType;
use App\Form\ConseilType;
use App\Form\DocumentType;
use App\Form\EvenementType;
use App\Form\FilmType;
use App\Form\ImageType;
use App\Form\LivreType;
use App\Form\QuestionType;
use App\Form\SonType;
use App\Repository\LivreRepository;
use App\Repository\SonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_showLivres", methods={"GET"})
     */
    public function showLivres(LivreRepository $livreRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $donnees=$livreRepository->findLivresOfUser($this->getUser());
        $livres=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('livre/showLivres.html.twig', [
            'livres' => $livres,
        ]);
    }

    /**
     * @Route("/index", name="livre_index", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $donnees=$livreRepository->findAll();
        $livres=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('livre/indexTousLivres.html.twig', [
            'livres'=>$livres,
        ]);
    }
    /**
     * @Route("/{id}/showdetailLivreBase", name="showdetailLivreBase", methods={"GET","POST"})
     */
    public function showdetailLivreBase( Livre $livre): Response
    {
        return $this->render('livre/showDetailLivre.html.twig',['livre'=>$livre,]);
    }

    /**
     * @Route("/new", name="livre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livre();
        $son = new Son();
        $livre->addSon($son);
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier=$son->getSon();
            $livre->setDateEcriture(new \DateTime('now'));
            $son->setDateEcriture(new \DateTime('now'));
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $nomFichier=$replacedTitre.'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $son->setSon($nomFichier);
            $livre->setIdUser($this->getUser());
            $find=array("<br>", "<br/>", "<br />");
            $livre->setResume(str_replace($find,"\n",  nl2br( $form->get('resume')->getData())));
            $son->setAuteurNom($this->getUser()->getNom());
            $son->setAuteurPrenom($this->getUser()->getPrenom());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return  $this->render('livre/index.html.twig',[
                'nbavis'=>0,
                'nbquestion'=>0,
                'nbcodebarre'=>0,
                'nbconseil'=>0,
                'nbevenement'=>0,
                'nbcitation'=>0,
                'nbimage'=>0,
                'nbfilm'=>0,
                'nbdocument'=>0,
                'nbson'=>1,
                'livre'=>$livre,
                'son'=>'uploads/'.$nomFichier,
            ]);
        }



        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/newAvis", name="avis_new", methods={"GET","POST"})
     */
    public function newAvis(Request $request , Livre $livre): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avi->setIdLivre($livre);
            $avi->setDateEcriture(new \DateTime('now'));
            $find=array("<br>", "<br/>", "<br />");
            $avi->setAvisText(str_replace($find,"\n",  nl2br( $form->get('avisText')->getData())));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avi);
            $entityManager->flush();
            $messageSucces='Votre avis a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }
        return $this->render('avis/_form.html.twig', [
            'avi'=>$avi,
            'form' => $form->createView(),
            'id' =>$livre->getId(),

        ]);
    }

    /**
     * @Route("/{id}/newDoc", name="document_new", methods={"GET","POST"})
     */
    public function newDoc( Livre $livre): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }

        return $this->render('document/_form.html.twig', [
            'document'=>$document,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newDocAction", name="document_action", methods={"GET","POST"})
     */
    public function newDocAction(Request $request, Livre $livre): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document->setIdLivre($livre);
            $document->setDateEcriture(new \DateTime('now'));
            $document->setVue(0);
            $fichier=$document->getFichier();
            $nomFichier= md5(uniqid()).'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $document->setFichier($nomFichier);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();
            $messageSucces='Votre document a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }
        $messageError="Votre document n'a  pas été enregistré,\n son format n'est pas valide";
        $titre=$livre->getTitre().'MainSon';
        $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
        $pathSon='uploads/'.$replacedTitre.'.mpga';
        $nbavis=count($livre->getTousLesAvis());
        $nbquestion=count($livre->getQuestions());
        $nbcodebarre=count($livre->getCodesBarre());
        $nbconseil=count($livre->getConseils());
        $nbevenement=count($livre->getEvenements());
        $nbcitation=count($livre->getCitations());
        $nbimage=count($livre->getImages());
        $nbfilm=count($livre->getFilms());
        $nbdocument=count($livre->getDocuments());
        $nbson=count($livre->getSons());
        return  $this->render('livre/index.html.twig',[
            'nbavis'=>$nbavis,
            'nbquestion'=>$nbquestion,
            'nbcodebarre'=>$nbcodebarre,
            'nbconseil'=>$nbconseil,
            'nbevenement'=>$nbevenement,
            'nbcitation'=>$nbcitation,
            'nbimage'=>$nbimage,
            'nbfilm'=>$nbfilm,
            'nbdocument'=>$nbdocument,
            'nbson'=>$nbson,
            'livre'=>$livre,
            'message'=>$messageError,
            'son'=>$pathSon,
        ]);
    }

    /**
     * @Route("/{id}/newCitation", name="citation_new", methods={"GET","POST"})
     */
    public function newCitation(Request $request, Livre $livre): Response
    {
        $citation = new Citation();
        $form = $this->createForm(CitationType::class, $citation);
        if($this->getUser()){
            $form->get('rapporteurNom')->setData($this->getUser()->getNom());
            $form->get('rapporteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $citation->setIdLivre($livre);
            $find=array("<br>", "<br/>", "<br />");
            $citation->setText(str_replace($find,"\n",  nl2br( $form->get('text')->getData())));
            $citation->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($citation);
            $entityManager->flush();

            $messageSucces='Votre citation a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('citation/_form.html.twig',[
            'citation' => $citation,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }


    /**
     * @Route("/{id}/newEvent", name="evenement_new", methods={"GET","POST"})
     */
    public function newEvent(Request $request, Livre $livre): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        if($this->getUser()){
            $form->get('rappoteurNom')->setData($this->getUser()->getNom());
            $form->get('rapporteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setIdLivre($livre);
            $find=array("<br>", "<br/>", "<br />");
            $evenement->setDescription(str_replace($find,"\n",  nl2br( $form->get('description')->getData())));
            $evenement->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $messageSucces='Votre évènement a été enregistré'; $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('evenement/_form.html.twig',[
            'evenement' => $evenement,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newSon", name="son_new", methods={"GET","POST"})
     */
    public function newSon(Livre $livre): Response
    {
        $son = new Son();
        $form = $this->createForm(SonType::class, $son);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }
        return $this->render('son/_form.html.twig',[
            'son' => $son,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newSonAction", name="son_action", methods={"GET","POST"})
     */
    public function newSonAction(Request $request, Livre $livre): Response
    {
        $son = new Son();
        $form = $this->createForm(SonType::class, $son);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $son->setIdLivre($livre);
            $son->setDateEcriture(new \DateTime('now'));
            $fichier=$son->getSon();
            $nomFichier= md5(uniqid()).'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $son->setSon($nomFichier);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($son);
            $entityManager->flush();

            $messageSucces='Votre son a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        $messageError="Votre son n'a pas été enregistré, \n son format n'est pas valide";
        $titre=$livre->getTitre().'MainSon';
        $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
        $pathSon='uploads/'.$replacedTitre.'.mpga';
        $nbavis=count($livre->getTousLesAvis());
        $nbquestion=count($livre->getQuestions());
        $nbcodebarre=count($livre->getCodesBarre());
        $nbconseil=count($livre->getConseils());
        $nbevenement=count($livre->getEvenements());
        $nbcitation=count($livre->getCitations());
        $nbimage=count($livre->getImages());
        $nbfilm=count($livre->getFilms());
        $nbdocument=count($livre->getDocuments());
        $nbson=count($livre->getSons());
        return  $this->render('livre/index.html.twig',[
            'nbavis'=>$nbavis,
            'nbquestion'=>$nbquestion,
            'nbcodebarre'=>$nbcodebarre,
            'nbconseil'=>$nbconseil,
            'nbevenement'=>$nbevenement,
            'nbcitation'=>$nbcitation,
            'nbimage'=>$nbimage,
            'nbfilm'=>$nbfilm,
            'nbdocument'=>$nbdocument,
            'nbson'=>$nbson,
            'livre'=>$livre,
            'message'=>$messageError,
            'son'=>$pathSon,
        ]);
    }


    /**
     * @Route("/{id}/newImage", name="image_new", methods={"GET","POST"})
     */
    public function newImage( Livre $livre): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }

        return $this->render('image/_form.html.twig',[
            'image' => $image,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newImageAction", name="image_action", methods={"GET","POST"})
     */
    public function newImageAction(Request $request, Livre $livre): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image->setIdLivre($livre);
            $image->setDateEcriture(new \DateTime('now'));
            $fichier=$image->getImage();
            $nomFichier= md5(uniqid()).'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $image->setImage($nomFichier);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            $messageSucces='Votre image a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        $messageError="Votre image n'a pas été enregistré,\n son format n'est pas valide";
        $titre=$livre->getTitre().'MainSon';
        $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
        $pathSon='uploads/'.$replacedTitre.'.mpga';
        $nbavis=count($livre->getTousLesAvis());
        $nbquestion=count($livre->getQuestions());
        $nbcodebarre=count($livre->getCodesBarre());
        $nbconseil=count($livre->getConseils());
        $nbevenement=count($livre->getEvenements());
        $nbcitation=count($livre->getCitations());
        $nbimage=count($livre->getImages());
        $nbfilm=count($livre->getFilms());
        $nbdocument=count($livre->getDocuments());
        $nbson=count($livre->getSons());
        return  $this->render('livre/index.html.twig',[
            'nbavis'=>$nbavis,
            'nbquestion'=>$nbquestion,
            'nbcodebarre'=>$nbcodebarre,
            'nbconseil'=>$nbconseil,
            'nbevenement'=>$nbevenement,
            'nbcitation'=>$nbcitation,
            'nbimage'=>$nbimage,
            'nbfilm'=>$nbfilm,
            'nbdocument'=>$nbdocument,
            'nbson'=>$nbson,
            'livre'=>$livre,
            'message'=>$messageError,
            'son'=>$pathSon,
        ]);
    }


    /**
     * @Route("/{id}/newFilm", name="film_new", methods={"GET","POST"})
     */
    public function newFilm(Request $request, Livre $livre): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        if($this->getUser()){
            $form->get('RapporteurNom')->setData($this->getUser()->getNom());
            $form->get('RapporteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film->setIdLivre($livre);
            $find=array("<br>", "<br/>", "<br />");
            $film->setResume(str_replace($find,"\n",  nl2br( $form->get('resume')->getData())));
            $film->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            $messageSucces='Le nom du film a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('film/_form.html.twig',[
            'film' => $film,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }


    /**
     * @Route("/{id}/newQuestion", name="question_new", methods={"GET","POST"})
     */
    public function newQuestion(Request $request, Livre $livre,\Swift_Mailer $mailer): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
            $form->get('mail')->setData($this->getUser()->getEmail());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setIdLivre($livre);
            $find=array("<br>", "<br/>", "<br />");
            $question->setQuestion(str_replace($find,"\n",  nl2br( $form->get('question')->getData())));
            $question->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            $message = (new \Swift_Message($livre->getIdUser()->getEmail()))
                ->setFrom('arbreDuLivre@gmail.com')
                ->setTo($livre->getIdUser()->getEmail())
                ->setBody('Une question vient d\'être ajouté sur le livre '.$livre->getTitre().' : '.$question->getQuestion(), 'text/plain')

            ;
            $mailer->send($message);

            $messageSucces='Votre question a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('question/_form.html.twig',[
            'question' => $question,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newCode", name="codeBarre_new", methods={"GET","POST"})
     */
    public function newCode(Request $request, Livre $livre): Response
    {
        $codeBarre = new CodeBarre();
        $form = $this->createForm(CodeBarreType::class, $codeBarre);
        if($this->getUser()){
            $form->get('RapporteurNom')->setData($this->getUser()->getNom());
            $form->get('RapporteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $codeBarre->setIdLivre($livre);
            $codeBarre->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($codeBarre);
            $entityManager->flush();

            $messageSucces='Le code de barre a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('code_barre/_form.html.twig',[
            'codeBarre' => $codeBarre,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newConseil", name="conseil_new", methods={"GET","POST"})
     */
    public function newConseil(Request $request, Livre $livre): Response
    {
        $conseil = new Conseil();
        $form = $this->createForm(ConseilType::class, $conseil);
        if($this->getUser()){
            $form->get('RapporteurNom')->setData($this->getUser()->getNom());
            $form->get('RapporteurPrenom')->setData($this->getUser()->getPrenom());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conseil->setIdLivre($livre);
            $find=array("<br>", "<br/>", "<br />");
            $conseil->setConseilText(str_replace($find,"\n",  nl2br( $form->get('conseilText')->getData())));
            $conseil->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conseil);
            $entityManager->flush();

            $messageSucces='Votre conseil a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $nbavis=count($livre->getTousLesAvis());
            $nbquestion=count($livre->getQuestions());
            $nbcodebarre=count($livre->getCodesBarre());
            $nbconseil=count($livre->getConseils());
            $nbevenement=count($livre->getEvenements());
            $nbcitation=count($livre->getCitations());
            $nbimage=count($livre->getImages());
            $nbfilm=count($livre->getFilms());
            $nbdocument=count($livre->getDocuments());
            $nbson=count($livre->getSons());
            return  $this->render('livre/index.html.twig',[
                'nbavis'=>$nbavis,
                'nbquestion'=>$nbquestion,
                'nbcodebarre'=>$nbcodebarre,
                'nbconseil'=>$nbconseil,
                'nbevenement'=>$nbevenement,
                'nbcitation'=>$nbcitation,
                'nbimage'=>$nbimage,
                'nbfilm'=>$nbfilm,
                'nbdocument'=>$nbdocument,
                'nbson'=>$nbson,
                'livre'=>$livre,
                'message'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('conseil/_form.html.twig',[
            'conseil' => $conseil,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }



    /**
     * @Route("/{id}", name="showLivre", methods={"GET","POST"})
     */
    public function showLivre(Livre $livre): Response
    {
        $titre=$livre->getTitre().'MainSon';
        $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
        $pathSon='uploads/'.$replacedTitre.'.mpga';
        $nbavis=count($livre->getTousLesAvis());
        $nbquestion=count($livre->getQuestions());
        $nbcodebarre=count($livre->getCodesBarre());
        $nbconseil=count($livre->getConseils());
        $nbevenement=count($livre->getEvenements());
        $nbcitation=count($livre->getCitations());
        $nbimage=count($livre->getImages());
        $nbfilm=count($livre->getFilms());
        $nbdocument=count($livre->getDocuments());
        $nbson=count($livre->getSons());
        return  $this->render('livre/index.html.twig',[
            'nbavis'=>$nbavis,
            'nbquestion'=>$nbquestion,
            'nbcodebarre'=>$nbcodebarre,
            'nbconseil'=>$nbconseil,
            'nbevenement'=>$nbevenement,
            'nbcitation'=>$nbcitation,
            'nbimage'=>$nbimage,
            'nbfilm'=>$nbfilm,
            'nbdocument'=>$nbdocument,
            'nbson'=>$nbson,
            'livre'=>$livre,
            'son'=>$pathSon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre, SonRepository $repoSon): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $titre=$livre->getTitre().'MainSon';
        $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
        $titreSon=$replacedTitre.'.mpga';
        $son = $repoSon->findOneBy(array('son'=>$titreSon));
        $livre->addSon($son);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier=$son->getSon();
            $son->setDateEcriture(new \DateTime('now'));
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $nomFichier=$replacedTitre.'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $son->setSon($nomFichier);
            $livre->setIdUser($this->getUser());
            $find=array("<br>", "<br/>", "<br />");
            $livre->setResume(str_replace($find,"\n",  nl2br( $form->get('resume')->getData())));
            $son->setAuteurNom($this->getUser()->getNom());
            $son->setAuteurPrenom($this->getUser()->getPrenom());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->render('livre/showDetailLivre.html.twig',['livre'=>$livre,]);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete",  methods={"DELETE"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach($livre->getTousLesAvis() as $avis)
                  $entityManager->remove($avis);
            foreach($livre->getConseils() as $conseil)
                   $entityManager->remove($conseil);
            foreach($livre->getCitations() as $citation)
                   $entityManager->remove($citation);
            foreach($livre->getDocuments() as $document)
                    $entityManager->remove($document);
            foreach($livre->getImages() as $image)
                    $entityManager->remove($image);
            foreach($livre->getSons() as $son)
                    $entityManager->remove($son);
            foreach($livre->getFilms() as $film)
                   $entityManager->remove($film);
            foreach($livre->getCodesBarre() as $code)
                   $entityManager->remove($code);
            foreach($livre->getEvenements() as $event)
                   $entityManager->remove($event);
            $questions=$livre->getQuestions();
            foreach($questions as $question){
                foreach($question->getReponses() as $reponse)
                        $entityManager->remove($reponse);
            }
            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            foreach($livre->getQuestions() as $question)
                     $entityManager->remove($question);
            $entityManager->flush();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index');
    }

}
