<?php

session_start(); 
echo "Vous êtes déconnecté.";

		session_destroy();
		unset($_SESSION);
		exit;
	
?>
