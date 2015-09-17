<?php
if(isset($_COOKIE["djdemocracy"])){
	if($_COOKIE["djdemocracy"]!=1){
		header( 'Location: home.php');
	}
}
?>
<html>
<head>
<script type="text/javascript">
function redirect(){
	setTimeout(function(){window.location="adminCtrl.php";},3000)
}
</script>
</head>
<body onload="redirect()">
<?php
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$table = $_GET['table'];

if($table == 1 || $table == 5){
// clear songs
mysqli_query($con, "TRUNCATE TABLE djdemocracy.songs");
echo "Cleared Songs</br>";
}

if($table == 2 || $table == 5){
// clear artists
mysqli_query($con, "TRUNCATE TABLE djdemocracy.artists");
echo "Cleared Artists</br>";
}

if($table == 3 || $table == 5){
// clear users
mysqli_query($con, "TRUNCATE TABLE djdemocracy.users");
echo "Cleared Users</br>";
}

if($table == 4 || $table == 5){
// clear votes
mysqli_query($con, "TRUNCATE TABLE djdemocracy.votes");
echo "Cleared Votes</br>";
}
 

?>
</body>
</html>