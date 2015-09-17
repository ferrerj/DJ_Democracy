<?php
 $con = mysqli_connect("localhost", "dbadmin", "password", "djdemocracy") or die('Could not connect: ' . mysqli_connect_error());
 //mysql_select_db("djdemocracy") or die(mysql_error());

$user = $_REQUEST["user"];
$password = $_REQUEST["password"];

// this page asks users for signin info then directs them to the index to check
$resultData = mysqli_query($con, "SELECT user_id, user_name, password FROM djdemocracy.users WHERE ((user_name='".mysql_real_escape_string($user)."') AND (password='".mysql_real_escape_string($password)."'))");
$result = mysqli_fetch_array($resultData);
if($result['user_id']!=NULL){
	$expire=time()+60*60*24*30;
	setcookie('djdemocracy', $result["user_id"], $expire);
	echo "1";
}  else {
	echo "0";
}
?>