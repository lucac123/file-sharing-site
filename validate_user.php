<?php
session_start();

$target = isset($_GET['target'])? $_GET['target'] : '.';

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$users = fopen('/srv/file-share/users.txt', 'r');
$passwords = fopen('/srv/file-share/passwords.txt', 'r');

$pass_hash = '';
while (!feof($users) && !feof($passwords)) {
	if ($username == trim(fgets($users))) {
		$pass_hash = trim(fgets($passwords));
		break;
	}
	fgets($passwords);
}

fclose($users);
fclose($passwords);

if ($pass_hash == '') {
	header("Location: login.php?une_error".(($target == '.') ? '' : '&'.$target));
}
else if (hash('sha256', $password) != $pass_hash) {
	header("Location: login.php?p_error" . (($target == '.') ? '' : '&'.$target));
}
else {
	$_SESSION['user'] = $username;
	header("Location: {$target}");
}
?>