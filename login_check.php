<?php
//database information
$username = "root";
$password = "root";
$dbServer = "localhost";
$dbName   = "portfolio2";

//validate data first, if successful, add it to the database, otherwise send back failure information
$check = "invalid";

//connect to the database, check the username and password
$passwordVal = md5($_POST['password']);
$conn = new mysqli($dbServer, $username, $password, $dbName);

// Check connection
if (!$conn->connect_error) 
{
	//pull data from table
	$sql = "SELECT username, password FROM users";
	$result = $conn->query($sql);
	
	//go through the usernames and passwords to check for valid login
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			if($_POST['username'] == $row["username"] && md5($_POST['password']) == $row["password"])
			{
				$check = $_POST['username'];
			}
		}
	}
	
}
else
{
	$check = "database";
}
$conn->close();
echo $check;

?>