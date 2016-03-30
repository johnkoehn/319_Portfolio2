<?php

//database information
$username = "root";
$password = "root";
$dbServer = "localhost";
$dbName   = "portfolio2";

//validate data first, if successful, add it to the database, otherwise send back failure information
$check = "successful";

if(preg_match('/[^A-Za-z0-9]+/', $_POST['username']))
{
	$check =  "username";
}
else if($_POST['password'] != $_POST['confPassword'])
{
	$check = "password";
}
else if(!preg_match('/^[\w!@]{6}[\w!@]{0,6}$/', $_POST['password']))
{
	$check = "password_invalid";
}

//if sign up is successful connect to the database and save the data
if($check == "successful")
{
	$passwordVal = md5($_POST['password']);
	$conn = new mysqli($dbServer, $username, $password, $dbName);
	
	// Check connection
	if ($conn->connect_error) 
	{
		$check = "database";
	}
	else
	{
		$sql = "INSERT INTO users (username, password) VALUES ('{$_POST['username']}', '{$passwordVal}')";
		if ($conn->query($sql) == TRUE) 
		{
		} 
		else 
		{
			$check = "username_not_unquie";
		}
	}
	$conn->close();
}
echo $check;

?>