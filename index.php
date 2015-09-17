<?php
if(isset($_COOKIE["djdemocracy"])){
header( 'Location: home.php');
}
?>
<html>
<head>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
<title>
DJ Democracy - Music to the People!
</title>
<script>
function drawLogo(){
	var canvas = document.getElementById('logo');
	canvas.height = (screen.width*(95/100))/4;
	canvas.width = (screen.width*(95/100));
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
	draw.font=draw.font = (((screen.width*(95/100))/1080)*45)+"px Impact";
	draw.fillText("Vote For", center6, center3);
	draw.fillText("Music", center3, (center+(center2*3.5)));
	draw.font= (((screen.width*(95/100))/1080)*115)+"px Impact";
	draw.fillStyle = 'blue';
	draw.fillText("DJ", (canvas.height), center-center2);
	draw.fillStyle = 'red';
	draw.fillText("Democracy", (canvas.height), (center+(center3)));
	localstorage.setItem('logo', canvas.toDataURL());
	var elements = document.getElementsByClassName("tagLine");
	for (var i in elements){
	  if (elements.hasOwnProperty(i)){
		elements[i].style.fontSize = (((screen.width*(95/100))/1080)*70)+"px";
		elements[i].style.textAlign = "center";
		elements[i].style.color="blue";
	  }
	}
	var theRules = new Array();
	var theRulesTwo = new Array();
	if (document.styleSheets[0].cssRules){
		theRules = document.styleSheets[0].cssRules;
	} else if (document.styleSheets[0].rules){
		theRules = document.styleSheets[0].rules;
	}
	theRules[0].style.width = (((screen.width*(95/100))/1080)*900)+"px";
	theRules[0].style.length = (((screen.width*(95/100))/1080)*100)+"px";
	/*theRules[0].style.fontSize = (((screen.width*(95/100))/1080)*70)+"px";
	theRules[1].style.fontSize = (((screen.width*(95/100))/1080)*70)+"px";
	theRules[2].style.fontSize = (((screen.width*(95/100))/1080)*70)+"px";
	theRules[3].style.fontSize = (((screen.width*(95/100))/1080)*70)+"px";*/
	document.getElementById('bot').style.Top = document.getElementById('theForm').offsetBottom;
}
</script>
<style>
input[type="text"], input[type="password"]{
padding: 0px;
text-align:center;
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size: 1.5em;
width: 100%;
margin-left: auto;
margin-right: auto;
background-color:#f2f2f2;
}
input[type="submit"]{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-size:1em;
}
form{
/*font-size: 2em;*/
font-family: 'Impact', Helvetica, Arial, sans-serif;
width: 100%;
height: 50%;
text-align:center;
align:center;
}
.tagLine{
font-family: 'Impact', Helvetica, Arial, sans-serif;
font-align:center;
align:center;
}
td{
font-size:3em;
font-family: 'Impact', Helvetica, Arial, sans-serif;
text-align:center;
align:center;
}
<?php
/*if(strpos($_SERVER['HTTP_USER_AGENT'], "iPhone")!==false||strpos($_SERVER['HTTP_USER_AGENT'], "iPad")!==false||strpos($_SERVER['HTTP_USER_AGENT'], "Chrome")!==false){
echo '#bot{
margin-top: 20%;
bottom:0;
}';
}*/
?>
</style>
</head>
<body onload="drawLogo()">
<table align="center">
	<tr>	
		<td>
			<canvas id='logo'></canvas>
		</td>
	</tr>
	<tr>
		<td class="tagLine">
			Music for the people</br>By the people
		</td>
	</tr>
</table>
<form  method="post" action="login.php" align="center" id="theForm">
<table align="center">
	<tr>
		<td>	
			DJ Name:<input type="text" name="user" class="box" /></br>
		</td>
	</tr>
	<tr>
		<td>
			Password: <input type="password" name="password" class="box"/></br>
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit">
		</td>
	</tr>
</table>
</form>
<table align="center" id="bot">
	<tr>
		<td>
			</br>
			<a class="tagLine" href="newUser.php">Create an Account</a>
		</td>
	</tr>
</table>
</body>
</html>