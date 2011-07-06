<?php
include 'include/commonTop.php';
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';
$max_file_size = 3000000000; // size in bytes

$_SESSION['soundcloud_url'] = $soundcloud_url;
?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/upload.css" />
	<title>Upload</title>
	<script>
		function unlockSubmit()
		{
			var a = document.getElementById('submit');
			a.disabled=0;
		}
	</script>
</head>
<body>
	<div id="container">
		<div id="top">
			<h1>Upload Your Work</h1>
			<?php if($_REQUEST['success']=="true") echo "<h2>Successful upload, dawg!</h2>";?>
			<ul id="menu">
				<li id="music">Music</li>
				<li id="visualart">Visual Art</li>
				<li id="film">Film</li>
				<li id="writing">Writing</li>
				<li id="photography">Photography</li>
			</ul>
			<span class="clear"></span>
		</div>
		<div id="loading">
		</div>
		<div id="content">
			<h2>Music</h2>
			<a href="<?= $soundcloud_url ?>">Sign in</a> to SoundCloud to upload your tunes!
		</div>
		<div id="footer">
		</div>
	</div>
	<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="js/upload.js"></script>
</body>
</html>
</body>
