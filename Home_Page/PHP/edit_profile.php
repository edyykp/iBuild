<?php
session_start();
include 'connect_db.php';

// initializing variables
$target_dir = "../profile_photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error_message = "";
$data = "";
$first_name = "";
$surname = "";
$email = "";
$country = "";
$city = "";
$tel = "";

// connect to the database
OpenCon();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $tel = mysqli_real_escape_string($conn, $_POST['phone']);
        $data = $_FILES["fileToUpload"]["name"];

        if(!empty($data)){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check == false) {
                $error_message = "File is not an image.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $error_message = "Your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $error_message = "Only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $error_message = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $error_message = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $data = mysqli_real_escape_string($conn, $data);
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            }
        }
	else {
		$error_message = "no photo uploaded";	
	}
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($first_name)) { $error_message = "All fields are required!";}
        if (empty($surname)) { $error_message = "All fields are required!";}
        if (empty($email)) { $error_message = "All fields are required!";}
        if (empty($tel)) { $error_message = "All fields are required!";}
        if (empty($country)) { $error_message = "All fields are required!";}
        if (empty($city)) { $error_message = "All fields are required!";}
        if(!preg_match("/^[A-Z]([a-z])*$/", $first_name)) { $error_message = "Please write a valid first name.";}
        if(!preg_match("/^[A-Z]([a-z])*$/", $surname)) { $error_message = "Please write a valid last name.";}
        if(!preg_match("/^([a-zA-Z0-9._-])+@([a-zA-Z0-9-])+\.([a-zA-Z.]){2,5}$/", $email)) { $error_message = "Please write a valid email.";}

        // check if email exists
        $user_check_query = "SELECT * FROM Users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $row = mysqli_fetch_assoc($result);
        if ( mysqli_num_rows($result)==1 && $row['user_id'] != $_SESSION['last_user']) {
             $error_message = "This email address is already in use.";
        }
        echo $error_message;
        // Finally, register user if there are no errors in the form
        if ($error_message == "") {
            $current_id = $_SESSION['last_user'];
            mysqli_query($conn, "UPDATE Users
                                 SET first_name =  '$first_name', last_name = '$surname', email = '$email', city = '$city', country = '$country', phone_number = '$tel', profile_photo = '$data'
                                 WHERE user_id = '$current_id';") or die(mysqli_error());
            CloseCon($conn);
            session_destroy();
            echo "image stored";
        }
}
?>
