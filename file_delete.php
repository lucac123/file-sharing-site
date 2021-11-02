<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error - user or file not set';
	exit;
}

$filename = $_GET['file'];



if (!unlink('/srv/file-share/'.$_SESSION['user'].'/'.$filename)) {
	echo 'Error - Could not Delete file';
	exit;
}
else
	header("Location: home.php");
?>