<?php 
include 'connect_db.php';
session_start();
$message = "";

OpenCon();
 
if(isset($_POST['email'])){          // if textBox not empty



    if(!empty($_POST["email"]) && !empty($_POST["password"])){

      $name = mysqli_real_escape_string($conn, $_POST["email"]);
      $password_user = md5(mysqli_real_escape_string($conn, $_POST["password"]));
      $sql = "Select * from Users where email = '" . $name . "' and password = '" . $password_user . "' limit 1";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)==1){
           if(!empty($_POST["rmbme"])){
                setcookie ("email",$name,time()+ (10 * 365 * 24 * 60 * 60));
                setcookie ("password",$password_user, time()+ (10 * 365 * 24 * 60 * 60));
           }
           else{
                if(isset($_COOKIE["email"])){
                    setcookie ("email","");
                }
                if(isset($_COOKIE["password"])){
                    setcookie ("password","");
                }
           }
           echo "Logged in";
           $data_db = mysqli_fetch_assoc($result);
           $_SESSION['email'] = $data_db['email'];
           $_SESSION['user_id'] = $data_db['user_id'];
           $_SESSION['first_name'] = $data_db['first_name'];
           $_SESSION['last_name'] = $data_db['last_name'];
           $_SESSION['country'] = $data_db['country'];
           $_SESSION['city'] = $data_db['city'];
           $_SESSION['phone_number'] = $data_db['phone_number'];
           $_SESSION['c_a'] = $data_db['c_a'];
           $_SESSION['profile_photo'] = $data_db['profile_photo'];
           CloseCon($conn);
           if($_SESSION['c_a'] == 0) {
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/first_group_project/Home_Page/PHP/architect_home.php', true, 303);
                exit;
           }
           else {
                header('Location: https://' . $_SERVER['HTTP_HOST'] . '/first_group_project/Home_Page/PHP/client_home.php', true, 303);
                exit;
           }
      }
      else{
        echo "invalid login";
        $message = "Invalid Login";
      }
    }
    else{
      echo "Both are required fields";
      $message = "Both are Required Fields";
    }
        
}

?>
