<?php

namespace App\Controller;


use App\Entity\Programme;
use App\Entity\Session;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionsController extends AbstractController
{
    #[Route('/session', name: 'app_liste_session')]
    public function listSessions(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findBy([],
            ['id' => 'ASC']),
            
  
        ]);
    }

    #[Route('session/{id}', name: 'app_session')]
    public function index(Session $session ): Response
    {
        return $this->render('session/prog.html.twig', [
            
            'session' => $session,
            
        ]);
    }
}
