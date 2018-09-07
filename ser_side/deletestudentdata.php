<button type="button" class="btn btn-danger btn-sm fas fa-times" data-toggle="modal" data-target="#de<?php echo $row['order'] ?>"></button>
    <div class="modal fade" id="de<?php echo $row['order'] ?>" role="dialog">
   <div class="modal-dialog modal-sm">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>

       <div class="modal-body">
           <center> <h3>ยืนยันการลบข้อมูล</h3></center>
       </div>
       <div class="modal-footer">

               <div style="text-align: center;">

                  <a type="button" href="deletedata.php?id=<?php echo $row['order']?>" class="btn btn-danger">Yes</a>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
               </div>

       </div>
     </div>
   </div>
</div>
