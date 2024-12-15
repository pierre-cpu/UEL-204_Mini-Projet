<?php
	session_start();

$_SESSION['statut'] = 'administrateur';
	
	// Vérifiez si une session est active et si l'utilisateur est bien un administrateur.
	if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'administrateur') {
		// Afficher un message avant redirection
		echo '<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Redirection</title>
			<script>
				// Redirection automatique après 4 secondes
				setTimeout(() => {
					window.location.href = "page_connexion.php";
				}, 4000);
			</script>
		</head>
		<body>
			<h1>Accès refusé</h1>
			<p>Vous n\'avez pas les droits nécessaires pour accéder à cette page.</p>
			<p>Vous serez redirigé vers la page de connection dans quelques secondes...</p>
		</body>
		</html>';
		exit(); // Arrête l'exécution du script
	}
	
	// Paramètres de connexion
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite";
	
	$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$message = ""; // Initialement vide
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours - Université</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <h1>Gérer les Cours</h1>
			
			 <!-- Affichage des messages -->
            <?php if (!empty($message)): ?>
                <p style="color: <?= strpos($message, 'succès') !== false ? 'green' : 'red'; ?>;">
                    <?= $message; ?> 
                </p>
            <?php endif; ?>
			
            <!-- Liste déroulante des cours -->
            <form action="" method="post">
			    <h2>Supression de Cours</h2>
                <label for="courseSelect"></label>
        			
				<select id="cours" name="cours" required>
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
				
                <button type="submit" name="delete">Supprimer le cours</button>
            </form>
		</div>
<br><hr><br>		
		<div class="form-container">
			<form action="" method="POST">
				<h2>Ajout de cours</h2>

				<label for="code_uel">Code uel du cours</label>
				<input type="text" id="code_uel" name="code_uel" required>

				<label for="nom">Nom du cours</label>
				<input type="text" id="nom" name="nom" required>

				<label for="credits">Nombre de crédits associés</label>
				<input type="credits" id="credits" name="credits" required>

				<button type="submit" name="add">Ajouter le cours</button>
			</form>
		</div>
    </div>
</body>
</html>

<?php  // Ajout d'un nouveau cours
//Vérifier que le bouton ajouter a été cliqué
if (isset($_POST['add'])) {
	if ($_POST && count($_POST)
			&& array_key_exists('code_uel', $_POST) && array_key_exists('nom', $_POST) && array_key_exists('credits', $_POST)
			&& !empty($_POST['code_uel']) && !empty($_POST['nom']) && !empty($_POST['credits'])) {
		
		$code_uel = filter_var($_POST['code_uel'], FILTER_VALIDATE_INT);
		if ($code_uel === false) {
			$message = "Erreur : code_uel doit être un entier valide.";
		} 
		else {
			$credits = filter_var($_POST['credits'], FILTER_VALIDATE_INT);
			if ($credits === false) {
				$message = "Erreur : le nombre de crédits doit être un entier valide.";
			} 
			else {
				$nom = trim($_POST['nom']);  // Supprime les espaces au début et la fin de la chaîne
				if (strlen($nom) > 255) {
					$message = "Erreur : le nom du cours est trop long.";
				} 
				else {
					// Requête d'insertion du cours dans la table
					try {
						$sql = "INSERT INTO cours (code_uel, nom, credits) VALUES (:code_uel, :nom, :credits)";
						$stmt = $bdd->prepare($sql);
						$stmt->bindParam(':code_uel', $code_uel);
						$stmt->bindParam(':nom', $nom);
						$stmt->bindParam(':credits', $credits);
						$stmt->execute();

						echo "<p style='color: green;'>Cours ajouté avec succès !</p>";
					} 
					catch (PDOException $e) {
						echo "<p style='color: red;'>Erreur lors de l'ajout du cours : " . $e->getMessage() . "</p>";
					} 
				}
			}
		}
	}
	else {
		$message = "Veuillez remplir tous les champs du formulaire.";
	}
}
	
	
			// Suppression d'un cours
if (isset($_POST['delete'])) {
	if (!empty($_POST['cours'])) {
    
		$code_uel = filter_var($_POST['cours'], FILTER_VALIDATE_INT);
		    
		if ($code_uel === false) {
			$message = "Erreur : le code du cours sélectionné est invalide.";
		}
		else {
			try {
				$sql = "DELETE FROM cours WHERE code_uel = :code_uel_delete";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':code_uel_delete', $code_uel_delete, PDO::PARAM_INT);
				$stmt->execute();

				if ($stmt->rowCount() > 0) {
					$message = "Cours supprimé avec succès !";
				} else {
					$message = "Aucun cours trouvé avec ce code.";
				}
			} 
			catch (PDOException $e) {
				$message = "Erreur lors de la suppression du cours : " . $e->getMessage();
			}
		}
	}
	else {
		$message = "Veuillez sélectionner un cours à supprimer.";
	}
}
?>