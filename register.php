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
<!DOCTYPE html>
<html>
  <head>
    <title>User Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>
    <?php
      if (isset($_POST["email"])) { echo "<div id='notify' class='notification is-danger'>Email exists or invalid password or Name not entered - please correct!</div>"; }
    ?>

	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
		<a class="navbar-item" href="https://toolkitsforsuccess.com">
			<img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="150" height="28">
		</a>
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
  </body>
</html>