<?php

namespace App\Controller;

use App\Repository\StagiaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeStagiaireController extends AbstractController
{
    #[Route('/liste/stagiaire', name: 'app_liste_stagiaire')]
    public function listStagiaires(StagiaireRepository $stagiaireRepository): Response
    {
        return $this->render('liste_stagiaire/index.html.twig', [
            'stagiaires' => $stagiaireRepository->findBy([],
        ['id' => 'ASC']),
        ]);
    }
}
