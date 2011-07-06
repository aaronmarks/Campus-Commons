<?php
include 'include/util.php';
$base = util::getParameter("base_path");

if($_REQUEST['code'] != "")
{
	echo "<script>window.location='/commons/codecheck.php';</script>";
}

?>

<?php
$email = $_GET["email"];
$pass = $_GET["password"];
if(strstr($email, "nyu.edu") == FALSE)
{
	echo "<script>alert('You did not enter a valid NYU email address.');window.location='/commons/campuscreatives.php';</script>";
}
else
{
	$to      = $email;
	$subject = 'Campus Creatives Code';
	$message = 'SjK34v8';
	mail($to, $subject, $message);
	?>
	
	Thank you for signing up <?=$email?>, a code has been sent to your email. <br><br>
	Enter your confirmation code below to get started.<br /><br>
	
	<form action="<?=$base?>/codecheck.php">
		<input type='hidden' name='email' value='<?=$email?>'>
		<input type='hidden' name='password' value='<?=$pass?>'>
		Code: <input type="text" name="code"><input type="submit">
	</form>
	
<?php	
}
?>
