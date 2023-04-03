<?php
session_start();
require_once("config.php");
if (!isset($_SESSION["adminuser"])){
	header("location:adminlogin.php");
}

$db = new PDO(
      "mysql:host=".USER_DB_HOST.";dbname=".USER_DB_NAME.";charset=".USER_DB_CHARSET,
      USER_DB_USER, USER_DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);


$st = $db->prepare("SELECT user_id,user_name,user_email,user_creation,user_logins,user_status FROM users");
$st->execute();
$user=[];
$results = $st->fetchAll();


foreach ($results as $key => $value) {

    $human_readable_date = date("Y-m-d", $value['user_creation']);
    $results[$key]['user_creation'] = $human_readable_date;
	if ($results[$key]['user_status']=="1") {
		$results[$key]['user_status']="OK";
		$results[$key]['Action'] = '<button type="button" class="button is-small is-danger" onclick="ban('.$results[$key]['user_id'].',0);">Ban</button>';
	} else {
		$results[$key]['user_status']="BAN";
		$results[$key]['Action'] = '<button type="button" class="button is-small is-success" onclick="ban('.$results[$key]['user_id'].',1);">Unban</button>';
	}
	
	

}



$results=replaceKeys("user_name","Name",$results);
$results=replaceKeys("user_id","ID",$results);
$results=replaceKeys("user_email","Email",$results);
$results=replaceKeys("user_creation","Created",$results);
$results=replaceKeys("user_logins","# Logins",$results);
$results=replaceKeys("user_status","Status",$results);

function replaceKeys($oldKey, $newKey, array $input){
    $return = array(); 
    foreach ($input as $key => $value) {
        if ($key===$oldKey)
            $key = $newKey;

        if (is_array($value))
            $value = replaceKeys( $oldKey, $newKey, $value);

        $return[$key] = $value;
    }
    return $return; 
}

?>
<!doctype HTML>
<html>
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
      </nav> <!-- END NAV -->
      <aside class="aside is-placed-left is-expanded">
        <div class="aside-tools">
          <div class="aside-tools-label">
            <a class="navbar-item" href="https://toolkitsforsuccess.com">
                <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
            </a>
          </div>
        </div>
        <div class="menu is-menu-main">
          <p class="menu-label">General</p>
          <ul class="menu-list">
            <li>
              <a href="index.html" class="has-icon">
                <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
                <span class="menu-item-label">Dashboard</span>
              </a>
            </li>
          </ul>
          <p class="menu-label">Examples</p>
          <ul class="menu-list">
            <li>
              <a href="tables.html" class="has-icon">
                <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
                <span class="menu-item-label">Tables</span>
              </a>
            </li>
            <li>
              <a href="forms.html" class="is-active has-icon">
                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                <span class="menu-item-label">Setup</span>
              </a>
            </li>
            <li>
              <a href="profile.html" class="has-icon">
                <span class="icon"><i class="mdi mdi-account-circle"></i></span>
                <span class="menu-item-label">Profile</span>
              </a>
            </li>
            <li>
              <a class="has-icon has-dropdown-icon">
                <span class="icon"><i class="mdi mdi-view-list"></i></span>
                <span class="menu-item-label">Submenus</span>
                <div class="dropdown-icon">
                  <span class="icon"><i class="mdi mdi-plus"></i></span>
                </div>
              </a>
              <ul>
                <li>
                  <a href="#void">
                    <span>Sub-item One</span>
                  </a>
                </li>
                <li>
                  <a href="#void">
                    <span>Sub-item Two</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <p class="menu-label">About</p>
          <ul class="menu-list">
            <li>
              <a href="https://toolkitsforsuccess.com" target="_blank" class="has-icon">
                <span class="icon"><i class="mdi mdi-github-circle"></i></span>
                <span class="menu-item-label">Toolkits For Success</span>
              </a>
            </li>
            <li>
              <a href="https://toolkitsforsuccess.com" class="has-icon">
                <span class="icon"><i class="mdi mdi-help-circle"></i></span>
                <span class="menu-item-label">About</span>
              </a>
            </li>
          </ul>
        </div>
      </aside> <!-- END SIDE MENU -->
      <section class="section is-title-bar">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <ul>
                <li>Admin</li>
                <li>Users</li>
              </ul>
            </div>
          </div>
        </div>
      </section> <!-- END TITLE BAR -->
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
            <div class="level-left">
              <div class="level-item"><h1 class="title">
                User Administration
              </h1></div>
            </div>
            <div class="level-right" style="display: none;">
              <div class="level-item"></div>
            </div>
          </div>
        </div>
      </section> <!-- END HERO BAR -->
      <section class="section is-main-section">
        <div class="card has-table">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Active Users
            </p>
            <a href="#" class="card-header-icon">
              <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
          </header> <!-- END TABLE HEADER -->
          <div class="card-content">
            <div class="b-table has-pagination">
              <div class="table-wrapper has-mobile-cards">
                <table class="table is-fullwidth is-striped is-hoverable is-fullwidth" id="user-table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created</th>
                      <th># Logins</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead> <!-- END THEAD -->
                  <tbody id="user-table-body"></tbody> <!-- END TBODY -->
                </table> <!-- END TABLE -->
              </div> <!-- END TABLE-WRAPPER HAS-MOBILE-CARDS -->
              <div class="notification">
                <div class="level">
                  <div class="level-left">
                    <div class="level-item">
                      <nav class="pagination" role="navigation" aria-label="pagination">
                        <ul class="pagination-list" id="pagination-list"></ul>
                      </nav>
                    </div>
                  </div>
                  <div class="level-right">
                    <div class="level-item">
                      <small>Page <span id="current-page"></span> of <span id="total-pages"></span></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- END OF CARD-CONTENT -->
        </div> <!-- END CARD HAS-TABLE -->
        <div class="container">
          <div class="columns is-centered">
            <div class="column is-12">
              <figure class="image has-text-centered">
                <img class="logo-image" style="width: 200px; height: auto;" src="<?php echo($logo); ?>">
              </figure>
              <h2 class="title has-text-centered">Admin Panel</h2>
            </div>
          </div>
          <div class="columns is-centered">
            <div class="column is-12">
              <div class="field has-addons">
                <label class="label">Search: </label>
                <div class="control">
                  <input class="input" type="text" onkeyup="filter(event)">
                </div>
              </div>
              <button type="button" class="button is-small" style="float: right; margin-bottom: 5px;" onclick="logout();">LOGOUT</button>

              <table id="user-table" class="table is-striped is-bordered" style="margin-top: 10px; width: 100%;">
                <thead>
                  <tr></tr>
                </thead>
                <tbody></tbody>
              </table>
              <div id="paginator"></div>
            </div>
          </div>
          <?php echo($footer); ?>
        </div>
      </section>
    </div> <!-- END App -->
  </body>
