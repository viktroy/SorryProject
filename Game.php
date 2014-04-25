<?php

class Game {

	private $deck;
	//private Board $board;
	//private $moveTypes = array("forward", "backward", "swap", "sorry");
	

	private $pawnLocations = array();

	function continueGame($decks) {
		$decks = $deck;
		$deck->drawCard();

		$board->displayBoard();
	}

	function startGame() {
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

		$deck = new Deck;
		print "deck created <br />";

		$deck->deckShuffle();

		print "deck shuffled <br />";

		for ($i=0; $i<45; $i++){
			print $i.":   ";
			print $deck->cards[$i]->toString();
				
		}

		

		print $cardCount;

		if ($cardCount>45){
			$cardCount=0;
			$deck->deckShuffle();
			print "END OF DECK <br />";
			print "deck shuffled <br />";
		}

		$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());

		print '<div class="board">';
		$board->displayBoard();
		print '</div>';


		/*$board->spaces[$yellowPawns[0]]->occupySpace('yellow');
		$board->spaces[$yellowPawns[1]]->occupySpace('yellow');
		$board->spaces[$yellowPawns[2]]->occupySpace('yellow');
		$board->spaces[$yellowPawns[3]]->occupySpace('yellow');

		$board->spaces[$redPawns[0]]->occupySpace('red');
		$board->spaces[$redPawns[1]]->occupySpace('red');
		$board->spaces[$redPawns[2]]->occupySpace('red');
		$board->spaces[$redPawns[3]]->occupySpace('red');

		$board->spaces[$greenPawns[0]]->occupySpace('green');
		$board->spaces[$greenPawns[1]]->occupySpace('green');
		$board->spaces[$greenPawns[2]]->occupySpace('green');
		$board->spaces[$greenPawns[3]]->occupySpace('green');

		$board->spaces[$bluePawns[0]]->occupySpace('blue');
		$board->spaces[$bluePawns[1]]->occupySpace('blue');
		$board->spaces[$bluePawns[2]]->occupySpace('blue');
		$board->spaces[$bluePawns[3]]->occupySpace('blue');*/



		
	}

	
}

?>