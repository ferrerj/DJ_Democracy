<?php
$fh=fopen("skip.txt","w") or die("can't open file");
fwrite($fh, "2");
fclose($fh);
echo "Skip";
//$fh = fopen("currentSong.txt", 'r');
//$currentSong = fgets($fh);
//fclose($fh);
//echo "Skipping ".$currentSong."...";
?>