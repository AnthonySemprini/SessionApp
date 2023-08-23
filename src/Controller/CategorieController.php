<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\ModuleRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_liste_categorie')]
    public function index(CategorieRepository $categorieRepository, ModuleRepository $moduleRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'modules' => $moduleRepository->findAll()
        ]);
    }
    
     #[Route('/categorie/new', name: 'app_new_categorie')]
    public function new(Categorie $categorie, Request $request, EntityManagerInterface $entityManager)
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $categorie = $form->getData();

                $entityManager->persist($categorie);

                $entityManager->flush();

                return $this->redirectToRoute('app_liste_categorie');

            }
            return $this->render('categorie/new.html.twig',[
                'formAddCategorie' => $form
            ]);
    }
}
