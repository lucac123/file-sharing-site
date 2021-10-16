<!DOCTYPE html>
<html>

<head>
	<title>FileShare | My Files</title>
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
if (!isset($_SESSION['user']))
	header("Location: login.php");
else {
	echo '<a href="logout.php">Log Out</a>'."\n";
}

$username = $_SESSION['user'];
		?>
	</nav>
	<div>
		<h2>Upload File</h2>
	</div>
</body>

</html>