<?php 
  include_once 'views/header.php';
?>


<?php
  echo '<form method="post" action="includes/profileUpdatePassword.inc.php?updateID='.$_SESSION['userID'].'" >';
    echo '<h1>Update Password</h1>';

      
      if(isset($_GET['error'])){

        if($_GET['error'] == "emptyinput"){
          echo "<p>Please fill in all fields!</p>";
          echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


        }else if($_GET['error'] == "oldPWDNoMatch"){
          echo "<p>Old Password does not match! Please enter your old passwords again!</p>";
          echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";

        }else if($_GET['error'] == "pwdnomatch"){
        echo "<p>Passwords do not match! Please enter your passwords again!</p>";
        echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";


        }else if($_GET['error'] == "none"){
          echo "<p>You have signed up!</p>";
          echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
        
        //to have a redirect marker
        } else if($_GET['error'] == "!"){
          echo "<script type=\"text/javascript\"> container.classList.add(\"right-panel-active\"); </script>";
        }
    }
    

  echo  '<input type="password" name="oldpwd" placeholder="Old password" />';
  echo  '<input type="password" name="pwd" placeholder="New password" />';
  echo  '<input type="password" name="pwdRepeat" placeholder="Confirm new password">';
  echo  '<button type="submit" name="submit">Update password</button>';
  echo  '</form>';
?>