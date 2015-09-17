<html>
<head>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
<?php
setcookie("djdemocracy", "", time()-3600);
?>
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
	setTimeout(function(){window.location='index.php';}, 2000);
}
</script>
<style>
td{
font-size:10em;
font-family: 'Impact', Helvetica, Arial, sans-serif;
text-align:center;
align:center;
}
</style>
</head>
<body onload='drawLogo();'>
<table>
	<tr>
		<td>
			<a href="index.php">
			<canvas id='logo'></canvas>
			</a>
		</td>
	</tr>
	<tr>	
		<td>
		Hope you had a good time!
		</td>
	</tr>
</table>
</body>
</html>