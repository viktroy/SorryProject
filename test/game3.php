<?php
ini_set("memory_limit",-1);
$movePawnClicked = array();

include ('../pawnSpacesArray.php'); 

include ('../Board.php');
include ('../Space.php');
include ('../Game.php');
include ('../Deck.php');
include ('../Card.php');
include ('../Pawn.php');



session_start();

$end = isset($_POST["endSession"]);
if ($end) {
	session_destroy();
}


if (!isset($_SESSION['cardCount'])) {
	$cardCount = 0;
	$_SESSION['cardCount'] = $cardCount;
} else {
	$cardCount = $_SESSION['cardCount'];
}



if (!isset($_SESSION['deck'])) {
	$deck = new Deck;
	$_SESSION['deck'] = $deck;
	$deck->deckShuffle();
} else {
	$deck = $_SESSION['deck'];
}



print "deck shuffled <br />";

for ($i=0; $i<45; $i++){
	print $i.":   ";
	print $deck->cards[$i]->toString();
}

if (!isset($_SESSION['board'])) {
	$board = new Board;
	$_SESSION['board'] = $board;
} else {
	$board = $_SESSION['board'];
}
$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());

if (!isset($_SESSION['yellowPawnLocation'])) {
	$yellowPawnLocation = array(0,0,0,0);
	for ($i=0; $i<4; $i++){
		$_SESSION['yellowPawnLocation'][$i] = $yellowPawnLocation[$i];
	}
	
} else {
	for ($i=0; $i<4; $i++){
		$yellowPawnLocation[$i] = $_SESSION['yellowPawnLocation'][$i];
	}
	
}

if (!isset($_SESSION['yellowPawns'])) {
	$yellowPawns = array();
	for ($i=0; $i<4; $i++){
		$yellowPawns[$i] = new Pawn('yellow', $yellowSpaces[$yellowPawnLocation[$i]]);
		print "Yellow Pawn Created";
		$_SESSION['yellowPawns'][$i] = $yellowPawns[$i];
	}
} else {
	for ($i=0; $i<4; $i++){
		$yellowPawns[$i] = $_SESSION['yellowPawns'][$i];
	}
	
}

if (!isset($_SESSION['cardVal'])) {
	$cardValue = $deck->cards[$cardCount]->cardValue();
	$_SESSION['cardVal'] = $cardValue;
} else {
	$cardValue = $_SESSION['cardVal'];
	
}


if($formSent) {
	$player1Name = $_POST["player1Name"];

	if (!isset($_SESSION['player1'])) {
		$_SESSION['player1'] = $player1Name;
	} else {
		$player1Name = $_SESSION['player1'];
	}
}

$cardDrawn = isset($_POST["drawCard"]);

if($cardDrawn) {
	//$deck->drawCard();
	$cardCount++;
	$_SESSION['cardCount'] = $cardCount;

	print "CARD DRAWN!";
	$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());
	$cardValue = $deck->cards[$cardCount]->cardValue();
	$_SESSION['cardVal'] = $cardValue;
}

$movePawnClicked[0] = isset($_POST["movePawn1"]);
$movePawnClicked[1] = isset($_POST["movePawn2"]);
$movePawnClicked[2] = isset($_POST["movePawn3"]);
$movePawnClicked[3] = isset($_POST["movePawn4"]);

