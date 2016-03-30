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
<h3> Click on an old drawing to edit! </h3>
<table>
<?php

//database information
$username = "root";
$password = "root";
$dbServer = "localhost";
$dbName   = "portfolio2";

$conn = new mysqli($dbServer, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) 
{
	echo "database failure!!";
	die;
}
$columns = 3; //images per row
$pointer = 0; //what column we are currently at

//pull the image information from the sql database, for each image, display a small version of it in the table
$sql = "SELECT id, title, user FROM images";
$result = $conn->query($sql);
echo "<tr>";

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		if($_SESSION['user'] == $row["user"])
		{
			echo "<td > <image src=\"images\\" . $row["id"] . "_small.png\" style=\"margin-right:50px\" border=\"5\"/> <p style=\"margin-right:50px\" align=\"center\">" . $row["title"] . "</p> </td>";
			$pointer += 1;
			if($pointer == 3)
			{
				echo "</tr><tr>";
				$pointer = 0;
			}
		}
	}
}

?>

</tr>

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