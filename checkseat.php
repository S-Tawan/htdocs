<?php
require 'server.php';
session_start();
$q1 = "SELECT * FROM `show_url` WHERE group_url = '1' AND hide = '0' ";
$q2 = "SELECT * FROM `show_url` WHERE group_url = '2' AND hide = '0' ";
$result12 = mysqli_query($con, $q1);
$result2 = mysqli_query($con, $q2);
require 'checklogin.php';
$a = $_SESSION['id'];
$b = $_SESSION['year'];
$c = $_SESSION['term'];
if ($_GET['id'] == 1) {
    $_SESSION['type'] = "กลางภาค";
} elseif ($_GET['id'] == 2) {
    $_SESSION['type'] = "ปลายภาค";
} elseif ($_GET['id'] == 3) {
    $_SESSION['type'] = "แก้ไขผลการเรียน(I)";
}
$d = $_SESSION['type'];

if ($d == "แก้ไขผลการเรียน(I)" && $c == 1) {
    $b--;
    $c = 2;
}
else if ($d == "แก้ไขผลการเรียน(I)" && $c == 2){
    $c=1;
}
$user = "SELECT * FROM student_table WHERE user_id = '$a'";
$q = "SELECT * FROM student_table WHERE user_id = '$a' AND exam_year = '$b' AND exam_term = '$c' AND exam_type = '$d'";
$result1 = mysqli_query($con, $user);
$result = mysqli_query($con, $q);
$row1 = mysqli_fetch_array($result1);

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
    <title>ระบบตรวจสอบที่นั่ง</title>
