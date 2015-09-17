<?php
ini_set('memory_limit','16M');
set_time_limit(60*60);
if(isset($_COOKIE["djdemocracy"])){
	if($_COOKIE["djdemocracy"]!=1){
		header( 'Location: home.php');
	}
}
?>
<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
</head>
<body onload="redirect()">
<?php
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
//include "filesUpOneDir.php";
$dir    = 'music/';
$files1 = scandir($dir);
$artists = sizeof($files1);

for($i = 2; $i < $artists; $i++){
	$artist = $files1[$i];
	$resultData = mysqli_query($con, "SELECT * FROM djdemocracy.artists WHERE artist='".$artist."'");
	$result = mysqli_fetch_array($resultData);	
	if($result['artist_id']==null){
		$currentDir = "music/".$artist;
		$files2 = scandir("$currentDir");
		mysqli_query($con, "INSERT INTO artists (artist) VALUES ('".$artist."')");
		echo "Added artist ".$artist." to artist database.</br>";
		$resultData = mysqli_query($con, "SELECT artist_id FROM artists WHERE artist='".$artist."'");
		$result = mysqli_fetch_array($resultData);	
	}
	$id = $result['artist_id'];
	$currentDir = "music/".$artist;
	if(is_dir($currentDir)){
		$files2 = scandir($currentDir);
		$songs = sizeof($files2);
		for($k = 2; $k < $songs; $k++){
			if(!is_dir($currentDir."/".$files2[$k])){
				$fileName = explode(".",$files2[$k]);
				$safe_file_name = mysql_real_escape_string($fileName[0]);
				$resultData = mysqli_query($con, "SELECT * FROM djdemocracy.songs WHERE title='".$safe_file_name."' AND artist='".$id."'");
				$result = mysqli_fetch_array($resultData);
				if($result['song_id']==null){
					mysqli_query($con, "INSERT INTO djdemocracy.songs (artist, title, last_play) VALUES ('".$id."', '".$safe_file_name."', DATE_SUB(NOW(),INTERVAL 30 MINUTE))");
					echo "Added ".$safe_file_name." by ".$artist." to the song database<br>";
				}
			}
		}
	}
} 
?>
</body>
</html>