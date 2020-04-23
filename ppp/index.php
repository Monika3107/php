<?php 
  // create curl resource
  $ch = curl_init();
  // set url
  curl_setopt($ch, CURLOPT_URL, "https://personal-sites.deakin.edu.au/~mvsolanki/sit780/218614619_ass1/Assignment1/read.php");
  //return the transfer as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // $output contains the output string
  $output = curl_exec($ch);
  $data = json_decode($output);
  $data = (array)$data;
  // close curl resource to free up system resources
  curl_close($ch);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Read Consume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
  </head>
  <body>
    <h1>Student Data</h1>
    <div style="margin-right:30%;margin-left:30%;">
        <form action="index.php" method="POST">
          <input id="sid" type="text" name='sid' placeholder="SID" required minlength="1" maxlength="20" size="10"/>
          <input id="fname" type="text" name='fname' placeholder="FNAME" required minlength="1" maxlength="20" size="10"/>
          <input id="sname" type="text" name='sname' placeholder="SNAME" required minlength="1" maxlength="20" size="10"/>
          <input id="email" type="text" name='email' placeholder="EMAIL" required minlength="1" maxlength="20" size="10"/>
          <center style="margin:10px;">
            <input class="button button5" type="submit" name="insert" value="INSERT" onClick="refreshPage()">
            <input class="button button5" type="submit" name="update" value="UPDATE" onClick="refreshPage()">
            <input class="button button5" type="submit" name="delete" value="DELETE"onClick="refreshPage()">
            <input class="button button5" type="reset" name="reset" value="RESET" onClick="refreshPage()">
          </center>
        </form>
    </div>
    <table class="table-fill">
      <thead>
        <tr>
          <th>SID</th>
          <th>FNAME</th>
          <th>SNAME</th>
          <th>EMAIL</th>
        </tr>
      </thead>
      <?php
        for($i = 0;$i<=sizeof($data)-1;$i++){
          $temp = (array)$data[$i];
          echo "<tr id='tr".$temp['SID']."' onclick=tableClick(".$temp['SID'].",'".$temp['FNAME']."','".$temp['SNAME']."','".$temp['EMAIL']."')><td>".$temp['SID']."</td><td>".$temp['FNAME']."</td><td>".$temp['SNAME']."</td><td>".$temp['EMAIL']."</td></tr>";
        }
      ?>
    </table>
    <div class="footer">
      <p>Please Select any raw from the table to update or delete that data</p>
    </div>
  </body>
</html>

<?php
  if(isset($_REQUEST['insert'])){
    echo "Insert clicked";
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://personal-sites.deakin.edu.au/~mvsolanki/sit780/218614619_ass1/Assignment1/insert.php?sid=".$_REQUEST['sid']."&fname=".$_REQUEST['fname']."&sname=".$_REQUEST['sname']."&email=".$_REQUEST['email']);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    if($output == 1){
      echo "<script>alert('Insert successful');</script>";
    }else{
      echo "<script>alert('Some error occured during insert');</script>";
    }

    //print_r($temp);
    // close curl resource to free up system resources
    curl_close($ch);
    echo("<meta http-equiv='refresh' content='1'>");
  }
?>

<?php
  if(isset($_REQUEST['update'])){
    echo "Update clicked";
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://personal-sites.deakin.edu.au/~mvsolanki/sit780/218614619_ass1/Assignment1/update.php?sid=".$_REQUEST['sid']."&fname=".$_REQUEST['fname']."&sname=".$_REQUEST['sname']."&email=".$_REQUEST['email']);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    if($output == 1){
      echo "<script>alert('Update successful');</script>";
    }else{
      echo "<script>alert('Some error occured during update');</script>";
    }

    // close curl resource to free up system resources
    curl_close($ch);
    echo("<meta http-equiv='refresh' content='1'>");
  }
?>

<?php
  if(isset($_REQUEST['delete'])){
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://personal-sites.deakin.edu.au/~mvsolanki/sit780/218614619_ass1/Assignment1/delete.php?sid=".$_REQUEST['sid']);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    if($output >= 1){
      echo "<script>alert('Delete successful');</script>";
    }else{
      echo "<script>alert('Some error occured during delete');</script>";
    }

    // close curl resource to free up system resources
    curl_close($ch);
    echo("<meta http-equiv='refresh' content='1'>");
  }
?>
