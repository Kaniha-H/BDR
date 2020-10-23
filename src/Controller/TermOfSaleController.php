<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TermOfSaleController extends AbstractController
{
    /**
     * @Route("/term/of/sale", name="term_of_sale")
     */
    public function index()
    {
        return $this->render('term_of_sale/index.html.twig', [
            'controller_name' => 'TermOfSaleController',
        ]);
    }
}
