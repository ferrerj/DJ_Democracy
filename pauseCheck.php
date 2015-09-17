<?php
$fh=fopen("pause.txt","r") or die("can't open file");
$pause = fgets($fh);
fclose($fh);
if($pause==0){
	echo "<span onclick=\"toggleSound();\">Pause</span>";
} else {
	echo "<span onclick=\"toggleSound();\">Play</span>";
}
?>