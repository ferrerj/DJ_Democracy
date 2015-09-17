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
$resultData = mysqli_query($con, "SELECT * FROM djdemocracy.songs");
$maxData = mysqli_query($con, "SELECT MAX(song_id) FROM djdemocracy.songs");
$max = mysqli_fetch_array($maxData);
$i = 1;
while($i<=$max['MAX(song_id)']){
	mysqli_query($con, "UPDATE djdemocracy.songs SET last_play=DATE_SUB(NOW(),INTERVAL 30 MINUTE) WHERE song_id='".$i++."'"); 
	
}
 

?>
</body>
</html>