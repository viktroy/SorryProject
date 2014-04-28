<?php

class Pawn {

	private $location;
	//private $relLocation;
	private $pawnColor = '';

	public function __construct($color, $location) {
		$this->pawnColor = $color;
		$this->location = $location;

		$this->location->occupy($this);
	}

	public function setLocation(Space $space) {
		$this->location = $space;
		$this->location->occupy($this);
	}

	public function getColor() {
		return $this->pawnColor;
	}

	public function getRelLocation() {
		switch ($this->pawnColor) {
			case 'yellow':
				return $this->location->relNumberYellow;
			case 'green':
				return $this->location->relNumberGreen;
			case 'red':
				return $this->location->relNumberRed;
			case 'blue':
				return $this->location->relNumberBlue;
		}
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