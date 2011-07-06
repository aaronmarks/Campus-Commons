<?php
include 'include/util.php';
if($_REQUEST['code'] == 'ok')
{
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$time = time();
	
	$sql = "insert into accounts (email, password) values ('$email', '$password')";
	$rec = util::executeQuery($sql, "");
	
	$sql = "select account_id from accounts where email='$email'";
	$rec = util::executeQuery($sql, "");
	$accountId = $rec[1][0];
	
	$sql = "update accounts set create_date=$time where account_id=$accountId";
	util::executeQuery($sql, "");
	
	util::timeStamp($accountId);
	
	session_start();
	$_SESSION['account_id'] = $accountId;
	header('Location: /commons/homepage.php');
}
else
{
	echo "<script>alert('Incorrect code entered. Please try again');window.location='/commons/campuscreatives.php';</script>";
}


?>