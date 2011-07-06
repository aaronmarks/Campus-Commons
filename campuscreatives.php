<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
<link rel="stylesheet" href="css/campuscreatives.css">
<title>Campus Creatives</title>
</head>

<script>
function showLogin()
{
	document.getElementById("login").setAttribute("style", "visibility: visible");
	document.getElementById("loginLink").setAttribute("style", "visibility: hidden");
}
</script>

<body> 

<div id="loginLink">
 <label for="login" onclick="showLogin()" class="uiButton"><input type="submit" id="button" tabindex="4" value="Login"></label> 
</div>

<div style="visibility: hidden" id="login">
<form  type="POST" action="/commons/login.php">
<table>

  <tr>
    <td>
</td><td><input type="text" value="email" id="login_box" name="login_email"  onclick="this.value='';" onfocus="this.style.color='black';">
    </td>
    <td>
</td><td><input type="text" value="password" id="login_box" name="login_password"  onclick="this.value='';" onfocus="this.style.color='black';">
    </td>
    <td>
          <label for="login" class="uiButton"><input type="submit" id="button" tabindex="4" value="Login"></label>
    </td>
   </tr>
   <tr>

</table>
</form></div>

<div id="container">

<div id="header"> 

<h1>Campus Creatives</h1>
<br>
<br>
<ul>
	<li><a>Music</a></li>
	<li><a>Visual Art</a></li>
	<li><a>Film</a></li>
	<li><a>Writing</a></li>
	<li><a>Photography</a></li>
</ul>
</div>

<br>
<br>
<br>
<br>

<div id="email">
<form type="POST" action="/commons/codesend.php">
<table>
<tr><td><input type="text" value="Your university email" id="login_box" name="email"  onclick="this.value='';" onfocus="this.style.color='black';"></td>
<td><input type="password" value="password" id="login_box" name="password" onclick="this.value='';" onfocus="this.style.color='black';"></td>
<td>
<td colspan="2"><input type="submit" id='submit' value='Sign Up'></td></tr>
</table>
</form>
</div>


</body>
</html>


