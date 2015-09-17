<?php
if(!isset($_COOKIE["djdemocracy"])){
header( 'Location: index.php');
}
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$resultData = mysqli_query($con, "SELECT user_name FROM djdemocracy.users WHERE (user_id='".$_COOKIE['djdemocracy']."')");
$results = mysqli_fetch_array($resultData);
$user = $results[0];
$home=1;
include 'header.php';
?>
<table class="content">
<?php
// this file contains all cookie related info


$resultsData = mysqli_query($con, "SELECT * FROM djdemocracy.votes WHERE (user_id='".$_COOKIE['djdemocracy']."')");
//$results = mysqli_fetch_array($resultData);
foreach($resultsData as $songs){
	$songData = mysqli_query($con, "SELECT * FROM djdemocracy.songs WHERE (song_id='".$songs['song_id']."')");
	$songResults = mysqli_fetch_array($songData);
	echo "<tr><td>".$songResults['title']." by ".$songResults['artist']."</br>Total Votes: ".$songResults['score']."</td></tr>";
}
?>
</table>
</body>
</html>