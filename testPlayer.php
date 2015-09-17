<html>
<head>
<title>
DJ Democracy - Music to the People!
</title>
<script type="text/javascript">
	// global var for aMachine in DOM
	var active;
	function init(){
		var aMachine = document.getElementById("aMachine");
		var bMachine = document.getElementById("bMachine");
		var vox = document.getElementById("vo");
		// this will set up interval to check song status
		// and load next song
		active = 0;
		serverUpdate("aMachine", "playerProc.php");
		//setTimeout(function(){aMachine.play();};, 500);
		aMachine.play();
		setInterval(function(){songProc();}, 1000);
	}
	function songProc(){
		var aMachine = document.getElementById("aMachine");
		var bMachine = document.getElementById("bMachine");
		if(active==0){
			// check status of aMachine and get next song and start bMachine if < 5s remaining
			if((aMachine.duration-aMachine.currentTime)<=5){
				// add fades, check for voice over later
				serverUpdate("bMachine", "playerProc.php");
				bMachine.play();
				setTimeout(function(){serverUpdate("vo", "voProc.php"); vox.play();}, 1000);
				active = 1;
				setTimeout(function(){aMachine.pause();}, 5500);
			}
		} else if(active==1){
			// do the same but switch to aMachine when < 5s remaining
			if((bMachine.duration-bMachine.currentTime)<=5){
				// add fades, check for voice over later
				serverUpdate("aMachine", "playerProc.php");
				aMachine.play();
				setTimeout(function(){serverUpdate("vo", "voProc.php"); vox.play();}, 1000);
				active = 0;
				setTimeout(function(){bMachine.pause();}, 5500);
			}
		}
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
	function nextSong(){
		serverUpdate("aMachine", "playerProc.txt");
	}
	function update(){
		serverUpdate("skipmsg", "skip.txt");
		serverUpdate("pausemsg", "pause.php");
		setTimeout(function(){update();}, 500);
	}

</script>
</head>
<body onload="init();">
	<audio controls id='aMachine'></audio></br></br>
	<audio controls id='bMachine'></audio></br></br>
	<audio controls id='vo'></audio>
	<h2 id='skip'></h2>
	<h2 id='pause'></h2>
	</br>
</body>
</html>