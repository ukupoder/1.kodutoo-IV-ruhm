<?php
	require("../../config.php");
	//see fail peab olema seotud kõigiga kus soovime sessooni kasutada'
	//saab kasutada nüüd $_session muutujat
	session_start();
	$database = "if16_ukupode";
	
	function signup($email,$password,$username,$gender)
	{
		$database ="if16_ukupode";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, username, gender) VALUES (?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssss", $email, $password, $username, $gender);
	
		if ($stmt->execute())
		{
			echo "<br>õnnestus";	
		}
		else
		{
			echo "error".$stmt->error;
		}
	}

	function login($username,$password)
	{
		
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare
		(
		"SELECT id,email,password,username,gender,created FROM user_sample WHERE username = ? "
		);
		
		echo $mysqli->error;
		$stmt->bind_param("s",$username);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $username, $gender, $created);
		$stmt->execute();
		echo $mysqli->error;
		//see fetch on ainult SELECT'i puhul
		if($stmt->fetch())
		{
			//oli olemas, rida käes
			$hash = hash("sha512", $password);
			
			if ($hash == $passwordFromDb)
			{
				echo "kasutaja ".$id." logis sisse";
				
				$_SESSION["userID"]= $id;
				$_SESSION["userUsername"]= $usernameFromDb;
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
			$notice = "Sellise kasutajanimega ".$username." kasutaja ei ole olemas";
			
			
			
		}
		return $notice;
		
	}

	function colorpicker ($color, $age)
	{
		{
		$database ="if16_ukupode";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO color_age (color, age) VALUES (?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("si", $color, $age);
	
		if ($stmt->execute())
		{
			echo "<br>õnnestus";	
		}
		else
		{
			echo "error".$stmt->error;
		}
	}
		
		
	}
	
	function saveEvent($age, $color) {
		
		$database = "if16_ukupode";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO whistle (age, color) values (?, ?)");
		
		echo $mysqli->error;
		// s -string
		// i - int
		// d- double
		//
		$stmt->bind_param("is", $age, $color);
		
		
		if ($stmt->execute()) {
			//echo "sobib";
		} else {
			
			echo "ei sobi";//.$stmt->error;
		}
	}
	
	function getAllPeople()
	{
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare
		("
			SELECT id,age,color
			FROM whistle
		");
		$stmt->bind_result($id, $age, $color);
		$stmt->execute();
		$results = array();
		
		while ($stmt->fetch())
		{
			echo $color."<br>";
			
			$human= new StdClass();
			$human->id = $id;
			$human->age = $age;
			$human->color = $color;
			
			
			
			array_push($results, $human);
		
		}
		return $results;
	}
	
	
	
/*

+----------+--------------+------+-----+-------------------+----------------+
| Field    | Type         | Null | Key | Default           | Extra          |
+----------+--------------+------+-----+-------------------+----------------+
| id       | int(11)      | NO   | PRI | NULL              | auto_increment |
| email    | varchar(255) | NO   | UNI | NULL              |                |
| password | varchar(128) | NO   |     | NULL              |                |
| created  | timestamp    | NO   |     | CURRENT_TIMESTAMP |                |
+----------+--------------+------+-----+-------------------+----------------+
4 rows in set (0.00 sec)
*/

/*
CREATE TABLE color_age
(
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
color varchar(15),
age INT(3),
created TIMESTAMP
);

mail, $password, $username, $gender

*/

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