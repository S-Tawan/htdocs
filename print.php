<?php
require 'server.php';
session_start();
$a = $_SESSION['id'];
$b = $_SESSION['year'];
$c = $_SESSION['term'];
$d = $_SESSION['type'];
$user = "SELECT * FROM student_table WHERE user_id = '$a'";
  $q = "SELECT * FROM student_table WHERE user_id = '$a' AND exam_year = '$b' AND exam_term = '$c' AND exam_type = '$d'";
  $result1 = mysqli_query($con,$user);
  $result = mysqli_query($con,$q);
  $row1 = mysqli_fetch_array($result1);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="font.css">
    <title>Document</title>
</head>
<body>
<br><br>
        <section class="container-fluid" style="height: 100%">
              <table class="table table-borderless" style="width: 100%">
                     <tr>
                        <th>
                            <center><img src="image/eddd219671f4e3e2333be5105343e18dd0ba426a.png" alt="LOGO" width="110" height="140"> <br>
                                 <h3>
                                สำนักวิชาการศึกษาทั่วไปและนวัตกรรมการเรียนรู้อิเล็กทรอนิกส์ <br>
                                        มหาวิทยาลัยราชภัฏสวนสุนันทา <br></h3>
                            </center>
                        </th>
                      </tr>
                      <tr>
                       
                          <td style="text-align: center">
                          <h4>
                             <?php echo "ชื่อ ".$row1['user_title']." ".$row1['user_first_name']." นามสกุล ".$row1['user_last_name']." รหัสนักศึกษา ".$row1['user_id'];
                             ?>
                             </h4>
                          </td>
                          
                      </tr>
                  </table>
                    

                <center><h4 style="width: 100%;height: 30px;">ตารางสอบวัดความรู้ <?php echo $d ?> ปีการศึกษา <?php echo $c."/".$b ?></h4></center>

               <div class="container">
<div id="resultsTable">
<div class="table-responsive">
                <table class="table table-striped table-sm table-bordered" style="width:100%" >
                    <thead>
                            <tr>
                                <th style="color:white;background-color: #55236d;border-radius:5px" colspan="7"><h4 >ตารางสอบวัดความรู้ <?php echo $d ?> ปีการศึกษา 1/2561</h4></th>
                            <tr>
                            <tr style="text-align: center">
                                            <td ><p style="font-size: 6">วิชา</p>  </td>
                                            <td ><p style="font-size: 6">วันที่สอบ</p>  </td>
                                            <td ><p style="font-size: 6">เวลาสอบ</p>  </td>
                                            <td ><p style="font-size: 6">สถานที่</p>  </td>
                                            <td ><p style="font-size: 6">อุปกรณ์ที่ใช้สอบ</p>  </td>
                                            <td ><p style="font-size: 6">ที่นั่งสอบ</p>  </td>
                                            <td ><p style="font-size: 6">หมายเหตุ </p> </td>
                                </tr>
                    </thead>
                        <tbody>
                                       <?php while($row =mysqli_fetch_array($result)){ ?>
                                        <?php
                                        $l_name = $row['exam_location'];
                                        $q_location =  "SELECT * FROM `location_table` WHERE name_location = '$l_name' ";
                                        $l_result = mysqli_query($con,$q_location);
                                        $l_row = mysqli_fetch_array($l_result);
                                        $sub = $row['exam_subject'];
                                        $q_sub = "SELECT * FROM `subject`  WHERE sub_id = '$sub' ";
                                        $re_sub = mysqli_query($con, $q_sub);
                                        $sub_row = mysqli_fetch_array($re_sub);


                                        ?>
                                      <tr style="text-align: center">
                                      <td style="text-align:left" ><p style="font-size: 6 "><?php echo $row['exam_subject'] . " " . $sub_row['id_name'] ?></p></td>
                                        <td><p style="font-size: 6"><?php echo $row['exam_date'] ?></p></td>
                                        <td><p style="font-size: 6"><?php echo $row['exam_time']?></p></td>
                                        <td><p style="font-size: 6"><?php echo $row['exam_location'] ?></p>
                                       
                                        <a href="<?php echo $l_row['url_location'] ?>" target="_blank" ><i class="fas fa-map-marked-alt" style="font-size: 40px; "></i></a>
                                        
                                        </td>
                                        <td><p style="font-size: 6"><?php echo $row['exam_tool'] ?></p>
                                       <!-- <div style="width:80%"> -->
                                          <?php if ($row['exam_tool']=="Tablet"): ?>
                                          <i class="fas fa-tablet-alt" style="font-size: 50px;" ></i>
                                          <?php endif; ?>
                                          <?php if ($row['exam_tool']=="Computer"): ?>
                                          <i class="fas fa-desktop" style="font-size: 50px;" ></i>
                                          <?php endif; ?>
                                        <!-- </div> -->
                                        </td>

                                        <td><p style="font-size: 6"><?php echo $row['exam_seat'] ?></p></td>
                                        <td><p style="font-size: 6"><?php echo $row['note'] ?></p></td>
                                      </tr>

                                      <?php } ?>
                                    <tr style="border-collapse: collapse">
                                        <td colspan="6" ><p style="font-size: 6">*** หากไม่พบข้อมูล ติดต่อได้ที่จุด one stop service</p></td>
                                        <td> <div onclick="openInNewTab('print.php');"><p style="font-size: 5"><a class="btn btn-link" ></a></p></div></td> 
                                    </tr>
                        </tbody>
                   </table>
        </div>
</div>
</div>
<br>
                  <center>
                  <button  class="btn btn-danger" onclick="myFunction()">Print</button>

                    <script>
                        function myFunction() {
                          window.print();
                        }
                    </script>
                  </center>
                  <br>
               </section>
                <footer>
                    <center>
                  <font style ="font-size: 6">
                    *** หากไม่พบข้อมูล กรุณาติดต่อสอบถามได้ที่จุด one stop service อาคาร34 ชั้น1 <br>
                    สำนักวิชาการศึสำนักวิชาการศึกษาทั่วไปและนวัตกรรมการเรียนรู้อิเล็กทรอนิกส์ ติดต่อ 02-160-1265-70
                  </font>
                    </center>
                </footer>


                <div>
                        <script src="node_modules/jquery/dist/jquery.min.js"></script>
                        <script src="node_modules/popper.js/dist/popper.min.js"></script>
                        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
                </div>
</body>
</html>
