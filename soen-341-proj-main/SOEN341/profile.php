<?php 
	include_once 'views/header.php';
	include_once 'includes/dbh.inc.php';

?>

<body style="background-image: url('./img/sb.jpg');
  background-repeat: no-repeat; background-size: 100% 100%; background-attachment: fixed;">
<div style="padding:2%">

	<form action="search.php" method="POST">
		<input type="text" name="search" placeholder="Search user...">
		<button type="submit" name="submit-search">Search</button>
	</form>
	
	<?php
		$sql = "SELECT * FROM user WHERE userID = {$_SESSION['userID']};";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if(isset($_GET['error'])){

			if($_GET['success'] == 'updateSuc'){
			echo "<p>Update successful!</p>";
	        echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
			}

		}

		echo "<Div>";
		echo "<h3>Your information</h3>";
		if($resultCheck > 0){
			
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> Your First Name: " . $row['fName'] . "</p><br>";
				echo "<p> Your Last Name: " . $row['lName'] . "</p><br>";
				echo "<p> Your email: " . $row['email'] . "</p><br>";
				echo "<p> Your role: " . $row['role'] . "</p><br>";
			}
			
			echo "<div>";
			echo '<a href="profileUpdate.php?updateID='.$_SESSION['userID'].'">Update your account</a><br>';
			echo '<a href="profilePasswordUpdate.php?updateID='.$_SESSION['userID'].'">Update your password</a>';
			echo "</div>";

			echo "</div><br><br><br>";
		}else{
			echo "<p> There was an error fetching your data! </p>";
		}
		echo "</div><br><br>";

	?>

	<?php
		$sql = "SELECT `user`.`userID`, `user`.`fName`, `user`.`lName`, `user`.`email` FROM `user` INNER JOIN `relationship` ON `user`.`userID` = `relationship`.`superID` WHERE `user`.`userID` != {$_SESSION['userID']};";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);


		echo "<Div>";
		echo "<h3>Your supervisors</h3>";
		if($resultCheck > 0){
			
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> Their First Name: " . $row['fName'] . "</p>";
				echo "<p> Their Last Name: " . $row['lName'] . "</p>";
				echo "<p> Their email: " . $row['email'] . "</p><br>";
			}
		}else{
			echo "<p> The query returned an empty result set (i.e. zero rows)! </p>";
		}
		echo "</div><br><br>";

	?>

	<?php
		$sql = "SELECT `user`.`userID`, `user`.`fName`, `user`.`lName`, `user`.`email` FROM `user` INNER JOIN `relationship` ON `user`.`userID` = `relationship`.`employeeID` WHERE `user`.`userID` != {$_SESSION['userID']};";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);


		echo "<Div>";
		echo "<h3>Your employees</h3>";
		if($resultCheck > 0){
			
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> Their First Name: " . $row['fName'] . "</p>";
				echo "<p> Their Last Name: " . $row['lName'] . "</p>";
				echo "<p> Their email: " . $row['email'] . "</p> <br>";
			}
		}else{
			echo "<p> The query returned an empty result set (i.e. zero rows)! </p>";
		}
		echo "</div><br><br>";

	?>
</div>
	
</body>

<?php
	include_once'views/footer.php';
?>