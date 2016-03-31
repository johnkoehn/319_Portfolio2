<?php
require 'smart_resize_image.function.php';
	//php functions
	function checkIfImageExist($conn)
	{
		//goes through sql and finds the image, if user and title are the same, use that image id
		$sql = "SELECT id, title, user FROM images";
		$result = $conn->query($sql);
		
		//go through the usernames and passwords to check for same image title and user
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				if($_POST['title'] == $row["title"] && $_SESSION['user'] == $row["user"])
				{
					return $row['id'];
				}
			}
		}
		return '';
	}
	
	function addNewImage($conn)
	{
		define('UPLOAD_DIR', 'images/');
		$img = $_POST['dataURL'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$id = uniqid();
		$file = UPLOAD_DIR . $id . '.png';
		$success = file_put_contents($file, $data);
		echo $success ? "file saved!" : 'Unable to save the file.';
	
		//save resized image
		$resizedFile = UPLOAD_DIR . $id . '_small.png';
		smart_resize_image(null , file_get_contents($file), 300 , 200 , false , $resizedFile , false , false ,100 );
		
		//add to database
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
	
	function updateOldImage($id)
	{
		define('UPLOAD_DIR', 'images/');
		$img = $_POST['dataURL'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $id . '.png';
		$success = file_put_contents($file, $data);
		echo $success ? "file saved!" : 'Unable to save the file.';
		
				//save resized image
		$resizedFile = UPLOAD_DIR . $id . '_small.png';
		smart_resize_image(null , file_get_contents($file), 300 , 200 , false , $resizedFile , false , false ,100 );
	}




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
	

	
	$id = checkIfImageExist($conn);
	
	if($id == '')
	{
		//new image
		addNewImage($conn);
	}
	else
	{
		//update old image
		updateOldImage($id);
		
	}
	

	
	
	$conn->close();

?>