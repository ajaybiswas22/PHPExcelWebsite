<?php
function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

 if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$usersearch = isset($_POST['bpage']) ? $_POST['bpage'] : 'nobody';
    $fileex = file_exists($usersearch);
    if($fileex == 1)
    {
    	echo 'File Found '.$usersearch;
    	$file_data = file_get_contents($usersearch);
        $file_data = str_replace_first("&&&&&&","******",$file_data);
    	$file_data = str_replace_first("%%%%%%","######",$file_data);
    	$fp2 = fopen($usersearch, "w") or die("Unable to open file!");
    	fwrite($fp2, $file_data);
        fclose($fp2);
    }

}
?>