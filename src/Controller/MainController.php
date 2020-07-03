<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Form\SearchTypeByCode;
use App\Form\SearchTypeByTitle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;
use App\Repository\CodeBarreRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="mainPage")
     */
    public function index(Request $request, LivreRepository $repolivre, CodeBarreRepository $repoCode)
    {
        $searchFormTitre = $this->createForm(SearchTypeByTitle::class);
        $searchFormTitre->handleRequest($request);

        $searchFormCode= $this->createForm(SearchTypeByCode::class);
        $searchFormCode->handleRequest($request);

        if ($searchFormTitre->isSubmitted() && $searchFormTitre->isValid()) {
            $titre = $searchFormTitre->getData()->getTitre();
            $livres = $repolivre->search($titre);
            if(empty($livres)){
                $message='Ce livre n\'a pas été encore ajouté à l\'arbre des livres';
                return $this->render('main/index.html.twig',[
                    'controller_name' => 'MainController',
                    'message'=>$message,
                    'searchFormTitre' => $searchFormTitre->createView(),
                    'searchFormCode' => $searchFormCode->createView()
                ]);

            }
            $livre=$livres[0];
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

        if ($searchFormCode->isSubmitted() && $searchFormCode->isValid()) {
            $code = $searchFormCode->getData()->getCode();
            $codeBarre = $repoCode->search($code);
            if(empty($codeBarre)){
                $message='Ce code barre ne correspond à aucun livre de l\'arbre des livres';
                return $this->render('main/index.html.twig',[
                    'controller_name' => 'MainController',
                    'message'=>$message,
                    'searchFormTitre' => $searchFormTitre->createView(),
                    'searchFormCode' => $searchFormCode->createView()
                ]);

            }
            $livre=$codeBarre[0]->getIdLivre();
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
        return $this->render('main/index.html.twig',[
            'controller_name' => 'MainController',
            'message'=>' ',
            'searchFormTitre' => $searchFormTitre->createView(),
            'searchFormCode' => $searchFormCode->createView()
        ]);
    }


    /**
     * @Route("/Apropos", name="showApropos")
     */
    public function showApropos(): Response
    {
        return $this->render('apropos.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/SeConnecter", name="seConnecter")
     */
    public function seConnecter(): Response
    {
        return $this->render('utilisateur/se_connecter.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }


    /**
     * @Route("/Inscription", name="inscription", methods={"GET","POST"})
     */
    public function inscription(Request $request): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Facebook", name="facebookUrl")
     */
    public function facebookUrl(): Response
    {
        return new RedirectResponse("https://www.facebook.com/Larbre-des-Livres-102312391544941");;
    }

    /**
     * @Route("/Twitter", name="twitterUrl")
     */
    public function twitterUrl(): Response
    {
        return new RedirectResponse("https://twitter.com/l_livres");;
    }

    /**
     * @Route("/Informations", name="Informations")
     */
    public function showInformations(): Response
    {
        return $this->render('informations.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
