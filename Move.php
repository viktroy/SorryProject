<?php

class Move {
//Move object represents a legal move which a player could choose based on the card they have drawn. A Move has a Pawn, a start Space, and an End space.
//Note that a move can cause a secondary effect move, for example with a swap or a Sorry card.
	
	private Pawn $movingPwn;
	private Space $start;
	private Space $end;

	private Move $effectMove;

	function __construct(Pawn $pawn, Space $start, Space $end, bool $isSwap, bool $isSplit) {
		$this->movingPwn = $pawn;
		$this->start = $start;
		$this->end = $end;
	}

	function getPawn() {
		return $movingPwn;
	}

	function getStart() {
		return $start;
	}

	function getEnd() {
		return $end;
	}

	public function setEnd($endRelLoc) {
		$this->end = $endRelLoc;
	}

	public function causesBump() {
		$colorOnEnd = $this->end->isOccupied();
		if ($colorOnEnd == '') {
			return false;
		} else {
			return true;
		}
		//Note: We assume that all Move objects represent legal moves, so we needn't worry about the case where $end is occupied by a Pawn of $movingPwn's color.
	}
/*
	function getResult(array $pawnLocations) {
		$pawnKey = array_search($start, $pawnLocations);
		$pawnLocations[$pawnKey] = $end;
		return $pawnLocations;
	}
*/
}
