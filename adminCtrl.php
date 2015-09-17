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
</head>
<body>
<table>
	<tr>
		<td>
			<a href="home.php">
			<img src="back.jpg" id="back" width="200" height="100">
			</a>
		</td>
		<td>
			<img src="logo.jpg" id="logo" width="300" height="100">
		</td>
	</tr>
	<tr>	
		<td colspan="3" id="content">
		<a href="scan.php" target="_blank">Scan Music Folder</a></br>
		<a href="/phpmyadmin/" target="_blank">Load PHPMYADMIN</a></br></br>
		For erasing data:</br>
		<a href="clearTable.php?table=1">Clear Songs</a></br>
		<a href="clearTable.php?table=2">Clear Artists</a></br>
		<a href="clearTable.php?table=3">Clear Users</a></br>
		<a href="clearTable.php?table=4">Clear Votes</a></br>
		<a href="clearTable.php?table=5">Clear All Tables</a></br></br>
		<a href="allPlayable.php">Make all songs Playable</a></br>
	</tr>
</table>
</body>
</html>