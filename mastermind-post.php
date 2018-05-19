<?php
/**
 * Created by PhpStorm.
 * User: shash
 * Date: 4/26/2018
 * Time: 15:14
 */

require 'lib/game.inc.php';

$controller = new Mastermind\MastermindController($mastermind, $_REQUEST);

header("Location: " . $controller->getPage());
exit;