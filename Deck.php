<?php

class Deck extends ArrayObject {

	private $deck;
	
	function __contruct() {
		$deck = array();
	}

	function __construct(array $cards) {
		$deck = array();
		foreach ($cards as $card) {
			if (! is_a($card, 'Card')) {
				echo "Error: Deck object can only be constructed from an array of Card objects.";
				break;
			}
			$this->addCard($card);
		}
		print "Deck object created.";
	}

	function addCard(Card $card) {
		$deck[] = $card;
	}

	function drawCard() {
		$topCard = array_shift($deck);
		return $topCard;
	}

	function shuffle() {
		$isSuffled = false;
		while (! $isSuffled) {
			$isShuffled = shuffle($this->deck);
		}
	}

	function isEmpty() {
		if (count($this->deck) == 0) {
			return true;
		} else {
			return false;
		}
	}

	function toString() {
		$deckStr = '';
		foreach ($deck as $card) {
			$deckStr += $card->toString() + "\n";
		}
	}
}

?>