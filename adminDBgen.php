<?php
	$json = '{ "data" : [';
	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
	$artistData = mysqli_query($con, "SELECT artist, artist_id, playable FROM artists WHERE artist_id IN (SELECT DISTINCT artist FROM songs) ORDER BY artist ASC");
	foreach($artistData as $artist){
		$json=$json."{\"artist\":\"".$artist['artist']."\", \"playable\":\"".$artist['playable']."\", \"song\":[";
		$songData = mysqli_query($con, "SELECT song_id, title, playable FROM songs WHERE artist=".$artist['artist_id']." ORDER BY song_id ASC");
		foreach($songData as $song){
			$json=$json."{\"id\":\"".$song['song_id']."\", \"playable\":\"".$artist['playable']."\", \"tit\":\"".$song['title']."\"},";
		}
		rtrim($json, ",");
		$json=$json."]},";
	}
	rtrim($json, ",");
	$json=$json."] }";
	$json = str_replace("},]", "}]", $json);
	file_put_contents('lib.json', $json);
	echo $json;
?>