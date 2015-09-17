<?php
$param = mysql_real_escape_string($_GET['q']);
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$artist_result = mysqli_query($con, "SELECT artist_id, artist FROM artists WHERE artist LIKE '%".$param."%' ORDER BY current_week DESC LIMIT 5");
$song_result = mysqli_query($con, "SELECT songs.song_id, songs.title, artists.artist 
									FROM songs INNER JOIN artists ON songs.artist=artists.artist_id
									WHERE songs.title LIKE '%".$param."%' ORDER BY total, score DESC LIMIT 5");
		/*
		if($artist_result!==NULL){
			echo '<tr><td class="header">Artists<br></td></tr>';
			foreach($artist_result as $artist){
				echo "<tr><td id='".($artist['artist_id']-1)."' onclick=\"goToArtist(".($artist['artist_id']-1).")\">".$artist['artist']."</tr></td>";
			}
		}
		if($song_result!==NULL){
			echo '<tr><td class="header">Songs<br></td></tr>';
			foreach($song_result as $songs){
				echo "<tr><td onclick=\"vote(".$songs['song_id'].")\">".$songs['title']." by ".$songs['artist']."</td></tr>";
			}
		}
		*/
?>