<?php

<html>
	<head>
	</head>

	<body>
		
		<?php

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

			if ($formSent || $randomSent) {

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

			}

		?>

		<p>Spaces numbered in forward direction from start. 0=Start, 66=Home.</p>
		<form name="randomButton" action="/~vtroiano/CS205/Sorry/testing/AITest.php" method="post">
			<input type="submit" name="cmdRandomize" value="Random Placement">
		</form>
		<form name="sorryAI" action="/~vtroiano/CS205/Sorry/testing/AITest.php" method="post">
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