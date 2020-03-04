
<!DOCTYPE html>
<html lang="en-US">
  <head>
  	<title>Search</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
<!--CSS and JS linking-->
<?php
include_once '../phpindex/master_format_head.php';
include_once '../phpindex/login_status.php';
?>

</head>
<body>
<div class="beforefooter">
<!--header-->
<?php
include '../phpindex/master_format.php';
?>
<h1>Search</h1>
<?php
include_once '../dependencies/SimpleXLSX.php';
$searchi = isset($_GET['search_query']) ? $_GET['search_query'] : '';

if(empty($searchi)){
    echo '<p class="bodmargin">Nothing to Search</p>';
    $searchi = "#";
}
$line_number = 0;
$temp_line = 0;
$var1 = "#";
$Var2 = "Nothing";
$arrcount = 0;
  if ( $xlsx = SimpleXLSX::parse('search_database.xlsx') )
   {
    echo '<table><tbody>';
    $i = 0;
    foreach ($xlsx->rows() as $elt) 
    {
      $arr[$arrcount] = $elt[0];
      $arr2[$arrcount] = $elt[1];
      $arr3[$arrcount] = $elt[2];
      $arrcount=$arrcount+1;
    }
  } 
  else {
    echo SimpleXLSX::parseError();
  }
while (list($key, $line) = each($arr)) {
   $line_number = (stripos($line, $searchi) !== FALSE) ? $key + 1 : $line_number;
   
   if($line_number != $temp_line)
   {
     $var1 = $arr2[$line_number-1];
     $var2 = $arr3[$line_number-1];
     echo '<a href="'. $var2 .'"><p class="bodmargin">'.$var1.'</p></a><br>';    
   }
   $temp_line = $line_number;
}
if($line_number == '0' and $searchi != "#")
{
  echo '<p class="bodmargin">Please type correctly</p>';
  echo '</table></tbody>';
}
else
{
 echo '</table></tbody>'; 
}
?>

</div>
<?php
include_once '../phpindex/master_format_footer.php';
?>
<!--End of body-->
</body>
</html>
