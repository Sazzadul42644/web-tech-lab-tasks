<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration PHP</title>
</head>
<body>
    <h2>PHP validation page</h1>

    <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            function sanitize($data){
                $data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
            }
            //mkifjvoifsasjm;fj
            $firstName = sanitize($_POST['fname']);
			$lastName = sanitize($_POST['lname']);
            $gender = sanitize($_POST['gender']);
            $dob = sanitize($_POST['birthday']);
            $religion = sanitize($_POST['religion']);
            $presentAddr = sanitize($_POST['present-address']);
            $email = sanitize($_POST['email']);
            $userName = sanitize($_POST['uname']);
            $pass = sanitize($_POST['pass']);
            $cpass = sanitize($_POST['cpass']);

            if(strlen($pass) > 6){
                echo "password should max 5 characters";
            }
            else{
                if($pass == $cpass){
                    if(empty($firstName) or empty($lastName) or empty($gender) or empty($dob) or empty($religion) or empty($presentAddr) or empty($email) or empty($userName) or empty($pass) or empty($cpass) ){
                        echo "please fill up all requires field.";
                    }
                    else{
                        echo "Oparation successful";
                    }
                }
            }
        }
        else{
            echo "can not process get request";
        }
    ?>
    

    <?php
        
    ?>

    <br><br>
    <a href="registration.html">Go Back</a>
</body>
</html>