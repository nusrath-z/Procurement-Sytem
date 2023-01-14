<?php 
	include_once 'views/header.php';
?>

<?php
	echo '<form method="post" action="includes/profileUpdate.inc.php?updateID='.$_SESSION['userID'].'" >';
		echo  '<h1>Edit Profile</h1>';


	    
	    if(isset($_GET['error'])){

	      if($_GET['error'] == "emptyinput"){
	        echo "<p>Please fill in all fields!</p>";
	        echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
	      
	      //to have a redirect marker
	      } else if($_GET['error'] == "!"){
	        echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
	      }
	  }

	  echo "<input type='text' name='fName' value={$_SESSION["userFName"]} />";
	  echo "<input type='text' name='lName' value={$_SESSION["userLName"]} />";
	  

		echo '<button type="submit" name="submit">Edit Profile</button>';
	echo '</form>';
?>

<?php 
	include_once 'views/footer.php';
?>