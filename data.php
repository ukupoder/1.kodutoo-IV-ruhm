<?php
	require("../../config.php");
	require("functions.php");
	
	if (!isset($_SESSION["userUsername"]))
	{
		
		//header("Location: login.php");
		
	}
	
	if (isset($_GET["logout"]))
	{
		
		session_destroy();
		header("Location: login.php");
	}
	
	
	
	$color = "";
	$age = "";
	$colorError = "";
	$ageError = "";
	
	
	if (isset($_POST["color"]))
	{
		if (empty($_POST["color"]))
		{
			$colorError= "Väli on kohustuslik";	
		}	
		else
		{
			$color = $_POST["color"];
		
		}	
	}
	if (isset($_POST["age"]))
	{
		if (empty($_POST["age"]))
		{
			$ageError= "Väli on kohustuslik";	
		}	
		else
		{
			$age = $_POST["age"];
		
		}	
	}
	
	
	
	
if (
		isset($_POST["age"]) &&
		isset($_POST["color"]) &&
		!empty($_POST["age"]) &&
		!empty($_POST["color"])
	) 
	{
		saveEvent($_POST["age"], $_POST["color"]);
	}

	
	$people = getAllPeople();
	echo "<pre>";
	var_dump($people);
	echo "</pre>";
	
	

?>
<h1>Data</h1>
<p>

	Tere Tulemast <?=$_SESSION["userUsername"];?>!
	<a href="?logout"><br>logi välja</a>
</p>

<html>
	<head>
		<title>Logged in</title>
	</head>
	<body>
	<h1> Värv/vanus </h1>
	<form method="POST">
		<input name="color" placeholder="Värv" type="color"><?php echo $colorError; ?>
		<br>
		<input name="age" placeholder="Age" type="age"><?php echo $ageError; ?>
		<br>
		<input type="submit" value="Submit">
	</form>
	
	<h2>arhiiv</h2>
	
<?php

	$html = "<table>";
		$html .= "<tr>";
			$html .= "<th>ID</th>";
			$html .= "<th>Vanus</th>";
			$html .= "<th>Värv</th>";
		$html .= "</tr>";
		
		foreach($people as $p)
		{
			$html .= "<tr>";
				$html .= "<td>".$p->id."</td>";
				$html .= "<td>".$p->age."</td>";
				$html .= "<td>".$p->color."</td>";
			$html .= "</tr>";
			
			$style =" 
			
				background-color:".$p->color.";
				width: 40px;
				height: 40px;
				border-radius: 20px;
				text-align: center;
				line-height: 39px;
				float: left;
				margin: 20px;
			";
				
			echo "<p style='".$style."' >".$p->age."</p>";
		}
		
	$html .= "</table>";
	echo $html;


?>
	
	
	
	
	
	
	</body>
</html>