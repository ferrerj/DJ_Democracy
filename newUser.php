<html>
<head>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
<title>
DJ Democracy - Music to the People!
</title>
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
tr{
font-size:70px;
text-align:center;
}
input[type="text"], input[type="password"]{
padding: 0px;
text-align:center;
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size: 70px;
width: 100%;
height: 50%;
margin-left: auto;
margin-right: auto;
background-color:#f2f2f2;
}
form{
font-size:70px;
font-family: 'Impact', Helvetica, Arial, sans-serif;
text-align:center;
}

#join
{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size: 70px;
padding: 5%;
}
</style>
</head>
<body onload="drawLogo()">
<table>
	<tr>
		<td>
			<a href="index.php">
			<canvas id='logo'></canvas>
			</a>
		</td>
	</tr>
</table>
<br><br>
<form action="processNewUser.php" method="POST" align="center">
	<table align="center">
		<tr>
			<td>
				DJ Name: <input type="text" name="user"id="user" /></br></br>
			</td>
		</tr>
		<tr>
			<td>
				Password: <input type="password" name="password" id="password" /></br></br>
			</td>
		</tr>
		<tr>
			<td>
				<span align="justify">Enter a word or phrase for password recovery:</span></br>
				<input type="text" name="secret" id="secret" /></br></br>
			</td>
		</tr>
		<tr>
			<td>
				<input id="join" type="submit" value="Join" width="40%" />
			</td>
		</tr>
	</table>
</form>
</body>
</html>