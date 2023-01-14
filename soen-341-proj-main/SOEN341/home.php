<?php 
	include_once 'views/header.php';
?>


<link rel="stylesheet" href="./css/home.css">

<body>
    <div class="col-md-12 blue-text text-center">
        <div class = "centered">
            <h3 class="display-3 font-weight-bold white-text mb-0 pt-md-5 pt-5">Procurement System</h3>
            <hr class="hr-light my-2 w-100">
            <h4 class="subtext-header mt-2 mb-4">Purchase and Manage Easily With Us</h4>
            <?php if(isset($_SESSION['userID'])):?>
                <a href="index.php" role="button" class="Register btn btn-rounded btn-outline-dark">
                    Access Main Page
                </a>
            <?php endif;?>
            <?php if(!isset($_SESSION['userID'])):?>
                <a href="account.php?error=!" role="button" class="Register btn btn-rounded btn-outline-dark">
                    Register Now
                </a>
                <a href="account.php" role="button" class="mx-4 Register btn btn-rounded btn-outline-dark">
                    Sign in
                </a>
            <?php endif;?>

                
		</div>

    </div>
	
</body>


	