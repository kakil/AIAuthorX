<?php
  $errorMessage = '';

  require_once __DIR__ . '/vendor/autoload.php';

  // Load environment variables
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  // Access environment variables
  $apiKey = $_ENV['PRODUCTDYNO_API_KEY'];
  $licenseCheckURL = $_ENV['PRODUCTDYNO_GET_LICENSE_URL'];
  $errorMessage = '';

  session_start();
  require_once "user/user-lib.php";

  function sendRequest($url, $params)
  {
      $url .= '?' . http_build_query($params); // Append parameters to the URL

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // No need to set CURLOPT_POST and CURLOPT_POSTFIELDS for GET request
      $response = curl_exec($ch);
      //echo "API Response: <pre>" . print_r($response, true) . "</pre>";
      curl_close($ch);
      return $response;
  }

  if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $licenseKeyValid = isset($_POST["licenseKeyValid"]) && $_POST["licenseKeyValid"] == '1';

    // Verify the username and password
    if ($USR->login($email, $password)) {
        // Username and password are valid
        $user = $USR->get($email);
        $licenseKey = $USR->getLicenseKey($user["user_id"]);

      if ($licenseKey) {
          // License key exists in the database
          // Verify the license using the API
          $params = [
              "_api_key" => $apiKey,
              "license_key" => $licenseKey
          ];

          // Send a POST request to verify the license
          $response = sendRequest($licenseCheckURL, $params);
          $responseData = json_decode($response, true);

          $licenseKey = $responseData["license_key"];
          $activated_at = $responseData["activated_at"];
          $guid = $responseData["guid"];

          if ($licenseKey 
            && $activated_at != '0000-00-00 00:00:00'
            && $guid != ''
          ) {
              // License is active, store the license key in the session
              $_SESSION["user"]["license_key"] = $licenseKey;
              $licenseKeyValid = true;
          } else {
              // Invalid license key or license not active
              $errorMessage = "Invalid license key or license not active.";
          }
      } else {
          // License key not found in the database
          $errorMessage = "License key not found.";
      }
    } else {
        // Invalid username or password
        $errorMessage = "Invalid username or password.";
    }
  }

  if (isset($_SESSION["user"]) && $licenseKeyValid) {
    $licenseKeyValid = false;
    // Both user and license are valid, proceed with login
    header("Location: pagepilotprompts.php");
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
      <!-- Error Message -->
      <section class="section">
        <?php if ($errorMessage !== '') : ?>
          <div id="notify" class="notification is-danger has-text-centered"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
      </section>
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