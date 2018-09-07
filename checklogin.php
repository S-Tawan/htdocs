<?php
  if (!isset($_SESSION['status'])) {
    $_SESSION['online'] = 1;
    header("Location: index.php");
  }
 ?>
