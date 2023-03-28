<?php

session_start();
if (isset($_POST["email"])) {
  require "user-lib.php";
  $USR->login($_POST["email"], $_POST["password"]);
}


if (isset($_SESSION["user"])) {
	header("Location: index.php");
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
    <section class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-one-third">
            <?php
            if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger'>Invalid user/password</div>"; }
            ?>
            <form id="login" method="post">
              <h2 class="title has-text-centered">MEMBER LOGIN</h2>
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