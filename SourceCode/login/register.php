<!DOCTYPE html>
<html lang="en-US">
  <head>
   <title>Register Page</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/forms.css">
   <script src="../js/snackbar.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script>
      var allowsubmit = false;
      $(function(){
         //on keypress 
         $('#confpass').keyup(function(e){
            //get values 
            var pass = $('#pass').val();
            var namm = $('#namm').val();
            var confpass = $(this).val();
            
            //check the strings
            if(pass == confpass && confpass.length > "5" && pass!=namm){
               //if both are same remove the error and allow to submit
               $('.error').text('');
               allowsubmit = true;
            }
            else{
               //if not matching show error and not allow to submit
               $('.error').text('Password not matching or same as name or less than 6 letters');
               allowsubmit = false;
            }
         });
         
         //jquery form submit
         $('#form').submit(function(){
            
            var pass = $('#pass').val();
            var confpass = $('#confpass').val();
            var namm = $('#namm').val();
            //just to make sure once again during submit
            //if both are true then only allow submit
            if(pass == confpass && confpass.length > "5" && pass!=namm){
               allowsubmit = true;
            }
            if(allowsubmit){
               return true;
            }else{
               document.getElementById("form").reset();
               return false;
            }
         });
      });
   </script>
</head>
<body>

   <?php
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      $usernamereg = isset($_POST['usernamereg']) ? $_POST['usernamereg'] : 'nobody';
      $usernamereg = stripslashes($usernamereg);
      $usernamereg = preg_replace('/\s/', '', $usernamereg);

      $secbird = isset($_POST['secbird']) ? $_POST['secbird'] : 'bird';
      $secbird = stripslashes($secbird);
      $secbird = preg_replace('/\s/', '', $secbird);
      $secbird = strtolower($secbird);

      $userverifypass = isset($_POST['pass']) ? $_POST['pass'] : 'nobody';

      if(empty($usernamereg) || empty($userverifypass) || empty($_POST["accept"])){
        echo '<img src onerror="snackbarF()"><div id="snackbar">You have been blocked</div>';
     }
     else if(preg_match("/([%\$\[\]?<>!\/@^&-+.,:;`~|\"#\*]+)/", $usernamereg))
      {
         echo '<img src onerror="snackbarF()"><div id="snackbar">Invalid username</div>';
      }
     else
     {
      $userverifypass = password_hash($userverifypass, PASSWORD_DEFAULT);
      $regi = '../profilepass/'. $usernamereg .'_passfile.php';
      $regi2 = '../profile/'. $usernamereg .'.php';
      $srcfile = '../profile/sampleprofile.php';
      $esca = "";
      $esca2 = "";
      $esca3 = "";
      $esca4 = "";
      $enda = "";
      if (file_exists($regi))  
      { 
        echo '<img src onerror="snackbarF()"><div id="snackbar">Already Registered</div>';
     } 
     else 
     { 
      $myfile = fopen($regi, "w") or die("Unable to open file!");
      $esca = '$usernamereg = \'';
      $esca2 = "\$passwordreg = '";
      $esca3 = "\$ckreg = 'inick';";
      $esca4 = "\$visname = 'Home';";
      $esca5 = "\$vislink = '../';";
      $esca6 = "\$blocked = '%%%%%%';\n";
      $esca7 = '$quesreg = \'';
      $enda = "';\n";
      $txt = "<?php \n";
      fwrite($myfile, $txt);
      $txt = $esca.$usernamereg.$enda;
      fwrite($myfile, $txt);
      $txt = $esca2.$userverifypass.$enda;
      fwrite($myfile, $txt);
      fwrite($myfile, $esca3);
      fwrite($myfile, $esca4);
      fwrite($myfile, $esca5);
      fwrite($myfile, $esca6);
      $txt = $esca7.$secbird.$enda;
      fwrite($myfile, $txt);
      $txt = "\n?>";
      fwrite($myfile, $txt);
      fclose($myfile);

      copy($srcfile, $regi2);
      $strold = file_get_contents($srcfile);
      $fp2 = fopen($regi2, "w") or die("Unable to open file!");
      $replaced = str_replace("sampleprofile",$usernamereg,$strold);
      $replaced2 = str_replace("xxx",$usernamereg,$replaced);
      $replaced2 = str_replace("yyy",date("Y/M/d"),$replaced2);
      fwrite($fp2, $replaced2);
      fclose($fp2);
      echo '<img src onerror="snackbarF()"><div id="snackbar">Registered Successfully</div>';
      header('Refresh: 2; login.php');
   }
}
}
?>


<div align = "center">
   <div class = "cen" align = "left">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>
      
      <div class="margincen">
         <a href="../">
            <img src="../images/homeim.png" alt="Home" class="center">
         </a>
         <form action="register.php" id="form" method="post">
            <div class="form-group">
               <label>Username<br/></label><input type = "text" name = "usernamereg" id="namm" class = "box"required><br /><br />
               <label for="desc">Password<br/></label> 
               <input type="password" class="box" name="pass" id="pass" required>
            </div><br />
            <div class="form-group">
               <label for="desc">Confirm Password<br/></label> 
               <input type="password" class="box" name="confpass" id="confpass" required>
            </div><br/>
            <div class="form-group">
               <label for="desc">What is your favorite Bird?<br/></label> 
               <input type="text" class="box" name="secbird" id="secbird" required>
            </div><br/>
             <div class="form-group">
                <input type="checkbox" name="accept" id="accept" required>I accept the <a href="../terms">terms and conditions</a> and <a href="../privacy">privacy policy</a>.</label>
            </div>
            <div class="form-group">
               <span class="error" style="color:red"></span><br />
            </div>
            <button type="submit" name="submit" class="button">Submit</button>
         </form>

      </div>
      
   </div>
   
</div>

</body>
</html>