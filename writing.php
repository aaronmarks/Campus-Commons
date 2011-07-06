<?php
include 'include/commonTop.php';
$writingId = $_REQUEST['id'];
util::increaseViews($writingId, "writing");
$sql = "select text, title, account_id from writing where writing_id=$writingId";
$rec = util::executeQuery($sql, "");
$text = $rec[1][0];
$title = $rec[1][1];
$accountId = $rec[1][2];

$sql = "select name, bio, prof_path from accounts where account_id=$accountId";
$rec = util::executeQuery($sql, "");
$name = $rec[1][0];
$bio = $rec[1][1];
$prof_path = $rec[1][2];
$firstName = explode(" ", $name);
$firstName = $firstName[0];

$portPhotos = util::getUserPics($accountId, "photo");
?>

<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="css/photo.css" />
</head>

<div id='container'>

<div id='leftHalf'>
<h2><span id='title'><?=$title?></span></h2>
<?=$text?>
<br><br>
</div>

<div id='rightHalf'>
<a href='/commons/profile.php?id=<?=$accountId?>'>
<img style='float:left;padding-right:20px;margin-top:20px' height=80px width=80px src=<?=$prof_path?>>	
<h3><?=$name?></a></h3>

<p>
<?=$bio?>
</p>

<h4>See other work by <a href='profile.php?id=<?=$accountId;?>'><u><?=$firstName?>.</a></u></h4>
</div>
