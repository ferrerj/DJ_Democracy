<?php
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$current = mysqli_query($con,"SELECT p.sid AS sid, s.title AS title, artists.artist AS artist FROM playing p INNER JOIN songs s ON p.sid=s.song_id INNER JOIN artists ON artists.artist_id=s.artist ORDER BY p.pid DESC LIMIT 0,1");
$curr = mysqli_fetch_array($current);
$latest = mysqli_query($con,"SELECT v.song_id, s.title, artists.artist, u.user_name FROM votes v INNER JOIN songs s ON v.song_id=s.song_id INNER JOIN artists ON artists.artist_id=s.artist INNER JOIN users u ON u.user_id=v.user_id ORDER BY v.vote_id DESC LIMIT 1");
$last = mysqli_fetch_array($latest);
echo "[{\"sid\":\"".$curr['sid']."\",\"text\":\"".$curr['title']." by ".$curr['artist']."\"},{\"sid\":\"".$last['song_id']."\",\"text\":\"".$last['user_name']." voted for ".$last['title']." by ".$last['artist']."\"}]";
?>