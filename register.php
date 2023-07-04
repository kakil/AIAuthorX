<?php

  // Load environment variables
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  // Access environment variables
  $apiKey = $_ENV['PRODUCTDYNO_API_KEY'];
  $licenseVerifyURL = $_ENV['PRODUCTDYNO_ACTIVATE_LICENSE_URL'];

  // Check for cart system payment here and redirect if not applicable

  session_start();
  if (isset($_POST["email"]) && trim($_POST["password"]) != "" && trim($_POST["name"] != "")) {
      require_once "user/user-lib.php";
      $isusr = $USR->get($_POST["email"]);
      if (!is_array($isusr)) {
        
          // Verify the license
          $licenseKey = $_POST["license"];
          //$apiKey = "b3b3b6db9e0ad0f88588abbb5779f16c"; // Replace with your actual API key
          $guid = "pagepilotpro.com"; // Replace with the user's GUID
          //$licenseVerifyURL = "https://app.productdyno.com/api/v1/licenses/activate";

          $requestData = [
              "_api_key" => $apiKey,
              "license_key" => $licenseKey,
              "guid" => $guid
          ];

          // Send a POST request to verify the license
          $ch = curl_init($licenseVerifyURL);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
          $response = curl_exec($ch);
          curl_close($ch);

          $responseData = json_decode($response, true);
          //var_dump('Response Data', $responseData);
          if (isset($responseData["license_key"]) && isset($responseData["activated_at"])) {

              // License verified, save the user details
              $USR->save(trim($_POST["name"]), trim($_POST["email"]), trim($_POST["password"]), trim($_POST["license"]));
              // Save the license to the database
              $licenseKey = $responseData["license_key"];
              $USR->saveapi($licenseKey, $_POST["email"]);

              // store license in session
              $_SESSION["license_key"] = $licenseKey;

              header("Location: login.php?new=1");
          } else {
              // License verification failed
              //var_dump('Failed');
              $invalidLicenseKey = true;

          }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <label class="label">License Key</label>
                <div class="control">
                  <input class="input" type="text" name="license" placeholder="License Key" required>
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

      <script>
        <?php if (isset($invalidLicenseKey) && $invalidLicenseKey): ?>
          document.addEventListener("DOMContentLoaded", function() {
            showInvalidLicenseModal("Invalid License Key", "Please enter a valid license key.");
          });
        <?php endif; ?>

        function showInvalidLicenseModal(title, content) {
          // Hide the loader when the modal is created
          $('.loader-wrapper').css('display', 'none');

          var modal = document.createElement('div');
          modal.className = 'modal is-active';
          modal.innerHTML = `
            <div class="modal-background jb-modal-close"></div>
            <div class="modal-card">
              <header class="modal-card-head">
                <p class="modal-card-title">${title}</p>
                <button class="delete jb-modal-close" aria-label="close"></button>
              </header>
              <section class="modal-card-body">
                <p class="has-text-danger has-text-weight-bold">${content}</p>
              </section>
              <footer class="modal-card-foot">
                <button class="button jb-modal-close is-danger">Close</button>
              </footer>
            </div>
            <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
          `;

          document.body.appendChild(modal);

          Array.from(modal.getElementsByClassName('jb-modal-close')).forEach(function (el) {
            el.addEventListener('click', function (e) {
              e.currentTarget.closest('.modal').classList.remove('is-active');
              document.documentElement.classList.remove('is-clipped');
              document.body.removeChild(modal);
            });
          });
        }
      </script>
    </div>
  </body>
</html>