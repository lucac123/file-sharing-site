<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error - file or user unset';
	exit;
}

$filename = $_GET['file'];
$file_home = $_SERVER['file_home'];
$username = $_SESSION['user'];

$path = "$file_home/$username/$filename";

$mime = mime_content_type($path);

header("Content-Type: ".$mime);
header("content-disposition: inline; filename=\"".$filename."\";");
readfile($path);
?>