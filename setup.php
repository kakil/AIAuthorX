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
<title>App Setup</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<link rel="stylesheet" href="css/main.css">
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</head>
<body>
  <nav class="navbar is-dark custom-navbar-shadow" role="navigation" aria-label="main navigation">
		<div class="navbar-brand ml-6">
      <a class="navbar-item" href="https://toolkitsforsuccess.com">
        <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
      </a>
		</div>
	</nav>
  <div class="main-content columns is-fullheight">
      <aside class="column is-2 is-narrow-mobile is-fullheight section is-hidden-mobile">
        <p class="menu-label is-hidden-touch">Navigation</p>
        <ul class="menu-list">
          <li>
            <a href="#" class="">
              <span class="icon"><i class="fa fa-home"></i></span> Home
            </a>
          </li>
          <li>
            <a href="#" class="is-active">
              <span class="icon"><i class="fa fa-table"></i></span> Links
            </a>

            <ul>
              <li>
                <a href="#">
                  <span class="icon is-small"><i class="fa fa-link"></i></span> Link1
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="icon is-small"><i class="fa fa-link"></i></span> Link2
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="">
              <span class="icon"><i class="fa fa-info"></i></span> About
            </a>
          </li>
        </ul>
      </aside>
      <div class="container column is-8">
        <!-- Your existing content goes here -->
        <section class="section">
          <div class="container">
            <div>
              <h1 class="title is-3 mb-3 ">App Setup</h1>
            </div>
            <div>
              <h5 class="subtitle is-5 is-italic">Please answer the following questions and press SUBMIT.</h5>
            </div>
            <div>
              <p class="is-size-7 mt-3">Once you have completed the setup remove setup.php and store the file for safe keeping.</p>
            </div>
          </div> <!-- END CONTAINER -->
        </section>
        <!-- End Title Section -->
        <section class="section">
          <div class="container is-light">  
            <div class="columns">
              <div class="column is-half custom-column">
                <form id="setup" method="post">
                  <div class="has-text-centered title is-4">
                      Database Setup
                  </div>
                  <!-- Database Host -->
                  <div class="field mb-5">
                    <label class="label">Database Host (usually "localhost"):</label>
                    <div class="control">
                      <input class="input" type="text" name="user_db_host" value="localhost" required>
                    </div>
                  </div>
                  <!-- Database Name -->
                  <div class="field mb-5">
                    <label class="label">Database Name:</label>
                    <div class="control">
                      <input class="input" type="text" name="user_db_name" placeholder="database_name" required>
                    </div>
                  </div>
                  <!-- Database User -->
                  <div class="field mb-5">
                    <label class="label">Database User:</label>
                    <div class="control">
                      <input class="input" type="text" name="user_db_user" placeholder="database_user" required>
                    </div>
                  </div>
                  <!-- Database Password -->
                  <div class="field mb-5">
                    <label class="label">Database Password:</label>
                    <div class="control">
                      <input class="input" type="text" name="user_db_password" placeholder="database_password" required>
                    </div>
                  </div>
                  <div class="has-text-centered title is-4 mt-5">
                      Website Setup
                  </div>
                  <!-- Site Name -->
                  <div class="field mb-5">
                    <label class="label">Site Name (Site Name for your title tag - Letters/Numbers only):</label>
                    <div class="control">
                      <input class="input" type="text" name="sitename" pattern="[a-zA-Z0-9 ]+" placeholder="Your Site Name">
                    </div>
                  </div>
                  <!-- Logout Redirect Link Value -->
                  <div class="field mb-5">
                    <label class="label">Logout Redirect (Link to go to when user logs out - leave at login.php if you want to return to login screen):</label>
                    <div class="control">
                      <input class="input" type="text" name="logoutredirect" value="login.php">
                    </div>
                  </div>
                  <!-- Admin username value -->
                  <div class="field mb-5">
                    <label class="label">Admin Username:</label>
                    <div class="control">
                      <input class="input" type="text" name="adminuser" value="admin">
                    </div>
                  </div>
                  <!-- Admin password -->
                  <div class="field mb-5">
                    <label class="label">Admin Password:</label>
                    <div class="control">
                      <input class="input" type="text" name="adminpassword" value="">
                    </div>
                  </div>
                  <!-- Footer HTML -->
                  <div class="field mb-5">
                    <label class="label">Footer HTML:</label>
                    <div class="control">
                      <textarea class="textarea" name="footerhtml">
                      <footer class="footer">
                        <div class="content has-text-centered">
                          <div class="columns is-vcentered">
                            <div class="column is-half">
                              <p class="is-size-7 has-text-grey">(C)2023 Your Software Name - For terms click <a href="terms.php" target="_BLANK">HERE</a></p>
                            </div>
                            <div class="column is-half">
                              <p class="is-size-7 has-text-grey is-pulled-right">Click <a href="https://supportlink.com">HERE</a> for support</p>
                            </div>
                          </div>
                        </div>
                      </footer>
                      </textarea>
                    </div>
                  </div>
                  <!-- Prompt Button Toggle -->
                  <div class="field mb-5">
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

                  <!-- OpenAI Toggle -->
                  <div class="field mb-5">
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
                  <div class="field mb-5">
                    <label class="label">OpenAI Key (Enter your key here only if you don't want individual use API keys):</label>
                    <div class="control">
                      <input class="input" type="text" name="masterapikey" placeholder="Your API Key">
                    </div>
                  </div>
                  <!-- Add other fields here -->
                  
                  <!-- Submit Button -->
                  <div class="field mb-5">
                    <div class="control">
                      <button class="button is-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  
  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>AI Author X</strong> Made By <a href="https://toolkitsforsuccess.com">ToolkitsForSuccess</a> in Florida. © AkilDev LLC 2023 - All Rights Reserved.
      </p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

