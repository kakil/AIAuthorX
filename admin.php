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
    
  $human_readable_date = date("Y-m-d", (int)$value['user_creation']);
  $results[$key]['user_creation'] = $human_readable_date;
	if ($results[$key]['user_status']=="1") {
		$results[$key]['user_status']="OK";
		$results[$key]['Action'] = '<button type="button" class="button is-small is-danger" onclick="ban('.$results[$key]['user_id'].',0);">Ban</button>';
	} else {
		$results[$key]['user_status']="BAN";
		$results[$key]['Action'] = '<button type="button" class="button is-small is-success" onclick="ban('.$results[$key]['user_id'].',1);">Unban</button>';
	}
	
	

}

// banned users
$bannedUsers = [];
foreach ($results as $key => $value) {
    
    if ($results[$key]['user_status'] == "BAN") {
        $bannedUsers[] = $results[$key];
    }
}



foreach ($results as $key => $value) {
  $results[$key] = replaceKeys("user_name", "Name", $results[$key]);
  $results[$key] = replaceKeys("user_id", "ID", $results[$key]);
  $results[$key] = replaceKeys("user_email", "Email", $results[$key]);
  $results[$key] = replaceKeys("user_creation", "Created", $results[$key]);
  $results[$key] = replaceKeys("user_logins", "# Logins", $results[$key]);
  $results[$key] = replaceKeys("user_status", "Status", $results[$key]);
}


