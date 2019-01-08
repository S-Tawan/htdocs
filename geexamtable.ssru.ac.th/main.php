<?php
 require 'server.php';
  session_start();
  $q1 =  "SELECT * FROM `show_url` WHERE group_url = '1' AND hide=0 ";
  $q2 =  "SELECT * FROM `show_url` WHERE group_url = '2' AND hide=0";
$result1 = mysqli_query($con,$q1);
$result2 = mysqli_query($con,$q2);
  require 'checklogin.php';
  $a = $_SESSION['id'];
  $y = $_SESSION['year'] ;
  $t = $_SESSION['term'];
  $q = "SELECT * FROM student_table WHERE user_id = $a AND exam_year = $y";
  $result = mysqli_query($con,$q);
  $row = mysqli_fetch_array($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="font.css">
    <title>หน้าหลัก</title>


     <script>
        .btn{
            transition:1s;text-decoration:none;text-align:left;
        }
        .btn:hover{background:#ffffff;color:#000; }

    </script>
</head>
<body>
    <header >
      <?php
     $banner = "SELECT * FROM `baner` WHERE `id` = 1";
     $sth2 = mysqli_query($con,$banner);
     $ImYourFather=mysqli_fetch_array($sth2,MYSQLI_ASSOC);
     $sing = $ImYourFather['name_baner'];
 
     $sql = "SELECT * FROM images WHERE name_pic = '$sing' ";
     $sth = mysqli_query($con,$sql);
     $Baner=mysqli_fetch_array($sth);
     echo '<img src="data:image/jpeg;base64,'.base64_encode( $Baner['image'] ).'" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"/>';
    ?>
      
    </header>

    <div class="container-fluid" style="background:#55236d">
        <div class="container">
        <nav class="navbar navbar-expand-md navbar-light"  style="background:#55236d">
              
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-md" href="main.php" style="color:white;margin-left:30px"><span class="fas fa-home"></span></a>
                    </li>
                    <li class="nav-item">
                        <div onclick="openInNewTab('http://gen-ed.ssru.ac.th/page/contact-us');">
                            <a class="nav-link btn btn-md"  style="color:white;margin-left:20px"><span>ติดต่อสอบถาม</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div style="text-align:right"></div>
                        <a class="nav-link btn btn-md" href="logout.php" style="color:white;margin-left:20px"><span class="fas fa-sign-out-alt" ></span> logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>

    </div><br>
	<div class="hiden-*-down">
    <div class="container">
        <div class="row">
            <div class="col col-sm-6">
            <div class="card ">
                <div class="card-header text-center" style="background:#55236d">
                <p style="color:white">ข้อมูลนักศึกษา</p>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class=" col col-sm-6" >
                        <p style="color:#55236d">ชื่อ</p>
                            <p style="color:#55236d">นามสกุล</p>
                            <p style="color:#55236d">รหัสนักศึกษา</p>
                        </div>
                        <div class="col col-sm-auto" >

                             <p><?php echo $row['user_title']." ".$row['user_first_name'] ?></p>
                            <p><?php echo $row['user_last_name'] ?></p>
                            <p><?php echo $row['user_id'] ?></p>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            <div class="col col-sm-6">
            <div class="card text-center">
                <div class="card-header" style="background:#55236d">
                <p style="color:white">ตรวจสอบที่นั่งสอบ</p>
                </div>
                <div class="card-body">
                    <div class="btn-group-vertical container-fluid">
                        <a class="btn btn-light btn-md" href="checkseat.php?id=1" style="background:#dd99ff">กลางภาค</a>
                        <a class="btn btn-light btn-md" href="checkseat.php?id=2" style="background:#dd99ff">ปลายภาค</a>
                        <a class="btn btn-light btn-md" href="checkseat.php?id=3" style="background:#dd99ff">แก้ไขผลการเรียน ( I )</a>
                        <a class="btn btn-light btn-md" href="#" style="background:#dd99ff">อื่นๆ</a>
                    </div>
                </div>

                </div>
            </div>
        </div>
</div>
</div>
<br>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color:#55236d">เว็ปไซต์ที่เกี่ยวข้อง</h4>
                                <ul>
                                  <?php
                                      while ($row1 = mysqli_fetch_array($result1)) {
                                  ?>
                                    <li><a href="<?php echo $row1['url']; ?>"  target="_blank" ><?php echo $row1['text']; ?></a></li>
                                  <?php
                                      }
                                  ?>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color:#55236d">เอกสารที่เผยแพร่</h4>
                                <ul>
                                  <?php
                                      while ($row2 = mysqli_fetch_array($result2)) {
                                        ?>
                                        <li><a href="<?php echo $row2['url']; ?>" target="_blank" ><?php echo $row2['text']; ?></a></li>
                                        <?php
                                      }
                                      ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br><br>



<footer class="container-fluid" style="background:#f6f6f6;height:"><br>

<div class="text-center" >
<br>
    <p>
        <?php
            echo $_SESSION['footer'];
        ?>
    </p>
                
    <br>
</div>
</footer>
 <div>
     <script src="node_modules/jquery/dist/jquery.min.js"></script>
     <script src="node_modules/popper.js/dist/popper.min.js"></script>
     <script src="node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
     <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
     <script src="link.js"></script>

 </div>
</body>
