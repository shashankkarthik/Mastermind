<?php
/**
 * Created by PhpStorm.
 * User: shash
 * Date: 4/26/2018
 * Time: 15:10
 */

namespace Mastermind;

class Mastermind
{
    private $colors = Array("orange","purple","green","red","yellow","blue");
    private $mErrorMessage = null;
    private $mGameOver = false;
    private $mEndGameMessage = null;

    private $mName = "";
    private $mCurrentGuess;

    private $mSolution = Array();
    private $mHistory = Array();




    public function __construct()
    {
        $this->initGuess();
        $this->generateSolution();
    }

    public function resetGame() {
        $this->mErrorMessage = null;
        $this->mGameOver = false;
        $this->mEndGameMessage = null;
        $this->mCurrentGuess = Array();
        $this->mSolution = Array();
        $this->mHistory =Array();

        $this->initGuess();
        $this->generateSolution();
    }

    public function getGameOver() {
        return $this->mGameOver;
    }

    public function setGameOver($gameOver) {
        $this->mGameOver = $gameOver;
    }


    public function getEndGameMessage()
    {
        return $this->mEndGameMessage;
    }


    public function setEndGameMessage($mEndGameMessage)
    {
        $this->mEndGameMessage = $mEndGameMessage;
    }



    public function getName() {
        return $this->mName;
    }
    public function setName($name){
        $this->mName = $name;
    }

    public function getCurrentGuess() {
        return $this->mCurrentGuess;
    }

    public function setIndividualGuess($ndx, $color) {

        $this->mCurrentGuess[$ndx] = $color;

    }

    public function getErrorMessage() {
        return $this->mErrorMessage;
    }

    public function setErrorMessage($msg) {
        $this->mErrorMessage = $msg;
    }

    public function getSolution() {
        return $this->mSolution;
    }

    public function giveUp() {
        $this->mCurrentGuess = $this->getSolution();
        $this->executeGuess();
    }


    public function generatePegs() {
        $pegs = Array();

        for ($i = 0; $i < 4; $i++) {
            if ($this->mCurrentGuess[$i] == $this->mSolution[$i]) {
                array_push($pegs,"red");
            }

            else if (in_array($this->mCurrentGuess[$i],$this->mSolution)) {
                array_push($pegs,"white");
            }

        }

        return $pegs;
    }

    public function executeGuess() {

        //incomplete guess
        if ($this->countInArray($this->mCurrentGuess,'empty') != 0) {
            $this->setErrorMessage("Must select a color for all spheres!");
        }
        else {
            //Generates pegs and stores guess-peg pair in history
            $pegs = $this->generatePegs();
            $this->storeGuess($this->mCurrentGuess,$pegs);

            //---PEG EVALUATION--

            //All correct
            if ($this->countInArray($pegs,"red") == 4) {
                $this->setGameOver(true);
                $this->setEndGameMessage("You guessed correctly!");
            }
            //Reset current guess if incorrect
            else {
                $this->initGuess();
            }
        }


    }

    public function getHistory() {
        return $this->mHistory;
    }


    private function storeGuess($guess, $pegs) {
        $snapshot = Array(
            "guess" => $guess,
            "pegs" => $pegs
        );

        array_push($this->mHistory, $snapshot);
    }

    private function countInArray($array, $target) {
        $count = 0;
        foreach($array as $arrayVal) {
            if ($arrayVal == $target) {
                $count++;
            }
        }

        return $count;
    }

    private function initGuess() {
        $this->mCurrentGuess = Array();
        for($i = 0; $i < 4; $i++) {
            array_push($this->mCurrentGuess, "empty");
        }
    }

    private function generateSolution() {
        for($i = 0; $i < 4; $i++) {
            $ndx = rand(0,5);
            array_push($this->mSolution, $this->colors[$ndx]);
        }
    }





}