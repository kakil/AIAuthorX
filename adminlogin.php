<?php
require_once("config.php");
session_start();
if (isset($_POST["username"]) && isset($_POST["password"])) {
	if ($_POST["username"]===$adminuser && $_POST["password"]===$adminpassword){
		$_SESSION["adminuser"] = [];
	}
}


if (isset($_SESSION["adminuser"])) {
	header("location:admin.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login Page</title>
    <!-- Bulma is included -->
    <link rel="stylesheet" href="css/main.min.css">

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
          if (isset($_POST["username"])) { echo "<div id='notify' class='notification is-danger  has-text-centered'>Invalid user/password</div>"; }
        ?>
        <div class="container mt-5">
          <div class="columns is-centered">
            <div class="column is-4">
              <form id="login" method="post">
                <figure class="image has-text-centered">
                  <img src="img/logo.png" style="max-width: 100%; height: auto;">
                </figure>

                <h2 class="title is-4 has-text-centered">ADMIN LOGIN</h2>
                <div class="field">
                  <label class="label">Username</label>
                  <div class="control">
                    <input class="input" type="text" name="username" placeholder="Username" required>
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
              </form>
            </div>
          </div>
        </div>
      </section>    
    </div> <!-- END APP -->
  </body>
</html>
