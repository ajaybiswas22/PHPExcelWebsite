<?php
session_start();
include_once '../phpindex/login_status.php';
$_SESSION["visitnameget"] = "Question Papers";
$_SESSION["visitlinkget"] = "../ComputerScience/questionpapers.php";
$currentdir = "../ComputerScience/";
include_once '../phpindex/lastvisited.php';
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
  	<title>Question Papers</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="question papers">
    <meta name="Description" content="Get all GATE question papers here">
<!--CSS and JS linking-->
<?php
include_once '../phpindex/master_format_head.php';
?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
<script>

    function deletecomment(id,id2) {

       if(confirm("Are you sure you want to delete this comment?")) {
            $.ajax({
            url: "../dependencies/deletecomment.php",
            type: "POST",
            data: 'comment_id='+id + '&file_id='+id2,
            success: function (result) {
                       //alert(result);
                       window.location.reload();
            }
           });
        }
     }
</script>

   <link rel="stylesheet" href="../css/snackbar.css">
   <script src="../js/snackbar.js"></script>
</head>
<body>
<div class="beforefooter">
<!--header-->
<?php
include '../phpindex/master_format.php';
include '../userlinking/questionpapers_in.php';
?>
  <h1>Question Papers</h1>
<!-- Some content to fill up the page -->
  <!--Prev next button-->
  <div class="clist">
  <div onclick="location.href='<?php echo $linkback ?>';" class="button" id="previous">&lt; </div>
  <div onclick="location.href='<?php echo $linknext ?>';" class="button" id="next">&gt;</div>

<!-- Episode or content list -->
<div class="dropdown">
  <button class="dropbtn"><?php echo $linktext_array[0] ?>&nbsp;<i class="fa fa-arrow-down"></i></button>
  <div class="dropdown-content">

  <?php

  foreach (array_combine($link_array, $linktext_array) as $la => $lta) 
  {
    echo <<<HTML
 <a href='$la';>$lta</a></li>
HTML;
  }

  ?>
  </div>
</div>
</div>
<div class="bodmargins">

<!-- Main Content Starts from Here -->
<p>Lorem Ipsum</p><p>Lorem Ipsum</p><p>Lorem Ipsum</p>
<!-- Main Content Ends Here -->

</div>
</div>

<?php
$blocker = '&&&&&&';
$blocking = '%%%%%%';
include_once '../dependencies/commentboxpage.php'; 
?>


<!--Footer-->
<?php
include_once '../phpindex/master_format_footer.php';
?>


<!--End of body-->
</body>
</html>
