<?php
  session_start();
  require 'server.php';
  $a = $_GET['id'];
  $q = "DELETE FROM `location_table` WHERE `order` = '$a'";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_location'] = 5;
    header("Location: location.php");
  }else {
    $_SESSION['counter_location'] = 6;
    header("Location: location.php");
  }

 ?>
