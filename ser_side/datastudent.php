<?php
require 'server.php';
session_start();
require 'checklogin.php';
$q_web = "SELECT * FROM web_show_time";
$result_web = mysqli_query($con, $q_web);
$row_web = mysqli_fetch_array($result_web);
$_SESSION['year'] = $row_web['web_year'];

if ($_SESSION['counter_student'] == 1) {
  echo '<script type="text/javascript">alert("เพิ่มข้อมูลสำเร็จ.");</script>';
} elseif ($_SESSION['counter_student'] == 2) {
  echo '<script type="text/javascript">alert("เพิ่มข้อมูลไม่สำเร็จ.");</script>';
} elseif ($_SESSION['counter_student'] == 3) {
  echo '<script type="text/javascript">alert("แก้ไขข้อมูลเรียบร้อย.");</script>';
} elseif ($_SESSION['counter_student'] == 4) {
  echo '<script type="text/javascript">alert("การแก้ไขข้อมูลเกิดข้อผิดพลาด.");</script>';
} elseif ($_SESSION['counter_student'] == 5) {
  echo '<script type="text/javascript">alert("ลบข้อมูลเรียบร้อย.");</script>';
} elseif ($_SESSION['counter_student'] == 6) {
  echo '<script type="text/javascript">alert("การลบข้อมูลเกิดข้อผิดพลาด.");</script>';
}
$_SESSION['counter_student'] = 0;
$q_sub = "SELECT * FROM subject ORDER BY sub_id ASC";
$re_sub = mysqli_query($con, $q_sub);
$q_sub_2 = "SELECT * FROM subject ORDER BY sub_id ASC";
$re_sub_2 = mysqli_query($con, $q_sub);
$q_location = "SELECT * FROM location_table ";
$re_location = mysqli_query($con, $q_location);
?>
<!DOCTYPE html>
<html>
<head>
  <title>data student</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/font.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>

    <script>
        function getSelectValue()
        {
            var selectedValue = document.getElementById("aa").value;
            <?php $_SESSION['batman'] = "console.log(selectedValue);" ?>
        }
        getSelectValue();
    </script>
