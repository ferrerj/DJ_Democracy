<?php
set_time_limit(60*60);
// scan the music directory
$dirs    = 'music/';
$file1 = scandir($dirs);
$artist = sizeof($file1);
//go through all the artist folders
for($i = 2; $i < $artist; $i++){
	// get all files in current artist folder
	$currentDirs = "music/".$file1[$i];
	$file2 = scandir($currentDirs);
	$song = sizeof($file2);
	for($j = 2; $j < $song; $j++){
		$currentSubDirs = $currentDirs."/".$file2[$j];
		// if the current subdir file is a directory then scan it and 
		if(is_dir($currentSubDirs)){
			//echo "ROBOCOPY 'C:\\xampp\\htdocs\\music\\".$files1[$i]."\\".$files2[$j]."\\*.*' 'C:\\xampp\\htdocs\\music\\".$files1[$i]."'"."<br>";
			exec("ROBOCOPY \"C:\\xampp\\htdocs\\music\\".$file1[$i]."\\".$file2[$j]."\" \"C:\\xampp\\htdocs\\music\\".$file1[$i]."\" /s /move");
			exec('RMDIR \'C:\\xampp\\htdocs\\music\\'.$file1[$i].'\\'.$file2[$j].'\' /S');
		}
	}
}

?>