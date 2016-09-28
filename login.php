<?php

	require("../../config.php");
	require("functions.php");
 
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

	
	
	
	$gender = "";
	$genderError = "";
	
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
		
		if (isset($_POST["gender"]))
		{
			
		}
		else
		{
			
			$genderError = "Vali üks kolmest";
		}	
	
	}	
	
	
	$signupUsernameError = "";
	
	if (isset($_POST["signupUsername"]))
	{
			if (empty($_POST["signupUsername"]))
			{
				$signupUsernameError= "Väli on kohustuslik";	
			}	
			else
			{
				$signupUsername = $_POST["signupUsername"];
			
			}	
	}	
	

	if ($signupEmailError == "" &&
		$signupPasswordError == "" &&
		$signupUsernameError == "" &&
		isset ($_POST["signupEmail"]) &&
		isset ($_POST["signupPassword"]) &&
		isset ($_POST["signupUsername"])
			
			
		)
	{
		
		echo "Salvestan...<br>";
		$password = hash("sha512",$_POST["signupPassword"]);
		//echo $password;
		signup($signupEmail, $password);
	}
	
	if(isset($_POST["loginEmail"]) && 
	isset($_POST["loginPassword"]) &&
	!empty($_POST["loginEmail"]) && 
	!empty($_POST["loginPassword"]))
	{
		
		login($_POST["loginEmail"], $_POST["loginPassword"]);
		
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
		<input name="signupUsername" placeholder="Username" type="Username"><?php echo $signupUsernameError; ?>
		<br>
		<input name="signupEmail" placeholder="näide@näide.ee" type="email" value="<?=$signupEmail;?>"><?php echo $signupEmailError; ?>
		<br>
		<input name="signupPassword" placeholder="parool(vähemalt 8 pikk)" type="password"><?php echo $signupPasswordError; ?>
		<br>
		
		
		<?php if ($gender == "female") { ?>
			<input type="radio" name="gender" value="female"> female <?=$genderError;?><br>
		<?php } else { ?>
			<input type="radio" name="gender" value="female" > female <?=$genderError;?><br>
		<?php } ?>
		
		<?php if ($gender == "male") { ?>
			<input type="radio" name="gender" value="male"> male <?=$genderError;?><br>
		<?php } else { ?>
			<input type="radio" name="gender" value="male" > male <?=$genderError;?><br>
		<?php } ?>
		
		
		<?php if ($gender == "other") { ?>
			<input type="radio" name="gender" value="other"> other <?=$genderError;?><br>
		<?php } else { ?>
			<input type="radio" name="gender" value="other"> other <?=$genderError;?><br>
		<?php } ?>
		<br>
	
		<input type="submit" value="Create">
	</form>
		

		
			
	</body>

</html>