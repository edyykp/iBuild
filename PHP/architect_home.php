<?php
session_start();
include_once "output-data.php";
include_once "select_id_by_email.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
	<title>Architect | Home</title>
	<link rel="stylesheet" type="text/css" href="../CSS/architect_home.css">
	<script src="https://kit.fontawesome.com/775a21356d.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
</head>
<body>
<input type="hidden" id="sender_id" value="<?php echo $_SESSION['user_id'];?>" style="display:none;"/>
<input type="hidden" id="sender_name" value="<?php echo $_SESSION['first_name'];?>" style="display:none;"/>

<nav>
	<div class="container">
		<div class="row">
			<div class="logo">
				<a href="../PHP/edit_profile_page.php"><img src="../img/logoWithBar4.png" alt="logo"></a>
			</div>
			<div class="menu">
				<ul>
					<li><a class="cta nav" href="#" id="action3"><img src="../img/loupe.png" alt="Search page icon"> Search</a></li>
					<li><a class="cta" href="#" id="action1"><img src="../img/alarm.png" alt="Notifications icon"></a></li>
					<li><a class="cta" href="#"><img src="../img/home.png" alt="Home icon"></a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="cover"></div>

<div class="content">
	<div class="container">
		<div class="row">
			<!-- Architect profile info - left column -->
			<div class="profile-info col-3">
				<div class="profile-pic"></div>
				<h2> <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"] ?> </h2>
				<p>Architect</p>
				<div class="architect-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></div>
				<p>Description of the architect</p>
				<p><i class="fas fa-map-marker-alt"></i> <?php echo $_SESSION["city"] . ", " . $_SESSION["country"] ?> </p>
				<p class="align-left"><i class="far fa-envelope"></i> <?php echo $_SESSION["email"] ?> </p>
			</div>

			<!-- Projects section - right column -->
			<div class="projects-section col-9">
				<div class="row">
					<a class="cta blue" href="#"><i class="fas fa-upload"></i> Upload Project</a>
					<a class="cta green" href="#">Edit Profile</a>
				</div>
				<div class="row">
					<h2>Projects</h2>
				</div>

				<?php while($row2 = mysqli_fetch_assoc($result2)): ?>
					<div class="row project-item">
						<img src="../img/projects-section-1.jpg" alt="Photo of the project">
						<a href="#"><h2> <?php echo $row2["project_name"]?> </h2></a>
						<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i>
						<p> <?php echo $row2["project_description"]?> </p>

						<?php $projectid = $row2["project_id"];
						createTags($projectid);?>
						<?php while($row3 = mysqli_fetch_assoc($result3)):?>
							<div class="tag"> <?php echo $row3["tag_name"]?> </div>
						<?php endwhile; ?>
					</div>
				<?php endwhile; ?>

				<div class="row project-item">
					<img src="../img/slideshow5.jpg" alt="Photo of the project">
					<a href="#"><h2>Project Title</h2></a>
					<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i>
					<p>Description of the project</p>
					<div class="tag">Office</div>
					<div class="tag">Home</div>
					<div class="tag">Interior Design</div>
					<div class="tag">Office</div>
					<div class="tag">Home</div>
					<div class="tag">Interior Design</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="container">
    <div class="column">
        <button class="open-button" onclick="openForm()">Chat</button>
        <div id="myForm" class="chat-popup">
            <div class="form-container" id="private_chat">
                        <h2>Private Chat</h2>
                        <div id="chat_area">
                            <div id="chat_text"></div>
                            <div id="acknowledgement"></div>
                        </div>
                        <input id="message" type="text" placeholder="Write message...." />
                        <button class="btn" id="send_message">Send</button>
                        <button class="btn cancel" onclick="closeForm()">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="footer">
	<div class="container">
		<div class="row">
			<div class="menu">
				<ul>
					<li><a class="cta" href="Terms_conditions.html">Terms and Conditions</a></li>
					<li><a class="cta" href="#">Privacy</a></li>
					<li><a class="cta" href="#">About us</a></li>
					<li><a class="cta" href="#">Help</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script src="../JS/pop_up_chat.js"></script>
<script src="../JS/chat_info.js"></script>
</body>
</html>
