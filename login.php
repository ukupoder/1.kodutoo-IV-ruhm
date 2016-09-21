<?php

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
			
			
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="female" checked>Female
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="male" checked>Male
			<input type="radio" name="gender" value="other">Other
			<input type="radio" name="gender" value="other" checked>Other
			<br>
		
			<input type="submit" value="Create">
		</form>
		

		
			
	</body>

</html>