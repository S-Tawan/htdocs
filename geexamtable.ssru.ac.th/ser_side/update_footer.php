<?php
  session_start();
  require 'server.php';
  require 'checklogin.php';
 
  $text =  $_POST['commentf'];
  $year =  $_POST['year'];
  $term =  $_POST['term'];
  $web_rub = "UPDATE `web_show_time` SET `web_term`='$term',`web_year`='$year',`footer`='$text'";
  $web_result1 = mysqli_query($con,$web_rub);
  if ($result) {
    $_SESSION['counter_footer'] = 3;
    header("Location: settingfooter.php");
  }else {
    $_SESSION['counter_footer'] = 3;
    header("Location: settingfooter.php");
  }

?>