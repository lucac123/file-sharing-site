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
if (!isset($_SESSION['user']))
	header("Location: login.php?target=files.php");
else {
	echo '<a href="logout.php">Log Out</a>'."\n";
}

$username = $_SESSION['user'];
		?>
	</nav>
	<div>
		<h2>My Files</h2>


	</div>
<?php
function list_files($uname) {
	
}
</body>

</html>