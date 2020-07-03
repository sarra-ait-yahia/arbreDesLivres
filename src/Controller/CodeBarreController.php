<?php

namespace App\Controller;

use App\Entity\CodeBarre;
use App\Form\CodeBarreType;
use App\Repository\CodeBarreRepository;
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
     * @Route("/", name="code_barre_index", methods={"GET"})
     */
    public function index(CodeBarreRepository $codeBarreRepository): Response
    {
        return $this->render('code_barre/index.html.twig', [
            'code_barres' => $codeBarreRepository->findAll(),
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

        return $this->redirectToRoute('code_barre_index');
    }
}
