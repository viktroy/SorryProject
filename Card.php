<?php

class Card {
//Card class represents an individual card and its effect(s).

	private $cardVal;
	private $moves;
	private $splittable;
	private $startable;
	private $drawAgain;

	function __construct($cardVal, int $forward, int $backward, bool $swap, bool $sorry, bool $startable, bool $splittable, bool $drawAgain) {
		$this->cardVal = $cardVal;
		if ($forward > 0) {
			
		}

		$this->splittable = $splittable;
		$this->startable = $startable;
		$this->drawAgain = $drawAgain;
	}

	function toString() {
		$cardStr = string($cardVal) + ' ';
		$moveTypes = array_keys($moves)
		foreach $moveTypes as $moveType {
			$cardStr += $moveType + ": " + $moves[$moveType] + "\n"
		}
	}
}

?>
