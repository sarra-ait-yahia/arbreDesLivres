<?php

namespace App\Controller;

use App\Entity\Citation;
use App\Form\CitationType;
use App\Repository\CitationRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/citation")
 */
class CitationController extends AbstractController
{
    /**
     * @Route("/{idLivre}", name="citation_index", methods={"GET"})
     */
    public function index(CitationRepository $citationRepository,Request $request, LivreRepository $repo,PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$citationRepository->findByLivre($livre);
        $citations=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        return $this->render('citation/index.html.twig', [
            'citations' => $citations,
            'livre' => $livre,
        ]);
    }

    /**
     * @Route("/{id}", name="citation_show", methods={"GET"})
     */
    public function show(Citation $citation): Response
    {
        return $this->render('citation/show.html.twig', [
            'citation' => $citation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="citation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Citation $citation): Response
    {
        $form = $this->createForm(CitationType::class, $citation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citation_index');
        }

        return $this->render('citation/edit.html.twig', [
            'citation' => $citation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="citation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Citation $citation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$citation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($citation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('citation_index');
    }
}
