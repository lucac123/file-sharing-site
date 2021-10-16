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
		<a href="fileshare.php">Home</a>
		<a href="files.php">Files</a>
		<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: fileshare.php");
else {
	echo '<a href="login.php?signup">Sign Up</a>';
	echo '<a href="login.php">Log In</a>';
}
		?>
	</nav>
	<div>
		<h2><?php (isset($_GET['signup'])? echo 'Sign Up' : echo 'Log In') ?></h2>
		<?php
		if (isset($_GET['signup']))
			printf('\t\t<form action="create_user.php" method="POST">');
		else
			printf('\t\t<form action="validate_user.php" method="POST">');
		?>
			<label for="uname">Username</label>
			<input type="text" id="uname" name="uname" />
			<label for="pass">Password</label>
			<input type="password" id="pass" name="pass" />

			<?php
		if (isset($_GET['signup']))
			printf('\t\t\t<button type="submit" value="Sign Up"/>');
		else
			printf('\t\t\t<button type="submit" value="Log In"/>');
		?>
		
		</form>
	</div>

</body>

</html>