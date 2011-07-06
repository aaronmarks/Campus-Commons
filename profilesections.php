<?php 
include 'include/util.php';
session_start();
$accountId = $_SESSION['prof_id'];
?>
<div id="section_all">
	<table id="allTable"><tr>
	<?php
	$topItems = util::getTopTen($accountId);
		for($i=0;$i<count($topItems);$i++)
		{
			echo"<td>";
			switch($topItems[$i]["type"])
			{
				case("picture"):
					$dimensions=util::profileResize($topItems[$i]["src"]);
					echo "<a href='".$topItems[$i]["link"]."'>";
					echo "<img width=".$dimensions["width"]."px height=".$dimensions["height"]." src='".$topItems[$i]["src"]."'><br /><br />";
					echo $topItems[$i]["title"]."</a>";
					break;
				case("text"):
					echo "<span class='text' style='height:180px; text-align:left'>";
					echo strlen($topItems[$i]["src"]) < 200 ? $topItems[$i]["src"] : substr($topItems[$i]["src"], 0, 200);
					echo "<br /><br /><a href='".$topItems[$i]["link"]."'>".$topItems[$i]["title"]."</a>";
					echo "</span>";
					break;
				case("video"):
					$sql = "select type from video where host_id='".$topItems[$i]["src"]."'";
					$rec = util::executeQuery($sql, "");
					$type = $rec[1][0];
					util::showVideo($type, $topItems[$i]["src"], 220, 140);
					break;
			}
			echo "</td>";
			echo ($i ==2 || $i == 5) ? "</tr><tr>" : "";
		}
		?>
	</tr></table>
</div>

<div id="section_music">
</div>

<div id="section_visualart">
	<?php
	$sql = "select visualart_id, file_path, title from visualart where account_id=$accountId";
	$rec = util::executeQuery($sql, "");
	for($i=1;$i<count($rec);$i++)
	{
		$photos[$i-1]["id"] = $rec[$i][0];
		$photos[$i-1]["path"] = $rec[$i][1];
		$photos[$i-1]["title"] = $rec[$i][2];
	}
	?>
	<table id='imageTable'>
	<tr>
	<?php
		for($i=0;$i<count($photos);$i++)
		{
			$size = getimagesize($photos[$i]['path']);
			if($size[0] > 200) //Scale width
			{
				$width = "200";
				$height = (200/$size[0]) * $size[1];
			}
			if($height>133) //Scale height
			{
				$width = (133/$height) * $width;
				$height = 133;
			}
			
			echo "<td>";
			echo "<a href='/commons/visualart.php?id=".$photos[$i]['id']."'>";
			echo "<img height=$height width=$width src='/commons/".$photos[$i]['path']."'><br />";
			echo "<div style='text-decoration:none; margin-top:10px;'>".$photos[$i]['title']."</div>";
			echo "</a>";
			echo "</td>";
			
			echo (($i+1) % 3 ==0) ? "</tr><tr>" : "";
		}
	?>
	</tr>
	</table>
</div>

<div id="section_film">
	<?php
	$WIDTH = 200;
	$HEIGHT = $WIDTH * .60;
	$sql = "select video_id, type, host_id, title from video where account_id=$accountId order by views desc";
	$rec = util::executeQuery($sql, "");

	for($i=1;$i<count($rec);$i++)
	{
		$films[$i-1]["id"] = $rec[$i][0];
		$films[$i-1]["type"] = $rec[$i][1];
		$films[$i-1]["host_id"] = $rec[$i][2];
		$films[$i-1]["title"] = $rec[$i][3];
	}
	?>
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

		echo ($i == 2) ? "<tr />" :  "";
		echo "</td>";
	}
	?>
	</td>
	</tr>
	</table>
</div>

<div id="section_writing">
	<?php
	$sql = "select writing_id, title, text from writing where account_id=$accountId";
	$rec=util::executeQuery($sql, "");
	for($i=1;$i<count($rec);$i++)
	{
		$pieces[$i-1]["id"]=$rec[$i][0];
		$pieces[$i-1]["title"]=$rec[$i][1];
		$maxLength = (strlen($rec[$i][2]) > 200) ? 200 : strlen($rec[$i][2]);
		$pieces[$i-1]["text"] = substr($rec[$i][2], 0, $maxLength);
	}
	?>
	
	<table id='piecesTable'>
	<tr>
	<?php
		for($i=0;$i<count($pieces);$i++)
		{	
			echo "<td><span class='text'><a href='/commons/writing.php?id=".$pieces[$i]["id"]."'><b>".$pieces[$i]["title"] . "</b></a><br /><br />";
			echo $pieces[$i]["text"] . "...<br /><br />";
			echo "<a href='/commons/writing.php?id=".$pieces[$i]["id"]."'><i>Read more...</i></span></a></td>";
			echo (($i+1) % 3 == 0) ? "</tr><tr>" : "";
		}
	?>
	</tr>
	</table>
	
</div>

<div id="section_photography">
	<?php
	$sql = "select photo_id, file_path, title from photos where account_id=$accountId";
	$rec = util::executeQuery($sql, "");
	for($i=1;$i<count($rec);$i++)
	{
		$photos[$i-1]["id"] = $rec[$i][0];
		$photos[$i-1]["path"] = $rec[$i][1];
		$photos[$i-1]["title"] = $rec[$i][2];
	}
	?>
	<table id='imageTable'>
	<tr>
	<?php
		for($i=0;$i<count($photos);$i++)
		{
			$size = getimagesize($photos[$i]['path']);
			if($size[0] > 200) //Scale width
			{
				$width = "200";
				$height = (200/$size[0]) * $size[1];
			}
			if($height>133) //Scale height
			{
				$width = (133/$height) * $width;
				$height = 133;
			}
			
			echo "<td>";
			echo "<a href='/commons/photo.php?id=".$photos[$i]['id']."'>";
			echo "<img height=$height width=$width src='/commons/".$photos[$i]['path']."'><br />";
			echo "<div style='text-decoration:none; margin-top:10px'>".$photos[$i]['title']."</div>";
			echo "</a>";
			echo "</td>";
			
			echo (($i+1) % 3 ==0) ? "</tr><tr>" : "";
		}
	?>
	</tr>
	</table>
</div>
