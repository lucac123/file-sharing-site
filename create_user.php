<?php
session_start();

$sql = new stdClass();
$sql->servername = $_SERVER['sql_server'];
$sql->user = $_SERVER['sql_user'];
$sql->pass = $_SERVER['sql_pass'];
$sql->db = $_SERVER['sql_db'];

$sql->user_table = $_SERVER['sql_user_table'];

$sql->conn = new mysqli($sql->servername, $sql->user, $sql->pass, $sql->db);

if ($sql->conn->connect_error) {
	die("Connection failed: ".$sql->conn->connect_errno);
}

$file_home = $_SERVER['file_home'];

$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

$_SESSION['errno'] = 0;

// CHECK FOR USERNAME VALIDITY
if (!preg_match('/^[\w]{1,30}$/', $username)) {
	$_SESSION['errno'] |= intval($_SERVER['ERROR_USERNAME_INVALID']);
}

// CHECK FOR PASSWORD VALIDITY
if (!preg_match('/^[\w!*@#\$\^]{1,100}$/', $password)) {
	$_SESSION['errno'] |= intval($_SERVER['ERROR_PASSWORD_INVALID']);
}

// CHECK FOR USERNAME UNIQUENESS
if (!($_SESSION['errno'] & intval($_SERVER['ERROR_USERNAME_INVALID']))) {
	$all_users = $sql->conn->query("SELECT username FROM $sql->user_table");

	while ($row = $all_users->fetch_assoc()) {
		if ($username == $row['username']) {
			$_SESSION['errno'] |= intval($_SERVER['ERROR_USERNAME_TAKEN']);
		}
	}
}


if ($_SESSION['errno']) {
	header("Location: login.php?signup");
}

$_SESSION['user'] = $username;
$pass = hash('sha256', $password);
$query = "INSERT INTO $sql->user_table VALUES ('$username','$pass')";
if (!($sql->conn->query($query) === TRUE)) {
	$error = $sql->conn->error;
	die("Error: $query<br>$error");
}

mkdir("$file_home/$username");

$target = '.';
if (isset($_SESSION['target'])) {
	$target = $_SESSION['target'];
	unset($_SESSION['target']);
}

header("Location: .");

//$query = "INSERT INTO ".$sql_user_table." (username, password) VALUES ('".$username."','".$password."')";
//if ($sql_server->query($query) === TRUE) {
//}
//else {
//	echo "Error: " . $query . "<br>" . $sql_server->error;
//}


/*
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
}*/
?>