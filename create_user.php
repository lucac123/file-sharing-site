<?php
session_start();

$target = isset($_GET['target'])? $_GET['target'] : '.';

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$users = fopen('/srv/file-share/users.txt', 'a+');
$passwords = fopen('/srv/file-share/passwords.txt', 'a');

while(!feof($users)) {
	if ($username == trim(fgets($users)))
		header("Location: login.php?signup&error".(($target == '.')?:$target);
}

fwrite($users, $username."\n");
fclose($users);

fwrite($passwords, hash('sha256', $password)."\n");
fclose($passwords);

$_SESSION['user'] = $username;

header("Location: {$target}");

?>