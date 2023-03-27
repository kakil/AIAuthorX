<?php
require_once("config.php");
session_start();
if (isset($_POST["username"]) && isset($_POST["password"])) {
	if ($_POST["username"]===$adminuser && $_POST["password"]===$adminpassword){
		$_SESSION["adminuser"] = [];
	}
}


if (isset($_SESSION["adminuser"])) {
	header("location:admin.php");
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
    if (isset($_POST["username"])) { echo "<div id='notify'>Invalid user/password</div>"; }
    ?>
    <form id="login" method="post">
		<img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
		<div style="text-align:center; margin-top:10px;"><h2 >ADMIN LOGIN</h2></div>
		<input type="username" name="username" placeholder="Username" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="submit" value="Sign In">
    </form>
  </body>
</html>