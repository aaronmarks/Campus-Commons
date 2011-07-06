<?php
include 'include/commonTop.php';
$accountId = $_REQUEST['id'];
$_SESSION['prof_id'] = $accountId;
$sql = "select name, bio, prof_path, email from accounts where account_id=$accountId";
$rec = util::executeQuery($sql, "");
$name = $rec[1][0];
$bio = $rec[1][1];
$prof_path = $rec[1][2];
$email = $rec[1][3];
$exploded = explode(" ", $name);
$firstName = $exploded[0];

$topItems = util::getTopTen($accountId);
?>

<HTML>
<head>
<link rel="stylesheet" href="css/profile.css">
<title>Profile</title>
</head>

<body>
<div id='wrapper'>
<div id="center">

<div id="name">
<img id='prof_pic' src='<?=$prof_path?>' height=65px width=65px/>
<h1><?=$name?></h1>
<span>New York University</span>
</div>

<div id="container">
	<div id="top"><br><br>
		<ul id="menu">
			<li id="All" class="selected">All</li>
			<li id="Music">Music</li>
			<li id="Visual Art">Visual Art</li>
			<li id="Film">Film</li>
			<li id="Writing">Writing</li>
			<li id="Photography">Photography</li>
		</ul>
		<span class="clear"></span>
	</div>
	<div id='loading'><img src='ajax-loader.gif'></div>
	<div id="content">
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
		<div id="footer">
		</div>
	</div>

</div>
	<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="js/profile.js"></script>

<div id="right">
<span>About <?=$firstName?></span>
<br>
<br>
<span><?=$bio?></span><br><br>
Email me at: <span id='email'><?=$email?></span>
</div>

</div>
</body>
</html>


