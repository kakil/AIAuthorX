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
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>
    <?php
    if (isset($_POST["username"])) { echo "<div id='notify' class='notification is-danger'>Invalid user/password</div>"; }
    ?>

    <section class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-half">
            <figure class="image has-text-centered">
              <img src="img/logo.png" style="max-width: 100%; height: auto;">
            </figure>

            <h2 class="title has-text-centered">ADMIN LOGIN</h2>

            <form id="login" method="post">
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
                  <input class="button is-primary" type="submit" value="Sign In">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
