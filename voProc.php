<?php
//if(rand(0,9)==0){
	$vox = scandir('vo');
	echo "<source src=\"vo/".$vox[(rand(0, (sizeOf($vox)-2))+2)]."\" type=\"audio/mpeg\">";
//} else {
//	echo '';
//}
?>