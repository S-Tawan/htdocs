<?php
  require 'server.php';
  session_start();
  $order = $_GET['id'];
  $q = "DELETE FROM `subject` WHERE `order` = '$order' ";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_subject']=5;
  }else {
    $_SESSION['counter_subject']=6;
  }
  header("Location: setting_subject_database.php");
?>
