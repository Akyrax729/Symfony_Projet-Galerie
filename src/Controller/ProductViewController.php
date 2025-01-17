<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProductViewController extends AbstractController{
    #[Route('/product/view/{id}', name: 'app_product_view')]
    public function index(Product $product): Response
    {   

        return $this->render('product_view/view.html.twig', [
            'product'=>$product,
        ]);
    }
}
