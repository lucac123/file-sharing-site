<!DOCTYPE html>
<html>

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
			<a class="button button-dark" id="logout-button" href="logout.php">log out</a>
		</div>
	</header>
	<div class="content-box" id="upload-form">
		<p class="mid-caption" id="upload-title">Upload File</p>
		<form enctype="multipart/form-data" action="file_upload_backend.php" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="150000000" />
			<label for="fileinput" class="button button-light" id="file-upload">choose file</label>
			<input name="upfile" type="file" id="fileinput"/>
			<button class="button button-dark form-submit" id="upload-submit" type="submit">upload file</button>
		</form>
	</div>
</body>

</html>