<?php
if(!isset($_COOKIE["djdemocracy"])){
	header( 'Location: index.php');
}
$home = 2;
include 'header.php';
?>
<script>
voteNow();
window.setTimeout(function(){history.back();}, 3000);
</script>
<table align="center">
	<tr>
		<td id="msg" class="msg">
			Hold On while we process your vote...
		</td>
	</tr>
</table>
</body>
</html>