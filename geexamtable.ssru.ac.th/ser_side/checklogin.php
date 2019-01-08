<?php

  if (!isset($_SESSION['login'])&&!isset($_SESSION['$status'])) {

    $_SESSION['meow'] = 1;
    header("Location: index.php");
  }
 ?>