</head>
<body>

     <header >
       <?php
        $banner = "SELECT * FROM `baner` WHERE `id` = 1";
        $sth2 = mysqli_query($con, $banner);
        $ImYourFather = mysqli_fetch_array($sth2, MYSQLI_ASSOC);
        $sing = $ImYourFather['name_baner'];

        $sql = "SELECT * FROM images WHERE name_pic = '$sing' ";
        $sth = mysqli_query($con, $sql);
        $Baner = mysqli_fetch_array($sth);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($Baner['image']) . '" alt="ssru" style="width:100%"  title="มหาลัยราชภัฎสวนสุนันทา"/>';
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
            <div class="col col-lg-6">
            <div class="card">
                <div class="card-header text-center" style="background:#55236d">
                <p style="color:white">ข้อมูลนักศึกษา</p>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class=" col col-lg-6" >
                            <p style="color:#55236d; font-size: 5">ชื่อ</p>
                            <p style="color:#55236d; font-size: 5">นามสกุล</p>
                            <p style="color:#55236d; font-size: 5">รหัสนักศึกษา</p>
                        </div>
                        <div class="col col-lg-auto" >

                             <p style="font-size: 5"><?php echo $row1['user_title'] . " " . $row1['user_first_name'] ?></p>
                            <p style="font-size: 5"><?php echo $row1['user_last_name'] ?></p>
                            <p style="font-size: 5"><?php echo $row1['user_id'] ?></p>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            <div class="col col-lg-6">
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
</div><br>
</div>
<div class="container">
<div id="resultsTable">
<div class="table-responsive">
                <table class="table table-striped table-sm table-bordered" style="width:100%" >
                    <thead>
                            <tr>
                               <?php 
                                $pitook = '<th style="color:white;background-color: #55236d;border-radius:5px" colspan="7"><h4 >ตารางสอบวัดความรู้ '.$d." ปีการศึกษา" . $c . "/" . $b .'</h4></th>';
                                $pitook2 = '<th style="color:white;background-color: #55236d;border-radius:5px" colspan="7"><h4 >ตารางสอบวัดความรู้ '.$d.'</h4></th>';
                                
                                if ($d == "แก้ไขผลการเรียน(I)") {
                                    echo $pitook2;
                                } else {
                                    echo $pitook;
                                }
                                ?>
                            <tr>
                            <tr style="text-align: center">
                                            <td ><p style="font-size: 7">วิชา</p>  </td>
                                            <td ><p style="font-size: 7">วันที่สอบ</p>  </td>
                                            <td ><p style="font-size: 7">เวลาสอบ</p>  </td>
                                            <td ><p style="font-size: 7">สถานที่</p>  </td>
                                            <td ><p style="font-size: 7">อุปกรณ์ที่ใช้สอบ</p>  </td>
                                            <td ><p style="font-size: 7">ที่นั่งสอบ</p>  </td>
                                            <td ><p style="font-size: 7">หมายเหตุ </p> </td>
                                </tr>
                    </thead>
                        <tbody>
                                       <?php while ($row = mysqli_fetch_array($result)) { ?>
                                        <?php
                                        $l_name = $row['exam_location'];
                                        $q_location = "SELECT * FROM `location_table` WHERE name_location = '$l_name' ";
                                        $l_result = mysqli_query($con, $q_location);
                                        $l_row = mysqli_fetch_array($l_result);
                                        $sub = $row['exam_subject'];
                                        $q_sub = "SELECT * FROM `subject`  WHERE sub_id = '$sub' ";
                                        $re_sub = mysqli_query($con, $q_sub);
                                        $sub_row = mysqli_fetch_array($re_sub);

                                        ?>
                                      <tr style="text-align: center">
                                        <td style="text-align:left" ><p style="font-size: 7 "><?php echo $row['exam_subject'] . " " . $sub_row['id_name'] ?></p></td>
                                        <td><p style="font-size: 7"><?php echo $row['exam_date'] ?></p></td>
                                        <td><p style="font-size: 7"><?php echo $row['exam_time'] ?></p></td>
                                        <td><p style="font-size: 7"><?php echo $row['exam_location'] ?></p>
                                       
                                        <a href="<?php echo $l_row['url_location'] ?>" target="_blank" ><i class="fas fa-map-marked-alt" style="font-size: 40px; "></i></a>
                                        
                                        </td>
                                        <td><p style="font-size: 7"><?php echo $row['exam_tool'] ?></p>
                                       
                                          <?php if ($row['exam_tool'] == "Tablet") : ?>
                                          <i class="fas fa-tablet-alt" style="font-size: 50px;" ></i>
                                          <?php endif; ?>
                                          <?php if ($row['exam_tool'] == "Computer") : ?>
                                          <i class="fas fa-desktop" style="font-size: 50px;" ></i>
                                          <?php endif; ?>
                                       
                                        </td>

                                        <td><p style="font-size: 7"><?php echo $row['exam_seat'] ?></p></td>
                                        <td><p style="font-size: 7"><?php echo $row['note'] ?></p></td>
                                      </tr>

                                      <?php 
                                    } ?>
                                    <tr style="border-collapse: collapse">
                                        <td colspan="6" ><p style="font-size: 7">*** หากไม่พบข้อมูล ติดต่อได้ที่จุด one stop service</p></td>
                                        <td> <div onclick="openInNewTab('print.php');"><p style="font-size: 7"><a class="btn btn-link" >Print</a></p></div></td>
                                    </tr>
                        </tbody>
                   </table>
        </div>
</div>
</div>
<br>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color:#55236d">เว็ปไซต์ที่เกี่ยวข้อง</h4>
                                <ul>
                                  <?php
                                    while ($row1 = mysqli_fetch_array($result12)) {
                                        ?>
                                    <li><a href="<?php echo $row1['url']; ?>"  target="_blank"  ><?php echo $row1['text']; ?></a></li>
                                  <?php

                                }
                                ?>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6">
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
<div class="text-center">
<br>
                <?php
                echo $_SESSION['footer'];
                ?>
    <br>
</div>
</footer>
    <div>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
        <script src="link.js"></script>
        
    </div>
</body>
</html>
