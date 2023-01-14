<?php

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

if(isset($_POST['submit'])){

	$updateID = $_GET['updateID'];
	
	$oldPWD = $_POST["oldpwd"];
	$newPWD = $_POST["pwd"];
	$confirmPWD = $_POST["pwdRepeat"];

	if(emptyInputPWD($oldPWD, $newPWD, $confirmPWD) !== false){
		header("location: ../profilePasswordUpdate.php?error=emptyinput");
		exit();
	}

	if(oldPWDNoMatch($conn, $oldPWD, $updateID) !== false){
	 	header("location: ../profilePasswordUpdate.php?error=oldPWDNoMatch");
	 	exit();
	}

	if(pwdMatch($newPWD, $confirmPWD) !== false){
		header("location: ../profilePasswordUpdate.php?error=pwdnomatch");
		exit();
	}

	updatePWD($conn, $newPWD, $updateID);

}else{
	header("location: ../account.php");
	exit();
}

?>