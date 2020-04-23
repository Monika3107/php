<?php
  $str = md5(microtime());
  $ran_str = substr($str,0,6);

  session_start();
  $_SESSION['captcha'] = $ran_str;
  $img = imagecreate(100,40);
  imagecolorallocate($img,220,220,255);
  $txtcol =  imagecolorallocate($img,0,0,0);
  imagestring($img,29,20,10,$ran_str,$txtcol);

  //header('Content:/image/jpeg');
  imagejpeg($img);
?>
