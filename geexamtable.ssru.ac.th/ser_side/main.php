<?php
session_start();
if (isset($_SESSION['role_user'])) {
    echo '<script type="text/javascript">alert("คุณไม่มีสิทธิ์เข้าถึงหน้านั้น");</script>';
    unset($_SESSION['role_user']);
}
require 'checklogin.php';
$_SESSION['role'] . " : ";
$_SESSION['counter_admin'];
$_SESSION['counter_admin'] = 0;
$_SESSION['counter_student'] = 0;
$_SESSION['import_success'] = 0;
$_SESSION['counter_subject'] = 0;
$_SESSION['counter_location'] = 0;
$_SESSION['counter_footer'] = 0;
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
                  <p><?php echo $_SESSION['admin_username'] . "  " . $_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
    </header>
    <?php
    require 'tab_menu.php';

    ?>

        <div class="col col-lg-10" style="border:1px solid #d9d9d9"></div>
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
