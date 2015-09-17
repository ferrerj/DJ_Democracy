<?php
	$json = '{ "data" : [';
	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
	$artistData = mysqli_query($con, "SELECT artist, artist_id FROM artists WHERE artist_id IN (SELECT DISTINCT artist FROM songs) ORDER BY artist ASC");
	foreach($artistData as $artist){
		$json=$json."{\"artist\":\"".$artist['artist']."\", \"song\":[";
		$songData = mysqli_query($con, "SELECT song_id, title FROM songs WHERE artist=".$artist['artist_id']." ORDER BY song_id ASC");
		foreach($songData as $song){
			$json=$json."{\"id\":\"".$song['song_id']."\", \"tit\":\"".$song['title']."\"},";
		}
		rtrim($json, ",");
		$json=$json."]},";
	}
	rtrim($json, ",");
	$json=$json."] }";
	$json = str_replace("},]", "}]", $json);
	//$file = file_get_contents('dj_democracy_funcs.js');
	file_put_contents('lib.json', $json);
	//file_put_contents('dj_democracy.js', "var music=".$json."\n".$file);
	echo $json;
	/*
	//$json = array();
	$json = array("data"=>array());
	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
	$artistData = mysqli_query($con, "SELECT artist, artist_id FROM artists WHERE artist_id IN (SELECT DISTINCT artist FROM songs) ORDER BY artist ASC");
	while($artist = mysqli_fetch_array($artistData)){
		var_dump($artist);
		$songData = mysqli_query($con, "SELECT song_id, title FROM songs WHERE artist='".$artist['artist_id']."' ORDER BY song_id ASC");
		$tempS = array();
		while($song = mysqli_fetch_array($songData)){
			$tempS['id'][] = $song['song_id'];
			$tempS['tit'][] = addslashes($song['title']);
		}
		array_push($json['data'], array("artist"=>addslashes($artist['artist']),"song"=>$tempS));
	}
	echo json_encode($json);
	file_put_contents('lib.json', json_encode($json));*/
?>