<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModifyController extends AbstractController{
    #[Route('/modify/product/{id}', name: 'update_product')]
    public function modify(Product $product, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        $get = $this->getUser();

        // dump($product);
        // dd($get);

        if($get == $product->getUser()){
        
            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager->persist($product);

                $entityManager->flush();

                $this->addFlash('success', 'Product modifié avec succès !');

                return $this->redirectToRoute('app_product');

            }

            return $this->render('modify/modify.html.twig', [
                'productform'=>$form->createView(),
                
            ]);
        }
        return $this->redirectToRoute('app_home');  
    }
}
