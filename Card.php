<?php

class Card {
//Card class represents an individual card and its effect(s).

	private $cardVal;
	private $moves;
	private $splittable;
	private $startable;
	private $drawAgain;
	private $description;

	function __construct($cardVal, $cardDescrip, int $forward, int $backward, bool $swap, bool $sorry, bool $startable, bool $splittable, bool $drawAgain) {
		$this->cardVal = $cardVal;
		$this->description = $cardDescrip;
		if ($forward > 0) {

		}

		$this->splittable = $splittable;
		$this->startable = $startable;
		$this->drawAgain = $drawAgain;

		print "Card object created.";
	}

	function toString() {
		$cardStr = string($this->cardVal) + " " + $this->description + "\n";
		$moveTypes = array_keys($moves);
		foreach ($moveTypes as $moveType) {
			$cardStr += $moveType + ": " + $moves[$moveType] + "\n";
		}
	}
}

?>
