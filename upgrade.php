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
<title>Upgrade</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

    <?php
    if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger'>Invalid user/password</div>"; }
    ?>

  <nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="https://toolkitsforsuccess.com">
          <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="150" height="28">
        </a>
      </div>
    </nav>
    <section class="section">
        <div class="container">
            <h2 class="title has-text-centered">UPGRADE - Please answer the following questions and press GO.</h2>

            <form id="setup" method="post">
                <div class="field">
                    <label class="label">Admin Username</label>
                    <div class="control">
                        <input class="input" type="text" name="adminuser" value="admin">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Admin Password</label>
                    <div class="control">
                        <input class="input" type="text" name="adminpassword" value="">
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

