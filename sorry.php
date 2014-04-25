<?php 
	include ('./Game.php');
	include ('./Deck.php');
	include ('./Card.php');
	include ('./Board.php');
	include ('./Space.php');

	$cardCount = 0;
	$redPawns[0] = 0;
	$redPawns[1] = 1;
	$redPawns[2] = 2;
	$redPawns[3] = 3;
				
	$greenPawns[0] = 4;
	$greenPawns[1] = 5;
	$greenPawns[2] = 6;
	$greenPawns[3] = 7;
				
	$yellowPawns[0] = 8;
	$yellowPawns[1] = 9;
	$yellowPawns[2] = 10;
	$yellowPawns[3] = 11;
				
	$bluePawns[0] = 12;
	$bluePawns[1] = 13;
	$bluePawns[2] = 14;
	$bluePawns[3] = 15;
	
	function newGame() {
		$game = new Game();
		$game->startGame();
	}

	print "meow";
	newGame();
?>