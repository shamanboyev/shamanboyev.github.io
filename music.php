<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<?php
		$size = array();
if (isset($_REQUEST['playlist'])) {
	$songs = array();
	$playlists = array();
 $tracks = file($_REQUEST['playlist'], FILE_IGNORE_NEW_LINES);
 foreach($tracks as $track){
 	if(strpos($track, "#") !== 0){
 		$temptrack =  "songs/" . $track; // songs/Hello.mp3
 		$songs[] = $temptrack;
}
}
}
else{
	$songs = glob("songs/*.mp3");
	$playlists = glob("songs/*.m3u");
}

if (isset($_REQUEST['shuffle'])) {
	shuffle($songs);
}
?>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
			<a href ="music.php" style="font-weight: bold; float: center;">Home</a>
		</div>
		<div id="listarea">

			<ul id="musiclist">
				<?php
                    foreach($songs as $song){
                   $size = filesize($song);
                   if ($size <= 1023){
						$size = $size . " B";
					}elseif ($size<= 1048575){
						$size = round($size/1024, 2) . " KB";
					}elseif ($size >= 1048575){
						$size = round($size/1048575,2) . "MB";
					}
				?>
				<li class="mp3item">
<a href = "<?= $song ?>"> <?= basename($song) ?> </a> <?= $size ?>
				<?php
				}
					?>
				</li>
				<?php
                    foreach($playlists as $playlist){
				?>
				<li class="playlistitem">
<a href = "music.php?playlist=<?php echo $playlist ?>"> <?php echo basename($playlist) ?> </a>
					<?php
				}
					?>
				</li>
			</ul>
		</div>
		<a href ="music.php?shuffle=on" style="font-weight: bold;">Shuffle</a>
	</body>
</html>
