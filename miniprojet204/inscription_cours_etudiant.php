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
				<option value="">Sélectionner un cours</option>
				
				<?php   // Générer les options dynamiquement en PHP 
					
					// Paramètres de la bddexion
					$servername = "localhost";  
					$username = "universite";         
					$password = "universite";             
					$dbname = "universite";     

					try {
						$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						// Requête SQL pour récupérer les code_uel et nom des cours
						$get_info = "SELECT code_uel, nom FROM cours";
						$stmt = $bdd->prepare($get_info);
						$stmt->execute();

						// Récupérer les résultats sous forme de tableau associatif
						$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

						// Vérifier si des cours ont été récupérés
						if ($courses && count($courses)) {
							
							// Afficher chaque cours dans une option
							foreach ($courses as $course) {
								echo "<option value='" . $course['code_uel'] . "'>". $course['code_uel'] . ' | ' . $course['nom'] . "</option>";
							}
						} 
						else 
						{
							echo "<option value=''>Aucun cours disponible</option>";
						}
					} 
					
					catch (PDOException $e) 
					{
						echo "Erreur : " . $e->getMessage(); // Afficher l'erreur PDO
					} 
					finally {
						// Fermer la bddexion
						$bdd = null;
					}
				?>
				
			</select>
			
			<button type="submit">S'inscrire</button>
		</form>
	</div>
</body>
</html>

<?php  
// Vérifier que l'identifiant saisi est valide (présent dans la bdd)
	
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite"; 
	
	try {
		$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e){
		die("Erreur de bddexion : " . $e->getMessage());
	}	
	
	// Vérifier le formulaire 
	if ($_POST && count($_POST) && !empty($_POST['student_id']) && !empty($_POST['cours_uel'])) {
    
		$id = $_POST['student_id']; // Récupérer l'identifiant donné
		$cours_uel = $_POST['cours_uel'];

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
?>