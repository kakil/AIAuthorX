<?php

// Check for cart system payment here and redirect if not applicable

session_start();
if (isset($_POST["email"]) && trim($_POST["password"])!="" && trim($_POST["name"]!="")) {
	require_once "user/user-lib.php";
	$isusr=$USR->get($_POST["email"]);
	if (!is_array($isusr)) {  
		$USR->save(trim ($_POST["name"]), trim($_POST["email"]),trim($_POST["password"]));
		header("Location: login.php?new=1");
	} 
	
	
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>


<!doctype HTML>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo($sitename); ?></title>
    <!-- Bulma is included -->
    <link rel="stylesheet" href="css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> 
    <!-- <script src="admintable.js"></script> -->
  </head>
  <body>
    <div id="app">
      <nav id="navbar-main" class="navbar is-fixed-top is-dark">
        <div class="navbar-brand">
          <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
            <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
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
      </nav> <!-- END NAV -->
      <aside class="aside is-placed-left is-expanded">
        <div class="aside-tools">
          <div class="aside-tools-label mt-2">
            <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
          </div>
        </div>
        <div class="menu is-menu-main">
          <p class="menu-label">Admin</p>
          <ul class="menu-list">
            <li>
              <a href="admin.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                <span class="menu-item-label">User Admin</span>
              </a>
            </li>
            <li>
              <a href="register.php" class="has-icon is-active">
                <span class="icon has-update-mark"><i class="mdi mdi-account-edit"></i></span>
                <span class="menu-item-label">Create User Account</span>
              </a>
            </li>
            <li>
              <a href="login.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-login"></i></span>
                <span class="menu-item-label">User Login</span>
              </a>
            </li>
          </ul>
          <p class="menu-label">About</p>
          <ul class="menu-list">
            <li>
              <a href="https://toolkitsforsuccess.com" target="_blank" class="has-icon">
                <span class="icon"><i class="mdi mdi-web"></i></span>
                <span class="menu-item-label">Toolkits For Success</span>
              </a>
            </li>
            <li>
              <a href="https://toolkitsforsuccess.com" class="has-icon">
                <span class="icon"><i class="mdi mdi-help-circle"></i></span>
                <span class="menu-item-label">About</span>
              </a>
            </li>
            <hr>
            <li>
              <a href="adminlogout.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-logout"></i></span>
                <span class="menu-item-label">Logout Admin</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
      <section class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-4">
            <form id="login" method="post">
              <figure class="image">
                <img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
              </figure>
              <h2 class="title is-4 has-text-centered">CREATE YOUR ACCOUNT</h2>
              <div class="field">
                <label class="label">Your Name</label>
                <div class="control">
                  <input class="input" type="text" name="name" placeholder="Your Name" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control">
                  <input class="input" type="email" name="email" placeholder="Email" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Password</label>
                <div class="control">
                  <input class="input" type="password" name="password" placeholder="Password">
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <input class="button is-link is-fullwidth" type="submit" value="Create Account">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
   
    <footer class="footer">
		<div class="content has-text-centered">
			<p>
				<?php echo($footer); ?>
			</p>
		</div>
	</footer>

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  </body>
</html>