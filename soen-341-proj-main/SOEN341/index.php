<?php 
	include_once 'views/header.php';

	//guard to keep each role in their respective page
	if(isset($_SESSION['userRole'])){

		$role = $_SESSION['userRole'];

		if ($role == "supplier"){
			header("location: ./supplier.php");
		} elseif ($role == "client"){
			header("location: ./client.php");	
		}

	} else {

		header("location: ./home.php");
		
	}

	include_once 'views/footer.php'
?>