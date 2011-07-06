<?php
include 'include/commonTop.php';
$page = $_REQUEST['p'];
$limit = $page * 6;
$WIDTH = 325;
$HEIGHT = $WIDTH * .60;
$sql = "select video_id, type, host_id, title, name, video.account_id, views from video join accounts order by views desc limit $limit";
$rec = util::executeQuery($sql, "");

for($i=$limit-5;$i<$limit+1 && $i<count($rec);$i++)
{
	$films[$i-$limit+5]["id"] = $rec[$i][0];
	$films[$i-$limit+5]["type"] = $rec[$i][1];
	$films[$i-$limit+5]["host_id"] = $rec[$i][2];
	$films[$i-$limit+5]["title"] = $rec[$i][3];
	$films[$i-$limit+5]["name"] = $rec[$i][4];
	$films[$i-$limit+5]["accountId"] = $rec[$i][5];
	$films[$i-$limit+5]["views"] = $rec[$i][6];
}

?>

<head>
	<title>Film</title>
	<link rel="stylesheet" type="text/css" href="css/filmpage.css">
</head>
<br>

<div id='wrapper'>
	
<h2>
	New Film
</h2>
<br>
<table id='vidTable'>
<tr>
<?php
for($i=0;$i<count($films);$i++)
{
	echo "<td>";
	
	if($films[$i]["type"] == "vimeo")
	{
		util::showVideo("vimeo", $films[$i]["host_id"], $WIDTH, $HEIGHT);
	}
	else
	{
		util::showVideo("youtube", $films[$i]["host_id"], $WIDTH, $HEIGHT);
	}
	echo "<br /><br />";
	echo "<a href=film.php?id=".$films[$i]["id"].">";
	echo $films[$i]["title"];
	echo "</a>";
	echo "<br /><a href=profile.php?id=".$films[$i]["accountId"].">" . $films[$i]["name"] . "</a>";
	
	echo ($i == 2) ? "<tr />" :  "";
	echo "</td>";
	
}
?>
</td>
</tr>
</table>
</div>

<div id='nextPrevious'>
	<?php

	$prevPage = $page-1;
	$nextPage = $page+1;

	$sql = "select photo_id from photos order by views desc";
	$rec = util::executeQuery($sql, "");
	$doNext = ($rec[count($rec)-1][0] != $photos[count($photos)-1]["id"]) ? true : false;

	echo ($page != 1) ? "<a style='float:left;' href=filmPage.php?p=$prevPage>Previous</a>" : "";
	echo $doNext ? "<a style='float:right;' href='filmPage.php?p=$nextPage'>Next</a>" : "";
	?>
</div>
