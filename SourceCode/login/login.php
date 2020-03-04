<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
   <title>Login Page</title>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/forms.css">
   <script src="../js/snackbar.js"></script>
</head>
<body>
   <?php
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      if(isset($_SESSION["nameonsession"])||isset($_COOKIE["nameonsession"]))
      {  
         echo '<img src onerror="snackbarF()"><div id="snackbar">Please logout first</div>';
      }
      else
      {
         $userverify = isset($_POST['username']) ? $_POST['username'] : 'nobody';
         $userverify = stripslashes($userverify);
         $userverify = preg_replace('/\s/', '', $userverify);
         $userverifypass = isset($_POST['password']) ? $_POST['password'] : 'nobody';

         if(preg_match("/([%\$\[\]?<>!\/@^&-+.,:;`~|\"#\*]+)/", $userverify))
         {
            echo '<img src onerror="snackbarF()"><div id="snackbar">Invalid username</div>';
         }
         else
      {   
         $usersearch = '../profilepass/'. $userverify .'_passfile.php';
         $fileex = file_exists($usersearch);
         $cookie_name = "";
         $cookie_value = "";
         if($fileex == 1)
         {
            $loginval = 0;
            include $usersearch;
            if(password_verify($userverifypass, $passwordreg) == true && $userverify == $usernamereg && $blocked == "%%%%%%")
            {
               if(!empty($_POST["remember"])) {
                  include 'cryptkey.php';
                  $sessionTime = 365 * 24 * 60 * 60;
                  session_set_cookie_params($sessionTime);
                  $cookie_name = "nameonsession";
                  $cookie_value = encrypt($userverify, 'SECURE_KEYssssss');
                  setcookie($cookie_name, $cookie_value,time() + $sessionTime, "/",FALSE);
                  $strand=rand(); 
                  $resultand = md5($strand); 
                  $cookie_name = "ckreg";
                  $cookie_value = $resultand;
                  $resultand = password_hash($resultand, PASSWORD_DEFAULT);
                  $strold = file_get_contents($usersearch);
                  $fp2 = fopen($usersearch, "w") or die("Unable to open file!");
                  if($ckreg != "inick")
                  {
                     $replaced = str_replace($ckreg,$resultand,$strold);
                  }
                  else
                  {
                     $replaced = str_replace("inick",$resultand,$strold);
                  }
                  fwrite($fp2, $replaced);
                  fclose($fp2);
         // random cookie value is passed to session but before that hashed value is stored
                  setcookie($cookie_name, $cookie_value,time() + $sessionTime, "/",FALSE);   
                  echo '<img src onerror="snackbarF()"><div id="snackbar">Welcome</div>';
                  header('Refresh: 1; ../../../');   

               }
               else
               {
                  echo '<img src onerror="snackbarF()"><div id="snackbar">Welcome</div>';
                  $_SESSION["nameonsession"] = $userverify;
                  $_SESSION["loginpassonsession"] = $userverifypass;
                  header('Refresh: 1; ../../../');
               }
            }
            elseif (password_verify($userverifypass, $passwordreg) == true && $userverify == $usernamereg && $blocked == "######") {
               echo '<img src onerror="snackbarF()"><div id="snackbar">You have been blocked</div>';
            }
            else
            {
               echo '<img src onerror="snackbarF()"><div id="snackbar">Wrong Username or Password</div>';
            }
         }
         if($fileex == 0)
         {
            echo '<img src onerror="snackbarF()"><div id="snackbar">Wrong Username or Password</div>';
         }
      }
      }
   }
   ?>
   <div align = "center">
      <div class = "cen" align = "left">
         <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>     
         <div class = "margincen">
            <a href="../">
               <img src="../images/homeim.png" alt="Home" class="center">
            </a>
            <form action = "login.php" method = "post">
               <label>Username<br/></label><input type = "text" name = "username" class = "box"/><br /><br />
               <label>Password<br/></label><input type = "password" name = "password" class = "box" /><br/><br />
               <input type="checkbox" name="remember" id="remember">Remember me</label><br /><br />
               <input type = "submit" class="button" value = " Login "/>
               <button type="button" class="button" onclick="location.href='register.php'">Register</button>
               </br></br><a href="forgotpassword.php">forgot password?</a>
            </form>           
         </div> 
      </div>
   </div>
</body>
</html>

