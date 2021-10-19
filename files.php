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
if (!isset($_SESSION['user'])) {
	header("Location: login.php?target=files.php");
}
else {
	echo '<a href="logout.php">Log Out</a>'."\n";
}

$username = $_SESSION['user'];
		?>
	</nav>
	<div>
		<h2>My Files</h2>
		<ul>
			<?php list_files($username); ?>
		</ul>
		<a href="file_upload.php">Upload</a>
	</div>
	<?php
function list_files($uname) {
	$files = array_diff(scandir("/srv/file-share/{$uname}"), array('..', '.'));

	foreach ($files as $file) {
		printf('<li><a href="file_display.php?file=%s" target="_blank">%s</a><a href="file_download.php?file=%s" target="_blank">Download</a><a href="file_delete.php?file=%s">Delete</a></li>'."\n",
			$file, $file, $file, $file);
	}
}
	?>
</body>

</html>