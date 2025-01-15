<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddGalerieController extends AbstractController{
    #[Route('/galerie/add', name: 'app_add_galerie')]
    public function index(): Response
    {
        return $this->render('add_galerie/addgalerie.html.twig', [
            
        ]);
    }
}
