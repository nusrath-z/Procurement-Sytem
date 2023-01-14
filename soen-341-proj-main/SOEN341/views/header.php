<?php
	session_start();
?>

<!DOCTYPE html>
	<html lang="en" dir="ltr">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	
	<head>
		<meta charset="utf-8">
		<title>SOEN 341 PROJECT</title>
	</head>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<div class="container-fluid p-3">

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<a class="navbar-brand" href="#"><img src="img/Owl.png" style="width:40px;" class="rounded-pill"></a>
					<li><a href="home.php" class="nav-link">Home</a></li>
					<li><a href="market.php" class="nav-link">Market</a></li>
					<?php if(isset($_SESSION['userID'])):?>
						<li><a href='index.php' class='nav-link'>Main Page</a></li>
						<li><a href='inbox.php' class='nav-link'>Inbox</a></li>
						<li><a href="profile.php" class="nav-link">Account</a></li>
						<li><a href='includes/logout.inc.php' class='nav-link'>Log out</a></li>
					<?php endif; if(!isset($_SESSION['userID'])): ?>
						<li><a href="account.php" class="nav-link">Account</a></li>
						<li><a href='account.php' class='nav-link'>Log in</a></li>
						<li><a href='account.php?error=!' class='nav-link'>Sign up</a></li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</nav>	
	
	

</html>