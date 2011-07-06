<?php
include 'include/commonTop.php';
$link = $_REQUEST["link"];
$type = strpos($link, "vimeo") ? "vimeo" : "youtube";
$accountId = $_SESSION['account_id'];
$title = mysql_real_escape_string($_REQUEST['title']);
$time = time();

if($type=="youtube")
{
	$start = strpos($link, "v=")+2;
	$end = (strpos($link, "&") == false) ? strlen($link) : strpos($link, "&")-$start;
	$vidId = substr($link, $start, $end);

}
else
{
	$start = strrpos($link, "/")+1;
	$end = strlen($link);
	$vidId = substr($link, $start, $end);
}

$sql = "insert into video (account_id, type, host_id, title, create_date, views) values($accountId, '$type', '$vidId', '$title', $time, 0)";
util::executeQuery($sql, "");
echo "<script>window.location='upload.php';</script>";
?>