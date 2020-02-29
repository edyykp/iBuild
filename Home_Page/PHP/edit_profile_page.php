<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>iBuild - edit profile</title>
	<link rel="stylesheet" type="text/css" href="../CSS/edit_profile_page.css">
  <body>
    <nav>
  		<div class="wide-wrapper">
  			<a href="../index.php" class="logo">iBuild</a>
  			<ul>
  				<li><a class="cta nav" href="#">Sign Up</a></li>
  				<li><a class="cta" href="#" id="action1">Login</a></li>
  				<li><a class="cta" href="#">Explore</a></li>
  			</ul>
  		</div>
  	</nav>

      <div class="head_text">
	      <h1>Edit Your Profile</h1>
	      <h2>Tell the world who you are.</h2>
			</div>
			<div class="edit_profile_form">
				  <h2>User Information: </h2>
                  <form id="user_info" action="edit_profile.php" method="post" enctype="multipart/form-data">
                      <div class="error-message"><?php if(isset($error_message)) { echo $error_message; } ?></div>
                      <img src="../profile_photos/<?php if(isset($_SESSION['profile_photo'])) echo $_SESSION['profile_photo']; else echo 'none_image.png';?>"  class="profile_image" alt="profile" id="profile_display">
                      <input type="file" id="profile_image" onchange="displayImage(this)" class="inputfile" name="fileToUpload" accept="image/*"/>
                      <label for="profile_image">Upload your photo</label>
                      <br>
                      <br>
                      <label for="first_name">First name:</label>
                      <br>
                    <input  type="text" class="inputBox" name="first_name" id="first_name" value="<?php if(isset($_SESSION['first_name'])) echo $_SESSION['first_name'];?>"/>
                      <br>
                      <br>
                    <label for="surname">Surname:</label>
                      <br>
                    <input  type="text" class="inputBox" name="surname" id="surname" value="<?php if(isset($_SESSION['last_name'])) echo $_SESSION['last_name'];?>"/>
                      <br>
                      <br>
                    <label for="country">Country*:</label>
                      <br>
                    <input  type="text" class="inputBox" name="country" id="country" value="<?php if(isset($_SESSION['country'])) echo $_SESSION['country'];?>"/>
                      <br>
                      <br>
                    <label for="city">City*:</label>
                      <br>
                    <input  type="text" class="inputBox" name="city" id="city" value="<?php if(isset($_SESSION['city'])) echo $_SESSION['city'];?>"/>
                      <br>
                      <br>
                    <label for="phone">Phone number*:</label>
                      <br>
                    <input  type="tel" class="inputBox" name="phone" id="phone" pattern="[0-9]*" value="<?php if(isset($_SESSION['phone_number'])) echo $_SESSION['phone_number'];?>"/>
                      <br>
                      <br>
                    <label for="email">Email:</label>
                      <br>
                      <input  type="text" id="email" class="inputBox" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>"/>
                      <br>
                      <br>
                      <input type="submit" id="save" value="Confirm and save" name="submit"/>
                      <label for="save"></label>
                      <button id="cancel">Cancel</button>
                  </form>

            </div>



 <script src="../JS/image_preview.js"></script>

  </body>
</html>
