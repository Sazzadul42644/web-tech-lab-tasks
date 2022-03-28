<?php 
	session_start();
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

		$uname = $unameErr = $pass = $passErr = $arr1 = $x = '';

		if ($_SERVER["REQUEST_METHOD"] === "POST"){
            function sanitize($data){
                $data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
            }

            if(empty($_POST['uname'])){
                $unameErr = "* user name required.";
            }
            else{
                $uname = sanitize($_POST['uname']);

                $handle = fopen("../content/admin.json", "r");
            	$fr = fread($handle, filesize("../content/admin.json"));

            	$arr1 = json_decode($fr);
            	//$lastIndex = count($arr1);

            	$fc = fclose($handle);

            	for($i=0; $i<count($arr1); $i++){
            		//echo $arr1[$i]->uname . " " . $arr1[$i]->pass;
            		if($arr1[$i]->uname === $uname){
            			echo $arr1[$i]->uname . " " . $arr1[$i]->pass;
            			$x = $i;

            			//setting cookie
            			setcookie("uname",$uname,time()+60*60*7, '/');
            			$unameErr = '';
            			break;
            		}
            		else{
            			$unameErr = "* invalid user name.";
            		} 
            	}
            }

            if(empty($_POST['pass'])){
                $passErr = "* password required.";
            }
            else{
                $pass = sanitize($_POST['pass']);
                if($arr1[$x]->pass !== $pass){
                	$passErr = "* password invalid.";
                }
            }

            if ($unameErr || $passErr){
            	$_SESSION['unameErr'] = $unameErr;
                $_SESSION['passErr'] = $passErr;
                header("Location: ../view/logIn.php");
                exit();
            }
            else{
            	session_destroy();
            	echo "from else";
            	header("Location: ../view/AdminDashboard.php");
                exit();
            }
        }
	?>

</body>
</html>