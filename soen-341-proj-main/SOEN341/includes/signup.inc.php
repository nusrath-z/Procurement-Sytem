<?php 

if(isset($_POST["submit"])){
	
	$fName = $_POST["fName"];
	$lName = $_POST["lName"];
	$email = $_POST["email"];
	$role_bool = $_POST["role"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdRepeat"];
	$role = "client";

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if(emptyInputSignup($fName, $lName, $email, $pwd, $pwdRepeat) !== false){
		header("location: ../account.php?error=emptyinput");
		exit();
	}

	if(invalidEmail($email) != false){
		header("location: ../account.php?error=invalidemail");
		exit();
	}

	if(emailTaken($conn, $email) != false){
		header("location: ../account.php?error=emailistaken");
		exit();
	}

	if(pwdMatch($pwd, $pwdRepeat) != false){
		header("location: ../account.php?error=pwdnomatch");
		exit();
	}

	if($role_bool == true){
		$role = "supplier";
	}

	createUser($conn, $fName, $lName, $email, $role, $pwd);

}else{
	header("location: ../account.php");
	exit();
}

?>