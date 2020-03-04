<?php
$Login_name = "Login";
$Login_link = "../login/login.php";
if (isset($_SESSION["nameonsession"]))
 {
    $username = $_SESSION["nameonsession"];
    $userlink = '../Profile/'.$username.'.php';
    $Login_name = $username;
    $Login_link = $userlink;
}
if(isset($_COOKIE["nameonsession"])) {
    include '../login/cryptkey.php';
    $_SESSION["nameonsession"] = decrypt($_COOKIE["nameonsession"], 'SECURE_KEYssssss');
    $_SESSION["ckreg"] = $_COOKIE["ckreg"];
    $username = $_SESSION["nameonsession"];
    $userlink = '../Profile/'.$username.'.php';
    $Login_name = $username;
    $Login_link = $userlink;
}
?>