<?php
/* Errors:
* ui_error - Invalid Username
* pi_error - Invalid Password
* un_error	-	Username Doesn't Exist
* pn_error	-	Password Incorrect
*/

session_start();

$target = isset($_GET['target'])? $_GET['target'] : '.';
$get_target = isset($_GET['target'])? '&'.$_GET['target'] : '';

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$errors = array('ui_error' => false, 'pi_error' => false, 'un_error' => false, 'pn_error' => false);
$has_error = false;

if (!preg_match('/^[\w]+$/', $username)) {
	$errors['ui_error'] = true;
	$has_error = true;
}

if (!preg_match('/^[\w!*@#\$\^]+$/', $password)) {
	$errors['pi_error'] = true;
	$has_error = true;
}

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
	$errors['un_error'] = true;
	$has_error = true;
}
else if (hash('sha256', $password) != $pass_hash) {
	$errors['pn_error'] = true;
	$has_error = true;
}

if ($has_error) {
	$error_string = '';

	foreach ($errors as $name => $status) {
		if ($status)
			$error_string .= '&'.$name;
	}

	header("Location: login.php?".$error_string.$get_target);
}
else {
	$_SESSION['user'] = $username;
	header("Location: {$target}");
}
?>