<?php 
	include_once 'views/header.php';

	//guard to keep each role in their respective page
	if(isset($_SESSION['userRole'])){
		if (($_SESSION['userRole']) == "supplier"){
			header("location: ./supplier.php");
		} elseif (($_SESSION['userRole']) == "client"){
			header("location: ./client.php");	
		}
    
	}

?>

<link rel="stylesheet" type="text/css" href="./css/account.css" />

<body>
    <div class="container" id="container">
      
      <!-- Sign Up Container DIV-->
      <div class="form-container sign-up-container">

        <form action="includes/signup.inc.php" method="post">
          <h1>Create Account</h1>

            <!-- Error checker-->
            <?php
            if(isset($_GET['error'])){

              if($_GET['error'] == "emptyinput"){
                echo "<p>Please fill in all fields!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


              }else if($_GET['error'] == "invalidemail"){
                echo "<p>Please enter a valid email address!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


              }else if($_GET['error'] == "emailistaken"){
                echo "<p>This email address is already taken! Please choose another one!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


              }else if($_GET['error'] == "pwdnomatch"){
                echo "<p>Passwords do not match! Please enter your passwords again!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


              }else if($_GET['error'] == "stmtfailed"){
                echo "<p>Something went wrong, try again!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


              }else if($_GET['error'] == "none"){
                echo "<p>You have signed up!</p>";
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
              
              //to have a redirect marker
              } else if($_GET['error'] == "!"){
                echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
              }
          }
          ?>

          <!-- Sign Up Form-->
          <input type="text" name="fName" placeholder="First name" />
          <input type="text" name="lName" placeholder="Last name" />
          <input type="text" name="email" placeholder="Email" />
          <input type="password" name="pwd" placeholder="Password" />
          <input type="password" name="pwdRepeat" placeholder="Confirm password">
          <br> Are you a supplier? 
			    <input type="checkbox" name="role"><br>
          <button type="submit" name="submit">Sign up</button>
        </form>

      </div>

      <!-- Log In Container DIV-->
      <div class="form-container sign-in-container">
        <form action="includes/login.inc.php" method="post">
          <h1>Log In</h1>
          
          <!-- Error checker-->
          <?php
            if(isset($_GET['error'])){

              if($_GET['error'] == "emptylogininput"){
                echo "<p>Please fill in all fields!</p>";

              }else if($_GET['error'] == "wronglogin"){
                echo "<p>Please enter a valid email address!</p>";

              }else if($_GET['error'] == "wrongpwd"){
                echo "<p>Password is incorrect! Please enter your password again!</p>";

              }
            }
          ?>
          <!-- Log In Form-->
          <input type="email" name="email" placeholder="Email"/>
          <input type="password" name="pwd" placeholder="Password" />
          <a-mod href="#">Forgot Your Password?</a-mod>
          <button type="submit" name="submit">Log In</button>
        </form>
      </div>

    
      <!-- Sign Up Container Setup-->
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome!</h1>
            <p>Login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello!</h1>
            <p>Please enter your details here!</p>
            <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>

    </div>
          
    <!-- Js to monitor Panel -->
    <script type="text/javascript">
      const signUpButton = document.getElementById("signUp");
      const signInButton = document.getElementById("signIn");
      const container = document.getElementById("container");

      signUpButton.addEventListener("click", () => {
        container.classList.add("right-panel-active");
      });
      signInButton.addEventListener("click", () => {
        container.classList.remove("right-panel-active");
      });
    </script>

</body>
</html>

<?php 
	include_once 'views/footer.php'
?>
