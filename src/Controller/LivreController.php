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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_showLivres", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/showLivres.html.twig', [
            'livres' => $livreRepository->findLivresOfUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/{id}/showdetailLivreBase", name="showdetailLivreBase", methods={"GET","POST"})
     */
    public function showdetailLivreBase(Request $request, Livre $livre): Response
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
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $nomFichier=$replacedTitre.'.'.$fichier->guessExtension();
            $fichier->move($this->getParameter('upload_directory'), $nomFichier);
            $son->setSon($nomFichier);
            $livre->setIdUser($this->getUser());
            $son->setAuteurNom($this->getUser()->getNom());
            $son->setAuteurPrenom($this->getUser()->getPrenom());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return  $this->render('livre/index.html.twig',[
                'feuille'=>0,
                'fruit'=>0,
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avi);
            $entityManager->flush();
            $messageSucces='Votre avis a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
    public function newDoc(Request $request, Livre $livre): Response
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
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('document/_form.html.twig', [
            'document'=>$document,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
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
            $citation->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($citation);
            $entityManager->flush();

            $messageSucces='Votre citation a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $messageSucces='Votre évènement a été enregistré'; $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
    public function newSon(Request $request, Livre $livre): Response
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
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('son/_form.html.twig',[
            'son' => $son,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
        ]);
    }

    /**
     * @Route("/{id}/newImage", name="image_new", methods={"GET","POST"})
     */
    public function newImage(Request $request, Livre $livre): Response
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
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
                'son'=>$pathSon,
            ]);
        }

        return $this->render('image/_form.html.twig',[
            'image' => $image,
            'form' => $form->createView(),
            'id' =>$livre->getId(),
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            $messageSucces='Le nom du film a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setIdLivre($livre);
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
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($codeBarre);
            $entityManager->flush();

            $messageSucces='Le code de barre a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conseil);
            $entityManager->flush();

            $messageSucces='Votre conseil a été enregistré';
            $titre=$livre->getTitre().'MainSon';
            $replacedTitre = preg_replace("#[ ,;:']+#", "", $titre);
            $pathSon='uploads/'.$replacedTitre.'.mpga';
            $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
                +count($livre->getConseils())+count($livre->getQuestions());
            $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
            return  $this->render('livre/index.html.twig',[
                'feuille'=>$feuille,
                'fruit'=>$fruit,
                'livre'=>$livre,
                'messageSucces'=>$messageSucces,
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
        $feuille=count($livre->getCodesBarre())+count($livre->getTousLesAvis())+count($livre->getCitations())+count($livre->getEvenements())+
            +count($livre->getConseils())+count($livre->getQuestions());
        $fruit=count($livre->getFilms())+count($livre->getSons())+count($livre->getImages())+count($livre->getDocuments());
        return  $this->render('livre/index.html.twig',[
            'feuille'=>$feuille,
            'fruit'=>$fruit,
            'livre'=>$livre,
            'son'=>$pathSon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

}
