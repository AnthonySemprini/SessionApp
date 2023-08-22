<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionsController extends AbstractController
{
    #[Route('/sessions', name: 'app_liste_sessions')]
    public function listSessions(SessionRepository $sessionRepository): Response
    {
        return $this->render('sessions/index.html.twig', [
            'sessions' => $sessionRepository->findBy([],
            ['id' => 'ASC'])
        ]);
    }
}
