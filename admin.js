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
function setTable(data) {
	var db = JSON.parse(data);
}
function makeDiv (className, id, content) {
	var elem = document.createElement("DIV");
	elem.className=className;
	elem.id = id;
	if(content!="")elem.appendChild(document.createTextNode(content));
	return elem;
}