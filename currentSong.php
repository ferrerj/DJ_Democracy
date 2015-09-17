<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
	
	$fh = fopen("currentSong.txt", 'r');
	$currentSong = fgets($fh);
	fclose($fh);
	echo "data:$currentSong\n\n";
	flush();
?>