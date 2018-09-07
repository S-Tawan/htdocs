<?php 
require 'server.php';
session_start();
$year = $_SESSION['p_year'];
$qli_term = $_SESSION['p_term'];
$qli_type = $_SESSION['p_type'];
$qli_sub = $_SESSION['p_sub'];
$qli_exam_date = $_SESSION['p_date'];
$qli_exam_time = $_SESSION['p_time'];
$qli_exam_location = $_SESSION['p_place'];

$term = $_SESSION['d_term'];
$type = $_SESSION['d_type'];
$sub = $_SESSION['d_sub'];
$exam_date = $_SESSION['d_date'];
$exam_time = $_SESSION['d_time'];
$exam_location = $_SESSION['d_place'];
$q = "SELECT * FROM student_table WHERE exam_year = '$year' $qli_term $qli_type $qli_sub $qli_exam_date $qli_exam_time $qli_exam_location";
//$q = "SELECT * FROM student_table ORDER BY exam_seat ASC";
// $q = "SELECT * FROM student_table WHERE exam_year = '$year' and exam_term = '$term' and exam_type = '$type' and exam_subject = '$sub' and exam_date =  '$exam_date' and exam_time ='$exam_time' and  exam_location =  '$exam_location' ORDER BY user_id ASC";

$result = mysqli_query($con, $q);






$head = '<div style="text-align:center; font-weight: bold; font-size: 14pt">
<span>รายชื่อนักศึกษาสอบ '.$type.' ภาคเรียนที่ '.$term.'/'.$year.'</span><br><span>สำนักวิชาการศึกษาทั่วไปและนวัตกรรมการเรียนรู้อิเล็กทรอนิกส์ : มหาวิทยาลัยราชภัฎสวนสุนันทา</span><br><span>วันที่ '.$exam_date.' เวลา '.$exam_time.' น. ห้อง '.$exam_location.'</span>
</div>';
$footer = '</tbody>
</table><br>
<div style="text-align:right;">
<span>กรรมการคุมสอบ...................................................................................................</span><br>
<span>กรรมการคุมสอบ...................................................................................................</span><br>
<span>กรรมการคุมสอบ...................................................................................................</span><br>
<span>จำนวนนักศึกษาที่เข้าสอบ.................................................................................................คน</span><br>
<span>จำนวนนักศึกษาที่ขาดสอบ.................................................................................................คน</span>

</div>
</div>';

$style = '<style>
table,th,td{
	border: 1pt solid black;
    border-collapse: collapse;
    margin-top:1pt;
    margin-button:1pt;
    padding: 2pt;
   
}
table.layout {
    text-align:center;
    margin-left:0;
    margin-right:0;
	border-collapse: collapse;
}
td.layout {
	border: 1pt solid black;
}
th{
    text-align:center;
}

</style>';
$tablehead = '
        <div class="container"  >
                <table autosize="1" style="width:100%;" >
                        <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รหัสนักศึกษา</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>วิชาที่สอบ</th>
                                    <th>วันที่สอบ</th>
                                    <th>เวลาที่สอบ</th>
                                    <th>ห้องสอบ</th>
                                    <th style="width:80pt;">ลายเซ็น</th>
                                </tr>
                        </thead>
                        <tbody>';






require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 11,
    'default_font' => 'sarabun',
    "sarabun" => 'B',
    'format' => 'A4',
    'margin_left' => 1,
    'margin_right' => 1,
    'mode' => 'utf-8',
    // 'orientation' => 'L'
]);


$mpdf->pdf_version = '1.5';
$mpdf->shrink_tables_to_fit = 1;
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($style);
$mpdf->WriteHTML($tablehead);
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_title'] . $row['user_first_name'] . " " . $row['user_last_name'];
    $sub = $row['exam_subject'];
    $date = $row['exam_date'];
    $time = $row['exam_time'];
    $location = $row['exam_location'];
    $seat = $row['exam_seat'];
    $q_sub = "SELECT `id_name` FROM `subject`  WHERE sub_id = '$sub' ";
    $re_sub = mysqli_query($con, $q_sub);
    $sub_row = mysqli_fetch_array($re_sub);
    $sub_name = $sub_row['id_name'];
	//$sub_name =substr($sub_name,5,40);

    $tablebody = ' <tr>
        <td style="text-align:center"><p>' . $seat . '</p></td>
        <td style="text-align:center"><p>' . $user_id . '</p></td>
        <td><p>' . $user_name . '</p></td>
        <td style="text-align:center"><p>' . $sub .' '.$sub_name. '</p></td>
        <td style="text-align:center"><p>' . $date . '</p></td>
        <td style="text-align:center"><p>' . $time . '</p></td>
        <td style="text-align:center"><p>' . substr($location,0,5) . '</p></td>
        <td ></td>
       </tr>';
    $mpdf->WriteHTML($tablebody);
}


$mpdf->WriteHTML($footer);



$mpdf->Output();

?>
