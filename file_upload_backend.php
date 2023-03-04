<?php
session_start();

$filename = basename($_FILES['upfile']['name']);

$file_home = $_SERVER['file_home'];

$username = $_SESSION['user'];

move_uploaded_file($_FILES['upfile']['tmp_name'], "$file_home/$username/$filename");

header("Location: home.php");
?>