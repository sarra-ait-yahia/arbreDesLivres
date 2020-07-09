<?php

namespace App\Controller;

use App\Entity\Son;
use App\Form\SonType;
use App\Repository\LivreRepository;
use App\Repository\SonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/son")
 */
class SonController extends AbstractController
{
    /**
     * @Route("/", name="son_Tous", methods={"GET"})
     */
    public function TousSon(SonRepository $sonRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $donnees=$sonRepository->findAll();
        $son=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('son/toutSon.html.twig', [
            'sons' =>$son,
        ]);

    }

    /**
     * @Route("/{id}", name="son_index", methods={"GET"})
     */
    public function index(SonRepository $sonRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('id');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$sonRepository->findBy(array('idLivre'=>$livre));
        $son=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            15 // Nombre de résultats par page
        );
        return $this->render('son/index.html.twig', [
            'sons' =>$son,
            'livre' => $livre,
        ]);

    }

    /**
     * @Route("/{idLivre}/{id}", name="son_show", methods={"GET","POST"})
     */
    public function show(Son $son): Response
    {
        return new BinaryFileResponse('../public/uploads/'.$son->getSon());
    }

    /**
     * @Route("/{id}/edit", name="son_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Son $son): Response
    {
        $form = $this->createForm(SonType::class, $son);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('son_index');
        }

        return $this->render('son/edit.html.twig', [
            'son' => $son,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="son_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Son $son): Response
    {
        if ($this->isCsrfTokenValid('delete'.$son->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($son);
            $entityManager->flush();
        }

        return $this->redirectToRoute('son_Tous');
    }
}
