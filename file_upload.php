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
		?>
	</nav>
	<div>
		<h2>Upload File</h2>
		<form enctype="multipart/form-data" action="file_upload_backend.php" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
			<label for="fileinput">Choose file:</label>
			<input name="upfile" type="file" id="fileinput" />
			<button type="submit">Upload File</button>
		</form>
	</div>
</body>

</html>