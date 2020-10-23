<?php

namespace App\Controller;

use App\Entity\Master;
use App\Form\MasterType;
use App\Repository\MasterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/master", name="master")
 */
class MasterController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     * Route("/masters, name="master:index")
     */
    public function index(MasterRepository $masterRepository)
    {
        $masters = $masterRepository->findAll();

        return $this->render('master/index.html.twig', [
            'masters'=> $masters
        ]);
    }
    /**
     * @Route("", name=":create", methods={"HEAD","GET","POST"})
     * Route("/master", name="master:create")
     */
    public function create(Request $request)
    {
        $master = new Master;

        $form = $this->createForm(MasterType::class, $master);

        $form->handleRequest ($request);

        if ( $form->isSubmitted())
        {
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($master);

            $em->flush();

            return $this->redirectToRoute("master:index");
        }
        
        $form = $form->createView();

        return $this->render('master/create.html.twig', ['form' => $form ]);
        
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     * Route("/master/{id}", name="master:read")
     */
    public function read(Master $master)
    {
        return $this->render('master/read.html.twig', [
            'master' => $master
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update", methods={"HEAD","GET","POST"})
     * Route("/master/{id}/edit", name="master:update")
     */
    public function update(Master $master, Request $request)
    {
        $form = $this-> createForm(MasterType::class, $master);

        $form->handleRequest ($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($master); 
            $em->flush();

            return $this->redirectToRoute("master:read", [
                'id' => $master->getId()
            ]);
        }
        $form = $form->createView();
        
        return $this->render('master/update.html.twig', [
            'form'=> $form,
            'master'=> $master
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     * Route("/master/{id}/delete", name="master:delete")
     */
    public function delete(Master $master, Request $request)
    {
        if ($request->getMethod() == 'DELETE')
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($master); 
            $em->flush();

            return $this->redirectToRoute('master:index');
        }
         
        return $this->render('master/delete.html.twig', [
            'master' => $master
        ]);
    }
}
