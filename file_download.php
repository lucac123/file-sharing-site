<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error user or file unset';
	exit;
}

$filename = $_GET['file'];
$file_home = $_SERVER['file_home'];
$username = $_SESSION['user'];

if (file_exists("$file_home/$username/$filename")) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: 0');
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-Length: '.filesize("$file_home/$username/$filename"));
	header('Pragma: public');

	flush();
	readfile("$file_home/$username/$filename");
	exit;
}
else {
	echo 'File doesnt exist';
	exit;
}