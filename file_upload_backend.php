<?php
session_start();

$filename = basename($_FILES['upfile']['name']);

$username = $_SESSION['user'];

move_uploaded_file($_FILES['upfile']['tmp_name'], "/srv/file-share/{$username}/{$filename}");

header("Location: home.php");
?>