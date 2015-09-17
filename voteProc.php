<?php
/*
if(!isset($_COOKIE["djdemocracy"])){
	header( 'Location: index.php');
}*/
$song = $_GET['song_id'];
$uid = $_COOKIE['djdemocracy'];
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$resultsData = mysqli_query($con, "SELECT vote($uid, $song) AS result;");
$results = mysqli_fetch_array($resultsData);
echo $results["result"];
?>