if($movePawnClicked[0]) {
	$board->spaces[$yellowPawns[0]->getRelLocation()]->unOccupySpace($yellowPawns[0]->getColor());

	$yellowPawnLocation[0]+=$deck->cards[$cardCount]->cardValue();
	
	if ($yellowPawnLocation[0]==12) {
		print "SLIDE ON GREEN 1!";
		$yellowPawnLocation[0]+=3;
	}
	elseif ($yellowPawnLocation[0]==20) {
		print "SLIDE ON GREEN 2!";
		$yellowPawnLocation[0]+=4;
	}
	elseif ($yellowPawnLocation[0]==27) {
		print "SLIDE ON RED 1!";
		$yellowPawnLocation[0]+=3;
	}
	elseif ($yellowPawnLocation[0]==35) {
		print "SLIDE ON RED 2!";
		$yellowPawnLocation[0]+=4;
	}
	elseif ($yellowPawnLocation[0]==42) {
		print "SLIDE ON BLUE 1!";
		$yellowPawnLocation[0]+=3;
	}
	elseif ($yellowPawnLocation[0]==50) {
		print "SLIDE ON BLUE 2!";
		$yellowPawnLocation[0]+=4;
	}

	$_SESSION['yellowPawnLocation'][0] = $yellowPawnLocation[0];
	//$newLocation = $yellowSpaces + 1;
	$yellowPawns[0]->setRelLocation($yellowSpaces[$yellowPawnLocation[0]]);
	print $yellowPawnLocation[0];
	$board->spaces[$yellowSpaces[$yellowPawnLocation[0]]]->occupySpace($yellowPawns[0]->getColor());
}
elseif($movePawnClicked[1]) {
	$board->spaces[$yellowPawns[1]->getRelLocation()]->unOccupySpace($yellowPawns[1]->getColor());
	$yellowPawnLocation[1]++;
	$_SESSION['yellowPawnLocation'][1] = $yellowPawnLocation[1];
	//$newLocation = $yellowSpaces + 1;
	$yellowPawns[1]->setRelLocation($yellowSpaces[$yellowPawnLocation[1]]);
	print $yellowPawnLocation[1];
	$board->spaces[$yellowSpaces[$yellowPawnLocation[1]]]->occupySpace($yellowPawns[1]->getColor());
}
elseif($movePawnClicked[2]) {
	$board->spaces[$yellowPawns[2]->getRelLocation()]->unOccupySpace($yellowPawns[2]->getColor());
	$yellowPawnLocation[2]++;
	$_SESSION['yellowPawnLocation'][2] = $yellowPawnLocation[2];
	//$newLocation = $yellowSpaces + 1;
	$yellowPawns[2]->setRelLocation($yellowSpaces[$yellowPawnLocation[2]]);
	print $yellowPawnLocation[2];
	$board->spaces[$yellowSpaces[$yellowPawnLocation[2]]]->occupySpace($yellowPawns[2]->getColor());
}
elseif($movePawnClicked[3]) {
	$board->spaces[$yellowPawns[3]->getRelLocation()]->unOccupySpace($yellowPawns[3]->getColor());
	$yellowPawnLocation[3]++;
	$_SESSION['yellowPawnLocation'][3] = $yellowPawnLocation[3];
	//$newLocation = $yellowSpaces + 1;
	$yellowPawns[3]->setRelLocation($yellowSpaces[$yellowPawnLocation[3]]);
	print $yellowPawnLocation[3];
	$board->spaces[$yellowSpaces[$yellowPawnLocation[3]]]->occupySpace($yellowPawns[3]->getColor());
}

?>

<html>
	<head>
		<title>Sorry!</title>
		<link href="master.css" rel="stylesheet" type="text/css">
	</head>

	<body>
	<div id="end">
		<form name="endSessionButton" action="" method="post">
			
			<input type="submit" name="endSession" value="End Session" id="end">


		</form>
	</div>

	<div id="start">
		<form name="startGameButton" action="" method="post">
			Player 1 Name: <input type="text" name="player1Name">
			<br />
			<input type="submit" name="gameStart" value="Start Game" id="startButton">


		</form>
	</div>

	<div id="turn">
		<form name="drawCardButton" action="" method="post">
			
			<input type="submit" name="drawCard" value="Draw Card" id="drawCard">


		</form>
	</div>

		<?php

		

		//$_SESSION['deck']->deckShuffle();
		//$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());
		

		//$board->displayBoard();
		//$yellowPawns[0] = 0;
		//$board->spaces[$yellowPawns[0]]->occupySpace('yellow');
		for ($i=0; $i<4; $i++){
			//print $i;
			$board->spaces[$yellowPawns[$i]->getRelLocation()]->occupySpace($yellowPawns[$i]->getColor());
		}
		
		$num = 0;
		
		for ($i = 0; $i < 16; $i++) {
			print "<div class='row'>";

				for ($j = 0; $j < 16; $j++) {
					print '<div class="cellBody">';
						print '<div class="'.$board->spaces[$num]->something().'">';
						print '</div>';
					print '</div>';
					//$this->spaces[$num]->displaySpaces();

					//$this->spaces[$cellID] = new Space($cellID);
					$num++;
				}	

			print "</div>";
		}

		?>
		<form name="pawnMove" action="" method="post">
		
			<input type="submit" name="movePawn1" value="Move Pawn 1" id="movePawnButton">
			<input type="submit" name="movePawn2" value="Move Pawn 2" id="movePawnButton">
			<input type="submit" name="movePawn3" value="Move Pawn 3" id="movePawnButton">
			<input type="submit" name="movePawn4" value="Move Pawn 4" id="movePawnButton">


		</form>


	</body>
</html>