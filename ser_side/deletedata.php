<?php
  require 'server.php';
  session_start();
  $id = $_GET['id'];
  $q = "DELETE FROM `student_table` WHERE `order` = $id";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_student'] = 5;
    header("Location: datastudent.php");
  }else {
    $_SESSION['counter_student'] = 6;
    header("Location: datastudent.php");
  }
 ?>
