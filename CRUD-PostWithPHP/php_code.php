<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "INSERT INTO info (id,name, address) VALUES (NULL,'$name', '$address')"); 
		$_SESSION['message'] = "Address saved"; 
		header('location: index.php');
	}

// ...
	if (isset($_POST['update'])) {
		if (!isset($_GET['edit'])){
			echo "edit is not set";
		}

		$name = $_POST['name'];
		$address = $_POST['address'];
		print_r(array($id,$name,$address));

		// Perform a query, check for error
		if (!$db -> query("UPDATE info SET name='$name', address='$address' WHERE id='$id'; ")) {
			echo("Error description: " . $db -> error);
		}else{
			echo "true";
		}
		// $_SESSION['message'] = "Address updated!"; 
		// header('location: index.php');
	}
	
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['message'] = "Address deleted!"; 
		header('location: index.php');
	}