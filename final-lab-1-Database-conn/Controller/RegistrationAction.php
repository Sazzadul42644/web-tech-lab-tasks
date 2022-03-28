<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration PHP</title>
</head>
<body>
    <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST"){

            $firstName = $firstNameErr = $gender = $genderErr = $addr = $phone = $email = $emailErr = $uname = $unameErr = $pass = $passErr = $cpass = $cpassErr = "";


            function sanitize($data){
                $data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
            }

            if(empty($_POST['fname'])){
                $firstNameErr = "* Full Name is required.";
            }
            else{
                $firstName = sanitize($_POST['fname']);
                if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
                    $firstNameErr = "Only letters and white space allowed";
                }
            }

            if(empty($_POST['gender'])){
                $genderErr = "* gender required.";
            }
            else{
                $gender = ($_POST['gender']);
            }

            
            $phone = sanitize($_POST['phone']);
          
            if (empty($_POST["email"])) {
                $emailErr = "* Email is required";
            } 
            else {
                $email = sanitize($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
                }
            }

            if(empty($_POST['uname'])){
                $unameErr = "* User name required.";
            }
            else{
                $uname = sanitize($_POST['uname']);
            }

            if(empty($_POST['pass'])){
                $passErr = "* password required.";
            }
            else{
                $pass = sanitize($_POST['pass']);
                if(strlen($pass) < 4){
                $passErr = "password should 4 characters minimum";
                }  
            } 

            if(empty($_POST['cpass'])){
                $cpassErr = "*confirm password required.";
            }
            else{
                $cpass = sanitize($_POST['cpass']);
                if($pass !== $cpass){
                    $cpassErr = "*confirm password doesn't match.";
                }
            }

            if($firstNameErr || $genderErr || $emailErr || $unameErr || $passErr || $cpassErr){
                $_SESSION['firstNameErr'] = $firstNameErr;
                $_SESSION['genderErr'] = $genderErr;
                $_SESSION['emailErr'] = $emailErr;
                $_SESSION['unameErr'] = $unameErr;
                $_SESSION['passErr'] = $passErr;
                $_SESSION['cpassErr'] = $cpassErr;

                header("Location: ../view/registration.php");
                exit(); 
            }

            else{

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "lab_database_conn";

                //creating conn
                $conn = new mysqli($servername, $username, $password, $dbname);

                //check conn
                if($conn->connect_error){
                    die("connecion error".$conn->connect_error);
                }
                else{
                    echo "conn success";
                }


                $sql = "INSERT INTO users (fullName, gender, uname, pass) VALUES ('$firstName', '$gender', '$uname', '$pass')";

                if($conn->query($sql)===TRUE){
                    echo "New record created successfully";
                }
                else{
                    echo "Error: ".$sql."<br>". $conn->error;
                }

                //close conn
                $conn->close();


                echo "Registration successful";

                session_destroy();   
            }
        }
        else{
            echo "can not process get request";
        }
    ?>
    

    

    <br><br>
    <form style="text-align: center">   
        <button type="submit" formaction="../view/registration.php"> Go Back </button>
        <br><br>
        <button type="submit" formaction="../view/logIn.php"> Log in </button>
    </form>
    
</body>
</html>