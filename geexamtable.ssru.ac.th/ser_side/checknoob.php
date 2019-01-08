<<?php
if ($_SESSION['role'] == 'Admin') {

} elseif (($_SESSION['role'] == 'ผู้ดูแลระบบ')) {

} else {
    $_SESSION['role_user'] = 1;
    header("Location: main.php");
}

 ?>
