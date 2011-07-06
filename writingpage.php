<?php include 'include/commonTop.php';
$page = $_REQUEST['p'];
$limit = $page * 6;
$sql = "select writing_id, text, title, name, views from writing join accounts order by views desc limit $limit";
$rec = util::executeQuery($sql, "");

for($i=$limit-5;$i<$limit+1 && $i<count($rec);$i++)
{
	$pieces[$i-$limit+5]["id"] = $rec[$i][0];
	$maxLength = (strlen($rec[$i][1]) > 300) ? 300 : strlen($rec[$i][1]);
	$pieces[$i-$limit+5]["text"] = substr($rec[$i][1], 0, $maxLength);
	$pieces[$i-$limit+5]["title"] = $rec[$i][2];
	$pieces[$i-$limit+5]["name"] = $rec[$i][3];
	$pieces[$i-$limit+5]["views"] = $rec[$i][4];
}

?>

<HTML>
<head>
<link rel="stylesheet" href="css/writingpage.css">
<title>Photographs</title>
</head>

<body>

<div id="center">
<br>
<h2>New Writing</h2>
<br>

<table id='piecesTable'>
<tr>
<?php
for($i=0;$i<count($pieces);$i++)
{
	echo "<td>";
	echo "<span class='text'><a href='/commons/writing.php?id=".$pieces[$i]["id"]."'><b>".$pieces[$i]["title"] . "</b><a><br />";
	echo "<span class='name'>by " . $pieces[$i]["name"]. "</span><br /><br />";
	echo $pieces[$i]["text"];
	echo "<a href='/commons/writing.php?id=".$pieces[$i]["id"]."'>...</a><br /><br />";
	echo "<a href='/commons/writing.php?id=".$pieces[$i]["id"]."'><i>Read more...</i></a></span>";
	if($i == 2) echo "</tr><tr>";
}
?>
</tr>
</table>

<div id='nextPrevious'>
<?php

$prevPage = $page-1;
$nextPage = $page+1;

echo ($page != 1) ? "<a style='float:left;' href=writingpage.php?p=$prevPage>Previous</a>" : "";
$minViews = $pieces[count($pieces)-1]["views"];
$sql = "select writing_id from writing where views<$minViews";
$rec = util::executeQuery($sql, "");
echo $rec[1][0] != 0 ? "<a style='float:right;' href='writingpage.php?p=$nextPage'>Next</a>" : "";
?>
</div>

</div>

<?php include 'include/commonBottom.php';?>
<br><br>
</body>
</html>