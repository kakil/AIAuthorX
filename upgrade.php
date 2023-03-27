<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$path = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
$urlhere = $protocol . '://' . $domain . $path . '/';

if (isset($_POST["adminuser"])) {
extract($_POST);
require_once("config.php");

$user_db_host=USER_DB_HOST;
$user_db_name=USER_DB_NAME;
$user_db_user=USER_DB_USER;
$user_db_password=USER_DB_PASSWORD;

$configout=<<<EOT
<?php
\$sitename="$sitename";
\$logo="img/logo.png";
\$runbutton=$runbutton; 
\$masterkeymode=$masterkeymode;
\$masterapikey="$masterapikey";
\$logoutredirect="$logoutredirect";
\$adminuser="$adminuser";
\$adminpassword="$adminpassword";
\$footer=<<<EOTFOOTER
$footer
EOTFOOTER;

define("USER_DB_HOST", "$user_db_host");
define("USER_DB_NAME", "$user_db_name");
define("USER_DB_CHARSET", "utf8mb4");
define("USER_DB_USER", "$user_db_user");
define("USER_DB_PASSWORD", "$user_db_password");
?>
EOT;

file_put_contents("config.php",$configout);
$register=$urlhere."register.php";
	$admin=$urlhere."admin.php";
	$login=$urlhere."login.php";
	echo ('<div style="font-family:Sans-Serif; border:2px solid #444; background:#EEE; width:400px; padding:20px; margin:0 auto; border-radius:5px; margin-top:100px;">Congratulations! Your software has been upgraded!<br><br>You can create your first user account here : <a href="'.$register.'">'.$register.'</a><br><br>You can login as a user here : <a href="'.$login.'">'.$login.'</a><br><br>You can login to the admin interface here : <a href="'.$admin.'">'.$admin.'</a><br><br></div>');
	unlink("setup.php");
	unlink("upgrade.php");
	exit();
	
}


?>
<!doctype HTML>
<html>
<head>
<title></title>
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
  box-sizing: border-box;
  color: #6f6f6f;
  font-size:14px;
}


#notify {
  background: #ffd9e3;
  padding: 10px;
  margin-bottom: 10px;
}


#setup {
  max-width: 900px;
  border: 1px solid #ddd;
  background: #f2f2f2;
  margin: 0 auto;
  padding: 20px;
}
#setup h2 {
  color: #6f6f6f;
  padding: 0;
  margin: 0 0 10px 0;
}
#setup label, #setup input, #setup textarea, #setup select {
  width: 100%;
  margin: 10px 0;
}
#setup input, #setup textarea, #setup select {
  padding: 10px;
}
#setup input[type=submit] {
  background: #4f69db;
  color: #fff;
  border: 0;
}
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


    <form id="setup" method="post">
		
		<div style="text-align:center; margin-top:10px;"><h2 style="font-size:18px" >UPGRADE - Please answer the following questions and press GO.</h2></div>
		<br>
		
		Admin Username
		<input type="text" name="adminuser" value="admin">
		Admin Password
		<input type="text" name="adminpassword" value="">
		
		<input type="submit" value="Go">
    </form>
<script>
</script>
</body>
</html>
