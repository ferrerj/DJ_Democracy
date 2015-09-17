<?php
// set timezone and connect to db
date_default_timezone_set ( 'America/New_York' );
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$resultData = mysqli_query($con, "SELECT * FROM djdemocracy.songs ORDER BY songs.score DESC");
$songid = 0;
$i = 0;
// get time right now
$rightNow = getdate();
while($winner = mysqli_fetch_array($resultData)){
	$score = $winner['score'];
	if($i==0){
		// get last play time and adjust for easy manipulation
		$lastPlay = $winner['last_play'];
		$splitLast = explode(" ", $lastPlay);
		$splitDate = explode("-", $splitLast[0]);
		$splitTime = explode(":", $splitLast[1]);
		// check to see if its been played in the last 30 min (down to the second)
		//echo (60*60*($rightNow['hours']-$splitTime[0]))+(60*($rightNow['minutes']-$splitTime[1]))+(($rightNow['seconds']-$splitTime[2]));
		//echo "</br>";
		if($splitDate[0]!=$rightNow['year']||$splitDate[1]!=$rightNow['mon']||$splitDate[2]!=$rightNow['mday']||(60*60*($rightNow['hours']-$splitTime[0])+60*($rightNow['minutes']-$splitTime[1])+($rightNow['seconds']-$splitTime[2]))>=1800){
			$title = $winner['title'];
			$artist = $winner['artist'];
			$score = $winner['score'];
			$songid = $winner['song_id'];
			$i = 1;
		} 
		if($score==0){
			$resultsData = mysqli_query($con, "SELECT MAX(song_id) FROM djdemocracy.songs");
			$result = mysqli_fetch_array($resultsData);
			$randomSongID = rand(1, $result[0]);
			$resultsData = mysqli_query($con, "SELECT * FROM djdemocracy.songs WHERE song_id='".$randomSongID."'");
			while($result = mysqli_fetch_array($resultsData)){
				$title = $result['title'];
				$artist = $result['artist'];
				$score = $result['score'];
				$songid = $result['song_id'];
			}
		}
	}
}
$fh=fopen("currentSong.txt","w") or die("can't open file");
fwrite($fh, $title." by ".$artist);
fclose($fh);
$credData = mysqli_query($con, "SELECT * FROM djdemocracy.votes WHERE votes.song_id='".$songid."'");
$cred = mysqli_fetch_array($credData);
$creditData = mysqli_query($con, "SELECT * FROM djdemocracy.users WHERE user_id='".$cred[1]."'");
$credit = mysqli_fetch_array($creditData);
mysqli_query($con, "UPDATE djdemocracy.songs SET score='".($credit['score']+1)."' WHERE (song_id='".$songid."')");

mysqli_query($con, "DELETE FROM djdemocracy.votes WHERE song_id='".$songid."'");
mysqli_query($con, "UPDATE djdemocracy.songs SET score='0' WHERE (song_id='".$songid."')");
mysqli_query($con, "UPDATE djdemocracy.songs SET last_play=Now() WHERE (song_id='".$songid."')");
echo "<audio controls oncanplay=\"playNow()\" onended=\"loadNext()\" id=\"song\"><source src=\"music/".$artist."/".$title.".mp3\" type=\"audio/mpeg\"></audio>";

?>