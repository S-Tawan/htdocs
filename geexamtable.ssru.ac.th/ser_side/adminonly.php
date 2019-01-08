<?php

require 'server.php';
session_start();
require 'checklogin.php';
if ($_SESSION['role'] == 'Admin') {

} elseif (($_SESSION['role'] == 'ผู้ดูแลระบบ')) {
    header("Location: subadminonly.php");
} else {
    $_SESSION['role_user'] = 1;
    header("Location: main.php");
}
$q = "SELECT * FROM admin_table";
$result = mysqli_query($con, $q);
if ($_SESSION['counter_admin'] == 1) {
    echo '<script type="text/javascript">alert("เพิ่มข้อมูลเรียบร้อย.");</script>';
} elseif ($_SESSION['counter_admin'] == 2) {
    echo '<script type="text/javascript">alert("การเพิ่มข้อมูลเกิดข้อผิดพลาด.");</script>';
} elseif ($_SESSION['counter_admin'] == 3) {
    echo '<script type="text/javascript">alert("แก้ไขข้อมูลเรียบร้อย.");</script>';
} elseif ($_SESSION['counter_admin'] == 4) {
    echo '<script type="text/javascript">alert("การแก้ไขข้อมูลเกิดข้อผิดพลาด.");</script>';
} elseif ($_SESSION['counter_admin'] == 5) {
    echo '<script type="text/javascript">alert("ลบข้อมูลเรียบร้อย.");</script>';
} elseif ($_SESSION['counter_admin'] == 6) {
    echo '<script type="text/javascript">alert("การลบข้อมูลเกิดข้อผิดพลาด.");</script>';
}

