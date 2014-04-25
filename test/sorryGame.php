<?php
	
	include ('../Board.php');
	include ('../Space.php');
	include ('../Game.php');
	include ('../Deck.php');
	include ('../Card.php');

	$board = new Board;

?>

<html>
	<head>
		<title>Sorry!</title>

		<link href="master.css" rel="stylesheet" type="text/css">


	

		


		<script>
			function startGame()
			{
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }


			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			    }
			  }
			xmlhttp.open("POST","../sorry.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send();
			}
		</script>



	</head>

	<body>
	<?php
		
		print '<div id="myDiv">';
		$game = new Game();
		
		$cardCount = 0;
		$redPawns[0] = 0;
		$redPawns[1] = 1;
		$redPawns[2] = 2;
		$redPawns[3] = 3;
				
		$greenPawns[0] = 4;
		$greenPawns[1] = 5;
		$greenPawns[2] = 6;
		$greenPawns[3] = 7;
				
		$yellowPawns[0] = 8;
		$yellowPawns[1] = 9;
		$yellowPawns[2] = 10;
		$yellowPawns[3] = 11;
				
		$bluePawns[0] = 12;
		$bluePawns[1] = 13;
		$bluePawns[2] = 14;
		$bluePawns[3] = 15;

		$formSent = isset($_POST["gameStart"]);
		$cardDrawn = isset($_POST["draw"]);
		
		if($cardDrawn) {
			print "something <br />";
			$game->continueGame($game->$deck);
		}

		if($formSent) {
			
			$game->startGame();

			$player1Name = $_POST["player1Name"];
			print "Player 1: ".$player1Name."<br />";

			/*print '<form name="drawCard" action="./sorryGame.php" method="post">';
			print '<input type="submit" name="draw" value="Draw Card">';
			print '</form>';*/

			print '<button type="button" onclick="startGame()">h Game</button>';
			//print '<div id="myDiv"></div>';


			/*$deck = new Deck;
			print "deck created <br />";

			$deck->deckShuffle();

			print "deck shuffled <br />";

			for ($i=0; $i<45; $i++){
				print $i.":   ";
				print $deck->cards[$i]->toString();
				
			}

			$board = new Board;

			print $cardCount;
			
			

			if ($cardCount>45){
				$cardCount=0;
				$deck->deckShuffle();
				print "END OF DECK <br />";
				print "deck shuffled <br />";
			}

			$board->spaces[101]->makeDeckSpace($deck->cards[$cardCount]->cardValue());

			$board->displayBoard();


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
			$board->spaces[$bluePawns[3]]->occupySpace('blue');*/

			



			for ($i=0; $i<2; $i++){
				print "<br />";
			}

		}

		print "</div>";



	?>

		<form name="startGameButton" action="./sorryGame.php" method="post">
			Player 1 Name: <input type="text" name="player1Name">
			<br />
			<input type="submit" name="gameStart" value="Start Game">


		</form>

		<form name="other" action="./sorryGame.php" method="post">
			
			
			<input type="submit" name="other" value="OTHER">


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


	</body>
</html>