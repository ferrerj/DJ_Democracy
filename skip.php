<?php
	$fh = fopen("skip.txt", 'r');
	$skip = fgets($fh);
	fclose($fh);
	if($skip==2){
		$fh=fopen("skip.txt","w") or die("can't open file");
		fwrite($fh, "0");
		fclose($fh);
		//echo "skipping...</br><img src=\"back.jpg\" onload=\"loadNext();\">";
	}
	echo $skip;
?>