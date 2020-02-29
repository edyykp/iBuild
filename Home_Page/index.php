<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
	<title>iBuild | Home</title>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href="CSS/login_page_style.css">
	<link rel="stylesheet" type="text/css" href="CSS/sign_style.css">
</head>

<body>

<nav>
	<div class="container">
		<div class="row">
			<div class="logo">
				<a href="index.php"><img src="img/logoWithBar4.png" alt="logo"></a>
			</div>
			<div class="menu">
				<ul>
					<li><a class="cta nav" href="#" id="action3">Sign Up</a></li>
					<li><a class="cta" href="#" id="action1">Login</a></li>
					<li><a class="cta" href="#">Explore</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>


<div class="logo-banner" id="slideshow-bg">
	<div class="container">
		<img src="img/full-logo5.png" alt="logo and tagline">
		<a class="cta alt" href="#" id="action2">Login</a>
		<a class="cta alt" href="#" id="cta-orange">Sign Up</a>
	</div>
</div>

<div class="description-banner">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>How it works</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<img src="img/slideshow5.jpg">
			</div>
			<div class="col-6">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
			<div class="col-6">
				<img src="img/slideshow2.jpg">
			</div>
		</div>
	</div>
</div>

<div class="map-banner">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div id = "map"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h2><span id="highlight"></span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<p>Satisfied customers worldwide</p>
			</div>
		</div>
	</div>
</div>

<div class="review-banner">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>Our Customer Stories</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="review-item">
					<img src="img/putin2.jpg">
					<p>This website is a life-saver!</p>
				</div>
			</div>
			<div class="col-4">
				<div class="review-item">
						<img src="img/putin1.jpg">
						<p>I used this website to build my dream home.The process has never been easier!</p>
				</div>
			</div>
			<div class="col-4">
				<div class="review-item">
					<img src="img/putin2.jpg">
					<p>What would have taken me months of work, took just a couple of clicks!</p>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="footer">
	<div class="container">
		<div class="row">
			<div class="menu">
				<ul>
					<li><a class="cta" href="HTML/Terms_conditions.html">Terms and Conditions</a></li>
					<li><a class="cta" href="#">Privacy</a></li>
					<li><a class="cta" href="#">About us</a></li>
					<li><a class="cta" href="#">Help</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>



<div id="page-mask"></div>

<div id="login">
	<header>
  		<img src="img/logo.jpg" alt="logo" width="30" height="30" id="logo">
  		<h1>Login</h1>
  		<img src="img/close.jpg" alt="delete" width="20" height="20" id="close">
	</header>

	<div class="login_form">
		<form method="POST" action="PHP/login.php" onsubmit="submit(92)">
			<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
			<input  type="text" class="inputBox" placeholder="Email address" name="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>"/>
			<input  type="password" class="inputBox" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>"/>
			<a href="HTML/forgot_password_page.html" id="fgtpwd">Forgot Password?</a>
  			<p id="rmbme">
				<input type="checkbox" name="rmbme" id="remember" value="<?php if(isset($_COOKIE['email'])) { ?> echo 'Yes' <?php } ?>"/> Remember Me
			</p>
  			<input type="submit" id="login_button" value="Login"/>
		</form>

  	<p id="newuser">New user? <a id="go_to_signup" href="#">Sign up</a></p>
	</div>
</div>


<div id="signup">
	<form method="POST" action="PHP/signup.php">
    <div class="error-message"><?php if(isset($error_message)) { echo $error_message; } ?></div>

		<div class="header row">
			<img class="form-header-logo" src="img/logoWithBar4.png" alt="logo">
			<a href="#" onclick=""> <!--This button should be able to turn off the pop-up or page by js?-->
				<img id="close-sign" src="close.png" width="24" height="24" alt="close">
			</a>
			<p>Sign Up</p>
		</div>

		<div class="signup-box">
			<h2>Welcome to iBuild</h2>
			<p>What is your role?
				<input type="radio" name="role" value="architect"/> Architect
				<input type="radio" name="role" value="client" checked/> Client
			</p>
			<div class="row">
				<div class="col-6">
					<input type="text" name="firstname" placeholder="First Name"/>
				</div>
				<div class="col-6">
					<input type="text" name="lastname" placeholder="Last Name"/>
				</div>
			</div>
			<div class="row">
				<div class="col-7">
					<input type="email" name="email" placeholder="Email Address"/>
				</div>
			</div>
			<div class="row">
				<div class="col-7">
					<input type="password" name="password" placeholder="Password"/>
				</div>
				<div class="col-5">
					<img class="info-sign" src="info.png" width="20" height="20" alt="info">
				</div>
			</div>
			<div class="row">
				<div class="col-7">
					<input type="password" name="password2" placeholder="Confirm Password"/>
				</div>
			</div>
			<div class="row">
				<div class="checkbox">
					<label><input type="checkbox" value="accept" name="accept"/><span> Accept <a href="HTML/Terms_conditions.html">Terms and Conditions</a></span></label>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<input id="submit-sign-up" value="Submit" type="submit" name="store"/>
				</div>
				<div class="col-6 alternate-link">
					<p>Already have an account? <a href="#" id="go_to_login">Login</a></p>
				</div>
			</div>
		</div>
	</form>
</div>


<script>
	const go_login_1 = document.getElementById("action1");
	const go_login_2 = document.getElementById("action2");
	const go_signup_1 = document.getElementById("action3");
	const go_signup_2 = document.getElementById("cta-orange");
	const login_form = document.getElementById("login");
	const signup_form = document.getElementById("signup");
	const exit_login = document.getElementById("close");
	const exit_signup = document.getElementById("close-sign");
	const mask = document.getElementById("page-mask");
	const change_pop_up_1 = document.getElementById("go_to_signup");
	const change_pop_up_2 = document.getElementById("go_to_login");

	go_login_1.onclick = function() {
  		login_form.style.display = "block";
		mask.style.display = "block";
		signup_form.style.display = "none";
		};

	go_login_2.onclick = function() {
  		login_form.style.display = "block";
		mask.style.display = "block";
		signup_form.style.display = "none";
		};

	exit_login.onclick = function() {
		login_form.style.display = "none";
		mask.style.display = "none";
		};

	go_signup_1.onclick = function() {
		signup_form.style.display = "block";
		mask.style.display = "block";
		login_form.style.display = "none";
	};

	go_signup_2.onclick = function() {
		signup_form.style.display = "block";
		mask.style.display = "block";
		login_form.style.display = "none";
	};

	exit_signup.onclick = function() {
		signup_form.style.display = "none";
		mask.style.display = "none";
	};

	change_pop_up_1.onclick = function() {
		login_form.style.display = "none";
		signup_form.style.display = "block";
	};

	change_pop_up_2.onclick = function () {
		login_form.style.display = "block";
		signup_form.style.display = "none";
	};
</script>

<script src="JS/maps_and_highlights.js"></script>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm-ORjjnjxQy2jxLVH5NR0ES8z_b4bzv8&callback=initMap">
</script>

</body>
</html>
