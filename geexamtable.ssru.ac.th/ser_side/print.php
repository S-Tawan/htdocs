<fom>
<fom>
<?php
require 'server.php';
session_start();
require 'checklogin.php';
$q_web = "SELECT * FROM web_show_time";
$result_web = mysqli_query($con, $q_web);
$row_web = mysqli_fetch_array($result_web);
$_SESSION['year'] = $row_web['web_year'];

$_SESSION['counter_student'] = 0;
$q_sub = "SELECT * FROM subject ORDER BY sub_id ASC";
$re_sub = mysqli_query($con, $q_sub);
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

          ?>

            <div class="col col-lg-10" style="border:1px solid #d9d9d9">
                  <center> <h3 class="text-info">ข้อมูลนักศึกษา</h3></center>
                  <div>
                  <div class="container-fluid">
                    <div class="text-center">
                    <div class="card" style="width:100%;">
                      <div class="card-body">
                      <form action = "print.php" method="POST" >
                          <?php
                          if(!isset($_POST['gogogo'])){
                          ?>
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col col-md-6">
                                <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $_SESSION['year'] ?>"required >
                              </div>
                              <div class="col col-md-6">
                                <p>ภาคการศึกษา : </p><select class="form-control" name="term"  >
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
                                              <select class="form-control" id="aa" name="sub" onchange="getSelectValue();"   >
                                              <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <?php while ($row_sub = mysqli_fetch_array($re_sub)) { ?>
                                                    <option value="<?php echo $row_sub['sub_id'] ?>"><?php echo $row_sub['sub_id'] . " " . $row_sub['id_name'] ?></option>
                                                <?php
                                              } ?>
                                              </select>
                                            </div>
                                            </div>

                                          </div>
                                          <div class="container-fluid">
                                            <div class="row">
                                                <div class="col col-md-6">
                                                <p>วันที่สอบ : (1 ม.ค. 2561)  </p><input class="form-control" type="text" name="date" value="" >
                                                </div>

                                               <div class="col col-md-6">
                                                <p>สถานที่สอบ : </p><select class="form-control" name="place" >
                                                <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <?php while ($row_location = mysqli_fetch_array($re_location)) { ?>
                                                    <option value="<?php echo $row_location['name_location'] ?>"><?php echo $row_location['name_location'] ?></option>
                                                         <?php
                                                      } ?>
                                                      </select>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="container-fluid">
                                          <p>เวลาสอบ : </p>
                                            <div class="row">
                                              <div class="col col-lg-6">เวลาเริ่ม : <input class="form-control" type="time" name="time1" ></div>
                                              <div class="col col-lg-6">เวลาสิ้นสุด : <input class="form-control" type="time" name="time2" ></div>
                                            </div>
                                          </div>
                                          <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="gogogo" >Search</button></div>
                                                    <?php }

                         else{
                          $year = $_POST['year'];
                          $term = $_POST['term'];
                          $type = $_POST['type'];
                          $sub = $_POST['sub'];
                          $exam_date = $_POST['date'];
                          $exam_time1 = $_POST['time1'] ;
                          $exam_time2 = $_POST['time2'] ;
                          $exam_time = $exam_time1.' - '.$exam_time2;
                          $exam_location = $_POST['place'];
                          ?>
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col col-md-6">
                                <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $year ?>"required >
                              </div>
                              <div class="col col-md-6">
                                <p>ภาคการศึกษา : </p><select class="form-control" name="term"  >
                                             <option selected hidden value="<?php echo $term ?>"><?php echo $term ?></option>
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
                                          <option selected hidden value="<?php echo $type ?>"><?php echo $type ?></option>
                                          <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                        <option>กลางภาค</option>
                                                        <option>ปลายภาค</option>
                                                        <option>แก้ไขผลการเรียน(I)</option>
                                                        <option>อื่นๆ...</option>
                                                      </select>
                                        </div>
                                            <div class="col col-md-6">
                                            <p>วิชาที่สอบ : </p>
                                              <select class="form-control" id="aa" name="sub" onchange="getSelectValue();"   >
                                              <option selected hidden  value="<?php echo $sub ?>"><?php echo $sub ?></option>
                                              <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <?php while ($row_sub = mysqli_fetch_array($re_sub)) { ?>
                                                    <option value="<?php echo $row_sub['sub_id'] ?>"><?php echo $row_sub['sub_id'] . " " . $row_sub['id_name'] ?></option>
                                                <?php
                                              } ?>
                                              </select>
                                            </div>
                                            </div>

                                          </div>
                                          <div class="container-fluid">
                                            <div class="row">
                                                <div class="col col-md-6">
                                                <p>วันที่สอบ : (1 ม.ค. 2561)  </p><input class="form-control" type="text" name="date" value="<?php echo $exam_date ?>" placeholder >
                                                </div>

                                               <div class="col col-md-6">
                                                <p>สถานที่สอบ : </p><select class="form-control" name="place" >
                                                <option selected hidden  value="<?php echo $exam_location ?>"><?php echo $exam_location?></option>
                                              <option value="ทั้งหมด">------ทั้งหมด------</option>
                                                <?php while ($row_location = mysqli_fetch_array($re_location)) { ?>
                                                    <option value="<?php echo $row_location['name_location'] ?>"><?php echo $row_location['name_location'] ?></option>
                                                         <?php
                                                      } ?>
                                                      </select>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="container-fluid">
                                          <p>เวลาสอบ : </p>
                                            <div class="row">
                                              <div class="col col-lg-6">เวลาเริ่ม : <input class="form-control" type="time" name="time1" value="<?php echo $exam_time1 ?>"></div>
                                              <div class="col col-lg-6">เวลาสิ้นสุด : <input class="form-control" type="time" name="time2" value="<?php echo $exam_time2 ?>" ></div>
                                            </div>
                                          </div>
                                          <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="gogogo" >Search</button></div>
                                                    <?php } ?>
                                          </form>
                      </div>
                    </div>
                  </div>
                  </div>
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
                    if($exam_date==''){
                      $qli_exam_date = '';
                    }
                    else{
                      $qli_exam_date = 'AND exam_date = '.'\''.$exam_date.'\''.'';
                    }
                    if($exam_time==' - '){
                      $qli_exam_time = '';
                    }
                    else{
                      $qli_exam_time = 'AND exam_time = '.'\''.$exam_time.'\''.'';
                    }
                    if($exam_location=='ทั้งหมด'){
                      $qli_exam_location = '';
                    }
                    else{
                      $qli_exam_location = 'AND exam_location = '.'\''.$exam_location.'\''.'';
                    }
                    //echo $year . $term . $type . $sub . $exam_date . $exam_time . $exam_location;
                    $_SESSION['p_year'] = $year;
                    $_SESSION['p_term'] = $qli_term;
                    $_SESSION['p_type'] = $qli_type;
                    $_SESSION['p_sub'] = $qli_sub;
                    $_SESSION['p_date'] = $qli_exam_date;
                    $_SESSION['p_time'] = $qli_exam_time;
                    $_SESSION['p_place'] = $qli_exam_location;
                    $_SESSION['d_term'] = $term;
                    $_SESSION['d_type'] = $type;
                    $_SESSION['d_sub'] = $sub;
                    $_SESSION['d_date'] = $exam_date;
                    $_SESSION['d_time'] = $exam_time;
                    $_SESSION['d_place'] = $exam_location;

                  //  $q = "SELECT * FROM student_table WHERE exam_year = '$year'$qli_term";
                    $q = "SELECT * FROM student_table WHERE exam_year = '$year' $qli_term $qli_type $qli_sub $qli_exam_date $qli_exam_time $qli_exam_location";
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


                         <th><p>รหัสนักศึกษา</p></th>
                         <th><p>คำนำหน้า</p></th>
                         <th><p>ชื่อ</p></th>
                         <th><p>นามสกุล</p></th>
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

                          <td><?php echo $row['user_id']; ?></td>
                          <td><?php echo $row['user_title']; ?></td>
                          <td><?php echo $row['user_first_name']; ?></td>
                          <td><?php echo $row['user_last_name']; ?></td>
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
                    <form action = "pagepdf.php"  target="_blank" >
                    <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="goprint">print</button></div>
                    </form>
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
