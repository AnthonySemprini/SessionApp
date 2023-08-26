<?php

namespace App\Controller;


use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Repository\ModuleRepository;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;

class SessionsController extends AbstractController
{
    
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
    
    
   
    
    #[Route('/session/{sess_id}/deleteStagiaire/{stag_id}', name: 'delete_stagiaire_session')]
    public function deleteStagiaire(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $sessId = $request->get('sess_id');
        $session = $entityManager->getRepository(Session::class)->find($sessId);
        
        $stagId = $request->get('stag_id');
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagId);
        
        $session->removeStagiaire($stagiaire);
        
        $entityManager->flush();
        
        return $this->redirectToRoute('app_prog_session', ['id' => $session->getId()]);
    }
    
    #[Route('/session/{sess_id}/addStagiaire/{stag_id}', name: 'add_stagiaire_session')]
    public function addStagiaire(Request $request,Stagiaire $stagiaire,  EntityManagerInterface $entityManager): Response
    {
        $sessId = $request->get('sess_id');
        $session = $entityManager->getRepository(Session::class)->find($sessId);
        
        $stagId = $request->get('stag_id');
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($stagId);
        //dd($entityManager->getRepository(Stagiaire::class));
        $session->addStagiaire($stagiaire);
        
        $entityManager->persist($stagiaire);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_prog_session', ['id' => $session->getId()]);
    }

    #[Route('/session/{id}', name: 'app_prog_session')]
    public function show(Session $session, SessionRepository $sr): Response 
    {
        $nonInscrits = $sr->findNonInscrits($session->getId());
        // $nonProgrammes = $sr->findNonProgrammes($session->getId());
        
        return $this->render('session/prog.html.twig',[
            'session' => $session,
            'nonInscrits' => $nonInscrits,
            // 'nonProgrammes' => $nonProgrammes
        ]);
    }

    #[Route('/session', name: 'app_liste_session')]
    public function listSessions(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findBy([],
            ['id' => 'ASC']),
            
    
        ]);
    }
}
