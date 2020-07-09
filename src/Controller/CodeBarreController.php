<?php

namespace App\Controller;

use App\Entity\CodeBarre;
use App\Form\CodeBarreType;
use App\Repository\CodeBarreRepository;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/code/barre")
 */
class CodeBarreController extends AbstractController
{
    /**
     * @Route("/", name="code_Tous", methods={"GET"})
     */
    public function tousCode(CodeBarreRepository $codeBarreRepository,Request $request,  PaginatorInterface $paginator): Response
    {
        $donnees=$codeBarreRepository->findAll();
        $code=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('code_barre/toutCode.html.twig', [
            'codes' =>$code,
        ]);
    }

    /**
     * @Route("/{idLivre}", name="code_barre_index", methods={"GET"})
     */
    public function index(CodeBarreRepository $codeBarreRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$codeBarreRepository->findBy(array('idLivre'=>$livre));
        $code=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            15 // Nombre de résultats par page
        );
        return $this->render('code_barre/index.html.twig', [
            'codes' =>$code,
            'livre' => $livre,
        ]);
    }

    /**
     * @Route("/{id}", name="code_barre_show", methods={"GET"})
     */
    public function show(CodeBarre $codeBarre): Response
    {
        return $this->render('code_barre/show.html.twig', [
            'code_barre' => $codeBarre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="code_barre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CodeBarre $codeBarre): Response
    {
        $form = $this->createForm(CodeBarreType::class, $codeBarre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('code_barre_index');
        }

        return $this->render('code_barre/edit.html.twig', [
            'code_barre' => $codeBarre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="code_barre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CodeBarre $codeBarre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$codeBarre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($codeBarre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('code_Tous');
    }
}
