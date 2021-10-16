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
	echo '<a href="logout.php">Log Out</a>';
else {
	echo '<a href="login.php?signup">Sign Up</a>'."\n";
	echo '<a href="login.php">Log In</a>';
}
		?>
	</nav>
	<div>
		<a href="files.php">Upload or View Files</a>
	</div>

</body>

</html>