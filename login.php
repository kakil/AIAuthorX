<?php

session_start();
if (isset($_POST["email"])) {
  require "user/user-lib.php";
  $USR->login($_POST["email"], $_POST["password"]);
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>
    <?php
      if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger'>Invalid user/password</div>"; }
    ?>

	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand ml-6">
		<a class="navbar-item" href="https://toolkitsforsuccess.com">
			<img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
		</a>
		</div>
		<div class="navbar-end mr-6">
		<div class="navbar-item">
		
		</div>
		</div>
	</nav>
    <section class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-4">
            <form id="login" method="post">
              <figure class="image">
                <img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
              </figure>
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
  </body>
</html>