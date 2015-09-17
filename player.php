<?php
if(isset($_COOKIE["djdemocracy"])){
	if($_COOKIE["djdemocracy"]!=2){
		header( 'Location: home.php');
	}
}
?>
<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
<script type="text/javascript">
	function loadNext(){
		window.location = "player.php";
	}
	function playNow(){
		document.getElementById('song').play();
	}
	function pauseNow(){
		document.getElementById('song').pause();
	}	
	function serverUpdate(id, file_name){
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText==0){
					playNow();
				} else if(xmlhttp.responseText==1){
					pauseNow();
				} else if(xmlhttp.responseText==2){
					update("pausemsg", "pause.php");
					loadNext();
				} else {
					document.getElementById(id).innerHTML=xmlhttp.responseText;
				}
			}
		}
		xmlhttp.open("POST",file_name,true);
		xmlhttp.send();
	}
	function update(){
		serverUpdate("skipmsg", "skip.txt");
		serverUpdate("pausemsg", "pause.php");
		setTimeout(function(){update();}, 500);
	}

</script>
</head>
<body onload="update();">
	<audio controls oncanplay="playNow()" onended="loadNext()" id='song'>
		<?php
			include('playerProc.php');
		?>
	</audio>
	<a href="player.php">Skip</a>
	<h2 id='skip'></h2>
	<h2 id='pause'></h2>
	</br>
</body>
</html>