<?php
  session_start();
  require 'server.php';
  require 'checknoob.php';
  $name_location = $_POST['name_location'];
  $url_location = $_POST['url_location'];

  $q = "INSERT INTO `location_table`(`order`,`name_location`, `url_location`)
        VALUES ('','$name_location','$url_location')";
  $result = mysqli_query($con,$q);
  if ($result) {
    $_SESSION['counter_location'] = 1;
    header("Location: location.php");
  }else {
    $_SESSION['counter_location'] = 2;
    header("Location: location.php");
  }
?>
