<?php 
	include_once 'views/header.php';
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
?>

<h1>Search results</h1>

<div>
<?php  
	if(isset($_POST['submit-search'])){
		$search = mysqli_real_escape_string($conn, $_POST['search']);
		$sql = "SELECT * FROM `user` WHERE fName LIKE '%$search%' OR lName LIKE '%$search%' OR email LIKE '%$search%';";


		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		if($queryResult > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<div>";
				echo "<p> User's  Name: " . $row['lName'] . "," . $row['fName'] . "</p>";
				echo "<p> User's email: " . $row['email'] . "</p>";
				echo "<p> Their role: " . $row['role'] . "</p>";

				$sqlRelationship = "SELECT * FROM relationship WHERE superID = {$_SESSION['userID']} AND employeeID = {$row['userID']} OR superID = {$row['userID']} AND employeeID = {$_SESSION['userID']}";

				$resultRelationship = mysqli_query($conn, $sqlRelationship);
				$queryResultRelationship = mysqli_num_rows($resultRelationship);

				if($queryResultRelationship > 0){

					echo "<div>";
					echo "<p>Relationship already exists with this user.</p>";
					echo "</div>";

				}else{

					echo '<form method="post" action="includes/search.inc.php?firstID='.$_SESSION['userID'].'&secondID='.$row['userID'].'">';
					echo '<button type="submit" name="addSuper">Add This user as an Employee</button>';
					echo '<button type="submit" name="addEmp">Add This user as a Supervisor</button>';
					echo '</form>';
				}

				echo "</div><br>";
			}
		}else{
			echo "There are no search results matching your search!";
		}
	}

?>

</div>