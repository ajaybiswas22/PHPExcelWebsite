<?php
session_start();
include_once '../phpindex/login_status.php';
$_SESSION["visitnameget"] = "Computer Science";
$_SESSION["visitlinkget"] = "../ComputerScience/computerscience.php";
$currentdir = "../ComputerScience/";
include_once '../phpindex/lastvisited.php';
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
  	<title>Computer Science</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

     function replycomment(id3,id4) {

      var x = document.getElementById('txa'); 
      x.value = '@' + id3 + ': ';

      var y = document.getElementById('replypos'); 
      y.value = id4;

      document.getElementById('txa').focus(); 
        
     }

</script>

   <link rel="stylesheet" href="../css/snackbar.css">
   <script src="../js/snackbar.js"></script>
</head>
<body>
<div class="beforefooter">
<!--header-->
<?php
include_once '../phpindex/master_format.php';
include_once '../phpindex/computerscience_in.php';
?>
  <h1>Computer Science</h1>
<!-- Some content to fill up the page -->
  <!--Prev next button-->
  <div class="clist">
  <div onclick="location.href='<?php echo $linkback ?>';" class="button" id="previous">&lt; </div>
  <div onclick="location.href='<?php echo $linknext ?>';" class="button" id="next">&gt;</div>

<!-- Episode or content list -->
<div class="dropdown">
  <button class="dropbtn"><?php echo $Cfirstlinktext ?>&nbsp;<i class="fa fa-arrow-down"></i></button>
  <div class="dropdown-content">
  <a href='<?php echo $Cfirstlink ?>';><?php echo $Cfirstlinktext ?></a></li>
  <a href='<?php echo $Csecondlink ?>';><?php echo $Csecondlinktext ?></a></li>
  <a href='<?php echo $Cthirdlink ?>';><?php echo $Cthirdlinktext ?></a></li>
  </div>
</div>
</div>

<div class="bodmargins">
<!-- Main Content Starts from Here -->
<div>
<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>
<div>
<h2>Why do we use it?</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
</div>
<p>&nbsp;</p>
<p><iframe width="560" height="315" src="https://www.youtube.com/embed/nLC8fDkTuzo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>



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
