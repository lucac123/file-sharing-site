<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: .");

$signup = isset($_GET['signup']);

$errno = isset($_SESSION['errno'])? $_SESSION['errno'] : 0;
unset($_SESSION['errno']);

$action = $signup ? 'create_user.php' : 'validate_user.php';

$logtype = $signup ? 'sign up' : 'log in';
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
		<a href=".">
			<img id="logo" src="images/logo.svg" alt="logo" />
			<p id="title">fileshare</p>
		</a>

		<div id="buttons">
			<a class="button button-light" href="login.php">log in</a>
			<a class="button button-dark" href="login.php?signup">sign up</a>
		</div>
	</header>

	<div class="content-box" id="log-form">
		<p class="mid-caption" id="log-title">Get Started</p>
		<form action="<?= $action ?>" method="POST">
			<label class="log-label" for="uname">username:</label><br />
			<input type="text" class="text-box" id="uname" name="uname" autofocus required/><br />
			<?= $errno & intval($_SERVER['ERROR_USERNAME_INVALID']) ? "<p class=\"error-text\">Username invalid. Only use letters and numbers</p>\n" : ''?>
			<?= $errno & intval($_SERVER['ERROR_USERNAME_TAKEN']) ? "<p class=\"error-text\">Username taken. Please choose another</p>\n" : ''?>
			<?= $errno & intval($_SERVER['ERROR_USERNAME_DNE']) ? "<p class=\"error-text\">Username not found</p>\n" : ''?>
			<label class="log-label" for="pass">password:</label><br />
			<input type="password" class="text-box" id="pass" name="pass" required /><br />
			<?= $errno & intval($_SERVER['ERROR_PASSWORD_INVALID']) ? "<p class=\"error-text\">Invalid Password. Only use letters, numbers, and symbols *, @, #, $, ^</p>\n" : ''?>
			<?= $errno & intval($_SERVER['ERROR_PASSWORD_INCORRECT']) ? "<p class=\"error-text\">Incorrect Password</p>\n" : ''?>
			<button class="button button-dark form-submit" type="submit"><?= $logtype ?></button>
		</form>
	</div>

</body>

</html>