function replaceKeys($oldKey, $newKey, array $input) {
  $return = array(); 
  foreach ($input as $key => $value) {
      if (is_array($value)) {
          $value = replaceKeys($oldKey, $newKey, $value);
      }

      if ($key === $oldKey) {
          $return[$newKey] = $value;
      } else {
          $return[$key] = $value;
      }
  }
  return $return; 
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
              <a href="admin.php" class="has-icon is-active">
                <span class="icon has-update-mark"><i class="mdi mdi-account-multiple"></i></span>
                <span class="menu-item-label">User Admin</span>
              </a>
            </li>
            <li>
              <a href="register.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-account-edit"></i></span>
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
      </section>
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
      </section>
      <section>
        <div class="tile is-ancestor mt-3" style="display: flex; justify-content: center;">
          <!-- Active User Count Card -->
          <div class="tile is-parent is-3">
            <div class="card tile is-child" style="width: 240px; height: 240px;">
              <header class="card-header">
                <p class="card-header-title" style="display: flex; align-items: center; justify-content: center;">
                  <span class="icon" style="margin-right: 5px;"><i class="mdi mdi-account default"></i></span>
                  Total Users
                </p>
              </header>
              <div class="card-content">
                <button id="total-users-button" class="button is-primary is-large is-fullwidth" style="width: 100px; height: 100px; font-size: 36px; font-weight: bold; margin: auto;">
                  Button
                </button>
              </div>
            </div>
          </div>
          <!-- Banned User Count Card -->
          <div class="tile is-parent is-3 is-offset-1">
            <div class="card tile is-child" style="width: 240px; height: 240px;">
              <header class="card-header">
                <p class="card-header-title" style="display: flex; align-items: center; justify-content: center;">
                  <span class="icon" style="margin-right: 5px;"><i class="mdi mdi-account-off default"></i></span>
                  Banned Users
                </p>
              </header>
              <div class="card-content">
                <button id="banned-users-button" class="button is-danger is-large is-fullwidth" style="width: 100px; height: 100px; font-size: 36px; font-weight: bold; margin: auto;">
                  Button
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>



      <!-- All Users -->
      <section class="section is-main-section">
        <div class="notification is-info">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                <div>
                  <span class="icon"><i class="mdi mdi-account-search default"></i></span>
                  <b class="mr-3">Search:</b><input type="text" id="search-input" placeholder="Search users...">
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Search All Users -->
        <div class="card has-table">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              All Users
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
      </section>

      <!-- Banned Users -->
      <section class="section is-main-section">
        <div class="notification is-info">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                <div>
                  <span class="icon"><i class="mdi mdi-account-search default"></i></span>
                  <b class="mr-3">Search:</b><input type="text" id="banned-search-input" placeholder="Search banned users...">
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Search Banned Users -->
        <div class="card has-table">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Banned Users
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
                  <tbody id="banned-users-table-body"></tbody> <!-- END TBODY -->
                </table> <!-- END TABLE -->
              </div> <!-- END TABLE-WRAPPER HAS-MOBILE-CARDS -->
              <div class="notification">
                <div class="level">
                  <div class="level-left">
                    <div class="level-item">
                      <nav class="pagination" role="navigation" aria-label="pagination">
                        <ul class="pagination-list" id="banned-pagination-list"></ul>
                      </nav>
                    </div>
                  </div>
                  <div class="level-right">
                    <div class="level-item">
                      <small>Page <span id="banned-current-page"></span> of <span id="banned-total-pages"></span></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- END OF CARD-CONTENT -->
        </div> <!-- END CARD HAS-TABLE -->
      </section>
      
      <footer class="footer">
        <div class="container-fluid">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                © 2023, ToolkitsForSuccess.com
              </div>
              <div class="level-item">
                <a href="https://toolkitsforsuccess.com" style="height: 20px">
                  <img src="https://img.shields.io/badge/release-v1.0.0-lightgrey">
                </a>
              </div>
            </div>
            <div class="level-right">
              <div class="level-item">
                <div class="logo">
                  <a href="https://toolkitsforsuccess.com"><img src="img/ToolkitsForSuccess_logo.png" alt="ToolkitsForSuccess.com"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <div id="sample-modal" class="modal">
        <div class="modal-background jb-modal-close"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Confirm action</p>
            <button class="delete jb-modal-close" aria-label="close"></button>
          </header>
          <section class="modal-card-body">
            <p>This will permanently delete <b>Some Object</b></p>
            <p>This is sample modal</p>
          </section>
          <footer class="modal-card-foot">
            <button class="button jb-modal-close">Cancel</button>
            <button class="button is-danger jb-modal-close">Delete</button>
          </footer>
        </div>
        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
      </div>
    </div>

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  </body>
</html>


<script>
  window.onload = function() {
  setPage(1);
  displayBannedUsersTable();
  setBannedPage(1);
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
const perPage = 10;
const totalItems = results.length;
const totalPages = Math.ceil(totalItems / perPage);

//banned users
const bannedUsers = results.filter(row => row.Status === "BAN");
const bannedPerPage = 10;
const totalBannedItems = bannedUsers.length;
const totalBannedPages = Math.ceil(totalBannedItems / bannedPerPage);

function displayTable(page, data = results) {
  const table = document.getElementById("user-table-body");
  const startIndex = (page - 1) * perPage;
  const endIndex = startIndex + perPage;
  const paginatedResults = data.slice(startIndex, endIndex);

  let html = "";
  for (const row of paginatedResults) {
    html += `<tr>
              <td class="text-left">${row.ID}</td>
              <td class="text-left">${row.Name}</td>
              <td class="text-left">${row.Email}</td>
              <td class="text-left">${row.Created}</td>
              <td class="text-left">${row['# Logins']}</td>
              <td class="text-left">${row.Status}</td>
              <td class="text-left">${row.Action}</td>
            </tr>`;
  }
  table.innerHTML = html;
}


//banned users
function displayBannedTable(page, data = bannedUsers) {
  const table = document.getElementById("banned-users-table-body");
  const startIndex = (page - 1) * bannedPerPage;
  const endIndex = startIndex + bannedPerPage;
  const paginatedBannedUsers = data.slice(startIndex, endIndex);

  let html = "";
  for (const row of paginatedBannedUsers) {
    html += `<tr>
              <td class="text-left">${row.ID}</td>
              <td class="text-left">${row.Name}</td>
              <td class="text-left">${row.Email}</td>
              <td class="text-left">${row.Created}</td>
              <td class="text-left">${row['# Logins']}</td>
              <td class="text-left">${row.Status}</td>
              <td class="text-left">${row.Action}</td>
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

//banned users
function displayBannedPagination(page) {
  const paginationList = document.getElementById("banned-pagination-list");
  let html = "";

  if (totalBannedPages > 1) {
    let startPage, endPage;
    if (totalBannedPages <= 5) {
      startPage = 1;
      endPage = totalBannedPages;
    } else {
      if (page <= 3) {
        startPage = 1;
        endPage = 5;
      } else if (page + 1 >= totalBannedPages) {
        startPage = totalBannedPages - 4;
        endPage = totalBannedPages;
      } else {
        startPage = page - 2;
        endPage = page + 2;
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      html += `<li>
                <a class="pagination-link${i === page ? " is-current" : ""}" data-banned-page="${i}" href="#">${i}</a>
              </li>`;
    }

    paginationList.innerHTML = `
      <li>
        <a class="pagination-previous${page === 1 ? " is-disabled" : ""}" data-banned-page="${page - 1}" href="#">Previous</a>
      </li>
      ${html}
      <li>
        <a class="pagination-next${page === totalBannedPages ? " is-disabled" : ""}" data-banned-page="${page + 1}" href="#">Next</a>
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

//banned users
function setBannedPage(page) {
  displayBannedTable(page);
  displayBannedPagination(page);

  // Update current page and total pages in HTML elements
  let currentPageElement = document.getElementById("banned-current-page");
  currentPageElement.textContent = page;

  let totalPagesElement = document.getElementById("banned-total-pages");
  totalPagesElement.textContent = totalBannedPages;
}



setPage(1);
displayBannedUsersTable();
setBannedPage(1);


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


//banned users
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-link") && e.target.hasAttribute("data-banned-page")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.bannedPage);
    setBannedPage(page);
  }
});

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-previous") && !e.target.classList.contains("is-disabled") && e.target.hasAttribute("data-banned-page")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.bannedPage);
    setBannedPage(page);
  }
});

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("pagination-next") && !e.target.classList.contains("is-disabled") && e.target.hasAttribute("data-banned-page")) {
    e.preventDefault();
    const page = parseInt(e.target.dataset.bannedPage);
    setBannedPage(page);
  }
});

