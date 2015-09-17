// generic ajax call for data, just add source and profit
var c = 0;
var a;
var t;
function getData(source, cb) {
	var returnData, xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
			cb(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET",source,true);
	xmlhttp.send();
}
function update() {
	"use strict";
	getData("newChart.php", loadCharts);
	getData("update.php", current);
	if (c === 600) {
		for(var i = 0; i< a; i++){
			document.getElementById('a'+i).remove();
		}
		document.getElementById('artists').innerHTML='';
		getData("lib.json", loadLib);
	}
}
function current(curr) {
	curr = JSON.parse(curr);
	var cur = document.getElementById("current"), newest = document.getElementById("recentVote");
	cur.innerHTML = curr[0].text;
	cur.setAttribute('sid', curr[0].sid);
	cur.onclick = function () {	window.location.href = "#vote";	getData("voteProc.php?song_id=" + this.getAttribute('sid'), voteFor); };
	newest.innerHTML = curr[1].text;
	newest.setAttribute('sid', curr[1].sid);
	newest.onclick = function () { window.location.href = "#vote"; getData("voteProc.php?song_id=" + this.getAttribute('sid'), voteFor); };
}
Element.prototype.remove = function () {
    this.parentElement.removeChild(this);
}
function loadLib(db) {
	db = JSON.parse(db);
	a = db.length;
	var artists = document.getElementById("artists");
	var body = document.getElementById("body");
	for (var i=0; i<db.data.length; i++) {
		var artistEntry = new makeDiv("entry", "e"+i, db.data[i].artist);
		artistEntry.onclick=function() {window.location.href="#"+this.id.replace("e","a");};
		artists.appendChild(artistEntry);
		var currentArtist = new makeDiv("container", "a"+i, "");
		body.appendChild(currentArtist);
		for(j=0;j<db.data[i].song.length;j++) {
			var currentSong = new makeDiv("entry", db.data[i].song[j].id, db.data[i].song[j].tit);
			currentSong.onclick = function() {
				window.location.href="#vote";
				getData("voteProc.php?song_id="+this.id, voteFor);
			}
			currentArtist.appendChild(currentSong);
		}
	}
}
function setPage(db) {
	window.onhashchange = function () {clearTimeout(t)};
	var elem = document.getElementById("voteResult");
	elem.height=screen.width*(0.49);
	elem.width=screen.width*(0.49);
	getData("lib.json", loadLib);
	if(window.location.hash==='') {
		window.location.hash='#home';
	}
	var chart = document.getElementById("chart");
	for(var i = 0; i<25; i++) {
		var cElem = new makeDiv('entry', 'c'+i, '');
		chart.appendChild(cElem);
		cElem.setAttribute('sid', 0);
		cElem.onclick = function() {window.location.href="#vote";getData("voteProc.php?song_id="+cElem.getAttribute('sid'), voteFor);};
	}
	getData("newChart.php", loadCharts);
	var imgs = document.getElementsByClassName('img');
	for(var i = 0; i<imgs.length; i++) {
		imgs[i].height = screen.width/8;
	}
	setInterval(function(){update();},2000);
}
// returns a div with certain class, id, content
function makeDiv (className, id, content) {
	var elem = document.createElement("DIV");
	elem.className=className;
	elem.id = id;
	if(content!="")elem.appendChild(document.createTextNode(content));
	return elem;
}
function voteFor (result) {
		//document.getElementById("msg").appendChild(document.createTextNode('Hold On while we process your vote...'));
		document.getElementById("msg").innerHTML = 'Hold on while we process your vote...';
		var msg2;
		if(result==1) {
			document.getElementById("msg").innerHTML = 'Vote Submitted.';
			var randomWittiness = Math.floor(Math.random()*4)+1;
			if(randomWittiness==1) {
				msg2 = 'Music for the people, by the people.';
			} else if(randomWittiness==2) {
				msg2 = 'Music to the people.';
			} else if(randomWittiness==3) {
				msg2 = 'Excercise your right to have a good time.';
			} else if(randomWittiness==4) {
				msg2 = 'Good music for the greater good.';
			}
			document.getElementById("msg2").innerHTML = msg2;
		} else if(result==0) {
			document.getElementById("msg").innerHTML = 'You can only vote for a song once until it plays';
		}
		drawResult(result);
		t = setTimeout(function() {window.history.back();},2000);
}
function drawResult (result) {
	var elem = document.getElementById("voteResult");
	var size = document.getElementById("voteResult").height;
	var center = size/2;
	var draw = elem.getContext("2d");
	draw.clearRect(0, 0, elem.width, elem.height);
	draw.webkitImageSmoothingEnabled=true;
	draw.lineCap = "round";
	draw.strokeStyle = "#FFFFFF";
	draw.beginPath();
	draw.arc(center, center, center, 0, 2 * Math.PI, false);
	draw.fillStyle = (result==0)?"#FF0000":"#00FF00";
	draw.fill();
	draw.lineWidth=5;
	draw.stroke();
	draw.lineCap = "square";
	if(result==0) {
		draw.lineWidth = (screen.width*(98/100)/1080)*120;
		var Location = [0,elem.height];
		draw.lineWidth = (screen.width*(98/100)/1080)*120;
		draw.strokeStyle = "#000000";
		draw.beginPath();
		draw.moveTo(Location[0], Location[0]);
		draw.lineTo(Location[1], Location[1]);
		draw.stroke();
		draw.beginPath();
		draw.moveTo(Location[1], Location[0]);
		draw.lineTo(Location[0], Location[1]);
		draw.stroke();
	} else if(result==1) {
		var xLocation = [elem.height/8,(elem.height/2)-((screen.width/1080)*20), (elem.height/2), elem.height];
		var yLocation = [elem.height*5/8, elem.height*13/16, elem.height*13/16, elem.height*3/16];
		draw.lineWidth = (screen.width*(98/100)/1080)*120;
		draw.strokeStyle = "#FFFFFF";
		for(var i = 0; i<4; i++) {
			draw.beginPath();
			draw.moveTo(xLocation[i], yLocation[i++]);
			draw.lineTo(xLocation[i], yLocation[i]);
			draw.stroke();
		}
	}
}
// runs search
function check (params) {
	document.getElementById("searchSongs").innerHTML = '';
	document.getElementById("searchArtists").innerHTML = '';
	var find = (params!==null)?'hideS':'showS';
	var next = (params!==null)?'showS':'hideS';
	if(params.length>2) {
		var elem = document.getElementsByClassName(find);
		for(var i = 0; i<elem.length; i++) {
			elem.className = next;
		}
		getData("newSearch.php?q="+params, search);
	}
}
function search (result) {
	result = JSON.parse(result);
	var artist = document.getElementById("searchArtists");
	var song = document.getElementById("searchSongs");
	for(var i = 0; i<result.artists.length; i++) {
		var elem = new makeDiv("entry","sa"+result.artists[i].aid,result.artists[i].artist);
		elem.onclick = function() {
			window.location.href="#a"+this.id.substring(2,this.id.length);
		}
		artist.appendChild(elem);
	}
	//document.getElementById("searchArtists").innerHTML = artist;
	for(var i = 0; i<result.songs.length; i++) {
		var elem = new makeDiv("entry","ss"+result.songs[i].sid,result.songs[i].song+" by "+result.songs[i].artist);
		elem.setAttribute('sid', result.songs[i].sid);
		elem.onclick = function() {window.location.href="#vote";getData("voteProc.php?song_id="+elem.getAttribute('sid'), voteFor);};
		song.appendChild(elem);
	}
	//document.getElementById("searchSongs").innerHTML = song;
}
// loads charts
function loadCharts(chart) {
	if(chart) {
		chart = JSON.parse(chart);
		for(var i = 0; i<chart.result.length; i++) {
			if(document.getElementById('c'+i).getAttribute('sid')!=chart.result[i].sid)
				chartElem(i, chart.result[i].sid, chart.result[i].song + " by " +chart.result[i].artist+"<br>votes: "+chart.result[i].count);
		}
		if(chart.result.length<25) {
			for(var i = chart.result.length; i<25; i++) {
				chartElem(i, 0, "");
			}
		}
	}
}
function chartElem(id, sid, text) {
	var elem = document.getElementById('c'+id);
	elem.innerHTML = text;
	elem.setAttribute('sid', sid);
	elem.ClassName = (sid===0)?"display:none;":"display:block";
}