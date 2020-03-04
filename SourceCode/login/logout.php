<?php
session_start();
include 'cryptkey.php';
unset($_SESSION["nameonsession"]);
unset($_SESSION["loginpassonsession"]);
unset($_SESSION["visitlinkget"]);
unset($_SESSION["visitnameget"]);
if(isset($_COOKIE["nameonsession"])){
	$sessionTime = -3600;
    session_set_cookie_params($sessionTime);
$dec = decrypt($_COOKIE["nameonsession"], 'SECURE_KEYssssss');
include '../profilepass/'.$dec.'_passfile.php';
$rep = $ckreg;
$strold = file_get_contents('../profilepass/'.$dec.'_passfile.php');
         $fp2 = fopen('../profilepass/'.$dec.'_passfile.php', "w") or die("Unable to open file!");
         $replaced = str_replace($rep,"inick",$strold);

         fwrite($fp2, $replaced);
         fclose($fp2);
setcookie("nameonsession", "",time() + $sessionTime, "/");
setcookie("ckreg", "",time() + $sessionTime, "/");
}
header("Location:login.php");
?>