<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TermOfUseController extends AbstractController
{
    /**
     * @Route("/term/of/use", name="term_of_use")
     */
    public function index()
    {
        return $this->render('term_of_use/index.html.twig', [
            'controller_name' => 'TermOfUseController',
        ]);
    }
}
