<?php

class Space {
//Space object represents a single space on the game board.

	private $absNumber = 0;					//Spaces are numbered 0-87.

	//These properties only applicable for special spaces (not in outer track).
	private $color = '';	
	private $pieceColor = '';							
	private $isStart = false;
	private $isHome = false;
	private $isSafeZone = false;
	private $isSlide = false;
	private $isSlideStart = false;
	private $isSlideEnd = false;
	private $isOccupied = false;
	private $isDeck = false;
	private $cardNum = '';


	function __construct($absNumber) {
		$this->absNumber = $absNumber;	
		$this->isStart = false;
		$this->isHome = false;
		$this->isSafeZone = false;	
		$this->isSlide = false;
		$this->isSlideStart = false;
		$this->isSlideEnd = false;
		$this->isOccupied = false;
		$this->isDeck = false;
		

	}

	function makeDeckSpace($cardNum){
		$this->isDeck = true;
		$this->cardNum = $cardNum;
	}

	function makeStartSpace($color) {
		$this->color = $color;
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

	function occupySpace($color) {
		$this->pieceColor = $color;

		$this->isOccupied = true;
	}

	function displaySpaces() {
		print '<div class="cellBody">';

		if ($this->isStart){
			
				print '<div class="startCell_'.$this->color.'">';
				print  $this->absNumber . '</div>';
			
		}
		elseif ($this->isDeck){
			print '<div class="drawnDeck_'.$this->cardNum.'">';
			print $this->absNumber . '</div>';
		}
		elseif ($this->isSafeZone){
			
				print '<div class="safeZone'.$this->color.'">';
				print $this->absNumber . '</div>';
			
		}
		elseif ($this->isHome){
			
				print '<div class="homeCell_'.$this->color.'">';
				print $this->absNumber . '</div>';
			
		}
		elseif ($this->isSlide){
			if ($this->isOccupied){
				print '<div class="pawnSlide_'.$this->color.'_'.$this->pieceColor.'">';
					print $this->absNumber;
					print $this->pieceColor;
				print '</div>';
			}
			else {
				print '<div class="slide_'.$this->color.'">';
				print $this->absNumber.'</div>';
			}	
			
		}
		elseif ($this->isSlideStart){
			if ($this->isOccupied){
				print '<div class="pawnSlideStart_'.$this->color.'_'.$this->pieceColor.'">';
					print $this->absNumber;
					print $this->pieceColor;
				print '</div>';
			}
			else {
				print '<div class="slideStart_'.$this->color.'">';
				print $this->absNumber.'</div>';
			}
				
		}
		elseif ($this->isSlideEnd){
			if ($this->isOccupied){
				print '<div class="pawnSlideEnd_'.$this->color.'_'.$this->pieceColor.'">';
				print $this->absNumber.'</div>';
			}
			else {
				print '<div class="slideEnd_'.$this->color.'">';
				print $this->absNumber.'</div>';
			}
				
		}
		else {
				if ($this->isOccupied){
					print '<div class="pawn_'.$this->pieceColor.'">';
						print $this->absNumber;
						print $this->pieceColor;
					print '</div>';
				}
				else {
					print ' <div class="cell'.$this->absNumber.'">';
						print $this->absNumber;
					print '</div>';
				}
			
		}
		
		print '</div>';
	}

}

?>