<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Module;
use App\Repository\ModuleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
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
