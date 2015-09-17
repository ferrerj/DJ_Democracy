<?php
if(!isset($_COOKIE["djdemocracy"])){header( 'Location: index.php');}
?>
<html>
<head>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi"  charset="utf-8">
<?php
if(strpos($_SERVER['HTTP_USER_AGENT'], 'iphone')!==FALSE||strpos($_SERVER['HTTP_USER_AGENT'], 'ipod')!==FALSE||strpos($_SERVER['HTTP_USER_AGENT'], "ipad")!==FALSE){
	echo '<link rel="stylesheet" type="text/css" href="DJ_Iphone.css">';
} else {
	echo '<link rel="stylesheet" type="text/css" href="DJ_android.css">';
}
?>
<script src="dj_hidden.js"></script>
</head>
<body id="body" onload="setPage();">
<div id="menu" class="menu" style="z-index:1">
	<div id="current" class="entry">Current Song:</div>
	<div id="recentVote" class="entry">Most Recent Vote:</div>
</div>
<div class='header' style="z-index:2;">
	<a href="#home"><img src="logo.png" style="height:100%"></a>
	<a href="#menu"><img src="menu.png" style="height:100%;right:0px"></a>
</div>
<div id="home" class="container">
	<div class="img">
	<a href="#artists"><img src="artist.png" style="width:49%"></a>
	<a href="#chart"><img src="chart.png" style="width:49%" onclick="loadCharts();"></a>
	</div>
	<div class="img">
	<a href="#search"><img src="search.png" style="width:49%"></a>
	<a href="logout.php"><img src="logout.png" style="width:49%"></a>
	</div>
</div>
<div id="artists" class="container"></div>
<div id="chart" class="container"></div>
<div id="vote" class="container">
	<div id="msg" class="entry"></div>
	<canvas id="voteResult" style="display: block;margin-left: auto;margin-right: auto;"></canvas>
	<div id="msg2" class="entry"></div>
</div>
<div id="search" class="container">
	<form class="entry" id="bar" style="text-align:center;display:block;margin-left:auto;margin-right:auto;"><input type="text" size="30" onkeyup="check(this.value)"></form>
	<div style="display:block;">
		<div class="hideS" style="display:block;">Artists:</div>
		<div id="searchArtists" style="display:block;"></div>
		<div class="hideS" style="display:block;">Songs:</div>
		<div id="searchSongs" style="display:block;"></div>
	</div>
</div>
</body>
</html>