<?php
require 'server.php';
session_start();
require 'checklogin.php';
require 'checksub.php';

$q = "SELECT * FROM web_show_time";
$result = mysqli_query($con,$q);
$row =mysqli_fetch_array($result);
if ($_SESSION['counter_footer']==3) {
    echo '<script type="text/javascript">alert("แก้ไขข้อมูลเรียบร้อย.");</script>';
  }elseif ($_SESSION['counter_footer']==4) {
    echo '<script type="text/javascript">alert("การแก้ไขข้อมูลเกิดข้อผิดพลาด.");</script>';
  }


$_SESSION['counter_footer']=0;

 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>AdminGE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/font.css">
    <link href="node_modules/bootstrap/dist/css/editor.css" type="text/css" rel="stylesheet"/>

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
        <div style="text-align: right">
                  <p><?php echo  $_SESSION['admin_username']."  ".$_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
    </header>
    <?php
    require 'tab_menu.php';
    ?>

        <div class="col col-lg-10" style="border:1px solid #d9d9d9">

           <br> <h2 class="text-center">ตั้งค่า footer</h2>
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 nopadding">
                                    <textarea id="txtEditor" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid footer text-center">
                <form action="update_footer.php" method="POST">
                    <div class="container"><div class="row">
                        <div class="container" ><br> <h2 class="text-center">Code Footer</h2><textarea  name="commentf" cols="110" rows="10" ><?php echo $row['footer']  ?></textarea></div>

                        <div class="container">


                        <br> <h2 class="text-center">ตั้งค่าการแสดงผลหน้าเว็บ</h2>
                        <p> ปีการศึกษาที่แสดง : </p><input type="text" name="year" value="<?php echo $row['web_year'] ?>">
                        <p> ภาคการศึกษาที่แดง : </p><input type="text" name="term" value="<?php echo $row['web_term'] ?>">
                        </div>
                        <div class="container"><br><br><br><br><button class="form-control btn btn-success btn-lg btn-block"   type="submit" name="gogogo">Upload</button></div>
                    </div>
                </form>
                    </div>


                    <p class="pull-right"> <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
                </div>
                </div>

    </div>
    </section>

<footer class="container-fluid"></footer>
        <div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/editor.js"></script>
        <script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>

        </div>

    </body>
</html>
