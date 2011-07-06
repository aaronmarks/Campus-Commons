<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<head>
<link rel="stylesheet" href="css/campuscreatives.css">
<title>Campus Creatives</title>

<script>
function showLogin()
{
	document.getElementById('loginForm').setAttribute('style', 'visibility:visible;display:block;margin-top:-20px;');
	document.getElementById('loginLink').setAttribute('style', 'visibility:hidden;');
}
</script>

</head>
<body>
    <div class="top">
       <div class="twrapper">
           
<div id="login">
<a id='loginLink' onClick="showLogin();" href="#">Log In</a>
<form style='visibility:hidden'id='loginForm' type="POST" action="/commons/login.php">
<table>

  <tr>
    <td>
</td><td><input type="text" value="email" name="login_email"  onclick="this.value='';" onfocus="this.style.color='black';">
    </td>
    <td>
</td><td><input type="text" value="password" name="login_password"  onclick="this.value='';" onfocus="this.style.color='black';">
    </td>
    <td>
          <label for="login" class="uiButton"><input type="submit" id="login" tabindex="4" value="Login"></label>
    </td>
   </tr>
   <tr>

</table>
</form></div>

</head>

<div id="container">

<div id="header"> 

<h1>Campus Creatives</h1>
<ul>
	<li><a href="#">All</a></li>
	<li><a href="#">Music</a></li>
	<li><a href="#">Visual Art</a></li>
	<li><a href="#">Film</a></li>
	<li><a href="#">Writing</a></li>
	<li><a href="#">Photography</a></li>
</ul>
</div>

<br/>
<br/>

<div id="content">
	<p>Join the new culture community:</p>
</div>

<div id="email">

<form type="POST" action="/commons/codesend.php">
<table>
<tr><td>NYU Email: </td><td><input type="text" value="Your university email" name="email"  onclick="this.value='';" onfocus="this.style.color='black';"></td></tr>
<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
<td>
</td></tr>
<tr><td colspan="2"><input type="submit" id='submit' value='Sign Up'></td></tr>
</table>
</form>
</div>

</div>

</body>
</html>


