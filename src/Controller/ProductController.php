<?php

namespace App\Controller;

use App\Form\FilterType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProductController extends AbstractController{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repository, Request $request): Response
    {
        $form = $this->createForm(FilterType::class);
        
        $form->handleRequest($request);

        $produit = $request->get('tag', 'all');
        $price = $request->get('estimated_price', 0);

        if ($form->isSubmitted()&&$form->isValid()){
            $data = $form->getData();
            $filter = 1;

            $produit = $form->get('tag')->getData();
            if ($data['tag'] != null){
                $produit = $produit->getLabel();
            }
        
            $price = $form->get('estimated_price')->getData();

            if ($price == null) {
                $price = 1000000000;
            }

            $price = $price + 0.99;


        }else 
        {
            $filter = null;
        };

        if ($filter == null){
            $products = $repository->findAll();
        } else {
            $products = $repository->filterTags($produit, $price);
        }

        return $this->render('product/product.html.twig', [
            'products'=>$products,
            'filterForm'=>$form->createView(),
        ]);
    }
}
