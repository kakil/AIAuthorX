<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$path = pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
$urlhere = $protocol . '://' . $domain . $path . '/';

if (isset($_POST["user_db_name"])) {
extract($_POST);

define("USER_DB_HOST", "$user_db_host");
define("USER_DB_NAME", "$user_db_name");
define("USER_DB_CHARSET", "utf8mb4");
define("USER_DB_USER", "$user_db_user");
define("USER_DB_PASSWORD", "$user_db_password");



try {
     $db = new PDO("mysql:dbname=".USER_DB_NAME.";host=".USER_DB_HOST, USER_DB_USER, USER_DB_PASSWORD );
     $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
     $sql ="SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_creation` varchar(255) NOT NULL,
  `user_lastlogin` varchar(255) NOT NULL,
  `user_logins` bigint(20) NOT NULL,
  `user_apikey` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
COMMIT;
" ;
     $db->exec($sql);
     

} catch(PDOException $e) {
    echo ("DATABASE ERROR!");
	die();
}

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
$footerhtml
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
	echo ('<div style="font-family:Sans-Serif; border:2px solid #444; background:#EEE; width:400px; padding:20px; margin:0 auto; border-radius:5px; margin-top:100px;">Congratulations! Your software is ready to use!<br><br>You can create your first user account here : <a href="'.$register.'">'.$register.'</a><br><br>You can login as a user here : <a href="'.$login.'">'.$login.'</a><br><br>You can login to the admin interface here : <a href="'.$admin.'">'.$admin.'</a><br><br></div>');
	unlink("setup.php");
	unlink("upgrade.php");
	exit();
	
}


?>
<!doctype HTML>
<html>
<head>
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <?php
      if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger'>Invalid user/password</div>"; }
      ?>
      <form id="setup" method="post">
        <h2 class="title is-4 has-text-centered">Setup - Please answer the following questions and press GO.</h2>
        <div class="field">
          <label class="label">Database Host (usually "localhost"):</label>
          <div class="control">
            <input class="input" type="text" name="user_db_host" value="localhost" required>
          </div>
        </div>
        <div class="field">
          <label class="label">Database Name:</label>
          <div class="control">
            <input class="input" type="text" name="user_db_name" placeholder="database_name" required>
          </div>
        </div>
        <div class="field">
          <label class="label">Database User:</label>
          <div class="control">
            <input class="input" type="text" name="user_db_user" placeholder="database_user" required>
          </div>
        </div>
        <div class="field">
          <label class="label">Database Password:</label>
          <div class="control">
            <input class="input" type="text" name="user_db_password" placeholder="database_password" required>
          </div>
        </div>
        <div class="field">
          <label class="label">Site Name (Site Name for your title tag - Letters/Numbers only):</label>
          <div class="control">
            <input class="input" type="text" name="sitename" pattern="[a-zA-Z0-9 ]+" placeholder="Your Site Name">
          </div>
        </div>
        <div class="field">
          <label class="label">Logout Redirect (Link to go to when user logs out - leave at login.php if you want to return to login screen):</label>
          <div class="control">
            <input class="input" type="text" name="logoutredirect" value="login.php">
          </div>
        </div>
        <div class="field">
          <label class="label">Admin Username:</label>
          <div class="control">
            <input class="input" type="text" name="adminuser" value="admin">
          </div>
        </div>
        <div class="field">
          <label class="label">Admin Password:</label>
          <div class="control">
            <input class="input" type="text" name="adminpassword" value="">
          </div>
        </div>
        <div class="field">
          <label class="label">Footer HTML (HTML for your footer - feel free to modify the example below):</label>
          <div class="control">
            <textarea class="textarea" name="footerhtml">
              <br>
              <br>
              <br>
              <hr>
              <div style="color:#777; font:size:14px; display:block; float:left;">(C)2023 Your Software Name - For terms click 
                <a href="terms.php" target="_BLANK">HERE</a>
              </div>
              <div style="color:#777; float:right">Click 
                <a href="https://supportlink.com">HERE</a> for support
              </div>
              <br>
              <hr>
            </textarea>
          </div>
        </div>
        <div class="field">
          <label class="label">Show the "Run Prompt" button (Select No to disable connections to OpenAI):</label>
          <div class="control">
            <div class="select">
              <select name="runbutton" required>
<option value="true" selected="selected">Yes</option>
<option value="false">No</option>
</select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">Use My OpenAI API Key (select "No" to make end user enter their own key - recommended):</label>
          <div class="control">
            <div class="select">
              <select name="masterkeymode" required>
                <option value="true">Yes</option>
                <option value="false" selected="selected">No</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">OpenAI Key (Enter your key here only if you don't want individual use API keys):</label>
          <div class="control">
            <input class="input" type="text" name="masterapikey" placeholder="Your API Key">
          </div>
        </div>
        <div class="field">
          <div class="control">
            <input class="button is-primary" type="submit" value="Go">
          </div>
        </div>
      </form>
    </div>

  </section>
</body>
</html>
