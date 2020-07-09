<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/avis")
 */
class AvisController extends AbstractController
{
    /**
     * @Route("/", name="avis_Tous", methods={"GET"})
     */
    public function avisTous(AvisRepository $avisRepository,Request $request, PaginatorInterface $paginator): Response
    {
        $donnees=$avisRepository->findAll();
        $avis=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            7 // Nombre de résultats par page
        );
        return $this->render('avis/toutAvis.html.twig', [
            'avis' =>$avis ,
        ]);
    }

    /**
     * @Route("/{idLivre}", name="avis_index", methods={"GET"})
     */
    public function index(AvisRepository $avisRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$avisRepository->findByLivre($livre);
        $avis=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        return $this->render('avis/index.html.twig', [
            'avis' =>$avis ,
            'livre' => $livre,
        ]);
    }



    /**
     * @Route("/{id}", name="avis_show", methods={"GET","POST"})
     */
    public function show(Avis $avi): Response
    {
        return $this->render('avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="avis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Avis $avi): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avis_index');
        }

        return $this->render('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="avis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Avis $avi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_Tous');
    }
}
