<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in form</title>
</head>
<body>
	<?php
        include '../view/common/header.php';
    ?>

	<h2>Admin Log in</h2>
	<form action="../controller/loginAction.php" method="post" novalidate>
		<fieldset>
			<legend>Provide User name & Password</legend>
				<label for="uname">User Name: </label>  <br>
	          	<input type="text" id="uname" name="uname"><?php echo $_SESSION['unameErr'] ?><br>
	          	<label for="pass">Password: </label><br>
	          	<input type="password" id="pass" name="pass" minlength="8"> <?php echo $_SESSION['passErr'] ?> <br>
		</fieldset>
		<br>
		<input type="submit" value="Submit">
		<a href="../controller/forgetPass.php">Forgotten Password?</a>
		<br><br>
		<button type="submit" formaction="../view/registration.php"> Go Back to registration</button>
	</form>

	<?php
		$_SESSION['unameErr'] = $_SESSION['passErr'] = '';
        include '../view/common/footer.php';
    ?>
</body>
</html>