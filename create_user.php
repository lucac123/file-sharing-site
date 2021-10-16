<?php
session_start();

$target = isset($_GET['target'])? $_GET['target'] : '.';

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$users = fopen('/srv/file-share/users.txt', 'r+');
$passwords = fopen('/srv/file-share/passwords.txt', 'a');

$user_exists = false;
while(!feof($users)) {
	if ($username == trim(fgets($users)))
		$user_exists = true;
}

if ($user_exists) {
	fclose($users);
	fclose($passwords);
	header("Location: login.php?signup&ue_error".(($target == '.') ? '' : '&'.$target));
}
else {
	$_SESSION['user'] = $username;

	fwrite($users, $username."\n");
	fclose($users);

	fwrite($passwords, hash('sha256', $password)."\n");
	fclose($passwords);

	header("Location: {$target}");
}
?>