<?php
  $dbuser = "mvsolanki";
  $dbpass = "Vsmd0405#";
  $db = "SSID";
  $connect = OCILogon($dbuser, $dbpass, $db);

  if (!$connect) {
    echo "An error occurred connecting to the database";
    exit;
  }

  $query = "SELECT * FROM tbl_students order by sid";
  $stmt = OCIParse($connect, $query);
  if(!$stmt) {
    echo "An error occurred in parsing the SQL string.\n";
    exit;
  }

  OCIExecute($stmt);
  $nrows = oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW+OCI_ASSOC);
  echo json_encode($res);
?>
