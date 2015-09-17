<?php
if(!isset($_COOKIE["djdemocracy"])){header( 'Location: index.php');}
?>
<html>
<head>
<meta id='vp' name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi"  charset="utf-8">
<title>
DJ Democracy - Music to the People!
</title>
<link rel="stylesheet" type="text/css" href="dj_democracy.css">
<script src="dj_single_page.js" type="text/javascript"></script>
</head>
<body id="body" onload="drawBanner();">
<div class='header' style="z-index:1;background:white;width=98%;height:25%">
	<img id="logo" onclick="history.pushState(null, null, '#home');setPage();">
<div id="main">
<form class="hide-class" id="bar" style="position:absolute;z-index:0;"><input type="text" size="30" onkeyup="check(this.value)"></form>
<table class="content" id="mainTable" style="position:absolute;z-index:0;" align="center"></table>
</div>
</body>
</html>