<?php
$return_arr = array();
$temp = array();
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$artist_result = mysqli_query($con, "SELECT a.song_id AS sid, b.artist, s.title AS song, a.scount
FROM songs s
INNER JOIN (
SELECT song_id, COUNT( song_id ) AS scount
FROM votes
GROUP BY song_id
)a 
ON a.song_id = s.song_id
INNER JOIN artists b
ON b.artist_id=s.artist
ORDER BY a.scount DESC 
LIMIT 0 , 25");
foreach($artist_result as $row){
  $json['artist'] = $row['artist'];
  $json['sid'] = $row['sid'];
  $json['song'] = $row['song'];
  $json['count'] = $row['scount'];
  array_push($return_arr,$json);
}
$temp['result'] = $return_arr;
header('Content-Type:application/json');
echo json_encode($temp);
?>