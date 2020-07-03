<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Form\ConseilType;
use App\Repository\ConseilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conseil")
 */
class ConseilController extends AbstractController
{
    /**
     * @Route("/", name="conseil_index", methods={"GET"})
     */
    public function index(ConseilRepository $conseilRepository): Response
    {
        return $this->render('conseil/index.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="conseil_show", methods={"GET"})
     */
    public function show(Conseil $conseil): Response
    {
        return $this->render('conseil/show.html.twig', [
            'conseil' => $conseil,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conseil_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conseil $conseil): Response
    {
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conseil_index');
        }

        return $this->render('conseil/edit.html.twig', [
            'conseil' => $conseil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conseil_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Conseil $conseil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conseil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conseil_index');
    }
}
