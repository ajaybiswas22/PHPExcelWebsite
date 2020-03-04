<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$pass_rec = isset($_POST['passgen']) ? $_POST['passgen'] : 'junk';
	$generated = password_hash($pass_rec, PASSWORD_DEFAULT);
	echo $generated;
}
?>