<!DOCTYPE html>
<html lang="en-US">
  <head>
  <title>Sitemap</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include '../phpindex/master_format_head.php';
include '../phpindex/login_status.php';
?>

<style>
ul.sitemapmargin {
  list-style: none;
}

ul.sitemapmargin li.sitemapmargin::before {
  content: "\2022";
  color: #8f1e45;
  font-weight: bold;
  display: inline-block; 
  width: 1em;
  margin-left: 200px;
}

ul.sitemapmargin li.sitemapmargin2::before {
  content: "\2022";
  color: #3d0836
  font-weight: bold;
  font-size: 20px;
  display: inline-block; 
  width: 1em;
  margin-left: 180px;
}
b.big{
  font-size: 20px;
  color: #3d0836;
}
b{
  font-weight: normal;
  color: #8f1e45;
}

@media only screen and (max-width: 1000px) {
  ul.sitemapmargin li.sitemapmargin::before {
    margin-left: 30px;
}
  ul.sitemapmargin li.sitemapmargin2::before {
    margin-left: 10px;
}
</style>

</head>
<body>
<?php
include_once '../phpindex/master_format.php';
?>
<div>
<h1>Sitemap</h1>
<?php
include_once '../dependencies/SimpleXLSX.php';

  if ( $xlsx = SimpleXLSX::parse('site_database.xlsx') )
   {
    echo '<ul class="sitemapmargin">';
    foreach ($xlsx->rows() as $elt) 
    {
      if($elt[2]=='1'){
      echo '<li class="sitemapmargin2"><a href="'. $elt[1] .'"><b class="big">'.$elt[0].'</b></a></li>';
      }
      else{
      echo '<li class="sitemapmargin"><a href="'. $elt[1] .'"><b>'.$elt[0].'</b></a></li>';
      }
    }
    echo '</ul class="sitemapmargin">';
  } 
  else {
    echo SimpleXLSX::parseError();
  }

?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php
include_once '../phpindex/master_format_footer.php';
?>
</body>
</html>