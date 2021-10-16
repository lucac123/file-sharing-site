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

$signup = isset($_GET['signup']);
$ue_error = isset($_GET['ue_error']);
$une_error = isset($_GET['une_error']);
$p_error = isset($_GET['p_error']);

$action = $signup ? 'create_user.php' : 'validate_user.php';
$action .= isset($_GET['target'])? '?target='.$_GET['target']:'';

$logtype = $signup ? 'Sign Up' : 'Log In';
		?>
	</nav>
	<div>
		<h2><?= $logtype ?></h2>
		<form action="<?= $action ?>" method="POST">
			<?= $ue_error ? '<p>Username already exists</p>'."\n" : ''?>
			<?= $une_error ? '<p>Username doesn\'t exist</p>'."\n" : ''?>
			<label for="uname">Username</label>
			<input type="text" id="uname" name="uname" required /><br />
			<?= $p_error ? '<p>Incorrect Password</p>'."\n" : ''?>
			<label for="pass">Password</label>
			<input type="password" id="pass" name="pass" required />
			<button type="submit"><?= $logtype ?></button>
		</form>
	</div>

</body>

</html>