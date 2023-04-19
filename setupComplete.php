<?php
session_start();

if (isset($_SESSION['register'], $_SESSION['admin'], $_SESSION['login'])) {
    $register = $_SESSION['register'];
    $admin = $_SESSION['admin'];
    $login = $_SESSION['login'];

   
    // Unset session variables after displaying the content
    unset($_SESSION['register']);
    unset($_SESSION['admin']);
    unset($_SESSION['login']);
} else {
    header("Location: setup.php");
    exit();
}

// $register = "https://takeactionreviews.com/myPromptSaaSTest/register.php";
// $login = "https://takeactionreviews.com/myPromptSaaSTest/login.php";
// $admin = "https://takeactionreviews.com/myPromptSaaSTest/admin.php";

?>

<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App Setup Complete - AI Author X - Admin Dashboard by ToolkitsForSuccess.com</title>

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
          <a href="setup.php" class="has-icon">
            <span class="icon"><i class="mdi mdi-view-list"></i></span>
            <span class="menu-item-label">Setup</span>
          </a>
        </li>
        <li>
          <a href="profile.html" class="is-active has-icon">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            <span class="menu-item-label">Setup Complete</span>
          </a>
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
          <a href="https://toolkitsforsuccess.com" class="has-icon">
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
            <li>Setup Complete</li>
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
            Congratulations! Your SaaS is ready for users!
          </h1></div>
        </div>
        <div class="level-right" style="display: none;">
          <div class="level-item"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section is-main-section">
    <div class="tile is-ancestor">
      <!-- Create User Account Card -->
      <div class="tile is-parent">
        <div class="card tile is-child" style="width: 480px;">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
              Create User Account
            </p>
          </header>
          <div class="card-content">
            <div class="field is-horizontal">
                <div class="field-label is-normal"><label class="label">First User</label></div>
                <div class="field-body">
                  <div class="field">
                    <div class="field file">
                        <a class="button is-primary" href="<?php echo $register; ?>">
                          <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                          <span>Create Account</span>
                        </a>
                    </div>
                    <p class="is-size-7">
                        <a href="<?php echo $register; ?>"><?php echo $register; ?></a>
                    </p>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Login As User Card -->
      <div class="tile is-parent">
        <div class="card tile is-child" style="width: 480px;">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account default"></i></span>
              Login As User
            </p>
          </header>
          <div class="card-content">
            <div class="field is-horizontal">
              <div class="field-label is-normal"><label class="label">Login User</label></div>
                <div class="field-body">
                  <div class="field">
                    <div class="field file">
                      <a class="button is-primary">
                        <span class="icon"><i class="mdi mdi-login default"></i></span>
                        <span>Login</span>
                      </a>
                    </div>
                    <p class="is-size-7">
                      <a href="<?php echo $login; ?>"><?php echo $login; ?></a>
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <div class="tile is-ancestor">
    <!-- Login As Admin Card -->
      <div class="tile is-parent">
        <div class="card tile is-child" style="width: 480px;">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple default"></i></span>
              Login As Admin
            </p>
          </header>
          <div class="card-content">
            <div class="field is-horizontal">
              <div class="field-label is-normal"><label class="label">Login Admin</label></div>
                <div class="field-body">
                  <div class="field">
                    <div class="field file">
                      <a class="button is-primary">
                        <span class="icon"><i class="mdi mdi-login default"></i></span>
                        <span>Login</span>
                      </a>
                    </div>
                    <p class="is-size-7">
                      <a href="<?php echo $admin; ?>"><?php echo $admin; ?></a>
                    </p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- Blank Card -->
      <div class="tile is-parent">
        <div class="card tile is-child" style="width: 480px; visibility: hidden;">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple default"></i></span>
              Login As Admin
            </p>
          </header>
          <div class="card-content">
            <div class="field is-horizontal">
              <div class="field-label is-normal"><label class="label">Login Admin</label></div>
                <div class="field-body">
                  <div class="field">
                    <div class="field file">
                      <a class="button is-primary">
                        <span class="icon"><i class="mdi mdi-login default"></i></span>
                        <span>Login</span>
                      </a>
                    </div>
                    <p class="is-size-7">
                      <a href="<?php echo $admin; ?>"><?php echo $admin; ?></a>
                    </p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
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
</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>
