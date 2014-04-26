<?php

class Deck extends ArrayObject {

	private $deck;

	private $cardDescrips = array(      1 => "Move a Pawn from Start or 1 space forward.",
								           "Move a Pawn from Start or 2 spaces forward.",
								           "Move a Pawn 3 spaces forward.",
								           "Move a Pawn 4 spaces backward.",
								           "Move a Pawn 5 spaces forward.",
								           "6 card does not exist.",
								           "Move a Pawn 7 spaces forward or split them between two Pawns.",
								           "Move a Pawn 8 spaces forward.",
								           "9 card does not exist.",
								           "Move a Pawn 10 spaces forward or 1 space backward.",
								           "Move a Pawn 11 spaces forward or swap it with an opponent's Pawn.",
								           "Move a Pawn 12 spaces forward.",
								  "sorry" => "Swap a Pawn from Start with an opponent's Pawn, which is sent back to its Start.",
								  );

	function __construct() {
		//$deck = array();

		$cardDist = array(   	      1 => 5,
								  	   	   4,
									  	   4,
									   	   4,
									  	   4,
									  	   0,
								 	       4,
									  	   4,
									  	   0,
									       4,
								   		   4,
								 	       4,
								"sorry" => 4 );
		//Construct Card objects.
		$cards = array();


		for ($i=0; $i < $cardDist[1]; $i++) {
							//val, f, b, swap, sorry, start, split, again	
			$this->cards[] = new Card(1, $this->cardDescrips[1], 1, 0, false, false, true, false, false);
		}
		for ($i=0; $i < $cardDist[2]; $i++) {
			$this->cards[] = new Card(2, $this->cardDescrips[2], 2, 0, false, false, true, false, true);
		}
		for ($i=0; $i < $cardDist[3]; $i++) {
			$this->cards[] = new Card(3, $this->cardDescrips[3], 3, 0, false, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[4]; $i++) {
			$this->cards[] = new Card(-4, $this->cardDescrips[4], 0, 4, false, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[5]; $i++) {
			$this->cards[] = new Card(5, $this->cardDescrips[5], 5, 0, false, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[7]; $i++) {
			$this->cards[] = new Card(7, $this->cardDescrips[7], 7, 0, false, false, false, true, false);
		}
		for ($i=0; $i < $cardDist[8]; $i++) {
			$this->cards[] = new Card(8, $this->cardDescrips[8], 8, 0, false, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[10]; $i++) {
			$this->cards[] = new Card(10, $this->cardDescrips[10], 10, 1, false, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[11]; $i++) {
			$this->cards[] = new Card(11, $this->cardDescrips[11], 11, 0, true, false, false, false, false);
		}
		for ($i=0; $i < $cardDist[12]; $i++) {
			$this->cards[] = new Card(12, $this->cardDescrips[12], 12, 0, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist["sorry"]; $i++) {
			$this->cards[] = new Card("sorry", $this->cardDescrips["sorry"], 0, 0, false, true, true, false, false);
		}

		$numCards = count($this->cards);
		print "Number of Cards: ".$numCards."<br />";

		/*for ($i=0; $i<45; $i++){
			print $i.":   ";
			print $this->cards[$i]->toString();
			
		}*/

	}

	/*function __construct(array $cards) {
		$deck = array();
		
		foreach ($cards as $card) {
			if (! is_a($card, 'Card')) {
				echo "Error: Deck object can only be constructed from an array of Card objects.";
				break;
			}
			//print $card->toString();
			$this->addCard($card);

			
		}
		foreach ($deck as $test){
			print "card: ";
			print $test->toString();
		}
		print "Deck object created.";
	}*/

	function addCard(Card $card) {
		$deck[] = $card;

	}

	function drawCard() {
		$topCard = array_shift($deck);
		return $topCard;
	}

	function deckShuffle() {
		shuffle($this->cards);
		/*$isSuffled = false;
		while (! $isSuffled) {
			print "test";
			$isShuffled = shuffle($this->cards);
		}*/
	}

	function isEmpty() {
		if (count($this->deck) == 0) {
			return true;
		} else {
			return false;
		}
	}

	function toString() {
		$deckStr = '';
		$debug = 0;

		for ($i=0; $i<45; $i++){
			print $i;
			$deckStr .= $deck[$i]->toString() . "<br />";
		}
		/*foreach ($deck as $cards) {
			print $debug;
			$deckStr .= $cards->toString() . "\n";
		}*/
		return $deckStr;
	}

	function displayDeck() {

	}
}

?>