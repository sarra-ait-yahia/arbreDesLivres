<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Form\ConseilType;
use App\Repository\ConseilRepository;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/", name="conseil_Tous", methods={"GET"})
     */
    public function toutConseil(ConseilRepository $conseilRepository,Request $request,PaginatorInterface $paginator): Response
    {

        $donnees=$conseilRepository->findAll();
        $conseil=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            7 // Nombre de résultats par page
        );
        return $this->render('conseil/ToutConseil.html.twig', [
            'conseils' =>$conseil,
        ]);
    }

    /**
     * @Route("/{idLivre}", name="conseil_index", methods={"GET"})
     */
    public function index(ConseilRepository $conseilRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$conseilRepository->findBy(array('idLivre'=>$livre));
        $conseil=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            7 // Nombre de résultats par page
        );
        return $this->render('conseil/index.html.twig', [
            'conseils' =>$conseil,
            'livre' => $livre,
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

        return $this->redirectToRoute('conseil_Tous');
    }
}
