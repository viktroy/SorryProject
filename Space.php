<?php

class Space {
//Space object represents a single space on the game board.

	private $absNumber = 0;					//Spaces are numbered 0-87.

	//These properties only applicable for special spaces (not in outer track).
	private $color = '';								
	private $isStart = false;
	private $isHome = false;
	private $isSafeZone = false;
	private $isSlide = false;
	private $isSlideStart = false;
	private $isSlideEnd = false;

	function __construct($absNumber) {
		$this->absNumber = $absNumber;	
		$this->isStart = false;
		$this->isHome = false;
		$this->isSafeZone = false;	
		$this->isSlide = false;
		$this->isSlideStart = false;
		$this->isSlideEnd = false;
		

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

	function displaySpaces() {
		print '<div class="cellBody">';

		if ($this->isStart){
			
				print '<div class="startCell_'.$this->color.'">';
				print  $this->absNumber . '</div>';
			
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
			
				print '<div class="slide_'.$this->color.'">';
				print $this->absNumber.'</div>';
			
		}
		elseif ($this->isSlideStart){
				print '<div class="slideStart_'.$this->color.'">';
				print $this->absNumber.'</div>';
		}
		elseif ($this->isSlideEnd){
				print '<div class="slideEnd_'.$this->color.'">';
				print $this->absNumber.'</div>';
		}
		else {
			
				print ' <div class="cell'.$this->absNumber.'">';
				echo $this->absNumber . '</div>';
			
		}
		
		print '</div>';
	}

}

?>