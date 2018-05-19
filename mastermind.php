<?php
require __DIR__ . "/lib/game.inc.php";
$view = new Mastermind\MastermindView($mastermind);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="mastermind.css" type="text/css" rel="stylesheet"/>
  <title>Mastermind</title>
</head>
<body>
<form id="gameform" action="mastermind-post.php" method="POST">
  <fieldset>
    <?php echo $view->presentName(); ?>
    <table class="game">
      <?php echo $view->presentHistory();?>
      <?php echo $view->presentCurrentGuess();?>
    </table>
    <?php echo $view->presentPicker();?>
    <?php echo $view->presentError();?>
    <?php echo $view->presentEndGame();?>
    <?php echo $view->presentSubmits();?>
  </fieldset>
</form>
<?php echo $view->presentSolution()?>
</body>
</html>