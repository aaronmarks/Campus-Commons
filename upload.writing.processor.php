<?php
include 'include/commonTop.php';
$accountId = $_SESSION['account_id'];
$title = mysql_real_escape_string($_REQUEST['title']);
$text = mysql_real_escape_string($_REQUEST['copyPaste']);
$time = time();

$sql = "insert into writing (account_id, title, text, create_date, views) values($accountId, '$title', '$text', $time, 0)";
util::executeQuery($sql, "");

echo "<script>window.location='/commons/upload.php';</script>";
?>