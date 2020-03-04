<?php
$creg ='';
$treg = '';
if((isset($_COOKIE["nameonsession"])&&isset($_COOKIE["ckreg"]))||(isset($_SESSION["nameonsession"]))&&isset($_SESSION["loginpassonsession"]))
{
  if(isset($_COOKIE["nameonsession"]))
  {
    $_SESSION["nameonsession"] = decrypt($_COOKIE["nameonsession"], 'SECURE_KEYssssss');
  }
  $usersearch = '../profilepass/'. $_SESSION["nameonsession"] .'_passfile.php';
  include '../profilepass/'. $_SESSION["nameonsession"] .'_passfile.php';

  if(isset($_COOKIE["ckreg"])&&empty($_SESSION["loginpassonsession"]))
  {
    $creg = $_COOKIE["ckreg"];
    $treg = $ckreg;
  }
  else if(empty($_COOKIE["ckreg"])&&isset($_SESSION["loginpassonsession"]))
  {
    $creg = $_SESSION["loginpassonsession"];
    $treg = $passwordreg;
  }
  else if(isset($_COOKIE["ckreg"])&&isset($_SESSION["loginpassonsession"]))
    {
    $creg = $_COOKIE["ckreg"];
    $treg = $ckreg;
    }

  if(password_verify($creg, $treg)== true)
  {
  $strold = file_get_contents($usersearch);
  $fp2 = fopen($usersearch, "w") or die("Unable to open file!");
  $replaced = str_replace($visname,$_SESSION["visitnameget"],$strold);
  $replaced = str_replace($vislink,$_SESSION["visitlinkget"],$replaced);
         fwrite($fp2, $replaced);
         fclose($fp2);
  }
}
?>