<?php

define("DEBUG", TRUE);

include("../debugHeader.php");

//include("../Board.php");
include("../Game.php");

//$board = new Board();
//$board->displayBoard();

$game = new Game();
$game->startGame();
//var_dump($board->getSliders());

print '<head><link href="master.css" rel="stylesheet" type="text/css"></head>';

?>