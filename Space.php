<?php

class Space {
//Space object represents a single space on the game board.

	private $absNumber;								//Absolute ID of the space as a cell of the 16 x 16 grid board display.
	private $pawnsOnSpace = array();

	//All spaces have $absNumber, but not all are traversable.
	private $traversable;							//Is the space a valid location for some or all Pawns?
	public $traversableNumber;						//Traversable spaces are numbered 0-87 for easier reference (starting from Yellow start).
	public $relNumberYellow;						//Space number relative to Yellow Start, 0-66.
	public $relNumberGreen;						//Space number relative to Green Start, 0-66.
	public $relNumberRed;							//Space number relative to Red Start, 0-66.
	public $relNumberBlue;							//Space number relative to Blue Start, 0-66.

	//These properties only applicable for special spaces (not in outer track).
	private $color;	
	//private $pieceColor = '';							
	private $isStart = false;
	private $isHome = false;
	private $isSafeZone = false;
	private $isSlide = false;
	private $isSlideStart = false;
	private $isSlideEnd = false;
	
	private $isOccupied = false;
	private $isDeck = false;
	private $cardNum = '';
	private $startPawnNum = 0;

	//This property only applicable for Start and Home spaces.
	private $numPawns;


	function __construct($absNumber, $traversableNumber, $relNumberYellow, $relNumberGreen, $relNumberRed, $relNumberBlue) {
		$this->absNumber = $absNumber;
		if ($traversableNumber == NULL) {
			$this->traversable = false;
		} else {
			$this->traversable = true;
			$this->traversableNumber = $traversableNumber;
		}

		$this->relNumberYellow = $relNumberYellow;
		$this->relNumberGreen = $relNumberGreen;
		$this->relNumberRed = $relNumberRed;
		$this->relNumberBlue = $relNumberBlue;

		$this->isStart = false;
		$this->isHome = false;
		$this->isSafeZone = false;	
		$this->isSlide = false;
		$this->isSlideStart = false;
		$this->isSlideEnd = false;
		//$this->isOccupied = false;
		$this->isDeck = false;
		

	}

	function makeDeckSpace($cardNum){
		$this->isDeck = true;
		$this->cardNum = $cardNum;
	}

