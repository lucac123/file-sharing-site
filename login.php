<!DOCTYPE html>
<html>

<head>
	<title>FileShare | Login</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="fileshare.css" />
</head>

<body>
	<header>
		<h1><span>FileShare</span> - Free Online File-Hosting Service</h1>
	</header>
	<nav>
		<a href=".">Home</a>
		<a href="files.php">Files</a>
		<?php
session_start();
if (isset($_SESSION['user']))
	header("Location: .");
else {
	echo '<a href="login.php?signup">Sign Up</a>'."\n\t\t";
	echo '<a href="login.php">Log In</a>'."\n";
}

/* Errors:
* ui_error	-	Invalid Username
* ue_error	-	Username Already Exists
* un_error	-	Username Doesn't Exist
* pi_error	-	Invalid Password
* pn_error	-	Password Incorrect
*/

$signup = isset($_GET['signup']);

$ui_error = isset($_GET['ui_error']);
$ue_error = isset($_GET['ue_error']);
$un_error = isset($_GET['un_error']);
$pi_error = isset($_GET['pi_error']);
$pn_error = isset($_GET['pn_error']);

$action = $signup ? 'create_user.php' : 'validate_user.php';

if (isset($_GET['target']))
	$action .= '?target='.$_GET['target'];

$logtype = $signup ? 'Sign Up' : 'Log In';
		?>
	</nav>
	<div>
		<h2><?= $logtype ?></h2>
		<form action="<?= $action ?>" method="POST">
			<?= $ui_error ? "<p>Username invalid. Only use letters and numbers</p>\n" : ''?>
			<?= $ue_error ? "<p>Username taken. Please choose another</p>\n" : ''?>
			<?= $un_error ? "<p>Username not found</p>\n" : ''?>
			<label for="uname">Username</label>
			<input type="text" id="uname" name="uname" required /><br />
			<?= $pi_error ? "<p>Invalid Password. Only use letters, numbers, and symbols *, @, #, $, ^</p>\n" : ''?>
			<?= $pn_error ? "<p>Incorrect Password</p>\n" : ''?>
			<label for="pass">Password</label>
			<input type="password" id="pass" name="pass" required />
			<button type="submit"><?= $logtype ?></button>
		</form>
	</div>

</body>

</html>