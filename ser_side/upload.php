<?php
require 'server.php';

$ext = pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
$new_taget_name = 'pdf_' . uniqid() . "." . $ext;
$target_path = "uploads/";
$upload_path = $target_path . $new_taget_name;
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($new_taget_name, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 8000000) {
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
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_path)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            $real_name = basename($_FILES["fileToUpload"]["name"]);
            echo $real_name;
            $q = "INSERT INTO `testpdf`(`url`,`real_name`) VALUES ('$new_taget_name','$real_name')";
            $result = mysqli_query($con, $q);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>