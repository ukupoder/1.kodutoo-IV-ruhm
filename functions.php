<?php
	$database = "if16_ukupode";
	
	function signup($email,$password)
	{
		$database ="if16_ukupode";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUE (?, ?)");
		$stmt->bind_param("ss",$email, $password);
		echo $mysqli->error;
		if ($stmt->execute())
		{
			echo "<br>õnnestus";	
		}
		else
		{
			echo "error".$stmt->error;
		}
	}





















/*
	function sum($x, $y)
	{
		
		return $x+$y;
		
	}
	echo sum(1231,12312);
	echo "<br>";
	
	
	
	function hello($firstname,$lastname)
	{
	return "Tere ".$firstname." ".$lastname;
	}
	echo hello("uku","poder");
*/
	
?>