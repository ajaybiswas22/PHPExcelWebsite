<?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$buser = isset($_POST['busername']) ? $_POST['busername'] : 'nobody';
	$usersearch = '../profilepass/'. $buser .'_passfile.php';
    $fileex = file_exists($usersearch);
    if($fileex == 1 && $buser != "Admin")
    {
    	echo 'File Found '.$usersearch;
    	$file_data = file_get_contents($usersearch);
    	$file_data = str_replace("%%%%%%","######",$file_data);
    	$fp2 = fopen($usersearch, "w") or die("Unable to open file!");
    	fwrite($fp2, $file_data);
        fclose($fp2);
    }
    else
    {
        echo "Cannot block Admin.";
    }

}
?>