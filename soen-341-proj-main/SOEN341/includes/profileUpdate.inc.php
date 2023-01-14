<?php 

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

if(isset($_POST["submit"])){

	$updateID = $_GET['updateID'];
	
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];

	if(emptyInputUpdate($fName, $lName) !== false){
		header("location: ../profileUpdate.php?error=emptyinput");
		exit();
	}

	updateUser($conn, $fName, $lName, $updateID);

}else{
	header("location: ../account.php");
	exit();
}

?>