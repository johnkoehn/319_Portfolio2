<?php
	session_start();
	define('UPLOAD_DIR', 'images/');
	$img = $_POST['dataURL'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$id = uniqid();
	$file = UPLOAD_DIR . $id . '.png';
	$success = file_put_contents($file, $data);
	echo $success ? "file saved!" : 'Unable to save the file.';
	
	//database information
	$username = "root";
	$password = "root";
	$dbServer = "localhost";
	$dbName   = "portfolio2";
	
	$conn = new mysqli($dbServer, $username, $password, $dbName);
	
	// Check connection
	if ($conn->connect_error) 
	{
		die;
	}
	else
	{
		$sql = "INSERT INTO images (id, title, user) VALUES ('{$id}',
		'{$_POST['title']}', '{$_SESSION['user']}')";
		if ($conn->query($sql) == TRUE) 
		{
		} 
		else 
		{
			echo $conn->error;
		}
	}
	
	
	$conn->close();

?>