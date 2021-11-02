<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error - file or user unset';
	exit;
}

$filename = $_GET['file'];
$username = $_SESSION['user'];

$path = '/srv/file-share/'.$username.'/'.$filename;

$mime = mime_content_type($path);

header("Content-Type: ".$mime);
header("content-disposition: inline; filename=\"".$filename."\";");
readfile($path);
?>