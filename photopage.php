<?php include 'include/commonTop.php';
$page = $_REQUEST['p'];
$limit = $page * 6;
$sql = "select photo_id, file_path, title, name, views from photos join accounts order by views desc limit $limit";
$rec = util::executeQuery($sql, "");
for($i=$limit-5;$i<$limit+1 && $i<count($rec);$i++)
{
	$photos[$i-$limit+5]["id"] = $rec[$i][0];
	$photos[$i-$limit+5]["path"] = $rec[$i][1];
	$photos[$i-$limit+5]["title"] = $rec[$i][2];
	$photos[$i-$limit+5]["name"] = $rec[$i][3];
	$photos[$i-$limit+5]["views"] = $rec[$i][4];
}
?>

<HTML>
<head>
<link rel="stylesheet" href="css/photopage.css">
<title>Photographs</title>
</head>

<body>

<div id="center">
<br>
<h2>New Photographs</h2>
<br>

<table id='imageTable'>
<tr>
<?php
for($i=0;$i<count($photos);$i++)
{
	$rs = "";
	$size = getimagesize($photos[$i]["path"]);
	if( ($size[0] / $size[1]) > 1.3 && ($size[0] / $size[1]) < 1.7) //If the ratio of the image is about 1.5
		{
			$width = "300";
			$height = "200";
		}
	else
		{
			if($size[0] > $size[1]) //Width > height
			{
				$width = "300";
					$height = $size[1] * (300 / $size[0]);
			}
			else //Height > width
			{
				$rs = "resized";
				$height = "200";
				$width = $size[0] * (200 / $size[1]);
			}
		}
	$titleDif = 200 -$height;
	echo "<td><a href='/commons/photo.php?id=".$photos[$i]["id"]."'>";
	echo "<img class='$rs' width=$width height=$height src='".$photos[$i]["path"]."' /><br /><br />";
	echo $photos[$i]["title"]."</a><br />";
	echo $photos[$i]["name"]."</td>";
	if($i == 2) echo "</tr><tr>";
}
?>
</tr>
</table>

<div id='nextPrevious'>
<?php

$prevPage = $page-1;
$nextPage = $page+1;

$sql = "select photo_id from photos order by views desc";
$rec = util::executeQuery($sql, "");
$doNext = ($rec[count($rec)-1][0] != $photos[count($photos)-1]["id"]) ? true : false;

echo ($page != 1) ? "<a style='float:left;' href=photoPage.php?p=$prevPage>Previous</a>" : "";
echo $doNext ? "<a style='float:right;' href='photopage.php?p=$nextPage'>Next</a>" : "";
?>
</div>

</div>
<br>
<?php
include 'include/commonBottom.php'
?>
<br><br>
</body>
</html>