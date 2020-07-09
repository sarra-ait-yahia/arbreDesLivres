<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/", name="document_Tous", methods={"GET"})
     */
    public function toutDocument(DocumentRepository $documentRepository,Request $request,  PaginatorInterface $paginator): Response
    {
        $donnees=$documentRepository->findAll();
        $document=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('document/toutDocument.html.twig', [
            'documents' =>$document,
        ]);

    }

    /**
     * @Route("/{idLivre}", name="document_index", methods={"GET"})
     */
    public function index(DocumentRepository $documentRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$documentRepository->findBy(array('idLivre'=>$livre));
        $document=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            15 // Nombre de résultats par page
        );
        return $this->render('document/index.html.twig', [
            'documents' =>$document,
            'livre' => $livre,
        ]);

    }
    /**
     * @Route("/{idLivre}/{id}/{vue}", name="document_show", methods={"GET","POST"})
     */
    public function show(Document $document,Request $request): Response
    {
        $vue=$request->attributes->get('vue');
        $document->setVue($vue);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($document);
        $entityManager->flush();
        return new BinaryFileResponse('../public/uploads/'.$document->getFichier());
    }

    /**
     * @Route("/{id}/edit", name="document_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_index');
        }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('document_Tous');
    }
}
