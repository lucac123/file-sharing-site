<!DOCTYPE html>
<html>
<?php
session_start();

$username = NULL;

$file_home = $_SERVER['file_home'];

if (!isset($_SESSION['user']))
	header("Location: login.php");
else
	$username = $_SESSION['user'];

$selected = NULL;
if (isset($_GET['selected']))
	$selected = $_GET['selected'];

function get_icon($type) {
	$path = 'images/file-unknown.svg';
	if ($type == 'image')
		$path = 'images/file-image.svg';
	if ($type == 'text')
		$path = 'images/file-text.svg';
	if ($type == 'video')
		$path = 'images/file-video.svg';
	return $path;
}

function format_size($size) {
	if ($size > 1000000)
		return intval($size/1000000).' mb';
	else if ($size > 1000)
		return intval($size/1000).' kb';
	else
		return intval($size).' b';
	return '';
}

function list_files($uname) {
	global $selected;
	global $file_home;

	$path = "$file_home/$uname/";
	$files = array_diff(scandir($path), array('..', '.', '.htaccess'));

	foreach ($files as $file) {
		$filesize = format_size(filesize($path.$file));
		$filetype = explode("/", mime_content_type($path.$file))[0];
		$filetime = date("M/j/Y", filemtime($path.$file));
		$icon = get_icon($filetype);
		$row_id = '';

		if ($file == $selected) {
			$row_id .= ' id="selected-row"';
		}

		$tabrow = <<<EOS
<tr class="file-row" $row_id>	
				<td class="file-name">
					<a href="home.php?selected=$file" class="file-link">
						<img src="$icon" alt="$filetype" class="file-icon"/>
					</a>
					<a href="display.php?file=$file" class="file-link" target="_blank">
					$file
					</a>
				</td>
				<td class="file-data">
					<a href="home.php?selected=$file" class="file-link">
					$filetype
					</a>
				</td>
				<td class="file-data">
					<a href="home.php?selected=$file" class="file-link">
					$filesize
					</a>
				</td>
				<td class="file-data">
					<a href="home.php?selected=$file" class="file-link">
					$filetime
					</a>
				</td>
			</tr>\n
EOS;
		echo $tabrow;
	}
}
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
			<a class="button button-dark" id="logout-button" href="logout.php">log out</a>
		</div>
	</header>
	<div id="home-content">
		<div id="file-ops">
			<a href="upload.php">
				<div id="upload-button">
					<img id="plus" src="images/plus.svg" width=60px alt="plus" />
					<p id="upload">upload</p>
				</div>
			</a>
			<?php
			if ($selected != NULL) {
				$icons = <<<EOS
<a href="file_download.php?file=$selected"><img width=30px class="small-icon" id="download-button" src="images/download.svg" alt="download" /></a>
<a href="file_delete.php?file=$selected"><img width=30px class="small-icon" id="delete-button" src="images/trash.svg" alt="delete" /></a>
EOS;
				echo $icons;
			}
			?>
		</div>
		<div id="file-list">
			<table>
				<tr id="header-row">
					<td class="table-header">name</td>
					<td class="table-header">file type</td>
					<td class="table-header">files size</td>
					<td class="table-header">upload date</td>
				</tr>
				<?php list_files($username); ?>
			</table>
		</div>
	</div>
</body>

</html>