<?php
if(!isset($_COOKIE["djdemocracy"])){
header( 'Location: index.php');
}
if(file_exists('C:/xampp/htdocs/generated/search.html')){
	include 'C:/xampp/htdocs/generated/search.html';
	exit(0);
}
ob_start();
$home=3;
include'header.php';
?>

<form>
<input type="text" size="30" onkeyup="search(this.value)">
</form>
</br>
<table id="results" class="table" width="100%">
</table>
</body>
</html>
<?php
	$buffer = ob_get_contents();
	file_put_contents('C:/xampp/htdocs/generated/search.html', $buffer);
	ob_flush();
?>