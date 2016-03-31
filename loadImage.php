<?php
	//find title and name that match and than return image name
	session_start();
	
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
	
	//goes through sql and finds the image, if user and title are the same, use that image id
	$sql = "SELECT id, title, user FROM images";
	$result = $conn->query($sql);
	$check = "";
	//go through the usernames and passwords to check for same image title and user
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			if($_GET['title'] == $row["title"] && $_SESSION['user'] == $row["user"])
			{
				$check = $row['id'];
				break;
			}
		}
	}
	$conn->close();
	echo $check;
	
	
?>