<?php
/**
 * Created by PhpStorm.
 * User: shash
 * Date: 4/26/2018
 * Time: 15:30
 */

namespace Mastermind;

class MastermindView
{
    private $mGame;
    public function __construct(Mastermind $game)
    {
        $this->mGame = $game;
    }

    public function presentName() {
        $html = "<p>".$this->mGame->getName()."'s Mastermind</p>";
        return $html;
    }

    public function presentCurrentGuess() {
        if(!$this->mGame->getGameOver()) {
            $colors = $this->mGame->getCurrentGuess();

            $html = "<tr><td>?:</td>";
            $value = 1;
            foreach($colors as $color) {
                /*<td>
              <button name="pick" value="1"><img src="images/empty.png" alt="A empty sphere"></button>
            </td>*/
                $html .= "<td>";
                $html .= '<button name="pick" value="'.$value.'"><img src="images/'.$color.'.png" alt="A '.$color.' sphere"></button>';
                $html .= "</td>";
                $value++;
            }
            $html .= "<td>&nbsp;</td>";
            $html .= "</tr>";

        }
        else {
            $html = "";
        }

        return $html;

    }

    public function presentSolution() {
        $colors = $this->mGame->getSolution();

        $html = '<p class="solution">';

        foreach($colors as $color) {
            /*
             <img src="images/blue.png" alt="A blue.png sphere"> <img src="images/green.png"
                                                                             alt="A green.png sphere"> <img
    src="images/orange.png" alt="A orange.png sphere"> <img src="images/purple.png" alt="A purple.png sphere"></p>
             */
            $html .= '<img src="images/'.$color.'.png" alt="A '.$color.'.png sphere">';

        }
        $html .= '</p>';

        return $html;
    }

    private function presentPegs($pegs) {
        $html = '<td>';
        foreach ($pegs as $peg) {
            $html .= '<img src="images/'.$peg.'peg.png" alt="'.$peg.' Peg"> ';
        }
        $html .= '</td>';
        return $html;
    }

    public function presentHistory() {
        $history = $this->mGame->getHistory();

        if (count($history) > 0) {

        }
        $html = '';

        for ($i = 0; $i < count($history); $i++) {
            $nth = $i + 1;
            $colors = $history[$i]['guess'];
            $pegs = $history[$i]['pegs'];



            $html .= '<tr>';

            $html .= '<td>'.$nth.':</td>';

            foreach ($colors as $color) {
                $html .= '<td><img src="images/'.$color.'.png" alt="A '.$color.' sphere"></td>';
            }
            //$html .= "<td>&nbsp;</td>";

            $html.= $this->presentPegs($pegs);


            $html .= '</tr>';
        }

        return $html;

    }

    public function presentError() {
        $html = "";
        $msg = $this->mGame->getErrorMessage();
        if($msg != null) {
            $html .= '<p class = "gripe">'.$msg.'</p>';
            $this->mGame->setErrorMessage(null);
        }
        return $html;

    }

    public function presentEndGame() {
        $html = "";
        $msg = $this->mGame->getEndGameMessage();
        if($msg != null) {
            $html .= '<p class = "end">'.$msg.'</p>';
        }
        return $html;
    }

    public function presentPicker() {
        if(!$this->mGame->getGameOver()) {
            $html = <<<HTML
<table class="picker">
      <tr>
        <td><img src="images/orange.png" alt="A orange.png sphere"><br><input type="radio" name="color" value="orange"></td>
        <td><img src="images/purple.png" alt="A purple.png sphere"><br><input type="radio" name="color" value="purple"></td>
        <td><img src="images/green.png" alt="A green.png sphere"><br><input type="radio" name="color" value="green"></td>
        <td><img src="images/red.png" alt="A red.png sphere"><br><input type="radio" name="color" value="red"></td>
        <td><img src="images/yellow.png" alt="A yellow.png sphere"><br><input type="radio" name="color" value="yellow"></td>
        <td><img src="images/blue.png" alt="A blue.png sphere"><br><input type="radio" name="color" value="blue"></td>
      </tr>
    </table>
HTML;
        }
        else {
            $html = "";
        }

        return $html;
    }

    public function presentSubmits() {
        if (!$this->mGame->getGameOver()) {
            $html = <<<HTML
<p><input type="submit" name="guess" value="Guess">
      <input type="submit" name="giveup" value="Give Up">
      <input type="submit" name="newgame" value="New Game"></p>
    <p><input type="submit" name="exit" value="Exit"></p>
HTML;

        }
        else {
            $html = <<<HTML
<p><input type="submit" name="newgame" value="New Game"></p>
<p><input type="submit" name="exit" value="Exit"></p>
HTML;

        }

        return $html;
    }







}