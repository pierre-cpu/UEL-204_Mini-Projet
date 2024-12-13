<!-- results.html -->
<?php session_start(); 
$_SESSION['utilisateur'] = 'bernard3';
	// Paramètres de connexion
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite";
	
	// Connexion à la bdd
	$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Requête SQL pour récupérer le numero_etudiant de l'etudiant connecté
	$get_info = $bdd->prepare ("SELECT numero_etudiant FROM etudiants WHERE identifiant = :identifiant");
	$get_info->bindParam(':identifiant', $_SESSION['utilisateur'], PDO::PARAM_STR);
	$get_info->execute();
	
	$etudiant = $get_info->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulter les notes</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<h2>Consulter mes Notes</h2>

		<form action="" method="post">
			<label for="code_uel">Choisissez un cours :</label>
			<select id="code_uel" name="code_uel" required>
				<option value="">-- Sélectionnez un cours --</option>
				
			<?php   // Générer les options dynamiquement en PHP 
					
				try {
					// Requête SQL pour récupérer le numero_etudiant de l'etudiant connecté
					$get_info = $bdd->prepare ("SELECT numero_etudiant FROM etudiants WHERE identifiant = :identifiant");
					$get_info->bindParam(':identifiant', $_SESSION['utilisateur'], PDO::PARAM_STR);
					$get_info->execute();
					
					$etudiant = $get_info->fetch(PDO::FETCH_ASSOC);
					
					// Requête SQL pour récupérer les code_uel des cours
					$get_uel = $bdd->prepare ("SELECT code_uel FROM inscriptions WHERE numero_etudiant = :identifiant");
					$get_uel->bindParam(':identifiant', $etudiant['numero_etudiant'], PDO::PARAM_STR);
					$get_uel->execute();
					
					// Requête SQL pour récupérer les cours par code_uel
					while ($courses = $get_uel->fetch(PDO::FETCH_ASSOC)) {
						
						$get_cours = $bdd->prepare ("SELECT code_uel, nom FROM cours WHERE code_uel = :code_uel");
						$get_cours->bindParam(':code_uel', $courses['code_uel'], PDO::PARAM_STR);
						$get_cours->execute();
						
						$cours = $get_cours->fetch(PDO::FETCH_ASSOC);
					
						$code_uel = htmlspecialchars($cours['code_uel'], ENT_QUOTES, 'UTF-8');
						$nom = htmlspecialchars($cours['nom'], ENT_QUOTES, 'UTF-8');
						
						echo "<option value='$code_uel'>$code_uel | $nom</option>";
					} 
				} 
				
				catch (PDOException $e) 
				{
					echo "Erreur : " . $e->getMessage(); // Afficher l'erreur PDO
				}
			?>
			</select>
			<button type="submit">Voir les notes</button>
		</form>
	</div>
</body>
</html>

<?php 
	// Afficher les Notes correspondant au cours seleccionné
	if($_POST && count($_POST)
			&& array_key_exists('cours_uel', $_POST)
			&& !empty($_POST['cours_uel'])) {
		$code_uel = $_POST['cours_uel'];
		
		try {
			// Requête sql pour récupérer les évalutions du cours sélectionné
			$get_evals = $bdd->prepare ("SELECT type, intitule, coeficient, date FROM evaluations WHERE code_uel = :code_uel");
			$get_evals->bindParam(':code_uel', $code_uel, PDO::PARAM_STR);
			$get_evals->execute();
			
			$evals = $get_evals->fetch(PDO::FETCH_ASSOC);
			var_dump($evals);
			// Requête sql pour récupérer les notes des évaluations de l'étudiant connecté
		}
		catch (PDOException $e)
		{
			echo "Erreur : " . $e->getMessage(); // Afficher l'erreur PDO
		}
	}
	else 
	{
		echo "Aucune donnée transmise : "; // Afficher l'erreur PDO
	}
	// Fermer la bddexion
	$bdd = null;
?>