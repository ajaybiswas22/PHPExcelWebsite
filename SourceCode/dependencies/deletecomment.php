<?php
session_start();
include_once("../dependencies/xlsxwriter.class.php");
include_once '../dependencies/SimpleXLSX.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$data = array(array(),);
$counter = 0;
$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : '10000';
$file_id = isset($_POST['file_id']) ? $_POST['file_id'] : '../dependencies/sample';

$namegets = isset($_SESSION["nameonsession"]) ? $_SESSION["nameonsession"] : 'nobody';
if ( $xlsx = SimpleXLSX::parse($file_id.'.xlsx') )
   {
    foreach ($xlsx->rows() as $elt) 
    {
        if($data == array(array(),))
        {
           $data = array(array($elt[0],$elt[1],$elt[2],$elt[3]),);     
        }
        elseif ($data != array(array(),) && $counter == $comment_id && $elt[0] == $namegets) 
        {
            echo "deleted";
            $comdata = "del ".$elt[0].' '.$elt[2].' '.$elt[1].' '.$file_id.' '.date("Y/M/d h:i")."\n";
            $fp = fopen('../logs/comments.txt', 'a');
            fwrite($fp, $comdata);  
            fclose($fp);
        }
        else
        {
        $data = array_merge($data,array(array($elt[0],$elt[1],$elt[2],$elt[3]),));  
        } 
        $counter = $counter + 1; 
    }

        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($file_id.'.xlsx'); 
   } 
  else {
        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($file_id.'.xlsx');
  }
}
?>