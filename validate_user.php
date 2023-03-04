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

$all_users = $sql->conn->query("SELECT username,password FROM $sql->user_table");

if (!($_SESSION['errno'] & intval($_SERVER['ERROR_USERNAME_INVALID']))) {
	$pass_hash = '';
	while ($row = $all_users->fetch_assoc()) {
		if ($username == $row['username']) {
			$pass_hash = $row['password'];
		}
	}

	if ($pass_hash == '') {
		$_SESSION['errno'] |= intval($_SERVER['ERROR_USERNAME_DNE']);
	}
	else if (hash('sha256', $password) != $pass_hash) {
		$_SESSION['errno'] |= intval($_SERVER['ERROR_PASSWORD_INCORRECT']);
	}
}

if ($_SESSION['errno']) {
	echo $_SESSION['errno'];
	echo "$username $password";
	header("Location: login.php?ayo");
}
else {
	$_SESSION['user'] = $username;

	$target = '.';
	if (isset($_SESSION['target'])) {
		$target = $_SESSION['target'];
		unset($_SESSION['target']);
	}
	var_dump($_SESSION);
	header("Location: $target");
	die();
}
?>