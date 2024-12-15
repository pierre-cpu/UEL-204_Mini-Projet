<?php
	session_start();
	// Paramètres de connexion
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite";
	
	$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bddexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
	<div class="container">
		<form action="" method="post">
			<h2>Inscription à un cours</h2>
			<label for="student_id">Identifiant :</label>
			<input type="text" id="student_id" name="student_id" required>
			
			<label for="cours_uel">Cours :</label>
			<select id="cours_uel" name="cours_uel" required>
				<option value="">-- Sélectionner un cours --</option>
				
				<?php   // Générer les options dynamiquement en PHP 
					
					try {						
						// Requête SQL pour récupérer les code_uel et nom des cours
						$get_info = "SELECT code_uel, nom FROM cours";
						$stmt = $bdd->prepare($get_info);
						$stmt->execute();

						// Récupérer les résultats sous forme de tableau associatif
						while ($course = $stmt->fetch(PDO::FETCH_ASSOC)) {
							// Utiliser htmlspecialchars pour empêcher les injections XSS
							$code_uel = htmlspecialchars($course['code_uel'], ENT_QUOTES, 'UTF-8');
							$nom = htmlspecialchars($course['nom'], ENT_QUOTES, 'UTF-8');
							
							echo "<option value='$code_uel'>$code_uel | $nom</option>";
						} 
					} 
					catch (PDOException $e) 
					{
						echo "Erreur de chargement des cours: " . $e->getMessage(); // Afficher l'erreur PDO
					} 
				?>
				
			</select>
			
			<button type="submit">S'inscrire</button>
		</form>
		<div class="role-section">
                <a href="deconnexion-session.php">  Pour vous déconneter, cliquez ici.</a>
                        </div>
	</div>
</body>
</html>

<?php  
	// Vérifier l'envoi du formulaire 
	if ($_POST && count($_POST)
			&& array_key_exists('student_id', $_POST) && array_key_exists('cours_uel', $_POST)
			&& !empty($_POST['student_id']) && !empty($_POST['cours_uel'])) {
    
		$id = $_POST['student_id']; // Récupérer l'identifiant donné
		$cours_uel = $_POST['cours_uel'];
		global $bdd;
		// Vérifier que l'identifiant existe dans la table etudiants

		$check_id = $bdd->prepare('SELECT numero_etudiant FROM etudiants WHERE identifiant = :identifiant');
		$check_id->bindParam(':identifiant', $id, PDO::PARAM_STR);
		$check_id->execute(); // Récupérer dans la table les champs où l'identifiant correspond.
		$etudiant = $check_id->fetch(PDO::FETCH_ASSOC); // Rendre ces données accessibles
		// condition où des données aec ce nom existent
		if ($etudiant) {
			echo "<p style='color:green;'>Identifiant valide.</p>";
			
			// Récupérer le `numero_etudiant` et la date actuelle
			$numero_etudiant = $etudiant['numero_etudiant'];
			$date_inscription = date('Y-m-d H:i:s');
			
			// Ajout d'une inscription dans la table Inscriptions
			$new_inscription = $bdd->prepare('INSERT INTO inscriptions (code_uel, numero_etudiant, date) VALUES (:code_uel, :numero_etudiant, :date)');
			$new_inscription->bindParam(':numero_etudiant', $numero_etudiant, PDO::PARAM_STR);
			$new_inscription->bindParam(':code_uel', $cours_uel, PDO::PARAM_STR);
			$new_inscription->bindParam(':date', $date_inscription, PDO::PARAM_STR);
			
			if ($new_inscription->execute()) {
				echo "<p style='color:green;'>Inscription réussie !</p>";
			}
			else {
				echo "<p style='color:red;'>Une erreur est survenue lors de l'inscription.</p>";
			}
		}
		else {
			echo "<p style='color:red;'>Identifiant incorect. Veuillez vérifier votre identifiant.</p>";
		}
	}
	else {
		echo 'ERREUR';
	}

	
	// Fermeture de la connexion
	$bdd = null;
?>