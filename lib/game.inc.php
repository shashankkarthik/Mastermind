<?php
/**
 * Created by PhpStorm.
 * User: shash
 * Date: 4/26/2018
 * Time: 15:28
 */


require __DIR__ . "/../vendor/autoload.php";

//Session Start
session_start();

define("MASTERMIND_SESSION", 'mastermind');

if (!isset($_SESSION[MASTERMIND_SESSION])) {
    $_SESSION[MASTERMIND_SESSION] = new Mastermind\Mastermind();
}

$mastermind = $_SESSION[MASTERMIND_SESSION];