<!DOCTYPE html>
<HTML>
<HEAD>
<title> WebDraw Home </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
session_start();
//check is session is going
if(!isset($_SESSION['user']))
{
	header("Location:login.php");
}


?>
</HEAD>

<body>

<h2> Welcome <?php echo $_SESSION['user']; ?> </h2>
<table>
</table>


<input type="button" id="newdrawing" name="newdrawing" value="Click to start a new drawing"> </input><br /><br />
<input type="button" id="logout" name ="logout" value="logout"> </input> <br />
<div id="myDiv"></div>

<script>
$(document).ready(function() 
{
	var logout = $("#logout");
	var t1 = $("#myDiv");
	var newdrawing = $("#newdrawing");
	var password = $("#password");
	var confPassword = $("#password_confirm");
	
	logout.click (function()
	{
		$.get("logout.php");
		window.location.href = "login.php";
	});
	
	newdrawing.click (function()
	{
		window.location.href = "draw.php";
	});
	
});

</script>


</body>