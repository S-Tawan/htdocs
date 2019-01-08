<?php
session_start();
require 'checklogin.php';
require 'server.php';
require 'checksub.php';
$qrum = "SELECT * FROM show_url WHERE group_url = '1' ";
$qrum1 = "SELECT * FROM show_url WHERE group_url = '2' ";
$re = mysqli_query($con, $qrum);
$re2 = mysqli_query($con, $qrum1);
if (isset($_POST['update'])) {
    $id = 1;
    $count = 1;
    $plus1 = "text";
    $plus2 = "link";
    $plus3 = "cb";
    while ($rowrow = mysqli_fetch_array($re)) {
        $sum1 = $plus1 . $id;
        $sum2 = $plus2 . $id;
        $sum3 = $plus3 . $id;
        if (isset($_POST[$sum3])) {
            $ed3 = 1;
        } else {
            $ed3 = 0;
        }
        $ed1 = $_POST[$sum1];
        $ed2 = $_POST[$sum2];
        $lin = $rowrow['id'];
        $qinq = "UPDATE `show_url` SET `id`='$id',`url`='$ed2',`text`='$ed1',`hide`='$ed3' WHERE `id`='$lin' ";//,`hide`='$ed3'
        $que = mysqli_query($con, $qinq);
        if ($que) {
            $count++;
        }
        $id = $id + 1;
    }
    while ($rowrow = mysqli_fetch_array($re2)) {
        $sum1 = $plus1 . $id;
        $sum2 = $plus2 . $id;
        $sum3 = $plus3 . $id;
        if (isset($_POST[$sum3])) {
            $ed3 = 1;
        } else {
            $ed3 = 0;
        }
        $ed1 = $_POST[$sum1];
        $ed2 = $_FILES[$sum2]['name'];

        $ext = pathinfo(basename($_FILES[$sum2]["name"]), PATHINFO_EXTENSION);
        $new_taget_name = 'pdf_' . uniqid() . "." . $ext;
        $target_path = "uploads/";
        $upload_path = $target_path . $new_taget_name;
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($new_taget_name, PATHINFO_EXTENSION));

        if ($_FILES[$sum2]["name"] != "") {


            if ($_FILES[$sum2]["size"] > 8000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
       // Allow certain file formats
            if ($imageFileType != "pdf") {
                echo "Sorry, only PDF files are allowed.";
                $uploadOk = 0;
            }
       // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
       // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES[$sum2]["tmp_name"], $upload_path)) {
                    echo "The file " . basename($_FILES[$sum2]["name"]) . " has been uploaded.";
                    $real_name = basename($_FILES[$sum2]["name"]);
                    //echo $real_name;
                    //$q = "INSERT INTO `testpdf`(`url`,`real_name`) VALUES ('$new_taget_name','$real_name')";
                    $q = "UPDATE `show_url` SET `url`='$new_taget_name',`real_name`='$real_name'
                               ,`text`='$ed1' WHERE `id` = '$id' ";
                    $result = mysqli_query($con, $q);
                    if ($result) {
                        $count++;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

        } else {


            $count++;
        }
        $q = "UPDATE `show_url` SET `hide`='$ed3' WHERE `id` = '$id' ";
        $result = mysqli_query($con, $q);
        $id = $id + 1;
    }

    if ($count == $id) {
        echo '<script type="text/javascript">alert("แก้ไขข้อมูลสมบูรณ์.");</script>';
    } else {
        echo '<script type="text/javascript">alert("แก้ไขข้อมูลไม่สมบูรณ์.");</script>';
    }
}
$q1 = "SELECT * FROM show_url WHERE group_url = '1'";
$q2 = "SELECT * FROM show_url WHERE group_url = '2'";
$result1 = mysqli_query($con, $q1);
$result2 = mysqli_query($con, $q2);
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
            </div>
   </header>

    <?php
    require 'tab_menu.php';

    ?>
       <div class="col col-lg-10" style="border:1px solid #d9d9d9">
           <br>
           <h4 style="margin-left: 5px;color:#6ac7ed;text-align:center">ตั้งค่าเว็บไซต์ที่เกี่ยวข้อง</h4><br>

           <div class="container-fluid">
               <form method="POST" action="settingweb.php" enctype="multipart/form-data">
               <table>
               <div class="row">
               <div class="col col-lg-12">
                   <table class="table table responsive">
                       <thead class="thead-drak">
                           <th scope="col" colp="2">ข้อที่</th>
                           <th scope="col" colp="2">ข้อความ</th>
                           <th scope="col" colp="2"></th>
                           <th scope="col" colp="2">ที่อยู่</th>
                           <th scope="col" colp="2"><center>ซ่อน</center></th>
                       </thead>
                       <tbody>
                         <?php $i = 1; ?>
                         <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                           <tr>
                               <th scope="row"><?php echo $i . " )." ?></th>
                               <td><input type="text" name="text<?php echo $i ?>" value="<?php echo $row1['text'] ?>" required></td>
                               <th scope="row"></th>
                               <td><input type="text" name="link<?php echo $i ?>" value="<?php echo $row1['url'] ?>" required></td>
                               <?php if ($row1['hide'] == 0) { ?>
                                 <td><center><input type="checkbox" name="cb<?php echo $i ?>" ></center></td>
                               <?php
                            } else { ?>
                                 <td><center><input type="checkbox" name="cb<?php echo $i ?>" checked></center></td>
                               <?php
                            } ?>
                           </tr>
                         <?php $i = $i + 1;
                    } ?>
                       </tbody>
                   </table>

               </div>
               <div class="col col-lg-12">
                   <table class="table table responsive">
                   <h4 style="margin-left: 5px;color:#6ac7ed;text-align:center">ตั้งค่าเอกสารเผยแพร่</h4><br>
                       <thead class="thead-drak">
                         <th scope="col" colp="2">ข้อที่</th>
                         <th scope="col" colp="2">ข้อความ</th>
                         <th scope="col" colp="2">ชื่อไฟล์ปัจจุบัน</th>
                         <th scope="col" colp="2">ไฟล์ข้อมูลPDF</th>
                         <th scope="col" colp="2"><center>ซ่อน</center></th>
                       </thead>
                       <tbody>
                         <?php while ($row2 = mysqli_fetch_array($result2)) {
                            $a = $i - 4; ?>
                           <tr>
                               <th scope="row"><?php echo $a . " )." ?></th>
                               <td><input type="text" name="text<?php echo $i ?>" value="<?php echo $row2['text'] ?>" required></td>
                               <th scope="row"><?php echo $row2['real_name'] ?></th>
                               <!-- <td><input type="text" name="link<? php// echo $i ?>" value="<? php// echo $row2['url'] ?>" required></td> -->
                               <td><input type="file" name="link<?php echo $i ?>" ></input></td>
                               <?php if ($row2['hide'] == 0) { ?>
                                 <td><center><input type="checkbox" name="cb<?php echo $i ?>"></center></td>
                               <?php
                            } else { ?>
                                 <td><center><input type="checkbox" name="cb<?php echo $i ?>" checked></center></td>
                               <?php
                            } ?>
                           </tr>
                         <?php $i = $i + 1;
                    } ?>
                       </tbody>
                   </table>
               </div>
               <center><input type="submit" class="btn btn-info btn-active" value="update" name="update"></center>
           </div>

           </table>
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
       </div>
   </body>
</html>
