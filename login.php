<?php

session_start();
if (isset($_POST["email"])) {
  require "user/user-lib.php";
  $USR->login($_POST["email"], $_POST["password"]);
}


if (isset($_SESSION["user"])) {
	header("Location: awesomeprompts.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <!-- Bulma is included -->
    <link rel="stylesheet" href="css/main.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">    
  </head>
  <body>
    <div id="app">
      <nav id="navbar-main" class="navbar is-fixed-top is-dark">
        <div class="navbar-brand">
          <a class="navbar-item" href="https://toolkitsforsuccess.com">
            <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
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
      <section class="section">
      <?php
        if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger  has-text-centered'>Invalid user/password</div>"; }
      ?>
    
        <div class="container mt-5">
          <div class="columns is-centered">
            <div class="column is-4">
              <form id="login" method="post">
                <div class="logo-container">
                  <figure class="image mb-5 has-text-centered">
                    <img class="logo-image" src="img/logo.png" width="300" height="60">
                  </figure>
                </div>
                <h2 class="title is-4 has-text-centered">MEMBER LOGIN</h2>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input class="input" type="email" name="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Password</label>
                  <div class="control">
                    <input class="input" type="password" name="password" placeholder="Password" required>
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <input class="button is-link is-fullwidth" type="submit" value="Sign In">
                  </div>
                </div>
                <div class="has-text-centered">
                  <a href="forgotpassword.php">Forgot Password</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div> <!-- END OF APP -->
  </body>
</html>