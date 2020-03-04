<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Profile</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/forms.css">
 </head>
<body>

<?php
include "../profilepass/Admin_passfile.php";
if(isset($_SESSION["visitlinkget"]))
{
$visitlink = $_SESSION["visitlinkget"];
$visitname = $_SESSION["visitnameget"];
} 
if(isset($_SESSION['nameonsession']))
{
	if(isset($_COOKIE["nameonsession"])) {
		$_SESSION["loginpassonsession"]=$_SESSION["ckreg"];
		$passwordreg = $ckreg;
		$visitlink = $vislink;
		$visitname = $visname;
	}
 	if($_SESSION["nameonsession"] == $usernamereg && password_verify($_SESSION["loginpassonsession"], $passwordreg)== true)
 	{
 		echo <<<HTML
 <form action = "../login/logout.php" method = "post">
                  <INPUT TYPE = "Submit" Name = "Submit1" VALUE = "logout" class="button">
               </form>

<form action="../login/blockuser.php" method = "post">
  Username:<br>
  <input type="text" name="busername">
  <br/><br/>
  <input type="submit" value="block">
</form> 
<form action="../login/unblockuser.php" method = "post">
  Username:<br>
  <input type="text" name="busername">
  <br/><br/>
  <input type="submit" value="unblock">
</form>
<form action="../login/commentblock.php" method = "post">
  Page Location (Prefix ../ for relative address):<br>
  <input type="text" name="bpage">
  <br/><br/>
  <input type="submit" value="b_comment">
</form>
<form action="../login/commentunblock.php" method = "post">
  Page Location (Prefix ../ for relative address):<br>
  <input type="text" name="bpage">
  <br/><br/>
  <input type="submit" value="ub_comment">
</form>
<form action="../dependencies/passwordgen.php" method = "post">
  Password:<br>
  <input type="text" name="passgen">
  <br/><br/>
  <input type="submit" value="generate">
</form>   

HTML;
if(isset($visitname))
{
		echo <<<HTML
               <h2>Your last visited page</h2>
               <a href="$visitlink">$visitname</a>

HTML;
}

 	}
 	else if($_SESSION["nameonsession"] == $usernamereg && password_verify($_SESSION["loginpassonsession"], $passwordreg)== false)
 	{
 		echo "Automatically logged out due to multiple sessions or someone else has logged in.";
		unset($_SESSION["nameonsession"]);
		unset($_SESSION["loginpassonsession"]);
 		$sessionTime = -3600;
    	session_set_cookie_params($sessionTime);
		setcookie("nameonsession", "",time() + $sessionTime, "/");
		setcookie("ckreg", "",time() + $sessionTime, "/");

 	}
 }
 ?>	
<h2>This is Admin.</h2>
<h3>User since 2019/Dec/14.</h3>
</body>
</html>