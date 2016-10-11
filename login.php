<?php

	require("../../config.php");
	require("functions.php");
	
	
	if (isset($_SESSION["userEmail"]))
	{
		header("Location: data.php");	
	}
 
	/*
	var_dump($_GET);
	echo "<br>";
	var_dump($_POST);
	*/

	
	
	
	$signupEmail = "";
	$signupEmailError = "";
	$notice = "";
	$gender = "";
	$genderError = "";
	$loginUsername = "";
	$loginUsernameError= "";
	$loginPasswordError=
	$signupPasswordError = "";
	$signupUsernameError = "";
	
	
	if (isset($_POST["loginUsername"]))
	{
		if (empty($_POST["loginUsername"]))
		{
			$loginUsernameError= "Väli on kohustuslik";	
		}
		else
		{
			$loginUsername = $_POST["loginUsername"];
			if (isset($_POST["loginPassword"]))
			{
				if (empty($_POST["loginPassword"]))
				{
					$loginPasswordError= "Väli on kohustuslik";
					
				}
				else
				{
					
				}
			}
		}
	}
	
	
	
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
			$gender = ($_POST["gender"]);
		}
		else
		{
			
			$genderError = "Vali üks kolmest";
		}	
	
	}	
	


	
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
		$genderError == "" &&
		$signupUsernameError == "" &&
		isset ($_POST["signupEmail"]) &&
		isset ($_POST["gender"]) &&
		isset ($_POST["signupPassword"]) &&
		isset ($_POST["signupUsername"])
			
			
		)
	{
		
		echo "Salvestan...<br>";
		$password = hash("sha512",$_POST["signupPassword"]);
		//echo $password;
		signup($signupEmail, $password, $signupUsername, $gender);
	}
	

	
	if(isset($_POST["loginUsername"]) &&
	isset($_POST["loginPassword"])&& 
	!empty($_POST["loginUsername"]) &&
	!empty($_POST["loginPassword"]))
	{
		
		$notice =login($_POST["loginUsername"],$_POST["loginPassword"]);
		
	}
	
	
?>


<!DOCTYPE html>


<html>
	<head>
		<title>Sisselogiming</title>
	</head>
	<body>
	<h1> sign in </h1>
	<p style="color:red"><?php echo $notice;?></p>
	<form method="POST">
		<input name="loginUsername" placeholder="Username" type="Username" value="<?=$loginUsername;?>"><?php echo $loginUsernameError; ?>
		<br>
		<input name="loginPassword" placeholder="parool" type="password"><?php echo $loginPasswordError; ?>
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