<?php
  require 'server.php';
  
  session_start();
  
  $login_id = mysqli_real_escape_string($con,$_POST['text']);
  $login_pw = mysqli_real_escape_string($con,$_POST['password']);

  $sql = "SELECT * FROM student_table WHERE login_username=? AND login_password=?";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt,"ss",$login_id,base64_encode($login_pw));
  mysqli_execute($stmt);
  $result_user = mysqli_stmt_get_result($stmt);
  $_SESSION['status'] = 0; //online
  if ($result_user->num_rows >=1) {
    $_SESSION['id'] = $login_id;
    header("Location: main.php");
  }else{
    $_SESSION['status'] = 1; //not match
    header("Location: index.php");
  }
 ?>
