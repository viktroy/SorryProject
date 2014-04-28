<?php

//Include Space.php
include("Space.php");

//Define debug constants.
define("DEBUG_REL_SPACE_VALS", FALSE);
define("DEBUG_SPACE_CREATION", FALSE);
define("DEBUG_SPECIAL_SPACE", FALSE);

class Board {

/*
	Board class represents a game board containing Space objects.
	Initial object outline by Victor. Edits and updates by Ryan. Clean-up by Victor

	Note: For basic display, the board is shown as a 16 X 16 grid of Spaces. Only the outer track, Start, Home, and Safe Zone spaces are valid Pawn positions.
*/

	var $spaces = array();			//For simple board display, each square in 16 x 16 grid is a Space object, but not all are used.
	var $traversable = array();

	//Declare $cellIDs, an array which maps the 88 traversable Spaces on the Board to their absolute cell ID's within the 16 x 16 grid.
	private $cellIDs = array(	 0 => 19,	//Yellow Start
										      60,	//Green Start
										      202,	//Red Start
										      161,	//Blue Start
										      4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,	//Top/Yellow edge, from Yellow Start
										      15,	//TR corner
										16 => 31, 47, 63, 79, 95, 111, 127, 143, 159, 175, 191, 207, 223, 239,	//Right/Green edge
										30 => 255,	//BR Corner
										31 => 254, 253, 252, 251, 250, 249, 248, 247, 246, 245, 244, 243, 242, 241,	//Bottom/Red edge
										45 => 240,	//BL Corner
										46 => 224, 208, 192, 176, 160, 144, 128, 112, 96, 80, 64, 48, 32, 16, // Left/Blue edge
										60 => 0,	//TL Corner
										61 => 1, 2, 3,	//Rest of Top/Yellow edge
										64 => 18, 34, 50, 66, 82,	//Yellow Safe Zone
										69 => 97,	//Yellow Home
										70 => 46, 45, 44, 43, 42,	//Green Safe Zone
										75 => 23,	//Green Home
										76 => 237, 221, 205, 189, 173,	//Red Safe Zone
										81 => 124,	//Red Home
										82 => 209, 210, 211, 212, 213,	//Blue Safe Zone
										87 => 198	//Blue Home
					 					);
	private $yellowAbsIDs = array();
	private $greenAbsIDs = array();
	private $redAbsIDs = array();
	private $blueAbsIDs = array();

	//Color constants for consistency when passing as arguments.
	const RED = "red";
	const YELLOW = "yellow";
	const GREEN = "green";
	const BLUE = "blue";
	
	//Slider placement constants. Board contains one short and one long slider of each color.
	const SHORT_SLIDER_LENGTH = 3;
	const LONG_SLIDER_LENGTH = 4;

	
	
	

	function __construct() {

		//Call function that builds each color's relative space ID array.
		$this->buildRelArrays();

		//Create 256 Space objects to make 16 x 16 grid.
		for ($cellID = 0; $cellID < 256; $cellID++) {

			$traversableID = array_search($cellID, $this->cellIDs);
			$yellowRelID = array_search($cellID, $this->yellowAbsIDs);
			$redRelID = array_search($cellID, $this->greenAbsIDs);
			$greenRelID = array_search($cellID, $this->redAbsIDs);
			$blueRelID = array_search($cellID, $this->blueAbsIDs);

			$this->spaces[$cellID] = new Space($cellID, $traversableID, $yellowRelID, $redRelID, $greenRelID, $blueRelID);
			if ($traversableID != NULL) {
				$this->traversable[$traversableID] = $this->spaces[$cellID];
			}
			
			//var_dump($this->spaces());
			debug_out("Space object created.", DEBUG_SPACE_CREATION);
			debug_out("New Space created with cellID " . $cellID . ", traversableID " . $traversableID . ", yellowRelID " . $yellowRelID . ", redRelID " . 
							$redRelID . ", greenRelID " . $greenRelID . ", blueRelID " . $blueRelID, DEBUG_REL_SPACE_VALS);
		}

		//Call function that sets special Spaces.
		$this->setSpecialSpaces();
	}

	public function cellID($traversableID) {
		return $this->cellIDs[$traversableID];
	}

	public function deckSpace($spaceID){
		$this->spaces[$spaceID]->makeDeckSpace($deck->cards[$cardCount]->cardValue());
	}

