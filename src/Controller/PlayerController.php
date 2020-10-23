<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/player", name="player")
 */
class PlayerController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     * Route("/players", name="player:index")
     */
    public function index(PlayerRepository $playerRepository)
    {
        $players= $playerRepository->findAll();
        return $this->render('player/index.html.twig', [
            'players' => $players
        ]);
    }
    /**
     * @Route("", name=":create",methods={"HEAD","GET","POST"})
     * Route("/player", name="player:create")
     */
    public function create(Request $request)
    {
        $player = new Player;
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest ($request);

        if ( $form->isSubmitted())
        {
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($player);

            $em->flush();

            return $this->redirectToRoute("player:index");
        }
        
        $form = $form->createView();

        return $this->render('player/create.html.twig', ['form'=> $form ]);
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     * Route("/player/{id}", name="player:read")
     */
    public function read(Player $player)
    {
        return $this->render('player/read.html.twig', [
            'player'=> $player
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update",methods={"HEAD","GET","POST"})
     * Route("/player/{id}/edit", name="player:update")
     */
    public function update(Player $player, request $request)
    {
        $form = $this-> createForm(PlayerType::class, $player);

        $form->handleRequest ($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player); 
            $em->flush();

            return $this->redirectToRoute("player:read", [
                'id' => $player->getId()
            ]);
        }
        $form = $form->createView();
        
        return $this->render('player/update.html.twig', [
            'form'=> $form,
            'player'=> $player
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     * Route("/player/{id}/delete", name="player:delete")
     */
    public function delete(Player $player, Request $request)
    {
        if ($request->getMethod() == 'DELETE')
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($player); 
            $em->flush();

            return $this->redirectToRoute('player:index');
        } 
        
        return $this->render('player/delete.html.twig', [
            'player' => $player
        ]);
    }
}
