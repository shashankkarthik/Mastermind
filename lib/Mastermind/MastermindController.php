<?php
/**
 * Created by PhpStorm.
 * User: shash
 * Date: 4/26/2018
 * Time: 15:30
 */

namespace Mastermind;

class MastermindController
{
    private $mGame;
    private $reset = false;
    private $page = 'mastermind.php';


    public function __construct(Mastermind $game, $post)
    {
        $this->mGame = $game;
        if (isset($post['name'])) {
            $this->mGame->setName($post['name']);
        }

        if (isset($post['pick'])) {
            $ndx = $post['pick']-1;
            if (isset($post['color'])) {
                $this->mGame->setIndividualGuess($ndx, $post['color']);
            }
            else {
                $this->mGame->setErrorMessage("Please select a color!");
            }

        }

        if (isset($post['giveup'])) {
            $this->mGame->giveUp();

            $this->mGame->setGameOver(true);
            $this->mGame->setEndGameMessage("You gave up!");
        }

        if (isset($post['newgame'])) {
            $this->mGame->resetGame();
        }

        if (isset($post['exit'])) {
            $this->mGame->resetGame();
            $this->page = 'index.php';
        }

        if (isset($post['guess'])) {
            $this->mGame->executeGuess();
        }

    }

    public function isReset() {
        return $this->reset;
    }

    public function getPage() {
        return $this->page;
    }



}
