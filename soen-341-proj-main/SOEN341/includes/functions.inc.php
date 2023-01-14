<?php

function emptyInputSignup($fName, $lName, $email, $pwd, $pwdRepeat){
	$result = false;
	if(empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($pwdRepeat)){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function emptyInputUpdate($fName, $lName){
	$result = false;
	if(empty($fName) || empty($lName)){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function invalidEmail($email){
	$result = false;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd, $pwdRepeat){
	$result = false;
	if($pwd !== $pwdRepeat){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function emailTaken($conn, $email){

	$sql = "SELECT * FROM user WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../account.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}else{
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);

}

function createUser($conn, $fName, $lName, $email, $role, $pwd){

	$sql = "INSERT INTO user (fName, lName, email, role, password) VALUES (?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../account.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, 'sssss', $fName, $lName, $email, $role, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("location: ../account.php?error=none");
	exit();
}

function updateUser($conn, $fName, $lName, $userID){

	$sql = "UPDATE user SET fName = '$fName', lName = '$lName' WHERE userID = '$userID';";

	mysqli_query($conn, $sql);

	$_SESSION['userFName'] = $fName;
	$_SESSION['userLName'] = $lName;

	header("location: ../profile.php?success=updateDataSuc");
	exit();
}

function emptyInputLogin($email, $pwd){
	$result = false;
	if(empty($email) || empty($pwd)){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function loginUser($conn, $identifier, $pwd){

	$emailTakenVar = emailTaken($conn, $identifier);

	if($emailTakenVar === false){
		header("location: ../account.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $emailTakenVar["password"];
	$checkpwd = password_verify($pwd, $pwdHashed);

	if($checkpwd === false){
		header("location: ../account.php?error=wrongpwd");
		exit();

	}else if($checkpwd === true){
		session_start();
		$_SESSION['userID'] = $emailTakenVar["userID"];
		$_SESSION['userFName'] = $emailTakenVar["fName"];
		$_SESSION['userLName'] = $emailTakenVar["lName"];
		$_SESSION['userEmail'] = $emailTakenVar["email"];
		$_SESSION['userRole'] = $emailTakenVar["role"];

		header("location: ../index.php");
		exit();
	}
}

function addRelationship($conn, $firstID, $secondID){

	$sql = "INSERT INTO relationship (superID, employeeID) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../account.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, 'ii', $firstID, $secondID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("location: ../profile.php?error=none");
	exit();
}

function emptyInputPWD($oldPWD, $newPWD, $confirmPWD){
	$result = false;
	if(empty($oldPWD) || empty($newPWD) || empty($confirmPWD)){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function oldPWDNoMatch($conn, $oldPWD, $userID){
	$result = true;

	$sql = "SELECT * FROM user WHERE userID = '$userID';";

	$queryResult = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($queryResult);

	$pwdHashed = $row["password"];

	$checkpwd = password_verify($oldPWD, $pwdHashed);

	if($checkpwd === true){
		$result = false;
	}

	return $result;
}

function updatePWD($conn, $pwd, $userID){

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	$sql = "UPDATE user SET password = '$hashedPwd' WHERE userID = '$userID';";

	mysqli_query($conn, $sql);

	header("location: ../profile.php?success=updatePWDSuc");
	exit();

}

?>