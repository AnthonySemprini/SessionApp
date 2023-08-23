<?php

namespace App\Controller;


use App\Entity\Session;
use App\Entity\Programme;
use App\Form\SessionType;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/session/new', name: 'app_new_session')]
    public function new(Session $session, Request $request, EntityManagerInterface $entityManager)
    {
        $session = new Session();

        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $session = $form->getData();
                // prepare pdo
                $entityManager->persist($session);
                // execute en pdo
                $entityManager->flush();

                return $this->redirectToRoute('app_liste_session');

            }
                return $this->render('session/new.html.twig',[
                    'formAddSession' => $form
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
