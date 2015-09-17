<?php
	// this file contains all cookie related info
	//$seedNo = $_GET["seedNo"];
	$uid = $_COOKIE['djdemocracy'];

	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());

	$result = mysqli_query($con, "SELECT s.song_id, a.artist, s.title, s.score
									FROM songs s, artists a
									WHERE (s.score>0) AND (s.artist = a.artist_id) 
									AND (s.last_play < DATE_SUB( NOW( ) , INTERVAL 30 MINUTE ))
									ORDER BY s.score DESC, s.last_play ASC");

	$k = 0;
	foreach($result as $row){
			if($row['score']>0){
				$k++;
				echo "<tr><td onclick=\"vote(".$row['song_id'].");\">$k:".$row['title']." by ".$row['artist']."</br>Total Votes: ".$row['score']."</td></tr>";
			}
	}
	if($k==0){
		echo "<tr><td onclick=\"history.pushState(null, null, \'#artist\');setPage();\">No Votes Yet. Click here to be the first</td></tr>";
	}
?>