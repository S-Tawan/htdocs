<?php
require 'server.php';
session_start();
$or = $_GET['id'];
$user_id = $_POST['user_id'];
$user_title = $_POST['title'];
$user_first_name = $_POST['fname'];
$user_last_name = $_POST['lname'];
$login_username = $_POST['username'];
$login_password = $_POST['password'];
$exam_year = $_POST['year'];
$exam_term = $_POST['term'];
$exam_type = $_POST['type'];
$exam_subject = $_POST['sub'];
$exam_date = $_POST['date'];
$exam_time = $_POST['time'];
$exam_location = $_POST['place'];
$exam_tool = $_POST['tool'];
$exam_seat = $_POST['seat'];
$note = $_POST['comment'];
$q = "UPDATE `student_table` SET `user_id`='$user_id',`user_title`='$user_title',`user_first_name`='$user_first_name',
      `user_last_name`='$user_last_name',`login_username`='$login_username',`login_password`='$login_password',
      `exam_year`='$exam_year',`exam_term`='$exam_term',`exam_type`='$exam_type',`exam_subject`='$exam_subject',`exam_date`='$exam_date',`exam_time`='$exam_time',`exam_location`='$exam_location',
      `exam_tool`='$exam_tool',`exam_seat`='$exam_seat',`note`='$note' WHERE `order`= $or";
$result = mysqli_query($con, $q);
if ($result) {
  $_SESSION['counter_student'] = 3;
  header("Location: datastudent.php");
} else {
  $_SESSION['counter_student'] = 4;
  header("Location: datastudent.php");
}
?>
