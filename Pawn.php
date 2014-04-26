<?php

class Pawn {

	private $relLocation;
	private $pawnColor = '';

	public function Pawn($color, $relLoc) {
		$this->pawnColor = $color;
		$this->relLocation = $relLoc;
	}

	public function setRelLocation($relLoc) {
		$this->relLocation = $relLoc;
	}

	public function getColor() {
		return $this->pawnColor;
	}

	public function getRelLocation() {
		return $this->relLocation;
	}

	public function getAbsLocation() {
	/*
	Start spaces: 0, 1, 2, and 3 in clockwise order from Red
	Main track: 4-63, clockwise from Red Start
	Red Safe Zone: 64-69 (Home is 69)
	Blue Safe Zone: 70-75 (Home is 75)
	Yellow Safe Zone: 76-81 (Home is 81)
	Green Safe Zone: 82-87 (Home is 87)
	*/

	$relLoc = $this->$relLocation;

		if (color == 'red') {
			if ($relLoc == 0) {
				return 0;
			}
			else {
				return ($relLoc + 3);
			}
		}
		if (color == 'blue') {
			if ($relLoc == 0) {
				return 1;
			}
			if ($relLoc > 60) {
				return ($relLoc + 9);
			}
			else {
				return (($relLoc + 15) % 60);
			}
		}
		if (color == 'yellow') {
			if ($relLoc == 0) {
				return 2;
			}
			if ($relLoc > 60) {
				return ($relLoc + 15);
			}
			return (($relLoc + 30) % 60);
		}
		if (color == 'blue') {
			if ($relLoc ==0) {
				return 3;
			}
			if ($relLoc > 60) {
				return ($relLoc + 21);
			}
			else {
				return (($relLoc + 45) % 60);
			}
		}
	}
}

?>