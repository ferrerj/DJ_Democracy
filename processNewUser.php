<?php
 $con = mysqli_connect("127.0.0.1", "dbadmin", "password", "djdemocracy") or die(mysql_error());
 //mysql_select_db("djdemocracy") or die(mysql_error());

$user = $_REQUEST["user"];
$password = $_REQUEST["password"];
$secret = $_REQUEST["secret"];
?>
<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
</head>
<body>
<?php
$result = mysqli_query($con, "SELECT user_name FROM djdemocracy.users WHERE (user_name='".$user."')");

if(!empty($result)){

	mysqli_query($con, "INSERT INTO djdemocracy.users (user_name, password, secret) VALUES ('".$user."', '".$password."', '".$secret."')");

	$resultData = mysqli_query($con, "SELECT user_id FROM djdemocracy.users WHERE (user_name='".$user."')");
	$result = mysqli_fetch_array($resultData);

	$expire=time()+60*60*24*30;
	setcookie('djdemocracy', $result["user_id"], $expire);
	echo "1";
	echo "<script language = \"JavaScript\">
		window.location=\"home_single_page.php#home\";
		</script>";
} else {
	echo "2";
	echo "<script language = \"JavaScript\">
		window.location=\"userExists.php\";
		</script>";
}
?>
<table>
	<tr>
		<td>
			<img src="back.jpg" id="back" width="200" height="100">
		</td>
		<td>
			<img src="logo.jpg" id="logo" width="300" height="100">
		</td>
		<td id="current"><?php echo "Hello, $user";?>
		</td>
	</tr>
	<tr>	
		<td colspan="3" id="content"></td>
	</tr>
</table>
</body>
</html>
