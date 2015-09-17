<?php
 $con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
 //mysql_select_db("djdemocracy") or die(mysql_error());

$user = $_REQUEST["user"];
$password = $_REQUEST["password"];
$secret = $_REQUEST["secret"];

$result = mysqli_query($con, "SELECT user_name FROM users WHERE (user_name='".$user."')");

if(!empty($result)){

	mysqli_query($con, "INSERT INTO users (user_name, password, secret) VALUES ('".$user."', '".$password."', '".$secret."')");

	$resultData = mysqli_query($con, "SELECT user_id FROM djdemocracy.users WHERE (user_name='".$user."')");
	$result = mysqli_fetch_array($resultData);

	$expire=time()+60*60*24*30;
	setcookie('djdemocracy', $result["user_id"], $expire);
	echo "1";
} else {
	echo "0";
}
?>