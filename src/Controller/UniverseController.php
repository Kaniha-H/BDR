<?php

namespace App\Controller;

use App\Entity\Universe;
use App\Form\UniverseType;
use App\Repository\UniverseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/universe", name="universe")
 */
class UniverseController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     * Route("/universes", name="universe:index")
     */
    public function index(UniverseRepository $universeRepository)
    {
        $universes = $universeRepository->findAll();

        return $this->render('universe/index.html.twig', [
            'universes' => $universes
        ]);
    }
    /**
     * @Route("", name=":create", methods={"HEAD","GET","POST"})
     * Route("/universe", name="universe:create")
     */
    public function create(Request $request)
    {
        $universe = new Universe;

        $form = $this->createForm(UniverseType::class, $universe);

        $form->handleRequest ($request);

        if ( $form->isSubmitted())
        {
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($universe);

            $em->flush();

            return $this->redirectToRoute("universe:index");
        }
        
        $form = $form->createView();

        return $this->render('universe/create.html.twig', ['form' => $form ]);
        
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     * Route("/universe/{id}", name="universe:read")
     */
    public function read( Universe $universe)
    {
        return $this->render('universe/read.html.twig', [
            'universe' => $universe
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update", methods={"HEAD","GET","POST"})
     * Route("/universe/{id}/edit", name="universe:update")
     */
    public function update(Universe $universe, Request $request)
    {
        $form = $this-> createForm(UniverseType::class, $universe);

        $form->handleRequest ($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universe); 
            $em->flush();

            return $this->redirectToRoute("universe:read", [
                'id' => $universe->getId()
            ]);
        }
        $form = $form->createView();
        
        return $this->render('universe/update.html.twig', [
            'form'=> $form,
            'universe'=> $universe
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     * Route("/universe/{id}/delete", name="universe:delete")
     */
    public function delete(Universe $universe, Request $request)
    {
        if ($request->getMethod() == 'DELETE')
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($universe); 
            $em->flush();

            return $this->redirectToRoute('universe:index');
        }
         
        return $this->render('universe/delete.html.twig', [
            'universe' => $universe
        ]);
    }
}
