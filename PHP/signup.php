<?php
include 'connect_db.php';

// initializing variables
$first_name = "";
$last_name = "";
$email    = "";
$c_a = 1;
$error_message = "";

// connect to the database
OpenCon();

// REGISTER USER
if( isset($_POST['accept']) && isset($_POST['store']) ) {

    if ( isset($_POST['email']) ) {

        // receive all input values from the form
        $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
        $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password2']);

        if (isset($_POST['role'])) {
            if($_POST['role'] == 'architect')
                $c_a = 0;
            else
                $c_a = 1;
        }

        // form validation: ensure that the form is correctly filled ...
        if (empty($first_name)) { $error_message = "All fields are required!";}
        if (empty($last_name)) { $error_message = "All fields are required!";}
        if (empty($email)) { $error_message = "All fields are required!";}
        if (empty($password_1)) { $error_message = "All fields are required!";}
        if ($password_1 != $password_2) { $error_message = "Passwords do not match.";}
        if(!preg_match("/^[A-Z]([a-z])*$/", $first_name)) { $error_message = "Please write a valid first name.";}
        if(!preg_match("/^[A-Z]([a-z])*$/", $last_name)) { $error_message = "Please write a valid last name.";}
        if(!preg_match("/^([a-zA-Z0-9._-])+@([a-zA-Z0-9-])+\.([a-zA-Z.]){2,5}$/", $email)) { $error_message = "Please write a valid email.";}
        $uppercase = preg_match("/[A-Z]+/", $password_1);
        $lowercase = preg_match("/[a-z]+/", $password_1);
        $number    = preg_match("/[0-9]+/", $password_1);
        $specchar  = preg_match("/\W+/", $password_1);
        if(!$uppercase || !$lowercase || !$number || strlen($password_1) < 8 || !$specchar || strlen($password_1) > 20) {
          $error_message = "Password does not meet all requirements.";
        }
        // first check the database to make sure
        // a user does not already exist with the same email
        $user_check_query = "SELECT * FROM Users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);

        if ( mysqli_num_rows($result)==1 ) {
          $error_message = "This email address is already in use.";
        }


        // Finally, register user if there are no errors in the form
        echo $error_message;
        if ($error_message == "") {
          $password = md5($password_1);//encrypt the password before saving in the database
            $error_message = "";
          mysqli_query($conn, "INSERT INTO Users (first_name, last_name, email, password, c_a)
                      VALUES ('$first_name', '$last_name', '$email', '$password', '$c_a')") or die(mysqli_error($conn));
          session_start();
          $_SESSION['last_user'] = mysqli_insert_id($conn);
          CloseCon($conn);
          header('Location: https://' . $_SERVER['HTTP_HOST'] . '/first_group_project/Home_Page/PHP/edit_profile_page.php', true, 303);
          exit;
        }
    }
}
else {
    $error_message = "Please accept terms and conditions";
}

?>
