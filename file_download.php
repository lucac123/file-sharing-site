<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error user or file unset';
	exit;
}

$filename = $_GET['file'];
$user = $_SESSION['user'];

if (file_exists('/srv/file-share/'.$user.'/'.$filename)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: 0');
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-Length: '.filesize('/srv/file-share/'.$user.'/'.$filename));
	header('Pragma: public');

	flush();
	readfile('/srv/file-share/'.$user.'/'.$filename);
	exit;
}
else {
	echo 'File doesnt exist';
	exit;
}