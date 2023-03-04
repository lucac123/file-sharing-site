<?php
session_start();

if (!isset($_GET['file']) || !isset($_SESSION['user'])) {
	echo 'Error - user or file not set';
	exit;
}

$filename = $_GET['file'];
$file_home = $_SERVER['file_home'];
$username = $_SESSION['user'];


if (!unlink("$file_home/$username/$filename")) {
	echo 'Error - Could not Delete file';
	exit;
}
else
	header("Location: home.php");
?>