<?php
include 'include/util.php';
$email = $_REQUEST['login_email'];
$pass = $_REQUEST['login_password'];

$sql = "select account_id from accounts where email='$email' and password='$pass'";
$rec = util::executeQuery($sql, "");
if($rec[1][0] == "" || $rec[1][0] == 0)
{
	echo "<script>window.location='/commons/campuscreatives.php';</script>";
}
else
{
	session_start();
	$_SESSION['account_id'] = $rec[1][0];
	util::timeStamp($rec[1][0]);
	echo "<script>window.location='/commons/homepage.php';</script>";
}

?>