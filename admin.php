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
		$results[$key]['Action'] = '<button type="button" onclick="ban('.$results[$key]['user_id'].',0);">Ban</button>';
	} else {
		$results[$key]['user_status']="BAN";
		$results[$key]['Action'] = '<button type="button" onclick="ban('.$results[$key]['user_id'].',1);">Unban</button>';
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
			<title><?php echo($sitename); ?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
			<link rel="stylesheet" href="css/main.css">
			<script src="admintable.js"></script>
		</head>
		<body >

			<div class="main-container">
				<div class="logo-section">
					<img class="logo-image" style="width:200px; height:auto;"  src="<?php echo($logo); ?>">
					<br>
					Admin Panel
				</div>

				<div class="table-container">
					<label>Search: </label><input type="text" onkeyup="filter(event)">
					<button type="button" class="custom-button-small" style="float:right; margin-bottom:5px;" onclick="logout();">LOGOUT</button>
					
					<table id="user-table" class="table is-striped is-bordered" style="margin-top:10px; width:100%;"	>
						<thead>
							<tr>
								
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div id="paginator"></div>
				</div>				
					
				
				<?php echo($footer); ?>
			</div>
			<div style="min-height:100%"></div>
		</body>
	<script>
	function logout(){
		window.location.assign('adminlogout.php');
	}
	function ban(id,banmode){
		var xhr = new XMLHttpRequest();
		xhr.open("POST", 'adminban.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
			if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
				location.reload();
			}
		}
		xhr.send("id="+id+"&banmode="+banmode);
	}
	
		var data = <?php echo json_encode($results); ?>;
        const options = {
            tableId:'user-table',
            currentPage:1,
            perPage:10,
            autoHeaders:true,
            arrowUp:'⇑',
            arrowDown:'⇓',
            previousText:'&#10094',
            nextText:'&#10095',
        }
        setTable(data, options);
    </script>
	</html>