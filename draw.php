<html>
<head>
<title> 
	Draw
</title>

<?php
session_start();
//check is session is going
if(!isset($_SESSION['user']))
{
	header("Location:login.php");
}


?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script type = "text/javascript" src = "./port2.js"></script>
</head>

<body>
	<form>
	Title:<input type="text" id="title" name="title" style="margin-left:55px"> </input><br /> <br />
	</form>
	<canvas id = "drawCanvas" width = "900" height = "600" style = "border:1px solid #d3d3d3;"></canvas> <br />
	
	<input type = "button" id = "save" value = "Save"> </input>
	<input type = "button" id = "home" value = "Home"> </input>
	<input type = "button" id = "logout" value = "Logout"> </input>

	
	<div id="info" style="color:red"> </div>
<script>

$(document).ready(function()
{
	var logout = $("#logout");
	var home = $("#home");
	var save = $("#save");
	var title = $("#title");
	var canvas = $("#drawCanvas");
	var info = $("#info");
	
	logout.click (function()
	{
		$.get("logout.php");
		window.location.href = "login.php";
	});
	
	home.click (function()
	{
		window.location.href = "home.php";
	});
	
	save.click (function()
	{
		if(title.val() != "")
		{
			var dataURL = canvas.toDataURL();
			$.post("save.php", {dataURL : dataURL, title : title.val()}, function(data)
				{
					if(data == "success")
					{
						info.html("Painting saved!");
					}
					else
					{
						info.html("Save failed!");
					}
				});
		}
		else
		{
			alert("Please enter a title!");
		}
		
	});
	
});

</script>
</html>