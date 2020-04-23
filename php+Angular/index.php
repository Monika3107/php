<?php
  /*verify captcha*/
  if(isset($_POST['submit'])){
    session_start();
    $code = $_SESSION['captcha'];
    $userCap = $_POST['captcha'];
    /* if valid captcha entered*/
    if ($code===$userCap) {
      /* get the user name and password from the form*/
      $username = $_REQUEST["username"];
    	$password = $_REQUEST["password"];
      $uniquekey = 'deakin';
      $encryptedpwd = md5($uniquekey.$password);

    	/*set oracle user login and password info */
      $dbuser = "mvsolanki";
      $dbpass = "Vsmd0405#";	// Deakin password
    	$db="SSID";
    	$connect=OCILogon($dbuser, $dbpass, $db);

    	if (!$connect)
    	{
    		echo("An error occurred connecting to the database");
    		exit;
    	}

    	/*build the sql statement */
    	$query="SELECT * FROM Login WHERE username='".$username. "' OR password='".$encryptedpwd."'";

    	/*check the sql statement for errors and if there are errors report them.*/
    	$stmt=OCIParse($connect, $query);
    	if(!$stmt)
    	{
    		echo("An error occurred in parsing the SQL string. \n");
    		exit;
    	}
    	OCIExecute($stmt);
  	/* complete checking if both or individual username and password are valid */
    	$username_exist = false;
    	$password_exist = false;
    	$valid = false;
    	$empty = true;
    	while(OCIFetch($stmt))
    	{
    			$empty = false;

    			if(OCIResult($stmt,"USERNAME") == $username)
    			{
    				if(OCIResult($stmt,"PASSWORD") == $encryptedpwd)
    				{
    					$valid = true;
    					//exit;
    				}
    				else
    					$username_exist = true;
    			}
    			else
    				$password_exist = true;
    	}

    	if($empty)
    		echo "Sorry, your account does not exist. Please try again.";
    	else
    	{
    		if ($valid){
    		  $_SESSION['username'] = $username;
          header('Location: displayData.php');
        }
    		elseif ($username_exist)
    			echo "Sorry, your password is incorrect.\n";
    		else
    			echo "Sorry, your username is incorrect.\n";
    	}

    	//close the connection
    	OCILogOff($connect);
    } else{
      if($userCap!=null){
        echo "Invalid CAPTCHA code entered.\n";
      }
    }
  }
	?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Read Consume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles.css">
    <script src="main.js"></script>
  </head>
  <body>
    <h1>Login</h1>
    <p align="center">For admin access credentials are admin/SIT780, for guest access credentials are guest/SIT780.</p>
    <div style="margin-right:30%;margin-left:30%;">
        <form action="index.php" method="POST">
          <input id="username" type="text" name='username' placeholder="username" required minlength="1" maxlength="20" size="10"/>
          <input id="password" type="password" name='password' placeholder="password" required minlength="1" maxlength="20" size="10"/>
          <input id="captcha" type="text" name='captcha' placeholder="captcha" required minlength="1" maxlength="20" size="10"/>
          <img id="capImg" src="captcha.php"><br>
          <center style="margin:10px;">
            <input class="button button5" type="submit" name="submit" value="SUBMIT" onClick="refreshPage()">
          </center>
        </form>
    </div>
    <div class="footer">
      <p>Please enter username and password for login</p>
    </div>
  </body>
</html>
