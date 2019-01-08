<?php
session_start();
require 'checklogin.php';
require 'server.php';
require 'checknoob.php';
if (isset($_POST["submit"])) {

    $check = getimagesize($_FILES["image"]["tmp_name"]);
  //  echo $_FILES['image']['name'];
    if ($check !== false) {
        $image = $_FILES['image']['tmp_name'];
        $image2 = $_FILES['image']['name'];
        $_SESSION['shownow'] = $image2;
        //echo $_SESSION['shownow'];
        $imgContent = addslashes(file_get_contents($image));

        $dataTime = date("Y-m-d H:i:s");

        //Insert image content into database
        $insert = $con->query("INSERT into images (image, created,name_pic) VALUES ('$imgContent', '$dataTime','$image2')");
        if ($insert) {
            echo '<script type="text/javascript">alert("File uploaded successfully.");</script>';
        } else {
            echo '<script type="text/javascript">alert("File upload failed, please try again.");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Please select an image file to upload.");</script>';
        echo "Please select an image file to upload.";
    }


}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AdminGE-setting banner</title>
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



        </div>
        <div style="text-align: right">
        <p><?php echo $_SESSION['admin_username'] . "  " . $_SESSION['role']; ?></p>
                <p>online</p>
                <br>
             </div>
    </header>

      <?php
    require 'tab_menu.php';

    ?>

        <div class="col col-lg-10" style="border:1px solid #d9d9d9">
        <center><h3 class="text-info">ตั้งค่า Banner</h3></center>
<br><br>
<div id="content" style="text-align: center">
    <form method="POST" action="setting.php" enctype="multipart/form-data">
  	    <input class="btn btn-light btn-md" type="file" name="image" required/>
        <button type="submit" class="btn btn-primary" name="submit" >นำเข้า</button>
    </form>
</div><br>
<div class="container-fluid">
    <div class="jumbotron" style="margin-left: 5px">
      <?php
        if (isset($_SESSION['shownow'])) {
            $c = 1;
            $sn = $_SESSION['shownow'];

            $sql = "SELECT * FROM images WHERE name_pic = '$image2' ";
            $sth = mysqli_query($con, $sql);
            $result = mysqli_fetch_array($sth);
            echo '<img src="data:image/jpeg;base64,' . base64_encode($result['image']) . '"alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"/>';
        }// code...


        ?>

    </div>

</div>
<form>
<div class="" style="text-align: right; margin-right: 10px">
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">ตกลง</button>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                 <?php
                if (!isset($c)) {
                    echo "<center><p>กรุณาอัพโหลดรูปภาพ</p></center>";
                    unset($_SESSION['shownow']);
                    unset($image2);
                    unset($c);
                } else {


                    echo "<center><p>อัพเดตข้อมูลเรียบร้อย</p></center>";

                    if (isset($_SESSION['shownow'])) {
                        $insert2 = $con->query(" UPDATE `baner` SET `name_baner`='$image2'WHERE id = 1");
                        if ($insert2) {

                            echo "<center><p>File uploaded successfully.</p></center>";
                        } else {
                            echo "<center><p>File upload failed, please try again.</p></center>";
                        }
                        unset($_SESSION['shownow']);
                        unset($image2);
                        unset($c);

                    }
                }

                ?>




            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" href="setting.php">Close</button>
            </div>
          </div>
        </div>
    </div>
    <!--Modal-->
            </div>
        </form>
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
        <script>
                  $('#myModal').modal({
                    show:false,
                    backdrop: 'static',
                    keyboard: false
                  });
                </script>
            <script>
        $(document).ready(function(){
            $('#insert').click(function(){
            var image_name = $('#image').val();
            if (image_name == '') {
                alert("Please SELECT image");
                return false;
            }
            else {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension,['gif','png','jpg','jpeg']) == -1) {
                alert('Invalid Image File');
                $('#image').val('');
                return false;
                }
            }
            });
        });
        </script>

        </div>

    </body>
</html>
