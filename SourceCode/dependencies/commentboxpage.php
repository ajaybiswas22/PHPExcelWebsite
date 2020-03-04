<?php

include_once("../dependencies/xlsxwriter.class.php");
include_once '../dependencies/SimpleXLSX.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$fileop = isset($_SESSION["visitnameget"]) ? $_SESSION["visitnameget"] : '';
$filepass = isset($_SESSION["visitnameget"]) ? $_SESSION["visitnameget"] : '';
$filepass = "'".$currentdir.$filepass."'";
$nameget = isset($_SESSION["nameonsession"]) ? $_SESSION["nameonsession"] : '';
$passget = isset($_SESSION["loginpassonsession"]) ? $_SESSION["loginpassonsession"] : 'nobody';
$usersearch = '../profilepass/'. $nameget .'_passfile.php';
$fileex = file_exists($usersearch);
$compos = isset($_GET["replytext"]) ? $_GET["replytext"] : -1;
$job = 0;
$match_compos = 0;
$passgetval = 0;

if($fileex == 1)
{
  include $usersearch;
  $passgetval = password_verify($passget, $passwordreg);
}

if($nameget == '' && isset($_GET['comments_query']) && $passgetval == 0)
{
  echo '<img src onerror="snackbarF()"><div id="snackbar">Login First</div>';
}
else
{
$toddate = date("Y/M/d h:i");
$i = 0;
$data = array(array(),);
$searchi = isset($_GET['comments_query']) ? $_GET['comments_query'] : '';
if ($blocker != '&&&&&&') 
{
  
}
elseif ($blocker = '&&&&&&' && preg_match("/([<>]+)/", $searchi)) 
{
  echo '<img src onerror="snackbarF()"><div id="snackbar">Tags Not Allowed</div>';
}
else
{
if($searchi !='' && strlen($searchi) < 1000 )
{
if ( $xlsx = SimpleXLSX::parse($fileop.'.xlsx') )
   {
    foreach ($xlsx->rows() as $elt) 
    {
        if($data == array(array(),))
        {
           $data = array(array($elt[0],$elt[1],$elt[2],$elt[3]),);     
        }
        elseif($data != array(array(),) && $compos == $match_compos )
        {
           $data = array_merge($data,array(array($elt[0],$elt[1],$elt[2],$elt[3]),));   
           $data = array_merge($data,array(array($nameget,'../profile/'.$nameget.'.php',$searchi,$toddate),)); 
           $job = 1;
        }
        elseif($data != array(array(),) && $compos != $match_compos )
        {
        $data = array_merge($data,array(array($elt[0],$elt[1],$elt[2],$elt[3]),));  
        }  
        $match_compos = $match_compos + 1;
    }

    $match_compos = 0;

    if($job == 1)
    {
        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($fileop.'.xlsx');
        $comdata = $nameget.' '.$searchi.' '.$_SESSION["visitlinkget"].' '.$toddate."\n";
        $fp = fopen('../logs/comments.txt', 'a');
        fwrite($fp, $comdata);  
        fclose($fp);
    }
    else
    {
        $data = array_merge($data,array(array($nameget,'../profile/'.$nameget.'.php',$searchi,$toddate),));
        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($fileop.'.xlsx');
        $comdata = $nameget.' '.$searchi.' '.$_SESSION["visitlinkget"].' '.$toddate."\n";
        $fp = fopen('../logs/comments.txt', 'a');
        fwrite($fp, $comdata);  
        fclose($fp);  
    }
    
    unset($compos);
   } 
  else {
        $data = array_merge($data,array(array($nameget,'../profile/'.$nameget.'.php',$searchi,$toddate),));
        $writer = new XLSXWriter();
        $writer->writeSheet($data);
        $writer->writeToFile($fileop.'.xlsx');
        $comdata = $nameget.' '.$searchi.' '.$_SESSION["visitlinkget"].' '.$toddate."\n";
        $fp = fopen('../logs/comments.txt', 'a');
        fwrite($fp, $comdata);  
        fclose($fp);
  }

}
elseif($searchi !='' && strlen($searchi) >= 1000 ) 
{
  echo '<img src onerror="snackbarF()"><div id="snackbar">Comment beyond limit</div>';
}
}
}

echo <<<HTML
<div class="detailBox">
    <div class="titleBox">
      <label>Comment Box</label>
    </div>
    <div class="commentBox">
        
        <p class="taskDescription">Remember to follow community guidelines and don't go off topic.</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            <li class = "commenter">
                <div class="commentText">
HTML;


$counter = 0;
  if ( ($xlsx = SimpleXLSX::parse($fileop.'.xlsx')) && $blocking == '%%%%%%')
   {
    foreach ($xlsx->rows() as $elt) 
    {
      if($elt[0]=="")
      {
        $counter = $counter + 1;
      }
      else
      {
      if($elt[0]==(isset($_SESSION["nameonsession"]) ? $_SESSION["nameonsession"] : ''))
      {
        echo '<p><a href="'.$elt[1].'">'.$elt[0].'</a><br/>'.$elt[2].'</p> <span class="date sub-text">on '.$elt[3].' GMT &nbsp;</span><a href="javascript:deletecomment('.$counter.','.$filepass.');"><span style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></span></a>';
      }
      else
      {
        echo '<p><a href="'.$elt[1].'">'.$elt[0].'</a><br/>'.$elt[2].'</p> <span class="date sub-text">on '.$elt[3].' GMT &nbsp;</span><a href="javascript:replycomment('."'".$elt[0]."'".','.$counter.');"><span style="color:blue"><i class="fa fa-reply" aria-hidden="true"></i></span></a>';
      }
      $counter = $counter + 1;
    }
    }
  }
  elseif (($xlsx = SimpleXLSX::parse($fileop.'.xlsx')) && $blocking != '%%%%%%') {
     echo '<p>Comment Section is disabled.</p>';
   } 
  else {
  }
$self = $_SERVER['PHP_SELF'];
echo <<<HTML
                </div>
            </li>
        </ul>
        <form class="form-inline" action="$self"  method="get">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your comments" id="txa" name="comments_query"/>
                <input type="hidden" id="replypos" name="replytext"/>
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>
HTML;

?>
