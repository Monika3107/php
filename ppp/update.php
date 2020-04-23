<?php
  if(isset($_REQUEST['sid'])) {
    $sid = $_REQUEST['sid'];
    $fname = $_REQUEST['fname'];
    $sname = $_REQUEST['sname'];
    $email = $_REQUEST['email'];
    $dbuser = "mvsolanki";
    $dbpass = "Vsmd0405#";
    $db = "SSID";
    $connect = OCILogon($dbuser, $dbpass, $db);

    if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
    }

    $query = "UPDATE tbl_students SET FNAME = '$fname', SNAME='$sname', EMAIL='$email' WHERE SID=".$sid;
    $stmt = OCIParse($connect, $query);
    if(!$stmt) {
      echo "An error occurred in parsing the SQL string.\n";
      exit;
    }

    OCIExecute($stmt);
    $nrows =  oci_num_rows($stmt);
    echo $nrows;
    $r = oci_commit($connect);
    if (!$r) {
      $e = oci_error($coconnectnn);
      trigger_error(htmlentities($e['message']), E_USER_ERROR);
    }
  } else {
        $nrows = 0;
        echo $nrows;
  }      
?>
