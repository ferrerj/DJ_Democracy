<?php
$fh=fopen("pause.txt","r") or die("can't open file");
$pause = fgets($fh);
fclose($fh);
$fh=fopen("pause.txt","w") or die("can't open file");
if($pause==0){
	fwrite($fh, "1");
	echo "Pause";
} else {
	fwrite($fh, "0");
	echo "Play";
}
fclose($fh);
?>