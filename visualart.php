<?php
include 'include/commonTop.php';
$visualartId = $_REQUEST['id'];
util::increaseViews($visualartId, "visualart");
$sql = "select file_path, title, account_id from visualart where visualart_id=$visualartId";
$rec = util::executeQuery($sql, "");
$src = $rec[1][0];
$title = $rec[1][1];
$accountId = $rec[1][2];

$size = getimagesize($src);
if($size[0] > 600) //Scale width
{
	$width = "600";
	$height = (600/$size[0]) * $size[1];
}
if($height>400) //Scale height
{
	$width = (400/$height) * $width;
	$height = 400;
}

$sql = "select name, bio, prof_path from accounts where account_id=$accountId";
$rec = util::executeQuery($sql, "");
$name = $rec[1][0];
$bio = $rec[1][1];
$prof_path = $rec[1][2];
$firstName = explode(" ", $name);
$firstName = $firstName[0];

$portPhotos = util::getUserPics($accountId, "visualart");
?>

<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="css/photo.css" />
</head>

<div id='container'>

<div id='leftHalf'>
<h2><span id='title'><?=$title?></span></h2>
<img width='<?=$width?>px' height='<?=$height?>px' src='/commons/<?=$src?>'/>
</div>

<div id='rightHalf'>
<a href='/commons/profile.php?id=<?=$accountId?>'>
<img style='float:left;padding-right:20px;margin-top:20px' height=80px width=80px src=<?=$prof_path?>>	
<h3><?=$name?></a></h3>

<p>
<?=$bio?>
</p>

<h4>Other art by <?=$firstName?>:</h4>
<table id='userGallery'>
<tr>
<?php
for($i=0;$i<count($portPhotos);$i++)
{
	echo "<td>";
	echo "<a href='/commons/visualart.php?id=".$portPhotos[$i][1]."'><img height='65px' width='65px' src='/commons/".$portPhotos[$i][0]."' /></a>";
	echo "</td>";
	if($i == 2 || $i == 5) echo "</tr><tr>";
}
?>
</tr>
</table>

</div>