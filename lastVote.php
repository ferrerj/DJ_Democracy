<?php
	$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
	$resultsData = mysqli_query($con, "SELECT * FROM votes ORDER BY vote_id DESC LIMIT 1");
	$vote_results = mysqli_fetch_array($resultsData);
	if($vote_results['vote_id']!=""){
		$songData = mysqli_query($con, "Select title, artist FROM songs WHERE (song_id=\"".$vote_results['song_id']."\")");
		$song_results = mysqli_fetch_array($songData);
		$userData = mysqli_query($con, "Select user_name FROM users WHERE (user_id=\"".$vote_results['user_id']."\")");
		$user_results = mysqli_fetch_array($userData);
		echo "<h3 onclick=\"vote(".$vote_results['song_id'].")\">".$user_results['user_name']." just voted for ".$song_results['title']." by ".$song_results['artist']."</h3>";
	} else {
		echo "";
	}
?>