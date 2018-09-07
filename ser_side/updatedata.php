
 <button type="button" class="btn btn-warnig btn-sm fas fa-pencil-alt" data-toggle="modal" data-target="#<?php echo $row['order'] ?>"></button>
 <!-- Modal -->

 <div class="modal fade" id="<?php echo $row['order'] ?>" role="dialog">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <form  role="form" action="updateform.php?id=<?php echo $row['order'] ?>" method="POST">
         <div class="modal-header ">
           <h3>แก้ไขข้อมูล นักศึกษา</h3>
           <button type="button" class="close" data-dismiss="modal">&times;</button>


         </div>

         <div class="modal-body ">

           <div  class="form-group" style="text-align: left">
             <h3 style="text-align: left">ข้อมูลทั่วไป</h3><br>
             <p>รหัสนักศึกษา : </p><input class="form-control" type="text" name="user_id" value="<?php echo $row['user_id'] ?>">
             <p>คำนำหน้า : </p><input class="form-control" type="text" name="title" value="<?php echo $row['user_title'] ?>">
             <p>ชื่อ : </p><input class="form-control" type="text" name="fname" value="<?php echo $row['user_first_name'] ?>">
             <p>นามสกุล : </p><input class="form-control" type="text" name="lname" value="<?php echo $row['user_last_name'] ?>">

             <p>Username : </p><input class="form-control" type="text" name="username" value="<?php echo $row['login_username'] ?>">
             <p>Password : </p><input class="form-control" type="text" name="password" value="<?php echo $row['login_password'] ?>">
             <br>
           </div>
           <div class="form-group" style="margin-left: 20px; text-align: left">
            <h3 style="text-align: left" >ข้อมูลการสอบ</h3><br>
            <p>ปีการศึกษา : </p><input class="form-control" type="text" name="year" value="<?php echo $row['exam_year'] ?>">
            <p>เทอม : </p><input class="form-control" type="text" name="term" value="<?php echo $row['exam_term'] ?>">
            <p>การกรอง : </p><input class="form-control" type="text" name="type" value="<?php echo $row['exam_type'] ?>">
            <p>วิชาที่สอบ : </p><input class="form-control" type="text" name="sub" value="<?php echo $row['exam_subject'] ?>">
            <p>วันที่สอบ : </p><input class="form-control" type="text" name="date" value="<?php echo $row['exam_date'] ?>">
            <p>ลำดับที่นั่งสอบ : </p><input class="form-control" type="text" name="seat" value="<?php echo $row['exam_seat'] ?>">
            <p>เวลาสอบ : </p><input class="form-control" type="text" name="time" value="<?php echo $row['exam_time'] ?>">
            <p>สถานที่สอบ : </p><input class="form-control" type="text" name="place" value="<?php echo $row['exam_location'] ?>">
            <p>สอบด้วยอุปกรณ์ : </p><input class="form-control" type="text" name="tool" value="<?php echo $row['exam_tool'] ?>">
            <label for="comment" >หมายเหตุ : </label>
            <textarea class="form-control" rows="3" name="comment" ><?php echo $row['note'] ?></textarea>
          </div>
          <br><br>
          <button  type="submit" class="btn btn-info pull-block form-control" value="save" >update</button>

        </div>

        <div class="modal-footer ">

        </div>
      </form>
    </div>
  </div>
 </div>
 <!--Modal-->
