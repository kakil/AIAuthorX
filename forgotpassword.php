<?php
session_start();
if (isset($_POST["email"])) {
  require "user/user-lib.php";
  $USR->lostpassword($_POST["email"],$sitename);
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password Page</title>
    <link rel="stylesheet" href="css/login.css">
	<style>
	.center {
	  display: block;
	  margin-left: auto;
	  margin-right: auto;
	  width: 100%;
	}	
	</style>
  </head>
  <body>

    <?php
    if (isset($_POST["email"])) { echo "<div id='notify'>If your email was found then a new password has been emailed to you. Don't forget to check your SPAM folder.</div>"; }
    ?>


    <form id="login" method="post">
		<img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
		<div style="text-align:center; margin-top:10px;"><h2 >FORGOT PASSWORD</h2></div>
		<div style="text-align:center; margin-top:10px; color:#777;">Enter your email below and press NEW PASSWORD and a new password will be emailed to you.</div>
		<input type="email" name="email" placeholder="Email" required>
		
		<input type="submit" value="NEW PASSWORD">
		<div style="text-align:center; margin-top:10px;"><a href="login.php">Return to Login</a></div>
		
    </form>
  </body>
</html>