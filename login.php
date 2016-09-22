<?php
	require("../../config.php");
 
	/*
	var_dump($_GET);
	echo "<br>";
	var_dump($_POST);
	*/

	
	
	
	
	$signupEmailError = "";
	$signupEmail = "";
	$gender = "female";
	if (isset($_POST["signupEmail"]))
	{
		if (empty($_POST["signupEmail"]))
		{
			$signupEmailError= "Väli on kohustuslik";	
		}	
		else
		{
			$signupEmail = $_POST["signupEmail"];
		
		}	
	}

	
	
	
	
	
	$signupPasswordError = "";

	if (isset($_POST["signupPassword"]))
	{
		if (empty($_POST["signupPassword"]))
		{
			$signupPasswordError= "Väli on kohustuslik";	
		}	
	
		elseif (strlen($_POST["signupPassword"])<8)
		{
				$signupPasswordError="Parool peab olema vähemalt 8 tähemärki pikk.";
		}
	}	
	
	
	
	
	
	
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} 
	
	if ($signupEmailError == "" &&
		$signupPasswordError == "" &&
		isset ($_POST["signupEmail"]) &&
		isset ($_POST["signupPassword"])
			
			
		)
	{
		
		echo "Salvestan...<br>";
		
		$password = hash("sha512",$_POST["signupPassword"]);
		echo $password;
		
		$database ="if16_ukupode";
		
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUE (?, ?)");
		
		
		
		$stmt->bind_param("ss",$signupEmail, $password);
		echo $mysql->error;
		
		if ($stmt->execute())
		{
			
			echo "<br>õnnestus";
			
			
		}
		else
		{
			echo "error".$stmt->error;
			
		}
		
		
		
		
	}
	
	
	
	
?>


<!DOCTYPE html>


<html>
	<head>
		<title>Sisselogiming</title>
	</head>
	<body>
	<h1> sign in </h1>
	<form method="POST">
		<input name="loginEmail" placeholder="näide@näide.ee" type="email">
		<br>
		<input name="loginPassword" placeholder="parool" type="password">
		<br>
		<input type="submit" value="Submit">
	</form>
		
		
		
		
		
	<h1> sign up </h1>
	<form method="POST">
		<input name="signupUsername" placeholder="Username" type="Username">
		<br>
		<input name="signupEmail" placeholder="näide@näide.ee" type="email" value="<?=$signupEmail;?>"><?php echo $signupEmailError; ?>
		<br>
		<input name="signupPassword" placeholder="parool" type="password"><?php echo $signupPasswordError; ?>
		<br>
		
		
		<?php if ($gender == "female") { ?>
			<input type="radio" name="gender" value="female" checked> female<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="female" > female<br>
		<?php } ?>
		
		<?php if ($gender == "male") { ?>
			<input type="radio" name="gender" value="male" checked> male<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="male" > male<br>
		<?php } ?>
		
		
		<?php if ($gender == "other") { ?>
			<input type="radio" name="gender" value="other" checked> other<br>
		<?php } else { ?>
			<input type="radio" name="gender" value="other" > other<br>
		<?php } ?>
		<br>
	
		<input type="submit" value="Create">
	</form>
		

		
			
	</body>

</html>