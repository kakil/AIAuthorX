<?php
class Users {
  
  private $pdo = null;
  private $stmt = null;
  public $error = null;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".USER_DB_HOST.";dbname=".USER_DB_NAME.";charset=".USER_DB_CHARSET,
      USER_DB_USER, USER_DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  
  function get ($id) {
    $this->query(sprintf("SELECT * FROM `users` WHERE `user_%s`=?", is_numeric($id) ? "id" : "email"), [$id]);
    return $this->stmt->fetch();
  }

  function getLicenseKey($id) {
    $this->query("SELECT `license_key` FROM `users` WHERE `user_id`=?", [$id]);
    $result = $this->stmt->fetchColumn();
    return $result ? $result : null;
  }

  
  function login ($email, $password) {
  
    if (isset($_SESSION["user"])) { return true; }

  
    $user = $this->get($email);
    if (!is_array($user)) { return false; }
  
	if ($user["user_status"]==0){return false;}
    
	
    if (password_verify($password, $user["user_password"])) {
      $_SESSION["user"] = [];
      $userlogins=$user["user_logins"];
	  $userlogins++;
	  $userlogins=$user["user_logins"]=$userlogins;
	  $user["user_lastlogin"]=time();
	  $sql = "UPDATE `users` SET `user_logins`=?, `user_lastlogin`=? WHERE `user_id`=?";
      $data = [$userlogins, $user["user_lastlogin"], $user["user_id"]];
	  $this->query($sql, $data);
	  foreach ($user as $k=>$v) { if ($k!="user_password") { $_SESSION["user"][$k] = $v; }}
      
	  return true;
    }
    return false;
  }

  
  function save ($name, $email, $pass, $licenseKey, $id=null) {
  
	$nowtime=time();
	
    if ($id===null) {
      $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`,`user_creation`,`user_lastlogin`,`user_logins`,`user_apikey`,`user_status`, `license_key`) VALUES (?,?,?,?,?,?,?,?,?)";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT),$nowtime,$nowtime,0,"",1, $licenseKey];
	
    } else {
      $sql = "UPDATE `users` SET `user_name`=?, `user_email`=?, `user_password`=?, `license_key`=? WHERE `user_id`=?";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT), $licenseKey, $id];
    }

    
    $this->query($sql, $data);
    return true;
  }
 
  function saveapi($apikey,$id) {
	
	$sql = "UPDATE `users` SET `user_apikey`=? WHERE `user_id`=?";
	$data = [$apikey, $id];
	$this->query($sql, $data);
    return true;
	}
  
  function lostpassword($emailforpassword,$sitename) {
	 $this->query(sprintf("SELECT user_id FROM `users` WHERE `user_%s`=?", "email"), [$emailforpassword]);
     $userfound=$this->stmt->fetch();
	 
	 if ($userfound!=""){
		 $id=$userfound["user_id"];
		 $password=randomPassword();
		 $sql = "UPDATE `users` SET `user_password`=? WHERE `user_id`=?";
		 $data = [password_hash($password, PASSWORD_DEFAULT), $id];		 
		 $qresult=$this->query($sql, $data);
		 $msg="Hi\r\n\r\nYou requested a new password from ".$sitename." - Here it is : ".$password."\r\n\r\nYou can use your email and this password to login.\r\n\r\nMany Thanks.";
		 mail($emailforpassword,"New password from ".$sitename,$msg);
	 }

  }
   function ban($id,$mode) {
	
	$sql = "UPDATE `users` SET `user_status`=? WHERE `user_id`=?";
	$data = [$mode, $id];
	$this->query($sql, $data);
    return true;
	} 
  
}


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}



require_once("config.php");

$USR = new Users();