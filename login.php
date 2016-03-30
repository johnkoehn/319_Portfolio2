<!DOCTYPE html>
<HTML>
<HEAD>
<?php
session_start();
//check is session is already going
if(isset($_SESSION['user']))
{
	header("Location:home.php");
}


?>


<title> WebDraw login </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</HEAD>

<body>

<h2> Enter login information to start drawing! </h2>
<br>
<form name="input" action="signup.php" method="post" >
Username:         <input type="text" id="username" name="username" style="margin-left:55px"> <br /> <br />
Password:         <input type="password" id="password" name="password" style="margin-left:58px"> <br /> <br />
<input type="button" id="login" name="login" value="login"> <br />
</form> <br />
<div id="myDiv"></div>
<br />
<a href="signup.php"> Need to sign up? </a>
<script>
$(document).ready(function() 
{
	var login = $("#login");
	var t1 = $("#myDiv");
	var username = $("#username");
	var password = $("#password");
	
	login.click (function()
	{
		$.post("login_check.php", {username : username.val(), password : password.val()}, 
        function(data) 
		{
			if(data == "invalid")
			{
				t1.html("Invalid username or password!");
			}
			else if(data == "database")
			{
				t1.html("database issue");
			}
           else
		   {
				t1.html(data);
				$.get("startsession.php", {username : username.val()});
				window.location.href = "home.php";
		   }

		});
		
	});
});

</script>


</body>