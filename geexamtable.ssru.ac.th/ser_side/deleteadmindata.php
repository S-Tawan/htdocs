<?php
  session_start();
  require 'server.php';
  $a = $_GET['id'];
  $q = "DELETE FROM `admin_table` WHERE `admin_id` = '$a'";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_admin'] = 5;
    header("Location: adminonly.php");
  }else {
    $_SESSION['counter_admin'] = 6;
    header("Location: adminonly.php");
  }

 ?>
