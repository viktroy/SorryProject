<?php

class Board {
//Board class represents a game board containing Spaces and Sliders.

	var $spaces = array(88);
	var $red = "red";
	var $yellow = "yellow";
	var $green = "green";
	var $blue = "blue";

	public $sliders = array();

	function __construct() {
		$cellID = 0;
		for ($i = 0; $i < 16; $i++) {
			for ($j = 0; $j < 16; $j++) {
				$this->spaces[$cellID] = new Space($cellID);
				$cellID++;
			}	
		}

		/*
		Set Start, Home, and Safe Zone spaces:
		Start spaces: 0, 1, 2, and 3 in clockwise order (Red, Blue, Yellow, Green)
		Red Safe Zone: 64-69 (Home is 69)
		Blue Safe Zone: 70-75 (Home is 75)
		Yellow Safe Zone: 76-81 (Home is 81)
		Green Safe Zone: 82-87 (Home is 87)
		*/
		/*$this->spaces[4]->makeStartSpace('yellow');
		$this->spaces[79]->makeStartSpace('green');
		$this->spaces[251]->makeStartSpace('red');
		$this->spaces[32]->makeStartSpace('blue');

		for ($i = 64; $i < 69; $i++) {
			$this->spaces[$i]->makeSafeZoneSpace('red');
		}

		for ($i = 70; $i < 75; $i++) {
			$this->spaces[$i]->makeSafeZoneSpace('blue');
		}*/
		/*
		for ($i = 76; $i < 81; $i++) {
			$this->spaces[$i]->makeSafeZoneSpace('yellow');
		}

		for ($i = 82; $i < 87; $i++) {
			$this->spaces[$i]->makeSafeZoneSpace('green');
		}*/

		// BOARD SPACES
		$yellowSlide = array("2","3","11","12","13");
		$yellowSlideStart = array("1","10");
		$yellowSlideEnd = array("4","14");
		$yellowSafeZone = array("18","34","50","66","82");
		$greenSlide = array("47","63","175","191","207");
		$greenSlideStart = array("31","159");
		$greenSlideEnd = array("79","223");
		$greenSafeZone = array("42","43","44","45","46");
		$redSlide = array("243","244","245","252","253");
		$redSlideStart = array("246","254");
		$redSlideEnd = array("242","251");
		$redSafeZone = array("173","189","205","221","237");
		$blueSlide = array("48","64","80","192","208");
		$blueSlideStart = array("96","224");
		$blueSlideEnd = array("32","176");
		$blueSafeZone = array("209","210","211","212","213");

		for ($i = 0; $i < 5; $i++) {
			$this->spaces[$yellowSlide[$i]]->makeSlideSpace('yellow');
			$this->spaces[$yellowSafeZone[$i]]->makeSafeZoneSpace('yellow');
			$this->spaces[$greenSlide[$i]]->makeSlideSpace('green');
			$this->spaces[$greenSafeZone[$i]]->makeSafeZoneSpace('green');
			$this->spaces[$redSlide[$i]]->makeSlideSpace('red');
			$this->spaces[$redSafeZone[$i]]->makeSafeZoneSpace('red');
			$this->spaces[$blueSlide[$i]]->makeSlideSpace('blue');
			$this->spaces[$blueSafeZone[$i]]->makeSafeZoneSpace('blue');
		}

		for ($i = 0; $i < 2; $i++) {
			$this->spaces[$yellowSlideStart[$i]]->makeSlideStart('yellow');
			$this->spaces[$yellowSlideEnd[$i]]->makeSlideEnd('yellow');
			$this->spaces[$greenSlideStart[$i]]->makeSlideStart('green');
			$this->spaces[$greenSlideEnd[$i]]->makeSlideEnd('green');
			$this->spaces[$redSlideStart[$i]]->makeSlideStart('red');
			$this->spaces[$redSlideEnd[$i]]->makeSlideEnd('red');
			$this->spaces[$blueSlideStart[$i]]->makeSlideStart('blue');
			$this->spaces[$blueSlideEnd[$i]]->makeSlideEnd('blue');
		}

		//Start Space
		$this->spaces[19]->makeStartSpace('yellow');
		$this->spaces[60]->makeStartSpace('red');
		$this->spaces[202]->makeStartSpace('green');
		$this->spaces[161]->makeStartSpace('blue');

		//End Space
		$this->spaces[23]->makeHomeSpace('green');
		$this->spaces[97]->makeHomeSpace('yellow');
		$this->spaces[124]->makeHomeSpace('red');
		$this->spaces[198]->makeHomeSpace('blue');

		//$this->spaces[18]->makeSlideSpace('yellow');
		/*$this->spaces[69]->makeHomeSpace('red');
		$this->spaces[75]->makeHomeSpace('blue');
		$this->spaces[81]->makeHomeSpace('yellow');
		$this->spaces[87]->makeHomeSpace('green');*/


	}

	public function displayBoard(){
		$num = 0;
		//Create 88 Space instances for Sorry board.
		for ($i = 0; $i < 16; $i++) {
			print "<div class='row'>";

				for ($j = 0; $j < 16; $j++) {
					$this->spaces[$num]->displaySpaces();

					//$this->spaces[$cellID] = new Space($cellID);
					$num++;
				}	

			print "</div>";
		}
	}

	public function addSlider(Slider $slider) {
		array_push($this->$sliders, $slider);
	}
}

?>