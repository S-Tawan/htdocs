<?php
session_start();
require 'server.php';
require 'checklogin.php';
$or = $_GET['id'];
$b = $_POST['name_location'];
$c = $_POST['url_location'];

$q = "UPDATE `location_table` SET `name_location`='$b',`url_location`='$c' WHERE `order`='$or' ";
$result = mysqli_query($con, $q);
if ($result) {
  $_SESSION['counter_location'] = 3;
  header("Location: location.php");
} else {
  $_SESSION['counter_location'] = 4;
  header("Location: location.php");
}
?>
