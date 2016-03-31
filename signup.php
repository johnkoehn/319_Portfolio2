<!DOCTYPE html>
<HTML>
<HEAD>
<title> Sign up </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php
session_start();
//check is session is already going
if(isset($_SESSION['user']))
{
	header("Location:home.php");
}


?>
</HEAD>

<body>

<h2> Enter the following information to sign up for WebDraw </h2>
<br>
<form name="input" action="signup.php" method="post" >
Username:         <input type="text" id="username" name="username" style="margin-left:55px"> <br /> <br />
Password:         <input type="password" id="password" name="password" style="margin-left:58px"> <br /> <br />
Confirm Password: <input type="password" id="password_confirm" name="password"> <br /> <br />
<input type="button" id="signup" name="submit" value="sign up"> <br />
</form>
<div id="myDiv"></div>
<br />
<a href="login.php"> Already have an account? </a>
<script>
$(document).ready(function() 
{
	var login = $("#signup");
	var t1 = $("#myDiv");
	var username = $("#username");
	var password = $("#password");
	var confPassword = $("#password_confirm");
	
	login.click (function()
	{
		$.post("signup_check.php", {username : username.val(), password : password.val(), 
		confPassword : confPassword.val()}, 
        function(data) 
		{
			if(data == "username")
			{
				t1.html("Username must contain only alphabetical or numeric characters");
			}
			else if(data == "password")
			{
				t1.html("Passwords don't match!!");
			}
			else if(data == "password_invalid")
			{
				t1.html("Password must between 6 to 12 characters long and can only contain letters, numbers and the characters ! and @");
			}
			else if(data == "username_not_unquie")
			{
				t1.html("Username " + username.val() + " already taken!");
			}
			else if(data == "successful")
			{
				t1.html("Account created!");
				$.get("startsession.php", {username : username.val()});
				window.location.href = "home.php";
			}
           else
		   {
				t1.html("Database issue! Contact admin!!");
				//enter site
				console.log(data);
				
				//window.location.href = "viewPosts.php?name=" + usernameString;
		   }

		});
		
	});
});

</script>


</body>
</html>