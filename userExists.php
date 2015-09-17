<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=false;">
<title>
DJ Democracy - Music to the People!
</title>
<style>
#join
{
width:75px;
height:35px;
}
</style>
</head>
<body>
<table>
	<tr>
		<td>
			<img src="back.jpg" id="back" width="200" height="100">
		</td>
		<td>
			<img src="logo.jpg" id="logo" width="300" height="100">
		</td>
		<td id="current">Home
		</td>
	</tr>
	<tr>	
		<td colspan="3" id="content">
			User Name already exists. Please try again!
			<form action="processNewUser.php" method="POST" align="center">
				Username: <input type="text" name="user"id="user" /><br>
				Password: <input type="password" name="password" id="password" /></br>
				<span align="justify">Enter a word or phrase for password recovery, like your dogs name, best friends name, or something else you are likely to remember that is not your password:</span></br>
				<input type="text" name="secret" id="secret" /></br></br>
				<input id="join" type="submit" value="Join" width="40%" />
			</form>
			</br>
		</td>
	</tr>
</table>
</body>
</html>
