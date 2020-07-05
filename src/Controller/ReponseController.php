<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\LivreRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reponse")
 */
class ReponseController extends AbstractController
{
    /**
     * @Route("/{idLivre}/{idQuestion}", name="reponse_index", methods={"GET"})
     */
    public function index(ReponseRepository $reponseRepository,Request $request, QuestionRepository $repoQ, LivreRepository $repo, PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $livre= $repo->findOneBy(array('id' =>$livreId ));
        $questionId=$request->attributes->get('idQuestion');
        $question= $repoQ->findOneBy(array('id' =>$questionId ));
        $donnees=$reponseRepository->findByQuestion($question);
        $reponse=$paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        return $this->render('reponse/index.html.twig', [
            'reponses' =>$reponse ,
            'question'=> $question,
            'livre' => $livre,
        ]);
    }

    /**
     * @Route("/new/{idLivre}/{idQuestion}", name="reponse_new", methods={"GET","POST"})
     */
    public function new(Request $request, LivreRepository $repoL, \Swift_Mailer $mailer,QuestionRepository $repoQ,ReponseRepository $reponseRepository,PaginatorInterface $paginator): Response
    {
        $livreId=$request->attributes->get('idLivre');
        $questionId=$request->attributes->get('idQuestion');
        $livre= $repoL->findOneBy(array('id' =>$livreId ));
        $question= $repoQ->findOneBy(array('id' =>$questionId ));

        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        if($this->getUser()){
            $form->get('auteurNom')->setData($this->getUser()->getNom());
            $form->get('auteurPrenom')->setData($this->getUser()->getPrenom());
            $form->get('mail')->setData($this->getUser()->getEmail());
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponse->setIdLivre($livre);
            $reponse->setIdQuestion($question);
            $reponse->setReponse(str_replace("<br />","\n",  nl2br( $form->get('reponse')->getData())));
            $reponse->setDateEcriture(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reponse);
            $entityManager->flush();

            $donnees=$reponseRepository->findByQuestion($question);
            $message = (new \Swift_Message())
                ->setFrom('arbreDuLivre@gmail.com')
                ->setTo($question->getMail())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emailReponse.html.twig',
                        ['livre' => $livre, 'question'=>$question,'reponse'=>$reponse]
                    ),
                    'text/html'
                );
            $mailer->send($message);
            foreach ($donnees as $donnee){
                if($reponse!==$donnee) {
                    $message = (new \Swift_Message())
                        ->setFrom('arbreDuLivre@gmail.com')
                        ->setTo($donnee->getMail())
                        ->setBody(
                            $this->renderView(
                            // templates/emails/registration.html.twig
                                'emailReponsePourParticipant.html.twig',
                                ['livre' => $livre, 'question' => $question, 'reponse' => $reponse]
                            ),
                            'text/html'
                        );
                    $mailer->send($message);
                }
            }

            $reponse=$paginator->paginate(
                $donnees,
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                5 // Nombre de résultats par page
            );
            return $this->render('reponse/index.html.twig', [
                'reponses' =>$reponse ,
                'question'=> $question,
                'livre' => $livre,
            ]);
        }

        return $this->render('reponse/_form.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
            'livre'=>$livre,
            'question'=>$question,
        ]);
    }

    /**
     * @Route("/{id}", name="reponse_show", methods={"GET"})
     */
    public function show(Reponse $reponse): Response
    {
        return $this->render('reponse/show.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reponse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reponse $reponse): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reponse_index');
        }

        return $this->render('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reponse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reponse $reponse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reponse_index');
    }
}
