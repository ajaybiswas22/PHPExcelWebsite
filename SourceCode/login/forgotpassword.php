<!DOCTYPE html>
<html lang="en-US">
  <head>
   <title>Forgot Password</title>
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
   					$userverify = isset($_POST['username']) ? $_POST['username'] : 'nobody';
   					$birdverify = isset($_POST['secbird']) ? $_POST['secbird'] : 'bird';
   					$newpass = isset($_POST['newpass']) ? $_POST['newpass'] : 'nobody';
   					if(preg_match("/([%\$\[\]?<>!\/@^&-+.,:;`~|\"#\*]+)/", $userverify) || preg_match("/([%\$\[\]?<>!\/@^&-+.,:;`~|\"#\*]+)/", $birdverify))
         			{
            			echo '<img src onerror="snackbarF()"><div id="snackbar">Invalid username or answer</div>';
         			}
         			else
         			{
                $birdverify = stripslashes($birdverify);
                $birdverify = preg_replace('/\s/', '', $birdverify);
                $birdverify = strtolower($birdverify);
         				$usersearch = '../profilepass/'. $userverify .'_passfile.php';
         				$fileex = file_exists($usersearch);
         				if($fileex == 1)
         				{
         					include $usersearch;
         					if($quesreg == $birdverify)
         					{
         						$newpass = password_hash($newpass, PASSWORD_DEFAULT);
         						$inpData = file_get_contents($usersearch);
    							$inpData = str_replace($passwordreg,$newpass,$inpData);
    							$fp = fopen($usersearch, "w") or die("Unable to open file!");
    							fwrite($fp, $inpData);
    							echo '<img src onerror="snackbarF()"><div id="snackbar">Updated Profile</div>';
                  header('Refresh: 2; login.php');
         					}
         					else
         					{
         						echo '<img src onerror="snackbarF()"><div id="snackbar">Invalid username or answer</div>';
         					}
         				}
         				else
         				{
         					echo '<img src onerror="snackbarF()"><div id="snackbar">Invalid username or answer</div>';
         				}
         			}	

   				}
   				?>
   <div align = "center">
      <div class = "cen" align = "left">
         <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Forgot Password</b></div>     
         <div class = "margincen">
            <a href="../">
               <img src="../images/homeim.png" alt="Home" class="center">
            </a>
            <form action = "forgotpassword.php" method = "post">
               <label>Username<br/></label><input type = "text" name = "username" class = "box"/><br /><br />
               <label>What is favorite Bird?<br/></label><input type = "text" name = "secbird" class = "box" /><br/><br />
               <label>New Password<br/></label><input type = "password" name = "newpass" class = "box" /><br/><br />
               <input type = "submit" class="button" value = "Submit"/>
            </form>           
         </div> 
      </div>
   </div>
</body>
</html>

