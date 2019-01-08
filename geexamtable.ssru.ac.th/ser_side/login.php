<?php
  require 'server.php';
  session_start();
  $login_id = mysqli_real_escape_string($con,$_POST['user']);
  $login_pw = mysqli_real_escape_string($con,$_POST['pass']);

  $sql = "SELECT * FROM admin_table WHERE admin_username=? AND admin_password=?";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt,"ss",$login_id,base64_encode($login_pw));
  mysqli_execute($stmt);
  $result_user = mysqli_stmt_get_result($stmt);
  $_SESSION['$status'] = 1;
  if ($result_user->num_rows ==1) {
    $row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC);
    if($row_user['admin_status']==0){
      $_SESSION['$status'] = 0;
      header("Location: index.php");
    }else {
      $_SESSION['login'] = 1 ;
      $_SESSION['role'] = $row_user['admin_role'];
      $_SESSION['counter_admin'] = 0;
      $_SESSION['counter_student'] = 0;
      $_SESSION['admin_username'] = $row_user['admin_username'];

      header("Location: main.php");
    }
  }else{
    $_SESSION['$status'] = 2;
    header("Location: index.php");
  }
 ?>
