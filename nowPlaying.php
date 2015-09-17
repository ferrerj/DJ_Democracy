<?php
$fh = fopen("currentSong.txt", 'r');
$currentSong = fgets($fh);
fclose($fh);
echo $currentSong;
?>