<?php

class Game {

	private Deck $deck;
	private SorryBoard $board;
	private $moveTypes = array("forward", "backward", "swap", "sorry");
	private $cardDist = array(   	  1 => 5,
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
	private array() $pawnLocations;

	function __contruct() {

		//Construct Card objects.
		$cards = array();
		for ($i=0; $i<$cardDist[1]; $i++) {
							//val, f, b, swap, sorry, start, split, again	
			$cards[] = new Card(1, 1, 0, false, false, true, false, false);
		}
		for ($i=0; $i<$cardDist[2]; $i++) {
			$cards[] = new Card(2, 2, 0, false, false, true, false, true);
		}
		for ($i=0; $i<$cardDist[3]; $i++) {
			$cards[] = new Card(3, 3, 0, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[4]; $i++) {
			$cards[] = new Card(4, 0, 4, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[5]; $i++) {
			$cards[] = new Card(5, 5, 0, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[7]; $i++) {
			$cards[] = new Card(7, 7, 0, false, false, false, true, false);
		}
		for ($i=0; $i<$cardDist[8]; $i++) {
			$cards[] = new Card(8, 8, 0, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[10]; $i++) {
			$cards[] = new Card(10, 10, 1, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[11]; $i++) {
			$cards[] = new Card(11, 11, 0, true, false, false, false, false);
		}
		for ($i=0; $i<$cardDist[12]; $i++) {
			$cards[] = new Card(12, 12, 0, false, false, false, false, false);
		}
		for ($i=0; $i<$cardDist["sorry"]; $i++) {
			$cards[] = new Card("sorry", 0, 0, false, true, true, false, false);
		}


		$deck = new Deck()
	}
}