<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DetailStagiaireController extends AbstractController
{
    #[Route('/detail/stagiaire/{id}', name: 'app_detail_stagiaire')]
    public function ficheStagiaire(Stagiaire $stagiaire): Response
    {
        return $this->render('detail_stagiaire/index.html.twig', [
            'stagiaires' => $stagiaire,
        ]);
    }
}
