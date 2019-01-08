<?php
session_start();

  require 'server.php';
  require 'checklogin.php';
  require 'checknoob.php';
  if ($_SESSION['import_success']==1) {
    echo '<script type="text/javascript">alert("นำเข้าข้อมูลจากไฟล์สำเร็จ.");</script>';
  }elseif ($_SESSION['import_success']==2) {
    echo '<script type="text/javascript">alert("นำเข้าข้อมูลจากไฟล์ไม่สำเร็จ.");</script>';
  }
  $_SESSION['import_success'] = 0;
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>AdminGE-importstudentinformation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/font.css">

    <style type="text/css">
        /* Adjust feedback icon position */
        #productForm .selectContainer .form-control-feedback,
        #productForm .inputGroupContainer .form-control-feedback {
            right: -15px;
        }
    </style>
    </head>
    <body>
    <header class="container-fluid">
    <center><a href="#"><img src="image/ปกหลังบ้าน.jpg" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"></a></center>
        <div style="text-align: right"> <!-- when show online now  -->
                  <p><?php echo  $_SESSION['admin_username']."  ".$_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
    </header>
    <?php
    require 'tab_menu.php';

    ?>

        <div class="col col-lg-10 text-center" style="border:1px solid #d9d9d9">

        <h3 class="text-info">นำเข้าข้อมูลนักศึกษา</h3>
                            <br>
                          <form class="input" action="csvimport.php" method="POST" enctype="multipart/form-data" required>
                                <div class="container" style="margin-left: 10px">
                                    <div style="text-align: center">
                                          <input class="btn btn-light btn-md" type="file" name="filee" required>
                                    </div><br>
                                    <div style="text-align: center">
                                        <p>เริ่มอ่านบรรทัดที่ </p>
                                        <input type="number" name="StartRow" required>
                                        <p>ถึงบรรทัดที่ </p>
                                        <input type="number" name="EndRow" required>
                                    </div>
                                    <br>
                                    <div style="text-align: center ">
                                        <button type="submit" class="btn btn-primary" name="sub">นำเข้า</button>
                                    </div>
                                </div>
                            </form>
        </div>
    </div>
    </section>





<footer class="container-fluid"></footer>
        <div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>



        </div>

    </body>
</html>
