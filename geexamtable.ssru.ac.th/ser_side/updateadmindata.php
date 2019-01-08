<?php
  session_start();
  require 'server.php';
  require 'checklogin.php';
  $a = $_GET['id'];
  $b = $_POST['user_id'];
  $c = $_POST['fname'];
  $d = $_POST['lname'];
  $e = $_POST['username'];
  $f = $_POST['password'];
  $f2 = base64_encode($f);
  echo $f2;
  $g = $_POST['status'];
  $h = $_POST['role'];
  echo $b;
  $q = "UPDATE `admin_table` SET `admin_id`='$b',`first_name`='$c',`last_name`='$d',
        `admin_username`='$e',`admin_password`='$f2',`admin_role`='$h',`admin_status`='$g' WHERE `admin_id`='$a' ";
  $result = mysqli_query($con,$q);
//  unset($a);
//  unset($_SESSION['derm']);
  if ($result) {
    $_SESSION['counter_admin'] = 3;
    header("Location: adminonly.php");
  }else {
    $_SESSION['counter_admin'] = 4;
    header("Location: adminonly.php");
  }
 ?>
