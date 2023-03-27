<?php

session_start();
if (isset($_POST["email"])) {
  require "user/user-lib.php";
  $USR->login($_POST["email"], $_POST["password"]);
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
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
    if (isset($_POST["email"])) { echo "<div id='notify'>Invalid user/password</div>"; }
    ?>


    <form id="login" method="post">
		<img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
		<div style="text-align:center; margin-top:10px;"><h2 >MEMBER LOGIN</h2></div>
		<input type="email" name="email" placeholder="Email" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="submit" value="Sign In">
		<div style="text-align:center; margin-top:10px;"><a href="forgotpassword.php">Forgot Password</a></div>
    </form>
  </body>
</html>