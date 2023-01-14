<?php 

if(isset($_POST['submit'])){

	$identifier = $_POST['email'];
	$pwd = $_POST['pwd'];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if(emptyInputLogin($identifier, $pwd) !== false){
		header("location: ../account.php?error=emptylogininput");
		exit();
	}

	loginUser($conn, $identifier, $pwd);

}else{
	header("location: ../account.php?");
	exit();
}

?>