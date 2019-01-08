<?php

  require 'server.php';
  session_start();
  if (!isset($_SESSION['status'])) {
    if (isset($_SESSION['online'])) {
      echo '<script type="text/javascript">alert("ท่านยังไม่ได้เข้าสู่ระบบ.");</script>';
      unset($_SESSION['online']);
    }
  }else {
    if ($_SESSION['status']==1) {
      echo '<script type="text/javascript">alert("ข้อมูลของท่านไม่ถูกต้อง.");</script>';
    }
  }

  $q_web =  "SELECT * FROM `web_show_time` ";
  $web_result = mysqli_query($con,$q_web);
  $web_row = mysqli_fetch_array($web_result);
  $_SESSION['year'] = $web_row['web_year'];
  $_SESSION['term'] = $web_row['web_term'];
  $_SESSION['footer'] = $web_row['footer'];

  $q1 =  "SELECT * FROM `show_url` WHERE group_url = '1' AND hide=0 ";
  $q2 =  "SELECT * FROM `show_url` WHERE group_url = '2' AND hide=0";
$result1 = mysqli_query($con,$q1);
$result2 = mysqli_query($con,$q2);


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
	<link rel="stylesheet" href="stylelogin.css">
    <title>Login</title>
	
	
</head>
<body>
    <header>
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
        <nav class="navbar navbar-expand-md navbar-light text-center"  style="background:#55236d">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                        <div onclick="openInNewTab('http://gen-ed.ssru.ac.th/page/contact-us');">
                            <a class="nav-link btn btn-md"  style="color:white;margin-left:20px"><span>ติดต่อสอบถาม</span></a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
        </div>

    </div><br>
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" action="login.php" method="POST" >
              <div class="form-label-group">
                <input type="text" name="text" class="form-control" placeholder="ใส่รหัสนักศึกษา" required autofocus>
				<center><small  class="form-text text-muted">ใส่รหัสนักศึกษา<br>(ตัวอย่าง 61XXXXXXXX)</small></center>
              </div>
              <div class="form-label-group">
                <input type="password" name="password" class="form-control" placeholder="GEตามด้วยรหัสนักศึกษา" required>
				<center><small  class="form-text text-muted">พิมพ์ GEตามด้วยรหัสนักศึกษา <br>(ตัวอย่าง GE61XXXXXXXX)</small></center>
              </div>
			  <center><input class="btn btn-signin" style="background:#55236d;color:white"  type="submit"  value="เข้าสู่ระบบ" class="button1" ></center>
			  
            </form>
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
                                    <li><a href="<?php echo $row1['url']; ?>" target="_blank" ><?php echo $row1['text']; ?></a></li>
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
                                        <li><a href="ser_side/uploads/<?php echo $row2['url']; ?> "target="_blank" ><?php echo $row2['text']; ?></a></li>
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

    <br>

    <footer class="container-fluid" style="background:#f6f6f6;height:"><br>

        <div class="text-center" >
            <br>
                <h5>
                <?php
                echo $_SESSION['footer'];
                ?>
                </h5>
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
