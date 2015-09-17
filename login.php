<?php
 $con = mysqli_connect("localhost", "dbadmin", "password", "djdemocracy") or die('Could not connect: ' . mysqli_connect_error());
 //mysql_select_db("djdemocracy") or die(mysql_error());

$user = $_REQUEST["user"];
$password = $_REQUEST["password"];

// this page asks users for signin info then directs them to the index to check
$resultData = mysqli_query($con, "SELECT user_id, user_name, password FROM djdemocracy.users WHERE ((user_name='".mysql_real_escape_string($user)."') AND (password='".mysql_real_escape_string($password)."'))");
$result = mysqli_fetch_array($resultData);
if($result['user_id']!=NULL){
	$expire=time()+60*60*24*30;
	setcookie('djdemocracy', $result["user_id"], $expire);
} 
?>
<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
<script>
function setDB(){
		// create banner
		var title = ["Vote For", "Music", "DJ", "Democracy"];
		var button = [document.getElementById("logo"), document.getElementById("menuButton")];
		center = (1080*(95/100))/4;
		center2 = center/6;
		center3 = (center-2.375*center2);
		center4 = (center-3*center2);
		center5 = (center-(3.65*center2));
		center6 = (center-(4.75*center2));
		button[0].height = ((1080*(95/100))/4);
		button[0].width = (button[0].height)*3.2;
		center = button[0].height/2;
		center2 /= 2;
		center3 /= 2;
		center4 /= 2;
		center5 /= 2;	
		draw = button[0].getContext('2d');
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
		draw.font= ((1080*(95/100)/1080)*45)+"px Impact";
		draw.fillText(title[0], center6, center3);
		draw.fillText(title[1], center3, (center+(center2*3.5)));
		draw.font= ((1080*(95/100)/1080)*115)+"px Impact";
		draw.fillStyle = 'blue';
		draw.fillText(title[2], (button[0].height), center-center2);
		draw.fillStyle = 'red';
		draw.fillText(title[3], (button[0].height), (center+(center3)));
		// draw menu button	
		button[1].height = button[0].height;
		button[1].width = (1080*(95/100))-button[0].width;
		var height = button[1].height;
		var width = button[1].width;
		draw = document.getElementById("menuButton").getContext("2d");
		draw.lineWidth = (1080*(95/100)/1080)*65;
		var heights = [(height/2), (height*8/10), (height/10), (height*2/5)];
		var widths = [(width/6), (width*5/6), (width/2)+(width/10), (width/2)-(width/10)];
		for(var i = 0; i<4; i++){
			draw.beginPath();
			draw.moveTo(widths[(i%3)?0:1], heights[(i<2)?0:2]);
			draw.lineTo(widths[(i%3)?2:3], heights[(i<2)?1:3]);
			draw.stroke();
		}
		var banner = document.getElementById("banner");
		banner.width = 1080*(95/100);
		banner.height = document.getElementById("logo").height;
		draw = banner.getContext("2d");
		var img_uri = document.getElementById("logo").toDataURL();
		var image = new Image();
		image.src =img_uri;
		draw.drawImage(image, 0, 0);
		img_uri= document.getElementById("menuButton").toDataURL();
		image = new Image();
		image.src =img_uri
		draw.drawImage(image, document.getElementById("logo").width, 0);
		var data = banner.toDataURL();
		localStorage.setItem('banner', data);
		// create home buttons
			// button names and elements
			var title = ['Artist', 'Chart', 'Search', 'Logout'];
			var button = [document.getElementById("artists"), document.getElementById("chart"), document.getElementById("search"), document.getElementById("logout")];
			// draw them, outer circle, inner circle then words
			for(var i = 0; i<4; i++){
				button[i].height = (screen.width*(95/100))/2;
				button[i].width = (screen.width*(95/100))/2;
				center = button[i].height/2;
				center2 = center/6;
				center3 = (center-2.375*center2);
				center4 = (center-3*center2);
				center5 = (center-(3.65*center2));
				center6 = (center-(4.75*center2));
				draw = button[i].getContext('2d');
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
				draw.font= ((screen.width*(95/100)/1080)*115)+"px Impact";
				if(i<2)draw.fillText(title[i], center4, center3); 
				if(i>1&&i<4)draw.fillText(title[i], center5, center3);
				//var data = ;
				localStorage.setItem(title[i], button[i].toDataURL());
			}
		// next page
		<?php
			if($result['user_id']==NULL){
				echo "window.location=\"badLogin.php\";";
			} else {
				if($result['user_id']==2){
					echo "window.location=\"player.php\";";
				} else {
					echo "window.location=\"home.php#home\";";
				}
			} 
		?>
}
</script>
</head>
<body onload="setDB()">
<table>
	<tr>
		<canvas id="logo" style="position:absolute;top:0;z-index:0"></canvas><canvas id="menuButton" style="position:absolute;top:0;z-index:0"></canvas>
		</br>
		<canvas id="banner" style="position:absolute;top:0;z-index:1"></canvas>
	</tr>
		<canvas id="artists" style="position:absolute;top:0;z-index:0"></canvas>
		<canvas id="chart" style="position:absolute;top:0;z-index:0"></canvas>
		<canvas id="search" style="position:absolute;top:0;z-index:0"></canvas>
		<canvas id="logout" style="position:absolute;top:0;z-index:0"></canvas>
	<tr>	
		<td>Loading...</td>
	</tr>
</table>
</body>
</html>
