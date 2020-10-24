<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainFullcalendarController extends AbstractController
{
    /**
     * @Route("/main/fullcalendar", name="main_fullcalendar")
     */
    public function index()
    {
        return $this->render('main_fullcalendar/index.html.twig', [
            'controller_name' => 'MainFullcalendarController',
        ]);
    }
}
