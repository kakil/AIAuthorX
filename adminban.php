<?php
require_once("config.php");
require_once("user/user-lib.php");
if (!isset($_SESSION["adminuser"])){
	header("location:adminlogin.php");
}
$userid=$_POST['id'];
$banmode=$_POST['banmode'];
$USR->ban($userid,$banmode);
?>