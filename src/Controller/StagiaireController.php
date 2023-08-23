<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_liste_stagiaire')]
    public function listStagiaires(StagiaireRepository $stagiaireRepository): Response
    {
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaireRepository->findBy([],
        ['id' => 'ASC']),
        ]);
    } 
    
    #[Route('/stagiaire/new', name: 'app_new_stagiaire')]
    public function new(Stagiaire $stagiaire, Request $request, EntityManagerInterface $entityManager)
    {
        $stagiaire = new Stagiaire();

        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $stagiaire = $form->getData();
                // prepare pdo
                $entityManager->persist($stagiaire);
                // execute en pdo
                $entityManager->flush();

                return $this->redirectToRoute('app_liste_stagiaire');

            }
                return $this->render('stagiaire/new.html.twig',[
                    'formAddStagiaire' => $form
                ]);
    }
    
    #[Route('stagiaire/{id}', name: 'app_stagiaire')]
    public function ficheStagiaire(Stagiaire $stagiaire, SessionRepository $sessionRepository): Response
    {
        return $this->render('stagiaire/detail.html.twig', [
            'stagiaire' => $stagiaire,
            'sessions' => $sessionRepository->findAll()
        ]);
    }
}
