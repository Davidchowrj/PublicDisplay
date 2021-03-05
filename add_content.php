<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/DbConnect.php';
    $target_dir = "images/contents/";
    $target_file = $target_dir . time() . '_' .basename($_FILES["TemplateFile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["TemplateFile"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000) {
        echo "Sorry, your file is too large. Max 10MB";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["TemplateFile"]["tmp_name"], $target_file)) {
            $title = $_POST['ETitle'];
            $desc = $_POST['EDesc'];
            $venue = $_POST['Venue'];
            $type = $_POST['EType'];
            $date_time = $_POST['EDate'] . ' ' . $_POST['ETime'];
            $eventDateTime = date("Y-m-d H:i:s", strtotime($date_time));
            $from = date("Y-m-d H:i:s", strtotime($_POST['StartDate']));
            $to = date("Y-m-d H:i:s", strtotime($_POST['EndDate']));
            $status = 1;
            $owner = $_COOKIE['user_id'];

            $sql = "INSERT INTO `content`(`content_title`, `content_desc`, `content_link`, `venue`, `content_type`, `content_date_time`, `display_date_from`, `display_date_to`, `content_status`, `created_by`) VALUES (
            '$title', '$desc', '$target_file', '$venue', '$type', '$eventDateTime', '$from', '$to', '$status', '$owner'
            )";

            if (mysqli_query($con, $sql)) {
                echo "The file " . basename($_FILES["TemplateFile"]["name"]) . " has been uploaded.";
            }else{
                echo mysqli_error($con);
            }
        } else {
            echo "Fail to upload";
        }
    }
}

// Create the page:
include ('add_content_page.inc.php');