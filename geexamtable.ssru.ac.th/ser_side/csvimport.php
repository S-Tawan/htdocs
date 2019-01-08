
<?php

  require 'server.php';
  session_start();
  require 'checklogin.php';
  mysqli_set_charset($con,'tis620');
  $a = $_FILES['filee']["tmp_name"];
  $file = fopen($a,'r');
  $start = $_POST['StartRow'];
  $end = $_POST['EndRow'];
//  echo $start." : ".$end."<br>";
  $row = 0;
  $success = 0;
  if (($handle = fopen("$a", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $value = "'".implode("','",$data)."'";
      //  echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        if ($row>=$start&&$row<=$end) {
            $q = "INSERT INTO student_table(`user_id`,`user_title`, `user_first_name`, `user_last_name`,`login_username`, `login_password`, `exam_year`, `exam_term`, `exam_type`, `exam_subject`, `exam_date`, `exam_time`, `exam_location`, `exam_tool`, `exam_seat`, `note`)
            VALUES(". $value .") ";
            $resault = mysqli_query($con,$q);
            $success++;
        }

    }
    if ($success == ($end-$start)+1) {
      $_SESSION['import_success'] = 1;

    }else {
      $_SESSION['import_success'] = 2;

    }
    header("Location: update_student_csv.php?id='(($end-$start)+1)'");
    //header("Location: main.php");
  fclose($handle);
  }
 ?>
