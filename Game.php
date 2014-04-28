<?php
	include ('Board.php');
	include ('Player.php');
	include ('Deck.php');
	include ('Card.php');
	include ('Pawn.php');
	include ('Space.php');

class Game {


	//private $deck;
	private $board;
	private $player1;
	private $player2;
	private $player3;
	private $player4;
	private $winner;
	//private $moveTypes = array("forward", "backward", "swap", "sorry");
	

	private $pawnLocations = array();

	function continueGame($decks) {
		$gameOver = playerWon();
		if ($gameOver){
			print '<div class="winner_'.$this->winner.'">';
			print '</div>';
		} else {
			$decks = $deck;
			$deck->drawCard();

			$board->displayBoard();
		}
		
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

		$board = new Board;

		$deck = new Deck;
		print "deck created <br />";

		$deck->deckShuffle();

		print "deck shuffled <br />";

/*
		for ($i=0; $i<45; $i++){
			print $i.":   ";
			print $deck->cards[$i]->toString();
			
		}
*/
		

		print $cardCount;

		if ($cardCount>45){
			$cardCount=0;
			$deck->deckShuffle();
			print "END OF DECK <br />";
			print "deck shuffled <br />";
		}

		$board->spaces[101]->makeDeckSpace($deck->deck[0]->cardValue());

	


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
		$yellowHomeSpace = $this->board->spaces[$board->cellID(0)];
		

		$pawn1Yellow = new Pawn('yellow', $yellowHomeSpace);	
		$pawn2Yellow = new Pawn('yellow', $yellowHomeSpace);
		$pawn3Yellow = new Pawn('yellow', $yellowHomeSpace);	
		$pawn4Yellow = new Pawn('yellow', $yellowHomeSpace);	

		$pawn1Green = new Pawn('green', $board->spaces[1]);
		$pawn2Green = new Pawn('green', $board->spaces[1]);
		$pawn3Green = new Pawn('green', $board->spaces[1]);
		$pawn4Green = new Pawn('green', $board->spaces[1]);

		$pawn1Red = new Pawn('red', $board->spaces[2]);
		$pawn2Red = new Pawn('red', $board->spaces[2]);
		$pawn3Red = new Pawn('red', $board->spaces[2]);
		$pawn4Red = new Pawn('red', $board->spaces[2]);

		$pawn1Blue = new Pawn('blue', $board->spaces[3]);
		$pawn2Blue = new Pawn('blue', $board->spaces[3]);
		$pawn3Blue = new Pawn('blue', $board->spaces[3]);
		$pawn4Blue = new Pawn('blue', $board->spaces[3]);


		$playerYellow = new Player($pawn1Yellow, $pawn2Yellow, $pawn3Yellow, $pawn4Yellow);
		$playerRed = new Player($pawn1Red, $pawn2Red, $pawn3Red, $pawn4Red);
		$playerGreen = new Player($pawn1Green, $pawn2Green, $pawn3Green, $pawn4Green);
		$playerBlue = new Player($pawn1Blue, $pawn2Blue, $pawn3Blue, $pawn4Blue);

		

	//	$playerYellowPawns = $playerYellow->getPawnLocations();

		/*$playerYellowPawns[0]->getRelLocation()
		->occupySpace($playerYellowPawns[0])*/

		/*$yellowPawn1 = $playerYellow->pawn1;
		$yellowPawn2 = $playerYellow->pawn2;
		$yellowPawn3 = $playerYellow->pawn3;
		$yellowPawn4 = $playerYellow->pawn4;
		$redPawn1 = $playerRed->pawn1;
		$redPawn2 = $playerRed->pawn2;
		$redPawn3 = $playerRed->pawn3;
		$redPawn4 = $playerRed->pawn4;
		$greenPawn1 = $playerGreen->pawn1;
		$greenPawn2 = $playerGreen->pawn2;
		$greenPawn3 = $playerGreen->pawn3;
		$greenPawn4 = $playerGreen->pawn4;
		$bluePawn1 = $playerBlue->pawn1;
		$bluePawn2 = $playerBlue->pawn2;
		$bluePawn3 = $playerBlue->pawn3;
		$bluePawn4 = $playerBlue->pawn4;



		$this->yellowPawn1->location->occupySpace($yellowPawn1);
		$yellowPawn2->location->occupySpace($yellowPawn2);
		$yellowPawn3->location->occupySpace($yellowPawn3);
		$yellowPawn4->location->occupySpace($yellowPawn4);
		$redPawn1->location->occupySpace($redPawn1);
		$redPawn2->location->occupySpace($redPawn2);
		$redPawn3->location->occupySpace($redPawn3);
		$redPawn4->location->occupySpace($redPawn4);
		$greenPawn1->location->occupySpace($greenPawn1);
		$greenPawn2->location->occupySpace($greenPawn2);
		$greenPawn3->location->occupySpace($greenPawn3);
		$greenPawn4->location->occupySpace($greenPawn4);
		$bluePawn1->location->occupySpace($bluePawn1);
		$bluePawn2->location->occupySpace($bluePawn2);
		$bluePawn3->location->occupySpace($bluePawn3);
		$bluePawn4->location->occupySpace($bluePawn4);*/
		
		print '<div class="board">';
		$board->displayBoard();
		print '</div>';
		
	}

	public function getLegalMoves(Player $player, Card $card) {
		
	}

	public function getPlayerMove($move) {
		$pawn = $move->movingPwn;
	
		
		$move->start->unOccupySpace($pawn);
		$move->end->occupySpace($pawn);
	}

	public function playerWon() {
	
		$yellowHome = $this->board->spaces[69]->pawnsOnSpace;
		$greenHome = $this->board->spaces[75]->pawnsOnSpace;
		$redHome = $this->board->spaces[81]->pawnsOnSpace;
		$blueHome = $this->board->spaces[87]->pawnsOnSpace;

		if ($yellowHome==4){
			$this->winner = 'yellow';
			return true;
		} elseif ($greenHome==4){
			$this->winner = 'green';
			return true;
		} elseif ($redHome==4){
			$this->winner = 'red';
			return true;
		} elseif ($blueHome==4){
			$this->winner = 'blue';
			return true;
		} else {
			return false;
		}
	}
	
}

?>