	private function buildRelArrays() {
		//Build arrays that map the 67 Spaces in each color's path around the board to their absolute cell ID's.

		$this->yellowAbsIDs[0] = $this->cellIDs[0];		//Yellow Start
		for ($i = 1; $i < 67; $i++) {
			$this->yellowAbsIDs[$i] = $this->cellIDs[$i + 3];			//Adding 3 ignores other colors' Start spaces. Don't have to mod because we don't cross 0.
		};

		$this->greenAbsIDs = array();
		$this->greenAbsIDs[0] = $this->cellIDs[1];		//Green Start
		for ($i = 1; $i < (64 - 18); $i++) {
			$this->greenAbsIDs[$i] = $this->cellIDs[$i + 18];		//Adding 18 ignores other colors' Start spaces and shifts around board. Mod 60 accounts for crossing 0.
		}
		for($i = (64 - 18); $i < 61; $i++){
			$this->greenAbsIDs[$i] = $this->cellIDs[(($i + 18) % 64) + 4];
		}
		for ($i = 61; $i < 67; $i++) {
			$this->greenAbsIDs[$i] = $this->cellIDs[$i + 9];				//Green Safe Zone and Home. Adding 9 ignores other colors' Start, Safe Zone, and Home spaces.
		}
		
		$this->redAbsIDs = array();
		$this->redAbsIDs[0] = $this->cellIDs[2];			//Red Start
		for ($i = 1; $i < (64 - 33); $i++) {
			$this->redAbsIDs[$i] = $this->cellIDs[$i + 33];
		}
		for ($i = (64 - 33); $i < 61; $i++) {
			$this->redAbsIDs[$i] = $this->cellIDs[(($i + 33) % 64) + 4];
		}
		for ($i = 61; $i < 67; $i++) {
			$this->redAbsIDs[$i] = $this->cellIDs[$i + 15];
		}

		$this->blueAbsIDs = array();
		$this->blueAbsIDs[0] = $this->cellIDs[3];			//Blue Start
		for ($i = 1; $i < (64 - 48); $i++) {
			$this->blueAbsIDs[$i] = $this->cellIDs[$i + 48];
		}
		for ($i = (64 - 48); $i < 61; $i++) {
			$this->blueAbsIDs[$i] = $this->cellIDs[(($i + 48) % 64) + 4];
		}
	}

