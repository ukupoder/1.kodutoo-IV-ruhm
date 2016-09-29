<?php

	require("functions.php");
	
	if (!isset($_SESSION["userEmail"]))
	{
		
		header("Location: login.php");
		
	}
	
	if (isset($_GET["logout"]))
	{
		
		session_destroy();
		header("Location: login.php");
		
	}
	



?>
<h1>Data</h1>
<p>

	Tere Tulemast <?=$_SESSION["userEmail"];?>!
	<a href="?logout"><br>logi välja</a>
</p>