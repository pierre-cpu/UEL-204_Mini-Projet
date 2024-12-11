<?php
	$serveur  = "localhost:3306";
	$database = "universite";
	$user     = "universite";
	$password = "universite";
	

	try
	{	
		
		$bdd=new PDO('mysql:host='.$serveur.';charset=utf8;dbname='.$database.'',$user,$password);
		
		
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e)
	{
		die('<strong>Erreur d�tect�e !!! </strong> : ' . $e->getMessage());
	}
?>