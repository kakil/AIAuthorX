<?php
session_start();
if (isset($_POST["email"])) {
  require "user/user-lib.php";
  $USR->lostpassword($_POST["email"],$sitename);
}


if (isset($_SESSION["user"])) {
	header("Location: go.php");
	exit();
}

?>
<<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>
    <?php
      if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-info'>If your email was found then a new password has been emailed to you. Don't forget to check your SPAM folder.</div>"; }
    ?>

    <section class="section">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-4">
            <form id="login" method="post">
              <figure class="image">
                <img class="center" style="max-width:100%; height:auto;" src="img/logo.png">
              </figure>
              <h2 class="title is-4 has-text-centered">FORGOT PASSWORD</h2>
              <p class="has-text-centered has-text-grey">
                Enter your email below and press NEW PASSWORD and a new password will be emailed to you.
              </p>
              <div class="field">
                <label class="label">Email</label>
                <div class="control">
                  <input class="input" type="email" name="email" placeholder="Email" required>
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <input class="button is-link is-fullwidth" type="submit" value="NEW PASSWORD">
                </div>
              </div>
              <div class="has-text-centered">
                <a href="login.php">Return to Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