	function makeStartSpace($color, $pawnNum) {
		$this->color = $color;
		$this->startPawnNum = $pawnNum;
		if ($this->isHome || $this->isSafeZone) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");		
		}
		else {
			$this->isStart = true;
		}
	}

	function makeSafeZoneSpace($color) {
		$this->color = $color;
		if ($this->isStart || $this->isHome) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");
		}
		else {
			$this->isSafeZone = true;
		}
	}

	function makeHomeSpace($color) {
		$this->color = $color;
		if ($this->isStart || $this->isSafeZone) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");
		}
		else {
			$this->isHome = true;
		}
	}

	function makeSlideSpace($color) {
		$this->color = $color;
		if ($this->isStart || $this->isSafeZone || $this->isHome) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");
		}
		else {
			$this->isSlide = true;
		}
	}
	
	function makeSlideStart($color) {
		$this->color = $color;
		if ($this->isStart || $this->isSafeZone || $this->isHome || $this->isSlide) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");
		}
		else {
			$this->isSlideStart = true;
		}
	}

	function makeSlideEnd($color) {
		$this->color = $color;
		if ($this->isStart || $this->isSafeZone || $this->isHome || $this->isSlide || $this->isSlideStart) {
			print("<p>Error: Space " . $this->absNumber . " cannot have multiple special designations.");
		}
		else {
			$this->isSlideEnd = true;
		}
	}

	function isSart() {
		return $this->isStart;
	}

	function isHome() {
		return $this->isHome;
	}

	function isSafeZone() {
		return $this->isSafeZone;
	}

	function isSliderStart() {
		return $this->isSlideStart;
	}

	function isSliderEnd() {
		return $this->isSlideEnd;
	}

	function isSliderSpace() {
		return $this->isSlideSpace;
	}

	function getColor() {
		return $this->color;
	}

	function getTraversableID() {
		return $this->traversableNumber;
	}

	function getAbsID() {
		return $this->absNumber;
	}

	function occupySpace(Pawn $pawn) {
		//If Space is color-specific, check that $pawn is the correct color.
		if ($this->isHome() or $this->isStart() or $this->isSafeZone()) {
			if($color != $this->color) {
				print "<br/>Error: " . $color . " Pawn cannot occupy " . $this->color . " Start, Home, or Safe Zone Space.<br/>";
				return -1;
			} //If Space is Safe Zone, check that it is not already occupied. 
			elseif ($this->isSafeZone() and $this->isOccupied()) {
				print "<br/>Error: Only one Pawn allowed on a Space.<br/>";
				return -1;
			} //If neither error is found, add $pawn to $pawnsOnSpace.
			else {
				//$this->isOccupied = true;
				$this->pawnsOnSpace[] = $pawn;
			}
		} //If Space is not color-specific, add $pawn to $pawnsOnSpace.
		else {
			$this->pawnsOnSpace[] = $pawn;
			//Note: We assume that a Swap or Sorry Move will already have been handled and that the Space will first be unOccupied.
		}

		//$this->pieceColor = $color;

		//$this->isOccupied = true;
		//$this->
	}

	function unOccupySpace($color) {
		/*Find a $color Pawn on Space and remove it. It doesn't matter which because a side from Start and Home, there will never be more than 
		one Pawn of the same color on the same Space.*/

		for ($i = 0; $i < count($this->pawnsOnSpace); $i ++) {
			if ($this->pawnsOnSpace[$i]->getColor() == $color) {
				array_splice($this->pawnsOnSpace, $i, 1);			//array_splice() rather than unset() to keep keys consecutive indexes to prevent non-object errors for indexes that no longer exist.
			}
		}
	}

	function isOccupied() {
		return (count($pawnsOnSpace) > 0);
	}

	/*
	function something() {
		$text='';

		if ($this->isStart){
			$text = 'startCell_'.$this->color.'_'.$this->startPawnNum;
		}
		elseif ($this->isDeck){
			$text = 'drawnDeck_'.$this->cardNum;
		}
		elseif ($this->isSafeZone){
			$text = 'safeZone'.$this->color;
		}
		elseif ($this->isHome){
			$text = 'homeCell_'.$this->color;
		}
		elseif ($this->isSlide){
			if ($this->isOccupied){
				$text = 'pawnSlide_'.$this->color.'_'.$this->pieceColor;
			}
			else {
				$text = 'slide_'.$this->color;
			}
			
		}
		elseif ($this->isSlideStart){
			if ($this->isOccupied){
				$text = 'pawnSlideStart_'.$this->color.'_'.$this->pieceColor;
			}
			else {
				$text = 'slideStart_'.$this->color;
			}
			
		}
		elseif ($this->isSlideEnd){
			if ($this->isOccupied){
				$text = 'pawnSlideEnd_'.$this->color.'_'.$this->pieceColor;
			}
			else {
				$text = 'slideEnd_'.$this->color;
			}
			
		}
		else {
			if ($this->isOccupied){
				$text = 'pawn_'.$this->pieceColor;
			}
			else {
				$text = 'cell'.$this->absNumber;
			}
			
		}
		return $text;
	}
	*/

	function displaySpace() {
		print '<div class="cellBody">';

		if ($this->isStart){
			
				print '<div class="startCell_'.$this->color.'_'.count($this->pawnsOnSpace).'">';
			
		}
		elseif ($this->isDeck){
			print '<div class="drawnDeck_'.$this->cardNum.'">';
			//print $this->absNumber . '</div>';
		}
		elseif ($this->isSafeZone){
			
			if ($this->isOccupied){
				print '<div class="safeZone'.$this->color.'_piece">';
			}
			else {
				print '<div class="safeZone'.$this->color.'">';
			}
			
		}
		elseif ($this->isHome){
			
				print '<div class="homeCell_'.$this->color.'_'.count($this->pawnsOnSpace).'">';
				//print $this->absNumber . '</div>';
			
		}
		elseif ($this->isSlide){
			if ($this->isOccupied){
				print '<div class="pawnSlide_'.$this->color.'_'.$this->pawnsOnSpace[0]->getColor().'">';
					//print $this->absNumber;
					//print $this->pieceColor;
				//print '</div>';
			}
			else {
				print '<div class="slide_'.$this->color.'">';
				//print $this->absNumber.'</div>';
			}	
			
		}
		elseif ($this->isSlideStart){
			if ($this->isOccupied){
				print '<div class="pawnSlideStart_'.$this->color.'_'.$this->pawnsOnSpace[0]->getColor().'">';
					//print $this->absNumber;
					//print $this->pieceColor;
				//print '</div>';
			}
			else {
				print '<div class="slideStart_'.$this->color.'">';
				//print $this->absNumber.'</div>';
			}
				
		}
		elseif ($this->isSlideEnd){
			if ($this->isOccupied){
				print '<div class="pawnSlideEnd_'.$this->color.'_'.$this->pawnsOnSpace[0]->getColor().'">';
				//print $this->absNumber.'</div>';
			}
			else {
				print '<div class="slideEnd_'.$this->color.'">';
				//print $this->absNumber.'</div>';
			}
				
		}
		else {
				if ($this->isOccupied){
					print '<div class="pawn_'.$this->pawnsOnSpace[0]->getColor().'">';
						//print $this->absNumber;
						//print $this->pieceColor;
					//print '</div>';
				}
				else {
					print ' <div class="cell'.$this->absNumber.'">';
						//print $this->absNumber;
					//print '</div>';
				}
			
		}
		
		print $this->absNumber . '<br/>';
		print 'Y' . $this->relNumberYellow . 'G' . $this->relNumberGreen . '<br/>R' . $this->relNumberRed . 'B' . $this->relNumberBlue;
		//print $this->pieceColor;
		print '</div>';
		print '</div>';
	}

}

?>