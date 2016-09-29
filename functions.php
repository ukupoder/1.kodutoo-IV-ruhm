<?php
	//see fail peab olema seotud kõigiga kus soovime sessooni kasutada'
	//saab kasutada nüüd $_session muutujat
	session_start();
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

	function login($email,$password)
	{
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare
		(
		"SELECT id,email,password,created FROM user_sample WHERE email = ? "
		);
		
		echo $mysqli->error;
		$stmt->bind_param("s",$email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		//see fetch on ainult SELECT'i puhul
		if($stmt->fetch())
		{
			//oli olemas, rida käes
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb)
			{
				echo "kasutaja ".$id." logis sisse";
				
				$_SESSION["userID"]= $id;
				$_SESSION["userEmail"]= $emailFromDb;
				header("Location: data.php");	
			}
			else
			{
				
				$notice = "parool vale ";
			}
		}
		else
		{
			//ei olnud ühtegi rida
			$notice = "Sellise emailiga ".$email." kasutaja ei ole olemas";
			
			
			
		}
		return $notice;
		
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