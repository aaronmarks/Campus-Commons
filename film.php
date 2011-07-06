<?php
include 'include/commonTop.php';
$filmId = $_REQUEST['id'];
util::increaseViews($filmId, "film");
$sql = "select type, host_id, title, account_id from video where video_id=$filmId";
$rec = util::executeQuery($sql, "");
$type = $rec[1][0];
$host_id = $rec[1][1];
$title = $rec[1][2];
$accountId = $rec[1][3];
$sql = "select name, bio, prof_path from accounts where account_id=$accountId";
$rec = util::executeQuery($sql, "");
$name = $rec[1][0];
$bio = $rec[1][1];
$prof_path = $rec[1][2];
$firstName = explode(" ", $name);
$firstName = $firstName[0];
$portPhotos = util::getUserPics($accountId, "photo");

$WIDTH = 600;
$HEIGHT = $WIDTH * .60;
?>

<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="css/photo.css" />
</head>

<div id='container'>

<div id='leftHalf'>
<h2><span id='title'><?=$title?></span></h2>
<?php util::showVideo($type, $host_id, $WIDTH, $HEIGHT )?>
</div>

<div id='rightHalf'>
<a href='/commons/profile.php?id=<?=$accountId?>'>
<img style='float:left;padding-right:20px;margin-top:20px' height=80px width=80px src=<?=$prof_path?>>	
<h3><?=$name?></a></h3>

<p>
<?=$bio?>
</p>

<h4>Other photos by <?=$firstName?>:</h4>
<table id='userGallery'>
<tr>
<?php
for($i=0;$i<count($portPhotos);$i++)
{
	echo "<td>";
	echo "<a href='/commons/photo.php?id=".$portPhotos[$i][1]."'><img height='65px' width='65px' src='/commons/".$portPhotos[$i][0]."' /></a>";
	echo "</td>";
	if($i == 2 || $i == 5) echo "</tr><tr>";
}
?>
</tr>
</table>

</div>