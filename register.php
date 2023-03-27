<?php

// Check for cart system payment here and redirect if not applicable

session_start();
if (isset($_POST["email"]) && trim($_POST["password"])!="" && trim($_POST["name"]!="")) {
	require_once "user/user-lib.php";
	$isusr=$USR->get($_POST["email"]);
	if (!is_array($isusr)) {  
		$USR->save(trim ($_POST["name"]), trim($_POST["email"]),trim($_POST["password"]));
		header("Location: login.php?new=1");
	} 
	
	
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Registration</title>
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
    if (isset($_POST["email"])) { echo "<div id='notify'>Email exists or invalid password or Name not entered - please correct!</div>"; }
    ?>
	<form id="login" method="post">
		<img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
		<div style="text-align:center; margin-top:10px;"><h2 >CREATE YOUR ACCOUNT</h2></div>
		<input type="name" name="name" placeholder="Your Name" required>
		<input type="email" name="email" placeholder="Email" required>
		<input type="password" name="password" placeholder="Password">
		<input type="submit" value="Create Account">
    </form>
  </body>
</html>