<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProductAddController extends AbstractController{
    #[Route('/product/add', name: 'app_product_add')]
    public function add(UserInterface $userid, Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        $get = $this->getUser();

        // dd($get);

        if($form->isSubmitted() && $form->isValid())
        {

            $product->setUser($get);

            $entityManager->persist($get);

            $entityManager->persist($product);

            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès !');

            // dd($product);

            return $this->redirectToRoute('app_product');

        }
        

        // RETURN 

        return $this->render('product_add/productadd.html.twig', [
            'productform'=>$form->createView(),
        ]);
    }
}
