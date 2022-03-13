<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>change password</title>
</head>
<body>

	<?php
		session_start();
		$userName = $_SESSION['currentUser'];
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
		<fieldset>
			<legend>Change Password</legend>
				<label for="uname">User Name: </label><br>
	          	<input type="text" id="uname" name="uname" value="<?php echo $userName;?>" disabled><br>
	          	<label for="pass">Current Password: </label><br>
	          	<input type="password" id="pass" name="pass" minlength="8"> <br>
	          	<label for="newPass">New Password: </label><br>
	          	<input type="password" id="newPass" name="newPass" minlength="8"> <br>
		</fieldset>
		<input type="submit" value="Submit">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] === "POST"){
			function sanitize($data){
                $data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
            }

            //$userName = sanitize($_POST['uname']);
            $pass = sanitize($_POST['pass']);
            $newPass = sanitize($_POST['newPass']);

            if (empty($pass) or empty($newPass)){
            	echo "Please fill up the form properly";
            }
            else{
            	
            	//$userName = $_SESSION['currentUser'];

            	$handle = fopen("users.json", "r");
            	$fr = fread($handle, filesize("users.json"));

            	$arr1 = json_decode($fr);
            	$lastIndex = count($arr1);

            	$fc = fclose($handle);

            	$userName = $_SESSION['currentUser'];
            	
            	for($i=0; $i<count($arr1); $i++){
            		//echo $arr1[$i]->uname . " " . $arr1[$i]->pass;
            		if($arr1[$i]->uname === $userName){
            			if($arr1[$i]->pass === $pass){
            				//session
            				echo "pass". $arr1[$i]->pass. "\n" . "new". $newPass. '\n';
            				$arr1[$i]->pass = $newPass;
            				echo "update pass". $arr1[$i]->pass. "\n" . "new". $newPass;
            				echo "password changed";
            				//header("location:welcomePage.php");
            				echo "<a href='welcomePage.php'>Welcome Page</a>";
            			}
            			else{
            				echo "current password incorrect";
            			}
            		} 
            	}
            	$newArr1 = json_encode($arr1);
            	$handle = fopen("users.json", "w");
            	fwrite($handle, $newArr1);
            	fclose($handle);
            }
		}
	?>
</body>
</html>