//Search
const searchInput = document.getElementById("search-input");
searchInput.addEventListener("input", handleSearch);

const bannedSearchInput = document.getElementById("banned-search-input");
bannedSearchInput.addEventListener("input", handleBannedSearch);


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

// Banned Users
function displayBannedUsersTable() {
  const table = document.getElementById("banned-users-table-body");

  let html = "";
  for (const row of bannedUsers) {
    html += `<tr>
              <td class="text-left">${row.ID}</td>
              <td class="text-left">${row.Name}</td>
              <td class="text-left">${row.Email}</td>
              <td class="text-left">${row.Created}</td>
              <td class="text-left">${row['# Logins']}</td>
              <td class="text-left">${row.Status}</td>
              <td class="text-left">${row.Action}</td>
            </tr>`;
  }
  table.innerHTML = html;
}

//Search
function handleSearch() {
  const searchQuery = searchInput.value.trim().toLowerCase();
  const filteredResults = results.filter(row => {
    const values = Object.values(row).map(value => value.toString().toLowerCase());
    return values.some(value => value.includes(searchQuery));
  });
  setPage(1);
  displayTable(1, filteredResults);
}

function handleBannedSearch() {
  const searchQuery = bannedSearchInput.value.trim().toLowerCase();
  const filteredBannedUsers = bannedUsers.filter(row => {
    const values = Object.values(row).map(value => value.toString().toLowerCase());
    return values.some(value => value.includes(searchQuery));
  });
  setBannedPage(1);
  displayBannedTable(1, filteredBannedUsers);
}

//Display Total Users
const bannedUsersButton = document.getElementById("banned-users-button");
const totalUsersButton = document.getElementById("total-users-button");
// Replace these numbers with the actual number of users and banned users
totalUsersButton.innerText = results.length;
bannedUsersButton.innerText = bannedUsers.length;


</script>