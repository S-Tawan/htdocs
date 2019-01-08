<?php
  require ('server.php');
  session_start();
  if (!isset($_SESSION['$status'])) {
      if (isset($_SESSION['meow'])) {
          echo '<script type="text/javascript">alert("ท่านไม่ได้เข้าสู่ระบบ.");</script>';
         // echo "haha";
            session_destroy();
        }
      else{


      }
    }


  else {
    if($_SESSION['$status'] == 0){
      echo '<script type="text/javascript">alert("ท่านยังไม่ได้รับอนุญาติให้ออนไลน์.");</script>';
    }elseif($_SESSION['$status'] == 2){
      echo '<script type="text/javascript">alert("ข้อมูลของท่านไม่ถูกต้อง.");</script>';
    }
  }
 ?>
 <!DOCTYPE html>

 <html>
     <head>

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
        <title>Log-in Admin</title>
        <!-- <center><a href="#"><img src="image/ปกหลังบ้าน.jpg" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"></a></center> -->
     </head>
     <body>
         <header class="containner-fluid">
         <center><a href="#"><img src="image/ปกหลังบ้าน.jpg" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"></a></center>
          </header><br>

          <div class="container-fluid">
            <div class="row">
                <div class=" col col-lg-4"></div>
                <div class="col col-lg-4" style="border:3px solid #d9d9d9">
                    <p style="text-align: center">เข้าสู่ระบบตรวจสอบตารางสอบ</p>
                    <p style="text-align: center">วัดความรู้รายวิชาศึกษาทั่วไป(สำหรับเจ้าหน้าที่,ผู้ดูแลระบบ)</p>
                    <form class="input" action="login.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control"  name="user"  placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control"  name="pass" placeholder="Password" required autofocus>
                        </div>
                        <center><button type="submit" class="btn btn-primary" style="margin-bottom: 5px">login</button></center>
                    </form>
                </div>
                    <div class="col col-lg-4"></div>
            </div>
          </div>



    <footer class="container-fluid"></footer>
    <div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


    </div>
     </body>
 </html>
