<?php

class Move {
	
	private $movingPwn;
	private $start;
	private $end;

	function __construct(Pawn $pawn, Space $start, Space $end) {
		$this->movingPwn = $pawn;
		$this->start = $start;
		$this->end = $end;
	}

	/*function __construct($moveType, $numSpaces) {

	}

	function __construct($moveType) {
		
	}*/

	function getPawn() {
		return $movingPwn;
	}

	function getStart() {
		return $start;
	}

	function getEnd() {
		return $end;
	}

	function getResult(array $pawnLocations) {
		$pawnKey = array_search($start, $pawnLocations);
		$pawnLocations[$pawnKey] = $end;
		return $pawnLocations;
	}
}