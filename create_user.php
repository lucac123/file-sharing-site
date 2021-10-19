<?php
/* Errors:
* ui_error	-	Invalid Username
* ue_error	-	Username Already Exists
* pi_error	-	Invalid Password
*/

session_start();

$target = isset($_GET['target'])? $_GET['target'] : '.';
$get_target = isset($_GET['target'])? '&'.$_GET['target'] : '';

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$errors = array('ui_error' => false, 'ue_error' => false, 'pi_error' => false);
$has_error = false;

if (!preg_match('/^[\w]+$/', $username)) {
	$errors['ui_error'] = true;
	$has_error = true;
}

if (!preg_match('/^[\w!*@#\$\^]+$/', $password)) {
	$errors['pi_error'] = true;
	$has_error = true;
}

$users = fopen('/srv/file-share/users.txt', 'r+');
$passwords = fopen('/srv/file-share/passwords.txt', 'a');

$user_exists = false;
while(!feof($users)) {
	if ($username == trim(fgets($users))) {
		$errors['ue_error'] = true;
		$has_error = true;
	}
}

if ($has_error) {
	fclose($users);
	fclose($passwords);

	$error_string = '';

	foreach ($errors as $name => $status) {
		if ($status)
			$error_string .= '&'.$name;
	}

	header("Location: login.php?signup".$error_string.$get_target);
}
else {
	$_SESSION['user'] = $username;

	fwrite($users, $username."\n");
	fclose($users);

	fwrite($passwords, hash('sha256', $password)."\n");
	fclose($passwords);

	mkdir("/srv/file-share/{$username}");

	header("Location: {$target}");
}
?>