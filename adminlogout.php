<?php
	session_start();
	require_once("config.php");
	unset($_SESSION["adminuser"]);
	header("Location: adminlogin.php");
?>