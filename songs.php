<?php
if(!isset($_COOKIE["djdemocracy"])){
header( 'Location: index.php');
}
$songPage = 'C:/xampp/htdocs/generated/songs.html';
if(file_exists($songPage)){
	include "generated/songs.html";
	exit(0);
}
ob_start();
$home = 11;
include 'header.php';
?>
<table class='table' id='songs' width="100%">
</table>
</body>
</html>
<?php
	$buffer = ob_get_contents();
	file_put_contents($songPage, $buffer);
	ob_flush();
?>