</head>
      <body>

          <header class="container-fluid">
          <center><a href="#"><img src="image/ปกหลังบ้าน.jpg" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"></a></center>
            <div style="text-align: right"> <!-- when show online now  -->
                  <p><?php echo $_SESSION['admin_username'] . "  " . $_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
          </header>
         
          <?php
            require 'tab_menu.php';
          if (!isset($_POST['gogogo'])) {
          ?>
            
            <div class="col col-lg-10" style="border:1px solid #d9d9d9">
                  <center> <h3 class="text-info">ข้อมูลนักศึกษา</h3></center>
                  <div>
                  <div class="container-fluid">
                    <div class="text-center">
                    <div class="card" style="width:100%;">
                      <div class="card-body">
                      <form action="datastudent.php" method="POST">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col col-md-6">
                                <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $_SESSION['year'] ?>"required >
                              </div>
                              <div class="col col-md-6">
                                <p>ภาคการศึกษา : </p><select class="form-control" name="term" >
                                              <option value="ทั้งหมด">------ทั้งหมด------</option>
                                              <option value="1">ภาคเรียนที่ 1</option>
                                              <option value="2">ภาคเรียนที่ 2</option>
                                              <option value="3">ภาคเรียนที่ 3</option>
                                            </select>
                              </div>
                              
                            </div>
                          </div>
                                       <div class="container-fluid"> 
                                         <div class="row">
                                         <div class="col col-md-6">
                                          <p>การสอบ : </p><select class="form-control" name="type" >
                                                        <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                        <option>กลางภาค</option>
                                                        <option>ปลายภาค</option>
                                                        <option>แก้ไขผลการเรียน(I)</option>
                                                        <option>อื่นๆ...</option>
                                                      </select>
                                        </div>
                                            <div class="col col-md-6">
                                            <p>วิชาที่สอบ : </p>
                                              <select class="form-control" id="aa" name="sub" onchange="getSelectValue();" >
                                                <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <?php while ($row_sub = mysqli_fetch_array($re_sub)) { ?>
                                                    <option value="<?php echo $row_sub['sub_id']?>"><?php echo $row_sub['sub_id'] . " " . $row_sub['id_name'] ?></option>
                                                
                                                <?php 

                                              } ?>
                                              </select>
                                            </div>
                                            </div>  
                                          </div>
                                          <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="gogogo">Search</button></div>
                                               
                                          </form>
                      </div>
                    </div>
                  </div>
                  </div>
                  <?php
          }
          else {
            $year = $_POST['year'];
            $term = $_POST['term'];
            $type = $_POST['type'];
            $sub = $_POST['sub'];
            ?>
              
              <div class="col col-lg-10" style="border:1px solid #d9d9d9">
                    <center> <h3 class="text-info">ข้อมูลนักศึกษา</h3></center>
                    <div>
                    <div class="container-fluid">
                      <div class="text-center">
                      <div class="card" style="width:100%;">
                        <div class="card-body">
                        <form action="datastudent.php" method="POST">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col col-md-6">
                                  <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $year ?>"required >
                                </div>
                                <div class="col col-md-6">
                                  <p>ภาคการศึกษา : </p><select class="form-control" name="term" >
                                  <option selected hidden  value="<?php echo $term ?>"><?php echo $term ?></option>
                                                <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <option value="1">ภาคเรียนที่ 1</option>
                                                <option value="2">ภาคเรียนที่ 2</option>
                                                <option value="3">ภาคเรียนที่ 3</option>
                                              </select>
                                </div>
                                
                              </div>
                            </div>
                                         <div class="container-fluid"> 
                                           <div class="row">
                                           <div class="col col-md-6">
                                            <p>การสอบ : </p><select class="form-control" name="type" >
                                            <option selected hidden  value="<?php echo $type ?>"><?php echo $type ?></option>
                                                          <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                          <option>กลางภาค</option>
                                                          <option>ปลายภาค</option>
                                                          <option>แก้ไขผลการเรียน(I)</option>
                                                          <option>อื่นๆ...</option>
                                                        </select>
                                          </div>
                                              <div class="col col-md-6">
                                              <p>วิชาที่สอบ : </p>
                                                <select class="form-control" id="aa" name="sub" onchange="getSelectValue();" >
                                                <option selected hidden  value="<?php echo $sub ?>"><?php echo $sub ?></option>
                                                  <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                  <?php while ($row_sub = mysqli_fetch_array($re_sub)) { ?>
                                                      <option value="<?php echo $row_sub['sub_id']?>"><?php echo $row_sub['sub_id'] . " " . $row_sub['id_name'] ?></option>
                                                  
                                                  <?php 
  
                                                } ?>
                                                </select>
                                              </div>
                                              </div>  
                                            </div>
                                            <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="gogogo">Search</button></div>
                                                 
                                            </form>
                        </div>
                      </div>
                    </div>
                    </div>
                    <?php
            }
                    ?>
                  
                  <?php
                  
                  if (isset($_POST['gogogo'])) {
                   
                    if($term=='ทั้งหมด'){
                      $qli_term = '';
                    }
                    else{
                      $qli_term = 'AND exam_term = '.'\''.$term.'\''.'';
                    }
                    if($type=='ทั้งหมด'){
                      $qli_type = '';
                    }
                    else{
                      $qli_type = 'AND exam_type = '.'\''.$type.'\''.'';
                    }
                    if($sub=='ทั้งหมด'){
                      $qli_sub = '';
                    }
                    else{
                      $qli_sub = 'AND exam_subject = '.'\''.$sub.'\''.'';
                    }
                    $q = "SELECT * FROM student_table WHERE exam_year = '$year' $qli_term $qli_type $qli_sub ";
                    $result = mysqli_query($con, $q);
                    ?>
                    <br><br>

                <section class="container-fluid">
                <div class="card text-center">
                      <div class="card-header">
                          <h4>ตารางนักศึกษา</h4>
                      </div>
                      <div class="card-body">
                      <div class="table-responsive" style="margin-left: 5px">
                    <table id="userdata" class="table table-striped table-bordered table responsive" style="width:100%">
                      <thead>
                        <tr>
                          <th>
                            <div class="container"><!-- Trigger the modal with a button -->
                              <button type="button" class="btn btn-info btn-sm fas fa-plus" data-toggle="modal" data-target="#myModal"></button>
                            </div>
                              <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                     <form  role="form" action="insertform.php" method="POST">
                                      <div class="modal-header ">
                                        <h3>กรอกข้อมูล นักศึกษา</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>


                                      </div>
                                      <div class="modal-body ">
                                        <div  class="form-group" style="text-align: left">
                                          <h3 style="text-align: left">ข้อมูลทั่วไป</h3><br>
                                          <p>รหัสนักศึกษา : </p><input class="form-control" type="text" name="user_id" required>
                                          <p>คำนำหน้า : </p><input class="form-control" type="text" name="title" required>
                                          <p>ชื่อ : </p><input class="form-control" type="text" name="fname" required>
                                          <p>นามสกุล : </p><input class="form-control" type="text" name="lname" required>
                                          <p>Username : </p><input class="form-control" type="text" name="username" required>
                                          <p>Password : </p><input class="form-control" type="text" name="password" required>
                                          <br>
                                        </div>
                                        <div class="form-group" style="margin-left: 20px; text-align: left">
                                         <h3 style="text-align: left" >ข้อมูลการสอบ</h3><br>
                                         <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" required>
                                         <p>ภาคการศึกษา : </p><select class="form-control" name="term" required>
                                           <option disabled selected value="">--------เลือกภาคเรียน--------</option>
                                           <option value="1">ภาคเรียนที่ 1</option>
                                           <option value="2">ภาคเรียนที่ 2</option>
                                           <option value="3">ภาคเรียนที่ 3</option>
                                         </select>
                                         <p>การสอบ : </p><select class="form-control" name="type" required>
                                           <option disabled selected value="">--------เลือกรูปแบบ--------</option>
                                           <option>กลางภาค</option>
                                           <option>ปลายภาค</option>
                                           <option>แก้ไขผลการเรียน(I)</option>
                                           <option>อื่นๆ...</option>
                                         </select>

                                         <p>วิชาที่สอบ : </p>
                                         <div class="row">
                                            <div class="container-fluid" >
                                              <select class="form-control" id="aa" name="sub" onchange="getSelectValue();" required>
                                                <option disabled selected value="" >----------------เลือกรายวิชา--------------------</option>
                                                <?php while ($row_sub = mysqli_fetch_array($re_sub_2)) { ?>
                                                    <option value="<?php echo $row_sub['sub_id']?>"><?php echo $row_sub['sub_id'] . " " . $row_sub['id_name'] ?></option>
                                                <?php 
                                              } ?>
                                              </select>
                                              </div>
                                            
                                          </div>

                                         <p>วันที่สอบ  : (1 ม.ค. 2561) </p><input class="form-control" type="text" name="date" required>
                                         <p>ลำดับที่นั่งสอบ : </p><input class="form-control" type="text" name="seat" required>
                                          <div class="container-fluid">
                                          <p>เวลาสอบ : </p>
                                            <div class="row">
                                              <div class="col col-lg-6">เวลาเริ่ม : <input class="form-control" type="time" name="time1"></div required>
                                              <div class="col col-lg-6">เวลาสิ้นสุด : <input class="form-control" type="time" name="time2"></div required>
                                            </div>
                                          </div>

                                         <p>สถานที่สอบ : </p><select class="form-control" name="place" required>
                                         <option disabled selected>เลือกรายวิชา</option>
                                                <?php while ($row_location = mysqli_fetch_array($re_location)) { ?>
                                                    <option value="<?php echo $row_location['name_location'] ?>"><?php echo $row_location['name_location'] ?></option>
                                                <?php 
                                              } ?>
                                         </select>

                                         <p>สอบด้วยอุปกรณ์ : </p><select class="form-control" name="tool"required>
                                           <option>Tablet</option>
                                           <option>Computer</option>
                                         </select>
                                         <label for="comment">หมายเหตุ : </label>
                                         <textarea class="form-control" rows="3" name="comment"></textarea>
                                       </div>
                                       <br><br>
                                       <button  type="submit" class="btn btn-info pull-block form-control" value="save" >save</button>

                                     </div>
                                   </form>
                                 </div>
                               </div>
                             </div>
                             <!--Modal-->

                         </th>
                         <th><p>รหัสนักศึกษา</p></th>
                         <th><p>คำนำหน้า</p></th>
                         <th><p>ชื่อ</p></th>
                         <th><p>นามสกุล</p></th>
                         <th><p>Username</p></th>
                         <th><p>Password</p></th>
                         <th><p>ปีการศึกษา</p></th>
                         <th><p>เทอม</p></th>
                         <th><p>การสอบ</p></th>
                         <th><p>วิชาที่สอบ</p></th>
                         <th><p>วันที่สอบ</p></th>
                         <th><p>เวลาสอบ</p></th>
                         <th><p>สถานที่สอบ</p></th>
                         <th><p>อุปกรณ์ที่สอบ</p></th>
                         <th><p>ที่นั่งสอบ</p></th>
                         <th><p>หมายเหตุ</p></th>

                       </tr>
                     </thead>
                     <tbody>
                      <?php

                      while ($row = mysqli_fetch_array($result)) {

                        ?>
                        <tr>
                          <td>
                            <div class="container">
                              <div class="row">
                                <div class="col col-md-6">

                                  <button type="button" class="btn btn-warning btn-sm fas fa-pencil-alt" data-toggle="modal" data-target="#<?php echo $row['order'] ?>"></button>
                                  <!-- Modal -->

                                  <div class="modal fade" id="<?php echo $row['order'] ?>" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <form  role="form" action="updateform.php?id=<?php echo $row['order'] ?>" method="POST">
                                          <div class="modal-header ">
                                            <h3>แก้ไขข้อมูล นักศึกษา</h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                          </div>

                                          <div class="modal-body ">

                                            <div  class="form-group" style="text-align: left">
                                              <h3 style="text-align: left">ข้อมูลทั่วไป</h3><br>
                                              <p>รหัสนักศึกษา : </p><input class="form-control" type="text" name="user_id" value="<?php echo $row['user_id'] ?>">
                                              <p>คำนำหน้า : </p><input class="form-control" type="text" name="title" value="<?php echo $row['user_title'] ?>">
                                              <p>ชื่อ : </p><input class="form-control" type="text" name="fname" value="<?php echo $row['user_first_name'] ?>">
                                              <p>นามสกุล : </p><input class="form-control" type="text" name="lname" value="<?php echo $row['user_last_name'] ?>">

                                              <p>Username : </p><input class="form-control" type="text" name="username" value="<?php echo $row['login_username'] ?>">
                                              <p>Password : </p><input class="form-control" type="text" name="password" value="<?php echo $row['login_password'] ?>">
                                              <br>
                                            </div>
                                            <div class="form-group" style="margin-left: 20px; text-align: left">
                                              <h3 style="text-align: left" >ข้อมูลการสอบ</h3><br>
                                              <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $row['exam_year'] ?>">

                                              <p>ภาคการศึกษา : </p><select class="form-control" name="term" required>
                                                <?php
                                                if ($row['exam_term'] == 1) { ?>
                                                  <option value="1">ภาคเรียนที่ 1</option>
                                                  <option value="2">ภาคเรียนที่ 2</option>
                                                  <option value="3">ภาคเรียนที่ 3</option><?php

                                                                                        } elseif ($row['exam_term'] == 2) { ?>
                                                  <option value="2">ภาคเรียนที่ 2</option>
                                                  <option value="1">ภาคเรียนที่ 1</option>
                                                  <option value="3">ภาคเรียนที่ 3</option><?php

                                                                                        } elseif ($row['exam_term'] == 3) { ?>
                                                  <option value="3">ภาคเรียนที่ 3</option>
                                                  <option value="1">ภาคเรียนที่ 1</option>
                                                  <option value="2">ภาคเรียนที่ 2</option><?php

                                                                                        } ?>
                                              </select>
                                              <p>การสอบ : </p><select class="form-control" name="type" required>
                                                <?php
                                                if ($row['exam_type'] == "กลางภาค") { ?>
                                                  <option>กลางภาค</option>
                                                  <option>ปลายภาค</option>
                                                  <option>แก้ไขผลการเรียน(I)</option>
                                                  <option>อื่นๆ...</option><?php

                                                                        } elseif ($row['exam_type'] == "ปลายภาค") { ?>
                                                  <option>ปลายภาค</option>
                                                  <option>กลางภาค</option>
                                                  <option>แก้ไขผลการเรียน(I)</option>
                                                  <option>อื่นๆ...</option><?php

                                                                        } elseif ($row['exam_type'] == "แก้ไขผลการเรียน(I)") { ?>
                                                  <option>แก้ไขผลการเรียน(I)</option>
                                                  <option>กลางภาค</option>
                                                  <option>ปลายภาค</option>
                                                  <option>อื่นๆ...</option><?php

                                                                        } elseif ($row['exam_type'] == "อื่นๆ...") { ?>
                                                  <option>อื่นๆ...</option>
                                                  <option>กลางภาค</option>
                                                  <option>ปลายภาค</option>
                                                  <option>แก้ไขผลการเรียน(I)</option><?php

                                                                                  }
                                                                                  ?>
                                              </select>

                                              <p>วิชาที่สอบ : </p><select class="form-control" name="sub" required>
                                                <?php
                                                $es = $row['exam_subject'];
                                                $qw = "SELECT * FROM `subject` WHERE `sub_id` = '$es' ";
                                                $rt = mysqli_query($con, $qw);
                                                $pony = mysqli_fetch_array($rt);
                                                ?>
                                                <option><?php echo $row['exam_subject'] . " " . $pony['id_name']; ?></option>
                                                <?php
                                                $blob = $row['exam_subject'];
                                                $q_suab = "SELECT * FROM `subject` WHERE sub_id != '$blob' ORDER BY sub_id ASC";
                                                $re_suad = mysqli_query($con, $q_suab);
                                                while ($ro_sub = mysqli_fetch_array($re_suad)) { ?>
                                                    <option value="<?php echo $ro_sub['sub_id'] ?>"><?php echo $ro_sub['sub_id'] . " " . $ro_sub['id_name'] ?></option>
                                                  <?php 
                                                } ?>
                                              </select>

                                              <p>วันที่สอบ : (1 ม.ค. 2561) </p><input class="form-control" type="text" name="date" value="<?php echo $row['exam_date'] ?>">
                                              <p>ลำดับที่นั่งสอบ : </p><input class="form-control" type="text" name="seat" value="<?php echo $row['exam_seat'] ?>">
                                              <p>เวลาสอบ : </p><input class="form-control" type="text" name="time" value="<?php echo $row['exam_time'] ?>">
                                              <p>สถานที่สอบ : </p><select class="form-control" name="place" required>
                                                
                                                <option><?php echo $row['exam_location']; ?></option>
                                                <?php
                                                $temp_location = $row['exam_location'];
                                                $qp_location = "SELECT * FROM `location_table` WHERE name_location != '$temp_location' ";
                                                $re_locatuon = mysqli_query($con, $qp_location);
                                                while ($ro_locatuon = mysqli_fetch_array($re_locatuon)) { ?>
                                                    <option value="<?php echo $ro_locatuon['name_location'] ?>"><?php echo $ro_locatuon['name_location'] ?></option>
                                                  <?php 
                                                } ?>
                                              </select>
                                              <p>สอบด้วยอุปกรณ์ : </p><input class="form-control" type="text" name="tool" value="<?php echo $row['exam_tool'] ?>">
                                              <label for="comment" >หมายเหตุ : </label>
                                              <textarea class="form-control" rows="3" name="comment" ><?php echo $row['note'] ?></textarea>
                                            </div>
                                            <br><br>
                                            <button  type="submit" class="btn btn-info pull-block form-control" value="save" >update</button>

                                          </div>

                                          <div class="modal-footer ">

                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!--Modal-->

                                </div>
                                <div class="col col-md-6">
                                  <button type="button" class="btn btn-danger btn-sm fas fa-times" data-toggle="modal" data-target="#de<?php echo $row['order'] ?>"></button>
                                      <div class="modal fade" id="de<?php echo $row['order'] ?>" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <center> <h3>ยืนยันการลบข้อมูล</h3></center>
                                        </div>
                                        <div class="modal-footer">

                                                <div style="text-align: center;">

                                                    <a type="button" href="deletedata.php?id=<?php echo $row['order'] ?>" class="btn btn-danger">Yes</a>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                              </div>
                            </div>

                          </td>
                          <td><?php echo $row['user_id']; ?></td>
                          <td><?php echo $row['user_title']; ?></td>
                          <td><?php echo $row['user_first_name']; ?></td>
                          <td><?php echo $row['user_last_name']; ?></td>
                          <td><?php echo $row['login_username']; ?></td>
                          <td><?php echo $row['login_password']; ?></td>
                          <td><?php echo $row['exam_year']; ?></td>
                          <td><?php echo $row['exam_term']; ?></td>
                          <td><?php echo $row['exam_type']; ?></td>
                          <td><?php echo $row['exam_subject']; ?></td>
                          <td><?php echo $row['exam_date']; ?></td>
                          <td><?php echo $row['exam_time']; ?></td>
                          <td><?php echo $row['exam_location']; ?></td>
                          <td><?php echo $row['exam_tool']; ?></td>
                          <td><?php echo $row['exam_seat']; ?></td>
                          <td><?php echo $row['note']; ?></td>
                          <?php

                        }
                        ?>
                      </tr>
                    </tbody>
                    </table>
                  </div> 



                      </div>
                    </div>
                  
              </section>
            </div>
          </div><!--body-->
          <?php

        }

        ?>
          </section>






        <div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

                  <style type="text/css">
                  /* Adjust feedback icon position */
                  #productForm .selectContainer .form-control-feedback,
                  #productForm .inputGroupContainer .form-control-feedback {
                    right: -15px;
                  }
                  </style>
                  <script>
                    $(document).ready(function(){
                      $('#userdata').DataTable();

                    })
                </script>
                <script>
                  $('#myModal').modal({
                    show:false,
                    backdrop: 'static',
                    keyboard: false
                  });
                </script>
        </div>
      </body>
      </html>
