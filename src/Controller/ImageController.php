<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Livre;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image")
 */
class ImageController extends AbstractController
{
    /**
     * @Route("/", name="image_Tous", methods={"GET"})
     */
    public function toutImage(ImageRepository $imageRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $donnees=$imageRepository->findAll();
        $image=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        return $this->render('image/toutImage.html.twig', [
            'images' =>$image,
        ]);

    }

    /**
     * @Route("/{id}", name="image_index", methods={"GET"})
     */
    public function index(ImageRepository $imageRepository,Request $request, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('id');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $donnees=$imageRepository->findBy(array('idLivre'=>$livre));
        $image=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            15 // Nombre de résultats par page
        );
        return $this->render('image/index.html.twig', [
            'images' =>$image,
            'livre' => $livre,
        ]);

    }

    /**
     * @Route("/{idLivre}/{id}", name="image_show", methods={"GET","POST"})
     */
    public function show(Image $image): Response
    {
        return new BinaryFileResponse('../public/uploads/'.$image->getImage());
    }

    /**
     * @Route("/{id}/edit", name="image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Image $image): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('image_index');
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Image $image): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('image_Tous');
    }
}
