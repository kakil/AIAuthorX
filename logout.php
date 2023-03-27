<?php
	session_start();
	require_once("config.php");
	unset($_SESSION["user"]);
	header("Location: ".$logoutredirect);
?>