<?php

class Card {
//Card class represents an individual card and its effect(s).

	private $cardVal;
	private $moves;
	private $splittable;
	private $startable;
	private $drawAgain;
	private $description;

	function __construct($cardVal, $cardDescrip, $forward, $backward, $swap, $sorry, $startable, $splittable, $drawAgain) {
		$this->cardVal = $cardVal;
		$this->description = $cardDescrip;
		if ($forward > 0) {

		}

		$this->splittable = $splittable;
		$this->startable = $startable;
		$this->drawAgain = $drawAgain;

		print "Card object created.";
	}

	function cardValue () {
		return $this->cardVal;
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