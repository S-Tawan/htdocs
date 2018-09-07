<?php

  require 'server.php';
  session_start();
  require 'checklogin.php';
  require 'checknoob.php';
  $q = "SELECT * FROM subject";
  $result = mysqli_query($con,$q);
  if ($_SESSION['counter_subject']==1) {
    echo '<script type="text/javascript">alert("เพิ่มข้อมูลรายวิชาสำเร็จ.");</script>';
  }elseif ($_SESSION['counter_subject']==2) {
    echo '<script type="text/javascript">alert("เพิ่มข้อมูลรายวิชาไม่สำเร็จ.");</script>';
  }elseif ($_SESSION['counter_subject']==3) {
    echo '<script type="text/javascript">alert("แก้ไขข้อมูลรายวิชาสำเร็จ.");</script>';
  }elseif ($_SESSION['counter_subject']==4) {
    echo '<script type="text/javascript">alert("แก้ไขข้อมูลรายวิชาไม่สำเร็จ.");</script>';
  }elseif ($_SESSION['counter_subject']==5) {
    echo '<script type="text/javascript">alert("ลบข้อมูลรายวิชาสำเร็จ.");</script>';
  }elseif ($_SESSION['counter_subject']==6) {
    echo '<script type="text/javascript">alert("ลบข้อมูลรายวิชาไม่สำเร็จ.");</script>';
  }
  $_SESSION['counter_subject']=0;
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>setting subject</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/font.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>


    </head>
    <body>

    <header class="container-fluid">
    <center><a href="#"><img src="image/ปกหลังบ้าน.jpg" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"></a></center>
            <div style="text-align: right"> <!-- when show online now  -->
                <p><?php echo  $_SESSION['admin_username']."  ".$_SESSION['role']; ?></p>
             </div>
          </header>
          <?php
    require 'tab_menu.php';

    ?>

        <div class="col col-lg-10" style="border:1px solid #d9d9d9">
                            <center><h3 class="text-info">SETTING SUBJECT</h3></center>
                            <div class="table-responsive" style="margin-left: 5px">
                                    <table id="admindata" class="table table-striped table-bordered table responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModal"></button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="text-center">
                                                                    <h2>เพิ่มข้อมูลรายวิชา</h2>
                                                                </div>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                            </div>
                                                            <form role="form" action="insert_subject.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group container-fluid" style="margin-left: 20px; text-align: left">
                                                                    <div class="container">
                                                                        <p>รหัสวิชา : </p><input type="text" name="sub_id" required>
                                                                    </div><br>

                                                                    <div class="form-group container">
                                                                        <div class="row">
                                                                            <div class="col col-md-6">
                                                                                <p>ชื่อวิชา : </p><input type="text" name="sub_name" required>
                                                                            </div>
                                                                    </div><br>


                                                                    </div>
                                                                <!--General information-->

                                                                <section>
                                                                    <button type="submit" class="btn btn-info">save</button>

                                                            </div>
                                                            </form>
                                                            <div class="modal-footer">

                                                                    <div style="text-align: right; margin-right: 50px; margin-bottom: 20px">

                                                                    </div>

                                                            </div>

                                                        </div>
                                                        </div>
                                                    </div>
                                                                </th>
                                                <th>รหัสวิชา</th>
                                                <th>ชื่อวิชา</th>
                                            </tr>
                                        </thead>
                                        <?php
                                            while($row =mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col col-lg-6">
                                                        <section>
                                                            <button type="button" class="btn btn-warning fas fa-pencil-alt" data-toggle="modal" data-target="#update_sub_data<?php echo $row['order'] ?>"></button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="update_sub_data<?php echo $row['order'] ?>" role="dialog">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                    <form action="update_subject.php?id=<?php echo $row['order'] ?>" method="POST">
                                                                        <div class="modal-header">
                                                                        <div class="text-center">
                                                                            <h2>แก้ไขข้อมูลรายวิชา</h2>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                        <div class="form-group container-fluid" style="margin-left: 20px; text-align: left">
                                                                            <div class="container">
                                                                            <p>รหัสวิชา : </p><input type="text" name="sub_id" value="<?php echo $row['sub_id'] ?>" >
                                                                            </div><br>
                                                                            <div class="form-group container">
                                                                            <div class="row">
                                                                                <div class="col col-md-6">
                                                                                <p>ชื่อวิชา : </p><input type="text" name="sub_name" value="<?php echo $row['id_name'] ?>" >
                                                                                </div>
                                                                            </div><br>
                                                                            </div>
                                                                        <!--General information-->
                                                                        <section>
                                                                    </div>
                                                                <div class="modal-footer">

                                                                <div style="text-align: right; margin-right: 50px; margin-bottom: 20px">
                                                                <button type="submit" class="btn btn-info">update</button>
                                                                            </div>

                                                                    </div>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>

                                                            </section>
                                                        </div>
                                                        <div class="col col-lg-6">
                                                        <section>
                                                            <button type="button" class="btn btn-danger fas fa-times" data-toggle="modal" data-target="#del_sub_id<?php echo $row['order'] ?>"></button>
                                                                <div class="modal fade" id="del_sub_id<?php echo $row['order'] ?>" role="dialog">
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

                                                                    <a type="button" href="delete_subject_data.php?id=<?php echo $row['order']?>" class="btn btn-danger">Yes</a>
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                                            </div>

                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td><?php echo $row['sub_id']; ?></td>
                                            <td><?php echo $row['id_name']; ?></td>
                                        <?php
                                          }
                                        ?>
                                        </tr>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>

            </section>



            <footer class="container-fluid"></footer>
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
            $('#admindata').DataTable();
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
