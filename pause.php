<?php
	$fh = fopen("pause.txt", 'r');
	$pause = fgets($fh);
	fclose($fh);
	echo $pause;
	//if($pause==1){
		/*$uid = $_COOKIE['djdemocracy'];
		$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
		$resultsData = mysqli_query($con, "SELECT * FROM djdemocracy.users WHERE (user_id='".$uid."')");
		$results = mysqli_fetch_array($resultsData);
		echo "<h2 onload=\"pauseNow();\">Song paused by $results['user_name']</h2></br>";*/
		//echo "pauseNow()";
	//} else {
	//	echo "playNow()";
	//}
?>