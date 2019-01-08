<<?php
if ($_SESSION['role'] == 'Admin') {

} elseif (($_SESSION['role'] == 'ผู้ดูแลระบบ')) {
  $_SESSION['role_user'] = 1;
      header("Location: main.php");
} else {
    $_SESSION['role_user'] = 1;
    header("Location: main.php");
}

 ?>
