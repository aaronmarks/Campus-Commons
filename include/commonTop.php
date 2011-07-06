<?php
include 'util.php';
session_start();
if($_SESSION['account_id'] == "" || $_SESSION['account_id'] == 0)
{
	echo "<script>window.location='/commons/campuscreatives.php';</script>";
}
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/commonTop.css" />
</head>

<div class="header"> 

<ul>
	<li><a href="http://localhost/commons/homepage.php?p=1">Home</a></li>
	<li><a href="http://localhost/commons/musicpage.php?p=1">Music</a></li>
	<li><a href="http://localhost/commons/visualartpage.php?p=1">Visual Art</a></li>
	<li><a href="http://localhost/commons/filmpage.php?p=1">Film</a></li>
	<li><a href="http://localhost/commons/writingpage.php?p=1">Writing</a></li>
	<li><a href="http://localhost/commons/photopage.php?p=1">Photography</a></li>
</ul>


<h1>Campus Creatives</h1>

</div>

<hr>
<div class="header">
<ul class='sub' style='float:right'>
       	<li ><a href="http://localhost/commons/upload.php">Upload</a></li>
		<li><a href="/commons/profile.php?id=<?=$_SESSION['account_id']?>">Profile</a></li>
		<li><a href="http://localhost/commons/accountpage.php">Account</a></li>
		<li style='border:none'><a href="http://localhost/commons/logout.php">Logout</a></li>
</ul>
</div>