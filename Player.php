<?php
include ('Pawn.php');
class Player {
//Player class represents a player via the positions of their Pawns on the board.

	

	public $pawn1;
	public $pawn2;
	public $pawn3;
	public $pawn4;
	public $currCard;

	function __construct($color) {
		$this->pawn1 = new Pawn($color);
		$this->pawn2 = new Pawn($color);
		$this->pawn3 = new Pawn($color);
		$this->pawn4 = new Pawn($color);
	}

	public function getPossibleMoves() {
		$possMoves = array();
		$moves = $this->currCard->getMoves();
		$pawn1CurrLoc = $this->pawn1->getRelLocation();
		$pawn2CurrLoc = $this->pawn2->getRelLocation();
		$pawn3CurrLoc = $this->pawn3->getRelLocation();
		$pawn4CurrLoc = $this->pawn4->getRelLocation();
		
		//Handle basic forward and backward options.
		if ($moves["forward"] != 0) {															//Forward move is an option.
			if ($pawn1CurrLoc != 0) {															//$pawn1 is not on its Start.
				$endLoc = $pawn1CurrLoc + $moves["forward"];
				if ($endLoc < 66) {																//Move does not pass $pawn

				}
				if ($endLoc > 66) {																//If adding forward would put the piece past Home, 
					$endLoc %= 60;
				}
			//	$possMoves[] = new Move($this->pawn1, $this->pawn1->getRelLocation() + )		//left off here
			}
		}
	}

	public function movePawn(Pawn $movePawn, Space $toRelSpace) {
		$movePawn->setRelLocation($toRelSpace);
	}

	public function getPawnLocations() {
		$pawns = array($this->pawn1->getRelLocation(), $this->pawn2->getRelLocation(), $this->pawn3->getRelLocation(), $this->pawn4->getRelLocation());
		return $pawns;
	}

	public function setCard(Card $card) {
		$this->$currCard = $card;
	}
}

?>