$_SESSION['counter_admin'] = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Only</title>
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
                <p><?php echo $_SESSION['admin_username'] . "  " . $_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
          </header>
          <?php
            require 'tab_menu.php';

            ?>


        <div class="col col-lg-10" style="border:1px solid #d9d9d9">
                            <center><h3 class="text-info">ADMIN</h3></center>
                            <div class="table-responsive" style="margin-left: 5px">
                                    <table id="admindata" class="table table-striped table-bordered table responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <button type="button" class="btn btn-info fas fa-plus" data-toggle="modal" data-target="#myModal"></button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="text-center">
                                                                    <h2>เพิ่มข้อมูลพนักงาน</h2>
                                                                </div>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                            </div>
                                                            <form role="form" action="insertadmin.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group container-fluid" style="margin-left: 20px; text-align: left">
                                                                    <div class="container">
                                                                        <p>รหัสพนักงาน : </p><input type="text" name="user_id" required>
                                                                    </div><br>

                                                                    <div class="form-group container">
                                                                        <div class="row">
                                                                            <div class="col col-md-6">
                                                                                <p>ชื่อ : </p><input type="text" name="fname" required>
                                                                            </div>
                                                                            <div class="col col-md-6">
                                                                                <p>นามสกุล : </p><input type="text" name="lname" required>
                                                                            </div>
                                                                            </div>
                                                                    </div><br>
                                                                    <div class="form-group container">
                                                                        <div class="row">
                                                                            <div class="col col-lg-6">
                                                                                <p>Username : </p><input type="text" name="username" required>
                                                                            </div>
                                                                            <div class="col col-lg-6">
                                                                                <p>Password : </p><input type="text" name="password" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    </div>
                                                                <!--General information-->

                                                                <section>
                                                                    <div style="margin-left: 20px">
                                                                            <div class="form-group" style="text-align: left">
                                                                                <p>ระดับ : </p><select class="form-control" name="role" >
                                                                                        <option>Admin</option>
                                                                                        <option>ผู้ดูแลระบบ</option>
                                                                                        <option>เจ้าหน้าที่ทั่วไป</option>
                                                                                </select><br>
                                                                                <p>Status : </p>
                                                                                <input type="radio" name="status" value="1" ><span> Online </span>
                                                                                <input type="radio" name="status" value="0" checked><span> Offline </span>
                                                                            </div>

                                                                    </div>
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
                                                <th>รหัสพนักงาน</th>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>ระดับ</th>
                                                <th>Active</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                        <tr>
                                            <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col col-lg-6">
                                                        <section>
                                                        <button type="button" class="btn btn-warning  fas fa-pencil-alt" data-toggle="modal" data-target="#update_admin_data<?php echo $row['admin_id'] ?>"></button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="update_admin_data<?php echo $row['admin_id'] ?>" role="dialog">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                <form action="updateadmindata.php?id=<?php echo $row['admin_id'] ?>" method="POST">
                                                                <div class="modal-header">
                                                                    <div class="text-center">
                                                                        <h2>แก้ไขข้อมูลพนักงาน</h2>
                                                                    </div>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <div style="margin-left: 20px; text-align: left">

                                                                <div>
                                                            <p> รหัสพนักงาน : </p><input type="text" name="user_id" value="<?php echo $row['admin_id']  ?>"><br>
                                                            <p> ชื่อ : </p><input type="text" name="fname" value="<?php echo $row['first_name'] ?>"><br>
                                                            <p> นามสกุล : </p><input type="text" name="lname" value="<?php echo $row['last_name'] ?>">
                                                                                        <br><br>
                                                            <p> Username : </p><input type="text" name="username" value="<?php echo $row['admin_username'] ?>"><br>

                                                            <p> Password : </p><input type="text" name="password" value="<?php $en1 = $row['admin_password']; echo base64_decode($en1) ?>">
                                                                                        <br><br>
                                                            <p>ระดับ : </p><select class="form-control" name="role" required >
                                                                 <option><?php echo $row['admin_role']; ?></option>
                                                                    <?php
                                                                    if ($row['admin_role'] == "Admin") {
                                                                        echo '<option>ผู้ดูแลระบบ</option><option>เจ้าหน้าที่ทั่วไป</option>';
                                                                    } elseif ($row['admin_role'] == "ผู้ดูแลระบบ") {
                                                                        echo '<option>Admin</option><option>เจ้าหน้าที่ทั่วไป</option>';
                                                                    } else {
                                                                        echo '<option>Admin</option><option>ผู้ดูแลระบบ</option>';
                                                                    }

                                                                    ?>
                                                            </select>

                                                            <?php
                                                            $c_id = $row['admin_id'];
                                                            $qr = "SELECT * FROM `admin_table` WHERE `admin_id` = '$c_id' ";
                                                            $qer = mysqli_query($con, $qr);
                                                            $rad = mysqli_fetch_array($qer);
                                                            if ($rad['admin_status'] == 0) { ?>
                                                            <input type="radio" name="status" value="1" ><p> Online </p>
                                                            <input type="radio" name="status" value="0" checked><p> Offline </p>
                                                            <?php
                                                        } elseif ($rad['admin_status'] == 1) { ?>
                                                            <input type="radio" name="status" value="1" checked><p> Online </p>
                                                            <input type="radio" name="status" value="0" ><p> Offline </p>
                                                            <?php
                                                        } ?>

                                                                                </div>
                                                        <div class="col-6"></div><br>
                                                                    <!--General information-->
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
                                                        <button type="button" class="btn btn-danger  fas fa-times" data-toggle="modal" data-target="#del_admin_id<?php echo $row['admin_id'] ?>"></button>
                                                            <div class="modal fade" id="del_admin_id<?php echo $row['admin_id'] ?>" role="dialog">
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

                                                                        <a type="button" href="deleteadmindata.php?id=<?php echo $row['admin_id'] ?>" class="btn btn-danger">Yes</a>
                                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>

                                                    </div>
                                            </div>


                                            </td>
                                            <td><?php echo $row['admin_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['admin_username']; ?></td>
                                            <td><?php echo base64_decode($row['admin_password']); ?></td>
                                            <td><?php echo $row['admin_role']; ?></td>
                                            <td><?php echo $row['admin_status']; ?></td>
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
