<?php

session_start();

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
  `license_key` varchar(255) NOT NULL,
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

$configout = <<<EOT
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

file_put_contents("config.php", $configout);
$register = $urlhere . "register.php";
$admin = $urlhere . "admin.php";
$login = $urlhere . "login.php";

$_SESSION['register'] = $register;
$_SESSION['admin'] = $admin;
$_SESSION['login'] = $login;

unlink("setup.php");
unlink("upgrade.php");

header("Location: setupComplete.php");
exit();

}

?>

<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App Setup - AI Author X - Admin Dashboard by ToolkitsForSuccess.com</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
  <nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
        <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
      </a>
    </div>
    <div class="navbar-brand is-right">
      <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
        <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
      </a>
    </div>
    <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
      <div class="navbar-end">
        <a href="https://toolkitsforsuccess.com" title="About" class="navbar-item has-divider is-desktop-icon-only">
          <span class="icon"><i class="mdi mdi-help-circle-outline"></i></span>
          <span>About</span>
        </a>
      </div>
    </div>
  </nav>
  <aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div class="aside-tools-label">
        <a class="navbar-item" href="https://toolkitsforsuccess.com">
            <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
        </a>
      </div>
    </div>
    <div class="menu is-menu-main">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li>
          <a href="index.html" class="has-icon">
            <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
      </ul>
      <p class="menu-label">Examples</p>
      <ul class="menu-list">
        <li>
          <a href="tables.html" class="has-icon">
            <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
            <span class="menu-item-label">Tables</span>
          </a>
        </li>
        <li>
          <a href="forms.html" class="is-active has-icon">
            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
            <span class="menu-item-label">Setup</span>
          </a>
        </li>
        <li>
          <a href="profile.html" class="has-icon">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            <span class="menu-item-label">Profile</span>
          </a>
        </li>
        <li>
          <a class="has-icon has-dropdown-icon">
            <span class="icon"><i class="mdi mdi-view-list"></i></span>
            <span class="menu-item-label">Submenus</span>
            <div class="dropdown-icon">
              <span class="icon"><i class="mdi mdi-plus"></i></span>
            </div>
          </a>
          <ul>
            <li>
              <a href="#void">
                <span>Sub-item One</span>
              </a>
            </li>
            <li>
              <a href="#void">
                <span>Sub-item Two</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="menu-label">About</p>
      <ul class="menu-list">
        <li>
          <a href="https://toolkitsforsuccess.com" target="_blank" class="has-icon">
            <span class="icon"><i class="mdi mdi-github-circle"></i></span>
            <span class="menu-item-label">Toolkits For Success</span>
          </a>
        </li>
        <li>
          <a href="https://aiauthorx.com" class="has-icon">
            <span class="icon"><i class="mdi mdi-help-circle"></i></span>
            <span class="menu-item-label">About</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Admin</li>
            <li>Setup</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item"><h1 class="title">
            App Setup
          </h1></div>
        </div>
        <div class="level-right" style="display: none;">
          <div class="level-item"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section is-main-section">
    <form id="setup" method="post">
      <div class="card">
        <header class="card-header">
            <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-ballot"></i></span>
            Database Setup
            </p>
        </header>
        <div class="card-content">
            <!-- Database Host Name -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                <label class="label">Database Host (usually "localhost"):</label>
                </div>
                <div class="field-body">
                <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input class="input" type="text" name="user_db_host" value="localhost" required>
                        <span class="icon is-small is-left"><i class="mdi mdi-database"></i></span>
                    </p>
                </div>
                </div>
            </div>
            <!-- Database Name -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                <label class="label">Database Name:</label>
                </div>
                <div class="field-body">
                <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input class="input" type="text" name="user_db_name" placeholder="database_name" required>
                        <span class="icon is-small is-left"><i class="mdi mdi-database"></i></span>
                    </p>
                </div>
                </div>
            </div>
            <!-- Database User Name -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                <label class="label">Database User:</label>
                </div>
                <div class="field-body">
                <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input class="input" type="text" name="user_db_user" placeholder="database_user" required>
                        <span class="icon is-small is-left"><i class="mdi mdi-account"></i></span>
                    </p>
                </div>
                </div>
            </div>
            <!-- Database Password -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                <label class="label">Database Password:</label>
                </div>
                <div class="field-body">
                <div class="field">
                    <p class="control is-expanded has-icons-left">
                        <input class="input" type="password" name="user_db_password" placeholder="database_password" required>
                        <span class="icon is-small is-left"><i class="mdi mdi-textbox-password"></i></span>
                    </p>
                </div>
                </div>
            </div>
        
        </div>
      </div>
      <div class="card">
          <header class="card-header">
              <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-ballot-outline default"></i></span>
              Website Setup
              </p>
          </header>
          <div class="card-content">
              <!-- Site Name -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">Site Name:</label>
                  </div>
                  <div class="field-body">
                      <div class="field">
                      <p class="control is-expanded has-icons-left">
                          <input class="input" type="text" name="sitename" pattern="[a-zA-Z0-9 ]+" placeholder="Your Site Name">
                          <span class="icon is-small is-left">
                          <i class="mdi mdi-web"></i>
                          </span>
                      </p>
                      <p class="help">(Site Name for your title tag - Letters/Numbers only)</p>
                      </div>
                  </div>
              </div>
              <!-- Logout Redirect Link -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">Logout Redirect Link:</label>
                  </div>
                  <div class="field-body">
                      <div class="field">
                      <p class="control is-expanded has-icons-left">
                      <input class="input" type="text" name="logoutredirect" value="login.php">
                          <span class="icon is-small is-left">
                          <i class="mdi mdi-link-variant"></i>
                          </span>
                      </p>
                      <p class="help">(Link to go to when user logs out - leave at login.php if you want to return to login screen)</p>
                      </div>
                  </div>
              </div>
              <!-- Admin User Name -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                  <label class="label">Admin Username:</label>
                  </div>
                  <div class="field-body">
                  <div class="field">
                      <p class="control is-expanded has-icons-left">
                      <input class="input" type="text" name="adminuser" value="admin">
                          <span class="icon is-small is-left"><i class="mdi mdi-account"></i></span>
                      </p>
                  </div>
                  </div>
              </div>
              <!-- Admin Password -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                  <label class="label">Admin Password:</label>
                  </div>
                  <div class="field-body">
                  <div class="field">
                      <p class="control is-expanded has-icons-left">
                      <input class="input" type="password" name="adminpassword" value="">
                          <span class="icon is-small is-left"><i class="mdi mdi-textbox-password"></i></span>
                      </p>
                  </div>
                  </div>
              </div>
              <!-- Footer HTML -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">Footer HTML </label>
                  </div>
                  <div class="field-body">
                      <div class="field">
                      <div class="control">
                          <textarea class="textarea" name="footerhtml">
                          <footer class="footer">
                            <div class="container-fluid">
                              <div class="level">
                                <div class="level-left">
                                  <div class="level-item">
                                    © 2023, YourWebsiteHERE.com
                                  </div>
                                  <div class="level-item">
                                    <a href="https://toolkitsforsuccess.com" style="height: 20px">
                                      <img src="https://img.shields.io/badge/release-v1.0.0-lightgrey">
                                    </a>
                                  </div>
                                </div>
                                <div class="level-right">
                                  <div class="level-item">
                                    <div>
                                     For Support Help - 
                                      <p class="supportInfo has-text-weight-bold has-text-link">
                                        <a href="https://YourSupportLinkHERE.com">CLICK HERE</a>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </footer>
                          </textarea>
                          <p class="help has-text-info is-italic">(HTML for your footer - edit the footer with your website or company name and support links)</p>
                      </div>
                      </div>
                  </div>
              </div>
              <hr/>
              <!-- Prompt Button Toggle -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">Show the "Run Prompt" button:</label>
                  </div>
                  <div class="field-body">
                      <div class="field is-narrow">
                          <div class="control">
                              <div class="select">
                                  <select name="runbutton" required>
                                      <option value="true" selected="selected">Yes</option>
                                      <option value="false">No</option>
                                  </select>
                              </div>
                          </div>
                          <p class="help">(Select No to disable connections to OpenAI)</p>
                      </div>
                  </div>
              </div>
              
              <!-- OpenAI Button Toggle -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">Use My OpenAI API Key:</label>
                  </div>
                  <div class="field-body">
                      <div class="field is-narrow">
                          <div class="control">
                              <div class="select">
                                  <select name="masterkeymode" required>
                                      <option value="true" selected="selected">Yes</option>
                                      <option value="false">No</option>
                                  </select>
                              </div>
                          </div>
                          <p class="help">(select "No" to make end user enter their own key - recommended)</p>
                      </div>
                  </div>
              </div>
              <!-- OpenAI API Key -->
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                      <label class="label">OpenAI API Key:</label>
                  </div>
                  <div class="field-body">
                      <div class="field">
                      <p class="control is-expanded has-icons-left">
                      <input class="input" type="text" name="masterapikey" placeholder="Your API Key">
                          <span class="icon is-small is-left">
                          <i class="mdi mdi-link-variant"></i>
                          </span>
                      </p>
                      <p class="help">(Enter your key here only if you don't want individual use API keys)</p>
                      </div>
                  </div>
              </div>
              <hr>
              <!-- Form Submit/Reset Buttons -->
              <div class="field is-horizontal">
                  <div class="field-label">
                  <!-- Left empty for spacing -->
                  </div>
                  <div class="field-body">
                  <div class="field">
                      <div class="field is-grouped">
                      <div class="control">
                          <button type="submit" class="button is-primary">
                          <span>Submit</span>
                          </button>
                      </div>
                      <div class="control">
                          <button type="button" class="button is-primary is-outlined">
                          <span>Reset</span>
                          </button>
                      </div>
                      </div>
                  </div>
                  </div>
              </div>

          </div>
      </div>
    </form>
  </section>
  
  <footer class="footer">
    <div class="container-fluid">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            © 2023, ToolkitsForSuccess.com
          </div>
          <div class="level-item">
            <a href="https://toolkitsforsuccess.com" style="height: 20px">
              <img src="https://img.shields.io/badge/release-v1.0.0-lightgrey">
            </a>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <div class="logo">
              <a href="https://toolkitsforsuccess.com"><img src="img/ToolkitsForSuccess_logo.png" alt="ToolkitsForSuccess.com"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div id="sample-modal" class="modal">
    <div class="modal-background jb-modal-close"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Confirm action</p>
        <button class="delete jb-modal-close" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p>This will permanently delete <b>Some Object</b></p>
        <p>This is sample modal</p>
      </section>
      <footer class="modal-card-foot">
        <button class="button jb-modal-close">Cancel</button>
        <button class="button is-danger jb-modal-close">Delete</button>
      </footer>
    </div>
    <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
  </div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>

