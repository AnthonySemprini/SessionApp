<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Entity\Categorie;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module/new', name: 'app_new_module')]
    public function new(Module $module, Request $request, EntityManagerInterface $entityManager)
    {
        $module = new Module();

        $form = $this->createForm(ModuleType::class, $module);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $module = $form->getData();

                $entityManager->persist($module);

                $entityManager->flush();

                return $this->redirectToRoute('app_liste_module');

            }
            return $this->render('module/new.html.twig',[
                'formAddModule' => $form
            ]);
    }
    #[Route('/module', name: 'app_liste_module')]
    public function index(ModuleRepository $moduleRepository): Response
    {
        return $this->render('module/index.html.twig', [
            'modules' => $moduleRepository->findBy([],
        ['nom' => 'ASC']),
        ]);
    }
    #[Route('module/{id}', name: 'app_module')]
    public function moduleByCateg(Module $module, Categorie $categorie): Response
    {
        return $this->render('module/moduleByCateg.html.twig', [
            'modules' => $module,
            'categorie' => $categorie
        ]);
    }

}
