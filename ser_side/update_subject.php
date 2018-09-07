<?php
  require 'server.php';
  session_start();
  $or = $_GET['id'];
  $id = $_POST['sub_id'];
  $name = $_POST['sub_name'];
  $q = "UPDATE `subject` SET `sub_id`='$id',`id_name`='$name' WHERE `order` = $or";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_subject']=3;
  }else {
    $_SESSION['counter_subject']=4;
  }
  header("Location: setting_subject_database.php");
?>
