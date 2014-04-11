<?php

class Player {
//Player class represents a player via the positions of their Pawns on the board.

	private Pawn $pawn1 = '';
	private Pawn $pawn2 = '';
	private Pawn $pawn3 = '';
	private Pawn $pawn4 = '';
	private Card $currCard = '';

	function __construct(Pawn $pawn1, Pawn $pawn2, Pawn $pawn3, Pawn $pawn4) {
		this->$pawn1 = $pawn1;
		this->$pawn2 = $pawn2;
		this->$pawn3 = $pawn3;
		this->$pawn4 = $pawn4;
	}

	public function movePawn(Pawn $movePawn, Space $toRelSpace) {
		$movePawn::setRelLocation($toRelSpace);
	}

	public function getPawnLocations() {
		$pawns[0] = $pawn1;
		$pawns[1] = $pawn2;
		$pawns[2] = $pawn3;
		$pawns[3] = $pawn4;
		return $pawns;
	}

	public function setCard(Card $card) {
		this->$currCard = $card
	}
}

?>