<?php
	date_default_timezone_set ( 'America/New_York' );
	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
	$resultData = mysqli_query($con, "call nextSong;");
	$result = mysqli_fetch_array($resultData);
	$artist = $result['artist'];
	$title = $result['title'];
	echo "<source src=\"music/".$artist."/".$title.".mp3\" type=\"audio/mpeg\">";
?>