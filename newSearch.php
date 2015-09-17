<?php
$param = mysql_real_escape_string($_GET['q']);
$return_arr = array();
$artist = array();
$song = array();
$temp = array();
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$artist_result = mysqli_query($con, "SELECT artist_id, artist FROM artists WHERE artist LIKE '%".$param."%' ORDER BY current_week DESC LIMIT 5");
$song_result = mysqli_query($con, "SELECT songs.song_id, songs.title, artists.artist, artists.artist_id 
									FROM songs INNER JOIN artists ON songs.artist=artists.artist_id
									WHERE songs.title LIKE '%".$param."%' ORDER BY total, score DESC LIMIT 5");

foreach($artist_result as $row){
  $json['aid'] = ($row['artist_id']-1);
  $json['artist'] = $row['artist'];
  array_push($artist,$json);
}
foreach($song_result as $row){
  $json['sid'] = ($row['song_id']);
  $json['song'] = $row['title'];
  $json['artist'] = $row['artist'];
  $json['aid'] = $row['artist_id']-1;
  array_push($song,$json);
}
$temp['artists'] = $artist;
$temp['songs'] = $song;
header('Content-Type:application/json');
echo json_encode($temp);
?>