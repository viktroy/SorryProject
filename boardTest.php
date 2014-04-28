<?php

define("DEBUG", TRUE);

include("../debugHeader.php");

include("../Board.php");

$board = new Board();
$board->displayBoard();
//var_dump($board->getSliders());

print '<head><link href="master.css" rel="stylesheet" type="text/css"></head>'

?>