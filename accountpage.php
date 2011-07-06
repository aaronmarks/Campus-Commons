<?php
include 'include/commonTop.php';
$sql = "select name, bio, email, prof_path from accounts where account_id=".$_SESSION['account_id'];

$rec = util::executeQuery($sql, "");
$name = ($rec[1][0] == "") ? "Your name" : $rec[1][0];
$bio = ($rec[1][1] == "") ? "Tell us about yourself..." : $rec[1][1];
$email = $rec[1][2];
$pic_path = $rec[1][3];

// make a note of the current working directory relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form
$max_file_size = 3000000000; // size in bytes
?>

<head>
<link rel="stylesheet" href="css/accountpage.css">
<title>Account</title>
</head>
<body>

<div id="container">

<div id="theForm"> 

<br/>
<br/>

<div id="content">
	<p>Update your profile:</p>
</div>
<table id='accountForm'>
<form id="Upload" action="upload.account.processor.php" enctype="multipart/form-data" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="300000000000">
	
	<tr>
	<td><label for="name">Name: </label></td>
	<td><input type="text" name="name" value="<?=$name?>"></td>
	</tr>
	
	<tr><td>Email: </td><td><span style='color:#555555'><?=$email?></span></td></tr>
	
	<tr>
	<td><label for="bio">Bio: </label></td>
	<td><textarea cols="40" rows="5" name="bio" value=><?=$bio; ?></textarea></td>
	</tr>
	
	<tr>
		<td><label for="file">Profile picture:</label></td>
		<td><input id="file" type="file" name="file"></td>
		<?php if($pic_path !="") echo "<td><img width=100px height=100px src='".$pic_path."'></td>";?>
	</tr>
	
	<tr>
		<td><input id="submit" type="submit" name="submit" value="Save Profile"></td>
	</tr>

</form>

</body>
</html>