</html>

<script>
  window.onload = function() {
  setPage(1);
}

function logout() {
  window.location.assign('adminlogout.php');
}

function ban(id, banmode) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", 'adminban.php', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      location.reload();
    }
  }
  xhr.send("id=" + id + "&banmode=" + banmode);
}

const results = <?php echo json_encode($results); ?>;
const perPage = 2;
const totalItems = results.length;
const totalPages = Math.ceil(totalItems / perPage);

function displayTable(page) {
  const table = document.getElementById("user-table-body");
  const startIndex = (page - 1) * perPage;
  const endIndex = startIndex + perPage;
  const paginatedResults = results.slice(startIndex, endIndex);

  let html = "";
  for (const row of paginatedResults) {
    html += `<tr>
              <td>${row.ID}</td>
              <td>${row.Name}</td>
              <td>${row.Email}</td>
              <td>${row.Created}</td>
              <td>${row['# Logins']}</td>
              <td>${row.Status}</td>
              <td>${row.Action}</td>
            </tr>`;
  }
  table.innerHTML = html;
}

function displayPagination(page) {
  const paginationList = document.getElementById("pagination-list");
  let html = "";

  if (totalPages > 1) {
    let startPage, endPage;
    if (totalPages <= 5) {
      startPage = 1;
      endPage = totalPages;
    } else {
      if (page <= 3) {
        startPage = 1;
        endPage = 5;
      } else if (page + 1 >= totalPages) {
        startPage = totalPages - 4;
        endPage = totalPages;
      } else {
        startPage = page - 2;
        endPage = page + 2;
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      html += `<li>
                <a class="pagination-link${i === page ? " is-current" : ""}" data-page="${i}" href="#">${i}</a>
              </li>`;
    }

    paginationList.innerHTML = `
      <li>
        <a class="pagination-previous${page === 1 ? " is-disabled" : ""}" data-page="${page - 1}" href="#">Previous</a>
      </li>
      ${html}
      <li>
        <a class="pagination-next${page === totalPages ? " is-disabled" : ""}" data-page="${page + 1}" href="#">Next</a>
      </li>
    `;
  } else {
    paginationList.innerHTML = "";
  }
}

function setPage(page) {
  displayTable(page);
  displayPagination(page);

  // Update current page and total pages in HTML elements
  let currentPageElement = document.getElementById("current-page");
  currentPageElement.textContent = page;

  let totalPagesElement = document.getElementById("total-pages");
  totalPagesElement.textContent = totalPages;
}

setPage(1);

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-link")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.page);
    setPage(page);
  }
});

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-previous") && !e.target.classList.contains("is-disabled")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.page);
    setPage(page);
  }
});

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-next") && !e.target.classList.contains("is-disabled")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.page);
    console.log("Next Page: " + page);
    setPage(page);
  }
});

function setCurrentPage(page) {
  currentPage = page;
  const prevPage = document.querySelector(".pagination-previous");
  const nextPage = document.querySelector(".pagination-next");
  prevPage.dataset.page = currentPage - 1;
  nextPage.dataset.page = currentPage + 1;
  updatePaginationList();
}

function updatePaginationList() {
  const paginationList = document.getElementById("pagination-list");
  paginationList.innerHTML = "";
  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement("li");
    const a = document.createElement("a");
    a.classList.add("pagination-link");
    a.dataset.page = i;
    a.innerText = i;
    if (i === currentPage) {
      a.classList.add("is-current");
    }
    li.appendChild(a);
    paginationList.appendChild(li);
  }
}

function displayData() {
  const tableId = "user-table-body";
  const startIndex = (currentPage - 1) * perPage;
  const endIndex = startIndex + perPage;
  const dataSlice = results.slice(startIndex, endIndex);
  const table = document.getElementById(tableId);
  table.innerHTML = "";
  if (autoHeaders) {
    const headerRow = document.createElement("tr");
    for (const [key, value] of Object.entries(dataSlice[0])) {
      const th = document.createElement("th");
      th.innerText = key;
      headerRow.appendChild(th);
    }
    table.appendChild(headerRow);
  }
  for (const row of dataSlice) {
    const tr = document.createElement("tr");
    for (const value of Object.values(row)) {
      const td = document.createElement("td");
      td.innerText = value;
      tr.appendChild(td);
    }
    table.appendChild(tr);
  }
}

const autoHeaders = false;
let currentPage = 1;

// Display current page number
const currentPageElement = document.getElementById("current-page");
currentPageElement.textContent = currentPage;

// Display total pages number
const totalPagesElement = document.getElementById("total-pages");
totalPagesElement.textContent = totalPages;
updatePaginationList();
displayData();

</script>
