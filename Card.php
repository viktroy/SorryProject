<?php
	include ('../Move.php');
class Card {
//Card class represents an individual card and its effect(s).



	private $cardVal;
	private $moves;
	private $forward;
	private $backward;
	private $swap;					//Does the card allow a swap move (aka an 11 card)?
	private $sorry;				//Is it a Sorry card?
	private $split;				//Does the card allow the spaces to be split between two pawns (aka a 7 card)?
	private $start;				//Does the card allow leaving Start (aka a 1 or 2 card)?
	private $drawAgain;
	private $description;

	function __construct($cardVal, $cardDescrip, $forward, $backward, $swap, $sorry, $start, $split, $drawAgain) {
		$this->cardVal = $cardVal;
		$this->description = $cardDescrip;
		/*
		if ($forward > 0) {

		}
		*/

		$this->forward = $forward;
		$this->backward = $backward;
		$this->swap = $swap;
		$this->sorry = $sorry;
		$this->split = $split;
		$this->start = $start;
		$this->drawAgain = $drawAgain;

		//print "Card object created.";
	}

	function cardValue() {

		return $this->cardVal;
	}

	function getMoves() {
		$moves = array("forward" => $this->forward, "backward" => $this->backward, "swap" => $this->swap, "sorry" => $this->sorry, "start" => $this->start, 
			"split" => $this->split);
		return $moves;
	}

	function toString() {
		$cardStr = $this->cardVal . " " . $this->description . "<br />";
		return $cardStr;
		/*
		$moveTypes = array_keys($moves);
		foreach ($moveTypes as $moveType) {
			$cardStr .= $moveType . ": " . $moves[$moveType] . "\n";
		}*/

	}
}

?>