<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: home.php");

?>

<head>
	<title>FileShare</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="fileshare.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet" />
</head>

<body>
	<header id="nav-bar">
		<a href="." class="title">
			<img id="logo" src="images/logo.svg" alt="logo" />
			<p id="title">fileshare</p>
		</a>

		<div id="buttons">
			<a class="button button-light" href="login.php">log in</a>
			<a class="button button-dark" href="login.php?signup">sign up</a>
		</div>
	</header>

	<div id="welcome-content">
		<p class="big-caption">Access your files any<br />time, anywhere</p>
		<a class="big-button" id="get-started" href="home.php">Get Started</a>
	</div>

</body>

</html>