<?php
    //connect database 
    require 'server.php';

    //get value form id
    $id = $_GET['id'];
    $i = 1;

    //update data form last to head
    $a = "SELECT `order` FROM `student_table` ORDER BY `order` DESC";
    $q_a = mysqli_query($con,$a);
    while($i<$id){
        $r_a = mysqli_fetch_assoc($q_a);
        $r_b = base64_encode($r_a['login_password']);
        $b = "UPDATE login_password='$r_b' ";
        mysqli_query($con,$b);
        $i++;
    }

    header("Location: importstudentinfo.php ");
?>