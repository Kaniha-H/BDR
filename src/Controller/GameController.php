<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/game", name="game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     * Route("/games", name="game:index")
     */
    public function index(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();
        return $this->render('game/index.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * @Route("", name=":create", methods={"HEAD","GET","POST"})
     * Route("/game", name="game:create")
     */
    public function create(Request $request)
    {
        $game = new Game;

        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest ($request);

        if ( $form->isSubmitted())
        {
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($game);

            $em->flush();

            return $this->redirectToRoute("game:index");
        }
        
        $form = $form->createView();

        return $this->render('game/create.html.twig', ['form' => $form ]);
        
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     * Route("/game/{id}", name="game:read")
     */
    public function read(Game $game)
    {
        return $this->render('game/read.html.twig', [
            'game'=> $game
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update")
     * Route("/game/{id}/edit", name="game:update")
     */
    public function update(Game $game, Request $request)
    {
        $form = $this-> createForm(GameType::class, $game);

        $form->handleRequest ($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game); 
            $em->flush();

            return $this->redirectToRoute("game:read", [
                'id' => $game->getId()
            ]);
        }
        $form = $form->createView();
        
        return $this->render('game/update.html.twig', [
            'form'=> $form,
            'game'=> $game
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     * Route("/game/{id}/delete", name="game:delete")
     */
    public function delete(game $game, Request $request)
    {
        return $this->render('game/delete.html.twig', [
            'game' => $game
        ]);
    }
}
