<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(window).load(function() {
	$("#onLoad").text("meow");
   $("#drawCard").hide();
});

$(document).ready(function(){
 
  $("#startGame").click(function(){
    $("#test1").text("Hello world!");
    $("#startGame").hide();
    $("#drawCard").show();
  });
  $("#drawCard").click(function(){
    $("#test2").html("<b>Hello world!</b>");
  });
  $("#btn3").click(function(){
    $("#test3").val("Dolly Duck");
  });
});
</script>
</head>

<body>
<p id="test1">This is a paragraph.</p>
<p id="test2">This is another paragraph.</p>
<p>Input field: <input type="text" id="test3" value="Mickey Mouse"></p>
<p id="onLoad">&nbsp;</p>

<button id="startGame">Start Game</button>
<button id="drawCard">Draw Card</button>
<button id="btn3">Set Value</button>
</body>
</html>