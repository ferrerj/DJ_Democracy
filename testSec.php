<html>
<head>
</head>
<body>
<?php
/*
// gets MAC Address from client
exec("arp -a ".$_SERVER['REMOTE_ADDR'], $output);
if($output){
	preg_match("%([0-9a-f][0-9a-f]-){5}([0-9a-f][0-9a-f])%", $output[3], $matches);
	echo "<br>".$matches[0];
}
echo "<br>";

// tests new stored proc to get next song
$con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
$resultsData = mysqli_query($con, "call nextSong;");
$results = mysqli_fetch_array($resultsData);
echo $results["title"]." by ".$results["artist"];
echo "<br>";
*/
// test cURL function on node.js server
// send data to node server
//$handle = curl_init("localhost:9081/".str_replace(" ", "&nbsp;", $results["title"])."/".str_replace(" ", "&nbsp;",$results["artist"])."/");
$handle = curl_init("localhost:9012/");

if(!$result = curl_exec($handle)){
	// in the player i can use the command start the node server as it hasnt started
	trigger_error(curl_error($handle));
} else {
	// in the player i can ignore starting the command, or even sending a player as one should exist.
	echo $result;
}
curl_close($handle);
?>
</body>
</html>