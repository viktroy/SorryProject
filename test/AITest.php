<?php
session_start();
/*	
class Space {
	function __construct(int $cellNum) {
		echo '<div class="cellBody">';
		echo '<div class="cell'.$cellNum.'">';
		echo $cellNum;
		echo '</div>';
	}
}

class Board {
	

   	function __construct() {
       for ($i = 0; $i < 88; $i++) {
			$this->$spaces[$i] = new Space($i);
		
		}
   }
}*/

	include ('../Board.php');
	include ('../Space.php');
	include ('../Game.php');
	include ('../Deck.php');
	include ('../Card.php');


	if (!isset($_SESSION['deck'])) {
		$deck = new Deck;
		$_SESSION['deck'] = $deck;
	} else {
		$deck = $_SESSION['deck'];
	}

	if (!isset($_SESSION['board'])) {
		$board = new Board;
		$_SESSION['board'] = $board;
	} else {
		$board = $_SESSION['board'];
	}

?>

<html>
	<head>
		<link href="master.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		
		<?php
			$cardCount = 0;

			//$game = new Game;

			//$deck = new Deck;

			

			//print "deck created <br />";

			//$deck->deckShuffle();

			print "deck shuffled <br />";

			for ($i=0; $i<45; $i++){
				print $i.":   ";
				print $deck->cards[$i]->toString();
				
			}

			//$board = new Board;

			


			//Set array of card descriptions.
			$descriptions[0] = "Swap a Pawn from Start with an opponent's Pawn.";
			$descriptions[1] = "Move a Pawn from Start or 1 space forward.";
			$descriptions[2] = "Move a Pawn from Start or 2 spaces forward.";
			$descriptions[3] = "";
			$descriptions[4] = "Move a Pawn 4 spaces backward.";
			$descriptions[5] = "";
			$descriptions[6] = "";
			$descriptions[7] = "Can be split between two Pawns already on the track.";
			$descriptions[8] = "";
			$descriptions[9] = "";
			$descriptions[10] = "Can instead move 1 space backward.";
			$descriptions[11] = "Can instead swap a Pawn already on the track with an opponent's Pawn already on the track.";
			$descriptions[12] = "";

			//Initialize form input arrays.
			$redPawns[] = "";
			$greenPawns[] = "";
			$yellowPawns[] = "";
			$bluePawns[] = "";

			//If form has been submitted, get POST'd values, compute AI move and display info.
			$formSent = isset($_POST["cmdSubmitted"]);
			$randomSent = isset($_POST["cmdRandomize"]);

			if($formSent) {

				//Get POST'd values.	
				$redPawns[0] = $_POST["redPawn1"];
				$redPawns[1] = $_POST["redPawn2"];
				$redPawns[2] = $_POST["redPawn3"];
				$redPawns[3] = $_POST["redPawn4"];
				
				$greenPawns[0] = $_POST["greenPawn1"];
				$greenPawns[1] = $_POST["greenPawn2"];
				$greenPawns[2] = $_POST["greenPawn3"];
				$greenPawns[3] = $_POST["greenPawn4"];
				
				$yellowPawns[0] = $_POST["yellowPawn1"];
				$yellowPawns[1] = $_POST["yellowPawn2"];
				$yellowPawns[2] = $_POST["yellowPawn3"];
				$yellowPawns[3] = $_POST["yellowPawn4"];
				
				$bluePawns[0] = $_POST["bluePawn1"];
				$bluePawns[1] = $_POST["bluePawn2"];
				$bluePawns[2] = $_POST["bluePawn3"];
				$bluePawns[3] = $_POST["bluePawn4"];

				$card = $_POST["selCard"];
				print($card);

				//If Random card was selected, pick a random card.
				if($card == -1) {
					$randomCard = rand(0, 10);
					//Adjust for nonexistent card values.
					if($randomCard >= 6){
						$randomCard++;
					}
					if($randomCard >= 9) {
						$randomCard++;
					}
					$card = $randomCard;
				}
			}

			if ($formSent) {

				print("Red Pawns:<br/>");
				foreach($redPawns as $redPawn) {
					print($redPawn . ", ");
				}
				print("<br/>Green Pawns:<br/>");
				foreach($greenPawns as $greenPawn) {
					print($greenPawn . ", ");
				}
				print("<br/>Yellow Pawns:<br/>");
				foreach($yellowPawns as $yellowPawn) {
					print($yellowPawn . ", ");
				}
				print("<br/>Blue Pawns:<br/>");
				foreach($bluePawns as $bluePawn) {
					print($bluePawn . ", ");
				}
				print("<br/>Red's Card:<br/>");
				print($card . "<br/>");
				print($descriptions[$card] . "<br/>");


				//TEST

				
				if ($cardCount>45){
					$cardCount=0;
					$deck->deckShuffle();
					print "END OF DECK <br />";
					print "deck shuffled <br />";
				}

				print $cardCount;
				$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());


				$board->spaces[$yellowPawns[0]]->occupySpace('yellow');
				$board->spaces[$yellowPawns[1]]->occupySpace('yellow');
				$board->spaces[$yellowPawns[2]]->occupySpace('yellow');
				$board->spaces[$yellowPawns[3]]->occupySpace('yellow');

				$board->spaces[$redPawns[0]]->occupySpace('red');
				$board->spaces[$redPawns[1]]->occupySpace('red');
				$board->spaces[$redPawns[2]]->occupySpace('red');
				$board->spaces[$redPawns[3]]->occupySpace('red');

				$board->spaces[$greenPawns[0]]->occupySpace('green');
				$board->spaces[$greenPawns[1]]->occupySpace('green');
				$board->spaces[$greenPawns[2]]->occupySpace('green');
				$board->spaces[$greenPawns[3]]->occupySpace('green');

				$board->spaces[$bluePawns[0]]->occupySpace('blue');
				$board->spaces[$bluePawns[1]]->occupySpace('blue');
				$board->spaces[$bluePawns[2]]->occupySpace('blue');
				$board->spaces[$bluePawns[3]]->occupySpace('blue');

				$board->displayBoard();


			}

		?>

		<p>Spaces numbered in forward direction from start. 0=Start, 66=Home.</p>
		<form name="randomButton" action="./AITest.php" method="post">
			<input type="submit" name="cmdRandomize" value="Random Placement">
		</form>
		<form name="sorryAI" action="./AITest.php" method="post">
			<fieldset>
				<p>Red Pawn Locations (relative to Red Start):</p>
				<input name="redPawn1" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $redPawns[0] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="redPawn2" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $redPawns[1] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="redPawn3" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $redPawns[2] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="redPawn4" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $redPawns[3] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
			</fieldset>
			<fieldset>
				<p>Green Pawn Locations (relative to Green Start):</p>
				<input name="greenPawn1" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $greenPawns[0] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="greenPawn2" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $greenPawns[1] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="greenPawn3" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $greenPawns[2] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="greenPawn4" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $greenPawns[3] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
			</fieldset>
			<fieldset>
				<p>Yellow Pawn Locations (relative to Yellow Start):</p>
				<input name="yellowPawn1" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $yellowPawns[0] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="yellowPawn2" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $yellowPawns[1] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="yellowPawn3" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $yellowPawns[2] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="yellowPawn4" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $yellowPawns[3] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
			</fieldset>
			<fieldset>
				<p>Blue Pawn Locations (Relative to Blue Start):</p>
				<input name="bluePawn1" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $bluePawns[0] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="bluePawn2" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $bluePawns[1] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="bluePawn3" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $bluePawns[2] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
				<input name="bluePawn4" type="number" min="0" max="66" value=
					<?php 
						if($randomSent) {
							echo("\"" . rand(0, 66) . "\"");
						}elseif($formSent) { 
							echo ("\"" . $bluePawns[3] . "\"");
						}else {
							echo ("\"" . '0' . "\""); } 
					?>>
			</fieldset>
			<fieldset>
				<select name="selCard" form="sorryAI">
					<option value="-1">Random</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="0">Sorry!</option>
				</select>
			</fieldset>
			<input type="submit" name="cmdSubmitted" vlaue="submit">
		</form>

		<?php 

			
			/*
			$cellID = 0;
			$boardID = 0;

				for ($row = 0; $row < 16; $row++) {
					print ' <div class="row"> <!-- Row ' . $row .' --> ';

						
						switch ($row) {
						    case 0:
						        for ($cell = 0; $cell < 16; $cell++) {
						   			print ' <div class="cellBody">';
									print ' <div class="cell'.$cellID.'">';
									print $cellID . '</div>';
									print ' </div>';
									$cellID++;
									$boardID++;
								}
						        break;
						    case 1:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
						    case 2:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 3:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 4:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 5:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 6:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 7:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 8:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 9:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 10:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 11:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 12:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 13:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 14:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	if ($cell == 0 || $cell == 15) {
						        		print ' <div class="cellBody">';
						        		print '<div class="cell'.$cellID.'">';
						        		print $cellID. '</div>';
						        		print ' </div>';
						        		$cellID++;
						        		$boardID++;
						        	} 
						        	else {
						        		print ' <div class="cellBody">';
						        		print ' <div class="inner'.$boardID.'">';
										print $boardID . '</div>';
										print ' </div>';
										$boardID++;
						        	}
									
								}
						        break;
							case 15:
						        for ($cell = 0; $cell < 16; $cell++) {
						        	print ' <div class="cellBody">';
									print ' <div class="cell'.$cellID.'">';
									print $cellID . '</div>';
									print ' </div>';
									$cellID++;
									$boardID++;
								}
						        break;

						}
						
					print '</div>';
				}*/

			?>
		<!--	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<table class="board">
			
			<tr> 
				<td class="tile">1</td>
				<td class="slide_yellowStart">slideArrow</td>
				<td class="slide_yellow">slide</td>
				<td class="slide_yellow">slide</td>
				<td class="start_yellow">start</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="slide_yellowStart">slideArrow</td>
				<td class="slide_yellow">slide</td>
				<td class="slide_yellow">slide</td>
				<td class="slide_yellow">slide</td>
				<td class="start_yellow">slideEnd</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_greenStart">slideArrow</td>
			</tr>
			<tr> 
				<td class="start_blue">slideEnd</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_green">slide</td>
			</tr>
			<tr> 
				<td class="slide_blue">slide</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_green">slide</td>
			</tr>
			<tr> 
				<td class="slide_blue">slide</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="start_green">start</td>
			</tr>
			<tr> 
				<td class="slide_blue">slide</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="slide_blueStart">slideArrow</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_greenStart">slideArrow</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_green">slide</td>
			</tr>
			<tr> 
				<td class="start_blue">start</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_green">slide</td>
			</tr>
			<tr> 
				<td class="slide_blue">slide</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="slide_green">slide</td>
			</tr>
			<tr> 
				<td class="slide_blue">slide</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="start_green">slideEnd</td>
			</tr>
			<tr> 
				<td class="slide_blueStart">slideArrow</td>
				<td class="tile">2</td>
				<td class="tile">3</td>
				<td class="tile">4</td>
				<td class="tile">5</td>
				<td class="tile">6</td>
				<td class="tile">7</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="tile">12</td>
				<td class="tile">13</td>
				<td class="tile">14</td>
				<td class="tile">15</td>
				<td class="tile">16</td>
			</tr>
			<tr> 
				<td class="tile">1</td>
				<td class="tile">2</td>
				<td class="start_red">slideEnd</td>
				<td class="slide_red">slide</td>
				<td class="slide_red">slide</td>
				<td class="slide_red">slide</td>
				<td class="slide_redStart">slideArrow</td>
				<td class="tile">8</td>
				<td class="tile">9</td>
				<td class="tile">10</td>
				<td class="tile">11</td>
				<td class="start_red">start</td>
				<td class="slide_red">slide</td>
				<td class="slide_red">slide</td>
				<td class="slide_redStart">slideArrow</td>
				<td class="tile">16</td>
			</tr>
			
		</table>-->
	</body>
</html>