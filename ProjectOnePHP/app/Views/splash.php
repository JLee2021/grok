<?php 

//TODO: Write functions to replace variables
$app_downloaded = false;
$token = "value from server";
$token = isset($_SESSION[$token]);

if($app_downloaded && $token){
  include('dashboard-user.php');
}

else if($token && !$app_downloaded){
  // require($install_app);
  include 'dashboard-user.php' ;
}

else{
  include 'login.php';
}

?>
