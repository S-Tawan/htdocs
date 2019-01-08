<?php
  require 'server.php';
  session_start();
  require 'checknoob.php';
  $sub_id = $_POST['sub_id'];
  $sub_name = $_POST['sub_name'];
  $q = "INSERT INTO `subject`(`order`, `sub_id`, `id_name`) VALUES ('','$sub_id','$sub_name')";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_subject']=1;
  }else {
    $_SESSION['counter_subject']=2;
  }
  header("Location: setting_subject_database.php");
?>
