<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/del/product/{id}', name: 'delete_product')]

    public function deleteproduct(Product $product, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("COUCOU". $product->getId(), $request->get('_token'))){
            $entityManager->remove($product);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_product");
        }

    }
}
