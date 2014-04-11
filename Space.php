<?php

class Space {
//Space object represents a single space on the game board.
	
	private int $absNumber = 0;					//Spaces are numbered 0-87.

	//These properties only applicable for special spaces (not in outer track).
	private $color = '';								
	private bool $isStart = false;
	private bool $isHome = false;
	private bool $isSafeZone = false;

	function __construct(int $absNumber) {
		this->$absNumber = $absNumber;
	}

	function makeStartSpace($color) {
		this->$color = $color;
		if (this->$isHome || this->$isSafeZone) {
			print("<p>Error: Space " . this->$absNumber . " cannot have multiple special designations.");		
		}
		else {
			this->$isStart = true;
		}
	}

	function makeSafeZoneSpace($color) {
		this->$color = $color;
		if (this->$isStart || this->$isHome) {
			print("<p>Error: Space " . this->$absNumber . " cannot have multiple special designations.");
		}
		else {
			this->$isSafeZone = true;
		}
	}

	function makeHomeSpace($color) {
		this->$color = $color
		if (this->$isStart || this->$isSafeZone) {
			print("<p>Error: Space " . this->$absNumber . " cannot have multiple special designations.");
		}
		else {
			this->$isHome = true;
		}
	}

}

?>