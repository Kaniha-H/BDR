<?php

namespace App\Controller;

use App\Controller\ProductController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class ShopController extends ProductController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(ProductRepository $productRepository)
    {
        return $this->render('shop/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }
}
