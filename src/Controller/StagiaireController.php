<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Repository\SessionRepository;
use App\Repository\StagiaireRepository;
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
    
    #[Route('stagiaire/{id}', name: 'app_stagiaire')]
    public function ficheStagiaire(Stagiaire $stagiaire, SessionRepository $sessionRepository): Response
    {
        return $this->render('stagiaire/detail.html.twig', [
            'stagiaire' => $stagiaire,
            'sessions' => $sessionRepository->findAll()
        ]);
    }
}