	private function setSpecialSpaces() {
		
		$YELLOW_SHORT_SLIDER_START = 61;
		$YELLOW_LONG_SLIDER_START = 9;

		$GREEN_SHORT_SLIDER_START = 16;
		$GREEN_LONG_SLIDER_START = 24;

		$RED_SHORT_SLIDER_START = 31;
		$RED_LONG_SLIDER_START = 39;

		$BLUE_SHORT_SLIDER_START = 46;
		$BLUE_LONG_SLIDER_START = 54;

		debug_out("yellow short slider start: ".$YELLOW_SHORT_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("yellow long slider start: ".$YELLOW_LONG_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("green short slider start: ".$GREEN_SHORT_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("green long slider start: ".$GREEN_LONG_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("red short slider start: ".$RED_SHORT_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("red long slider start: ".$RED_LONG_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("blue short slider start: ".$BLUE_SHORT_SLIDER_START, DEBUG_SPECIAL_SPACE);
		debug_out("blue long slider start: ".$BLUE_LONG_SLIDER_START, DEBUG_SPECIAL_SPACE);
		//Set slider Spaces, using constants defined above for easier reading.
		
		//Set short slider start Spaces.
		$this->spaces[$this->cellID($YELLOW_SHORT_SLIDER_START)]->makeSlideStart(self::YELLOW);
		$this->spaces[$this->cellID($GREEN_SHORT_SLIDER_START)]->makeSlideStart(self::GREEN);
		$this->spaces[$this->cellID($RED_SHORT_SLIDER_START)]->makeSlideStart(self::RED);
		$this->spaces[$this->cellID($BLUE_SHORT_SLIDER_START)]->makeSlideStart(self::BLUE);

		//Set short slider inner Spaces.
		for ($i = 1; $i < self::SHORT_SLIDER_LENGTH; $i++) {
			$this->spaces[$this->cellID($YELLOW_SHORT_SLIDER_START + $i)]->makeSlideSpace(self::YELLOW);
			$this->spaces[$this->cellID($GREEN_SHORT_SLIDER_START + $i)]->makeSlideSpace(self::GREEN);
			$this->spaces[$this->cellID($RED_SHORT_SLIDER_START + $i)]->makeSlideSpace(self::RED);
			$this->spaces[$this->cellID($BLUE_SHORT_SLIDER_START + $i)]->makeSlideSpace(self::BLUE);
		}

		//Set short slider end Spaces.
		$this->spaces[$this->cellID((($YELLOW_SHORT_SLIDER_START + self::SHORT_SLIDER_LENGTH) % 64) + 4)]->makeSlideEnd(self::YELLOW);	
			//Accounts for fact that Yellow's short slider ends on traversable space 4. If we wanted to allow user to place the sliders, every slider space and end would have to be % 64 + 4
		$this->spaces[$this->cellID($GREEN_SHORT_SLIDER_START + self::SHORT_SLIDER_LENGTH)]->makeSlideEnd(self::GREEN);
		$this->spaces[$this->cellID($RED_SHORT_SLIDER_START + self::SHORT_SLIDER_LENGTH)]->makeSlideEnd(self::RED);
		$this->spaces[$this->cellID($BLUE_SHORT_SLIDER_START + self::SHORT_SLIDER_LENGTH)]->makeSlideEnd(self::BLUE);

		//Set long slider start Spaces.
		$this->spaces[$this->cellID($YELLOW_LONG_SLIDER_START)]->makeSlideStart(self::YELLOW);
		$this->spaces[$this->cellID($GREEN_LONG_SLIDER_START)]->makeSlideStart(self::GREEN);
		$this->spaces[$this->cellID($RED_LONG_SLIDER_START)]->makeSlideStart(self::RED);
		$this->spaces[$this->cellID($BLUE_LONG_SLIDER_START)]->makeSlideStart(self::BLUE);

		//Set long slider inner Spaces.
		for ($i = 1; $i < self::LONG_SLIDER_LENGTH; $i++) {
			$this->spaces[$this->cellID($YELLOW_LONG_SLIDER_START + $i)]->makeSlideSpace(self::YELLOW);
			$this->spaces[$this->cellID($GREEN_LONG_SLIDER_START + $i)]->makeSlideSpace(self::GREEN);
			$this->spaces[$this->cellID($RED_LONG_SLIDER_START + $i)]->makeSlideSpace(self::RED);
			$this->spaces[$this->cellID($BLUE_LONG_SLIDER_START + $i)]->makeSlideSpace(self::BLUE);
		}

		//Set long slider end Spaces.
		$this->spaces[$this->cellID($YELLOW_LONG_SLIDER_START + self::LONG_SLIDER_LENGTH)]->makeSlideEnd(self::YELLOW);	
		$this->spaces[$this->cellID($GREEN_LONG_SLIDER_START + self::LONG_SLIDER_LENGTH)]->makeSlideEnd(self::GREEN);
		$this->spaces[$this->cellID($RED_LONG_SLIDER_START + self::LONG_SLIDER_LENGTH)]->makeSlideEnd(self::RED);
		$this->spaces[$this->cellID($BLUE_LONG_SLIDER_START + self::LONG_SLIDER_LENGTH)]->makeSlideEnd(self::BLUE);

		//Set Start Spaces.
		$this->spaces[$this->cellID(0)]->makeStartSpace(self::YELLOW, 4);
		$this->spaces[$this->cellID(1)]->makeStartSpace(self::GREEN, 4);
		$this->spaces[$this->cellID(2)]->makeStartSpace(self::RED, 4);
		$this->spaces[$this->cellID(3)]->makeStartSpace(self::BLUE, 4);

		//Set Home Spaces.
		$this->spaces[$this->cellID(69)]->makeHomeSpace(self::YELLOW);
		$this->spaces[$this->cellID(75)]->makeHomeSpace(self::GREEN);
		$this->spaces[$this->cellID(81)]->makeHomeSpace(self::RED);
		$this->spaces[$this->cellID(87)]->makeHomeSpace(self::BLUE);
	
		//Set Safe Zone Spaces.
		for ($i = 0; $i < 5; $i++) {
			$this->spaces[$this->cellID(64 + $i)]->makeSafeZoneSpace(self::YELLOW);
			$this->spaces[$this->cellID(70 + $i)]->makeSafeZoneSpace(self::GREEN);
			$this->spaces[$this->cellID(76 + $i)]->makeSafeZoneSpace(self::RED);
			$this->spaces[$this->cellID(82 + $i)]->makeSafeZoneSpace(self::BLUE);
		}
	}

	/*
	public function getSliders() {
		$sliders = array();
		$sliderID = 0;
		
		foreach ($this->traversable as $travSpace) {
			print "<br/>";
			var_dump($travSpace);
			print "<br/>";
		}

		foreach ($this->traversable as $trackSpace) {
			if ($trackSpace->isSliderStart()) {
				$sliders[$sliderID] = array($trackSpace->getColor(), $trackSpace->getTraversableID());
				$i = 1;
				while (! $this->traversable[(($trackSpace->getTraversableID() + $i) % 64)]->isSliderEnd()) {
					$i++;
				}
				$sliders[$sliderID][2] = (($trackSpace->getTraversableID() + $i) % 64);
				$sliderID++;
			}
		}
		return $sliders;
	}
	*/

	public function displayBoard(){
		$num = 0;
		//print "<div class='board'>";
		for ($i = 0; $i < 16; $i++) {
			print "<div class='row'>";

				for ($j = 0; $j < 16; $j++) {
					$this->spaces[$num]->displaySpace();

					//$this->spaces[$cellID] = new Space($cellID);
					$num++;
				}	

			print "</div>";
		}

		//print "</div>";
	}
}

?>