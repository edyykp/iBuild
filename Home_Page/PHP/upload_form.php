<?php
session_start();
include 'connect_db.php';
OpenCon();

//initialize variables
$name = "";
$price = "";
$description = "";
$tags_string = "";
$tags = array();
$error_message = "";

if(isset($_POST['submit'])){

    if(isset($_POST['name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);

        if(isset($_POST['price'])) {
            $price = mysqli_real_escape_string($conn, $_POST['price']);

            if(isset($_POST['description'])) {
                $description = mysqli_real_escape_string($conn, $_POST['text']);

                if(isset($_POST['tags'])) {
                    $tags = explode(" ", $_POST['tags']);
                    array_unique($tags);

                    // File upload configuration
                    $targetDir = "../uploaded_images_projects/";
                    $allowTypes = array('jpg','png','jpeg');

                    if(!empty(array_filter($_FILES['files']['name']))){
                        foreach($_FILES['files']['name'] as $key=>$val){
                           // File upload path
                           $fileName = basename($_FILES['files']['name'][$key]);
                           $targetFilePath = $targetDir . $fileName;

                           // Check whether file type is valid
                           $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                           if(!in_array($fileType, $allowTypes)){
                                $error_message = "Only images are allowed";
                           }
                        }
                        //if images are successfully uploaded
                        if($error_message == "") {
                            if(mysqli_query($conn, "INSERT INTO Projects (project_name, price, project_description, user_id) VALUES ($name, $price, $description, $_SESSION['user_id']);")) {
                                $last_id = mysqli_insert_id($conn);

                                foreach($tags as $key=>$val) {
                                    mysqli_query($conn, "INSERT INTO Tags (tag_name, project_id) VALUES ($tags[$key], $last_id);")
                                }

                                // Insert image file name into database
                                foreach($_FILES['files']['name'] as $key=>$val){
                                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                                        mysqli_query($conn, "INSERT INTO Images (image_blob, project_id) VALUES ($_FILES["files"]["name"][$key], $last_id);") or die(mysqli_error($conn));
                                    }
                                }
                            }
                        }
                    }else{
                        $error_message = 'Please select a file to upload.';
                    }
                }
                else {
                    $error_message = "At least one tag is required";
                }
            }
            else {
                $error_message = "Description is required";
            }
        }
        else {
            $error_message = "Price is required";
        }
    }
    else {
        $error_message = "Name is required.";
    }
}
?>