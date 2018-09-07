<?php
  session_start();
  require 'server.php';
  $user_id = $_POST['user_id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $password = base64_encode($_POST['password']);
  $role = $_POST['role'];
  $active = $_POST['status'];
  $q = "INSERT INTO `admin_table`(`admin_id`, `first_name`, `last_name`, `admin_username`, `admin_password`, `admin_role`, `admin_status`)
        VALUES ('$user_id','$fname','$lname','$username','$password','$role','$active')";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_admin'] = 1;
    header("Location: adminonly.php");
  }else {
    $_SESSION['counter_admin'] = 2;
    header("Location: adminonly.php");
  }
?>
