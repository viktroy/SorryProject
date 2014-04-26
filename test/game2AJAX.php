<?php

	include ('../Board.php');
	include ('../Space.php');
	include ('../Game.php');
	include ('../Deck.php');
	include ('../Card.php');


?>

<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

		<script>
		$(window).load(function() {
		 // executes when complete page is fully loaded, including all frames, objects and images
		 alert("window is loaded");
		});
		$(document).ready(function(){
			//$("#drawCard").hide();

		  $("#startGame").click(function(){
		    $("#drawCard").html("<button id='drawCard'>Draw Card</button>");
		    $("#startGame").hide();
		  });
		  $("#drawCard").click(function(){
		  	$("#myDiv").html("<p>Cardz Drahwn</p>");
		  	$("#drawCard").hide();
		  }
		});
		</script>



		<!--<script>
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
		</script>-->
		<title>Sorry!</title>

		<link href="master.css" rel="stylesheet" type="text/css">
	</head>

	<body>
	<?php
		
		



	?>
	<!--<button type="button" onclick="startGame()">Start Game</button>-->
	<button id="startGame">Starts Game</button>
	<button id="drawCard">Draw Card</button>
	<div id="myDiv"><p>Say something</p></div>



		


	</body>
</html>