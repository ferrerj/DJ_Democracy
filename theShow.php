<?php
if(isset($_COOKIE["djdemocracy"])){
	if($_COOKIE["djdemocracy"]!=1){
		header( 'Location: home.php');
	}
}
?>
<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>

<script type="text/javascript">
	function loadNext(){
		window.location = "player.php";
	}
	function playNow(){
		document.getElementById('song').play();
	}
	function pauseNow(){
		document.getElementById('song').pause();
	}	
	function serverUpdate(id, file_name){
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText==0){
					playNow();
				} else if(xmlhttp.responseText==1){
					pauseNow();
				} else if(xmlhttp.responseText==2){
					loadNext();
				} else {
					document.getElementById(id).innerHTML=xmlhttp.responseText;
				}
			}
		}
		xmlhttp.open("POST",file_name,true);
		xmlhttp.send();
	}
	function update(){
		serverUpdate("skipmsg", "skip.php");
		serverUpdate("pausemsg", "pause.php");
		setTimeout(function(){update();}, 500);
	}

</script>
</head>
<body>
	<script>
		update();
	</script>
	<audio controls oncanplay="playNow()" onended="loadNext()" id='song'>
		<?php
			date_default_timezone_set ( 'America/New_York' );
			$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
			$resultData = mysqli_query($con, "SELECT SUM(score), MAX(song_id) FROM djdemocracy.songs");
			$result = mysqli_fetch_array($resultData);
			if($result['SUM(score)']>0){
				$resultsData = mysqli_query($con, "SELECT * FROM djdemocracy.songs WHERE (score > 0) AND (last_play < DATE_SUB( NOW( ) , INTERVAL 30 MINUTE ))ORDER BY songs.score DESC , songs.last_play ASC LIMIT 1");
				$songid = 0;
				$i = 0;
				// get time right now
				$rightNow = getdate();
				while($winner = mysqli_fetch_array($resultsData)){
					$score = $winner['score'];
					if($i==0){
						// get last play time and adjust for easy manipulation
						$lastPlay = $winner['last_play'];
						$splitLast = explode(" ", $lastPlay);
						$splitDate = explode("-", $splitLast[0]);
						$splitTime = explode(":", $splitLast[1]);
						// check to see if its been played in the last 30 min (down to the second)
						if($splitDate[0]!=$rightNow['year']||$splitDate[1]!=$rightNow['mon']||$splitDate[2]!=$rightNow['mday']||(60*60*($rightNow['hours']-$splitTime[0])+60*($rightNow['minutes']-$splitTime[1])+($rightNow['seconds']-$splitTime[2]))>=1800){
							$title = $winner['title'];
							$artist = $winner['artist'];
							$score = $winner['score'];
							$songid = $winner['song_id'];
							$i = 1;
						} 
					}
				}
			} else {
						$randomSongID = rand(1, $result['MAX(song_id)']);
						$resultsData = mysqli_query($con, "SELECT * FROM djdemocracy.songs WHERE song_id='".$randomSongID."'");
						while($result = mysqli_fetch_array($resultsData)){
							$title = $result['title'];
							$artist = $result['artist'];
							$score = $result['score'];
							$songid = $result['song_id'];
						}
				}
			$fh=fopen("currentSong.txt","w") or die("can't open file");
			fwrite($fh, $title." by ".$artist);
			fclose($fh);
			$credData = mysqli_query($con, "SELECT * FROM djdemocracy.votes WHERE votes.song_id='".$songid."'");
			$cred = mysqli_fetch_array($credData);
			$creditData = mysqli_query($con, "SELECT * FROM djdemocracy.users WHERE user_id='".$cred['user_id']."'");
			$credit = mysqli_fetch_array($creditData);
			mysqli_query($con, "UPDATE djdemocracy.songs SET score='".($credit['score']+1)."' WHERE (song_id='".$songid."')");

			mysqli_query($con, "DELETE FROM djdemocracy.votes WHERE song_id='".$songid."'");
			mysqli_query($con, "UPDATE djdemocracy.songs SET score='0' WHERE (song_id='".$songid."')");
			mysqli_query($con, "UPDATE djdemocracy.songs SET last_play=Now() WHERE (song_id='".$songid."')");
		
			echo "<source src=\"music/".$artist."/".$title.".mp3\" type=\"audio/mpeg\">";
		?>
	</audio>
	<a href="player.php">Skip</a>
	</br>
	<div id="skipmsg">test1</div>
	</br>
	<div id="pausemsg">test2</div>
	<?php
		$fh = fopen("currentSong.txt", 'r');
		$currentSong = fgets($fh);
		fclose($fh);
		echo "<h2>".$currentSong."</h2>";
	?>
</body>
</html>