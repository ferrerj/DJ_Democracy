<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
<script>
function drawLogo(){
	var canvas = document.getElementById('logo');
	canvas.height = screen.width/4;
	canvas.width = screen.width;
	var center = canvas.height/2;
	var center2 = center/6;
	var center3 = (center-2.375*center2);
	var center4 = (center-3*center2);
	var center5 = (center-(4*center2));
	var center6 = (center-(3*center2));
	var draw = canvas.getContext('2d');
	draw.webkitImageSmoothingEnabled=true;
	draw.lineCap = 'round';
	draw.strokeStyle = '#FFFFFF';
	for(var k=0; k<2; k++){
		draw.beginPath();
		draw.arc(center, center, ((k==0)?center:center2), 0, 2 * Math.PI, false);
		draw.fillStyle = (k==0)?'black':'white';
		draw.fill();
		draw.lineWidth=5;
		draw.stroke();
	}
	draw.font=draw.font = ((screen.width/1080)*45)+"px Impact";
	draw.fillText("Vote For", center6, center3);
	draw.fillText("Music", center3, (center+(center2*3.5)));
	draw.font= ((screen.width/1080)*115)+"px Impact";
	draw.fillStyle = 'blue';
	draw.fillText("DJ", (canvas.height), center-center2);
	draw.fillStyle = 'red';
	draw.fillText("Democracy", (canvas.height), (center+(center3)));
}
</script>
<style>
.tagLine{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size:5em;
font-align:center;
align:center;
}
input[type="text"], input[type="password"]{
padding: 0px;
text-align:center;
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size: 2em;
width: 100%;
height: 50%;
margin-left: auto;
margin-right: auto;
background-color:#f2f2f2;
}
input[type="submit"]{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size: 1.5em;
}
form{
font-size: 4em;
font-family: 'Impact', Helvetica, Arial, sans-serif;
width: 100%;
height: 50%;
text-align:center;
align:center;
}
.msg{
font-size:4em;
font-family: 'Impact', Helvetica, Arial, sans-serif;
text-align:center;
align:center;
}
.song{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size:5em;
text-align:center;
}
</style>
</head>
<body onload='drawLogo();'>
<table>
	<tr>
		<td>
			<canvas id='logo'></canvas>
		</td>
	</tr>
	<tr align="center">
		<td class="tagLine">
			Music for the people</br>By the people
		</td>
	</tr>
	<tr>	
		<td align="center">
			<span class="msg">Your username or password was incorrect,</br>
			please try again or create a new account</br></span>
			<form method="post" action="login.php">
			Username: <input type="text" name="user" id="user"><br>
			Password: <input type="text" name="password" id="password"></br>
			<input type="submit">
			</form></br>
			<a href="newUser.php" class="msg">Create an Account</a></br>
			<a href="recoverPassword.php" class="msg">Forgot your password?</a>
		</td>
	</tr>
</table>
</body>
</html>
