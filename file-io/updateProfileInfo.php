<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update info</title>
</head>
<body>
	<?php 
		session_start();
		$userName = $_SESSION['currentUser'];

		$handle = fopen("users.json", "r");
        $fr = fread($handle, filesize("users.json"));

        $arr1 = json_decode($fr);

        $fc = fclose($handle);

        echo "<br><br>";

        for($i=0; $i<count($arr1); $i++){
            echo "<br><br>";
            //echo $arr1[$i]->uname . " " . $arr1[$i]->pass;
            if($arr1[$i]->uname === $userName){
            	$firstName = $arr1[$i]->firstName;
				$lastName = $arr1[$i]->lastName;
				$dob = $arr1[$i]->dob;
				$presentAddr = $arr1[$i]->presentAddr;
				$premanentAddr = $arr1[$i]->premanentAddr;
				$phone = $arr1[$i]->phone;
				$email = $arr1[$i]->email;
				$website = $arr1[$i]->website;
            } 
        }
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
        <fieldset>
          <legend>Basic Information:</legend>
          	<label for="uname">User Name: </label><br>
          	<input type="text" id="uname" name="uname" value="<?php echo $userName;?>" disabled><br>
            <label for="fname">First Name: </label><br>
            <input type="text" id="fname" name="fname" value="<?php echo $firstName;?>"><br>
            <label for="lname">Last Name:  </label><br>
            <input type="text" id="lname" name="lname" value="<?php echo $lastName;?>"><br>
            <label for="birthday">Date of Birth: </label>
            <input type="date" id="birthday" name="birthday" value="<?php echo $dob;?>"><br><br>          
        </fieldset>
        <br>
        <fieldset>
          <legend>Contact Information:</legend>
          <label for="present-address">Present Address: </label><br>
          <textarea name="present-address" id="present-address" cols="30" rows="4" value="<?php echo $presentAddr;?>"></textarea><br>
          <label for="premanent-address">Premanent Address:</label><br>
          <textarea name="premanent-address" id="premanent-address" cols="30" rows="4" value="<?php echo $premanentAddr;?>"></textarea><br>
          <label for="phone">phone:</label><br>
          <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?php echo $phone;?>"> <br>
          <label for="email">Email: </label><br>
          <input type="email" id="email" name="email" value="<?php echo $email;?>"><br>
          <label for="personal-website">Personal Website Link:</label><br>
          <input type="url" id="personal-website" name="personal-website" value="<?php echo $website;?>"><br>
        </fieldset>
        <br>
        <input type="submit" value="Submit">
      </form>

      <?php

      	$firstName2 = $lastName2 = $dob2 = $presentAddr2 = $premanentAddr2 = $phone2 = $email2 = $website2 = '';

      	if ($_SERVER["REQUEST_METHOD"] === "POST"){
            function sanitize($data){
                $data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
            }

            $firstName2 = sanitize($_POST['fname']);
			$lastName2 = sanitize($_POST['lname']);
            $dob2 = sanitize($_POST['birthday']);
            $presentAddr2 = sanitize($_POST['present-address']);
            $premanentAddr2 = sanitize($_POST['premanent-address']);
            $phone2 = sanitize($_POST['phone']);       
            $email2 = sanitize($_POST['email']);
            $website2 = sanitize($_POST['personal-website']);
        }
        if(empty($firstName2) or empty($lastName2) or empty($phone2) or empty($dob2) or empty($presentAddr2) or empty($premanentAddr2) or empty($email2) or empty($website2)){
                echo "please fill up all field.";
            }

        else{
        	for($i=0; $i<count($arr1); $i++){
            echo "<br><br>";
            //echo $arr1[$i]->uname . " " . $arr1[$i]->pass;
            if($arr1[$i]->uname === $userName){
            	$arr1[$i]->firstName = $firstName2;
				$arr1[$i]->lastName = $lastName2;
				$arr1[$i]->dob = $dob;
				$arr1[$i]->presentAddr = $presentAddr2;
				$arr1[$i]->premanentAddr = $premanentAddr2;
				$arr1[$i]->phone = $phone2;
				$arr1[$i]->email = $email2;
				$arr1[$i]->website = $website2;
				echo "update success!";
            } 
        }

      	$newArr1 = json_encode($arr1);
      	$handle = fopen("users.json", "w");
       	fwrite($handle, $newArr1);
        fclose($handle);
        echo "<a href='welcomePage.php'>go back to Welcome Page</a>";
        }
      	
      ?>
</body>
</html>