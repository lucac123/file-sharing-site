<!DOCTYPE html>
<html>

<head>
	<title>FileShare</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="fileshare.css" />
</head>

<body>
	<header>
		<h1><span>FileShare</span> - Free Online File-Hosting Service</h1>
	</header>
	<nav>
		<a href=".">Home</a>
		<a href="files.php">Files</a>
		<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: fileshare.php");
else {
	echo '<a href="login.php?signup">Sign Up</a>'."\n";
	echo '<a href="login.php">Log In</a>';
}

$signup = isset($_GET['signup']);
$error = isset($_GET['error']);
		?>
	</nav>
	<div>
		<h2><?= $signup ? 'Sign Up' : 'Log In' ?></h2>
		<form action="<?= $signup ? 'create_user.php' : 'validate_user.php' ?>" method="POST">
			<?= $error ? '<p>Username already exists</p>' : ?>
			<label for="uname">Username</label>
			<input type="text" id="uname" name="uname" required /><br />
			<label for="pass">Password</label>
			<input type="password" id="pass" name="pass" required />
			<button type="submit"><?= $signup ? 'Sign Up' : 'Log In' ?></button>
		</form>
	</div>

</body>

</html>