<?php

class Board {
//Board class represents a game board containing Spaces and Sliders.

	$spaces = array();
	$sliders = array();

	function __contruct() {
		//Create 88 Space instances for Sorry board.
		for ($i = 0; $i < 88; $i++) {
			this->$spaces[$i] = new Space($i);
		}

		/*
		Set Start, Home, and Safe Zone spaces:
		Start spaces: 0, 1, 2, and 3 in clockwise order (Red, Blue, Yellow, Green)
		Red Safe Zone: 64-69 (Home is 69)
		Blue Safe Zone: 70-75 (Home is 75)
		Yellow Safe Zone: 76-81 (Home is 81)
		Green Safe Zone: 82-87 (Home is 87)
		*/
		this->$spaces[0]::makeStartSpace('red');
		this->$spaces[1]::makeStartSpace('blue');
		this->$spaces[2]::makeStartSpace('yellow');
		this->$spaces[3]::makeStartSpace('green');

		for ($i = 64; $i < 69; $i++) {
			this->$spaces[$i]::makeSafeZoneSpace('red');
		}

		for ($i = 70; $i < 75; $i++) {
			this->$spaces[$i]::makeSafeZoneSpace('blue');
		}
		
		for ($i = 76; $i < 81; $i++) {
			this->$spaces[$i]::makeSafeZoneSpace('yellow');
		}

		for ($i = 82; $i < 87; $i++) {
			this->$spaces[$i]::makeSafeZoneSpace('green');
		}

		this->$spaces[69]::makeHomeSpace('red');
		this->$spaces[75]::makeHomeSpace('blue');
		this->$spaces[81]::makeHomeSpace('yellow');
		this->$spaces[87]::makeHomeSpace('green');
	}

	public function addSlider(Slider $slider) {
		array_push(this->$sliders, $slider);
	}
}

?>