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
    <title>Gestion des Professeurs - Université</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <h1>Gérer les Professeurs</h1>
			
			 <!-- Affichage des messages -->
            <?php if (!empty($message)): ?>
                <p style="color: <?= strpos($message, 'succès') !== false ? 'green' : 'red'; ?>;">
                    <?= $message; ?> 
                </p>
            <?php endif; ?>
			
            <!-- Liste déroulante des professeurs -->
            <form action="" method="post">
			    <h2>Supression d'un Professeur</h2>
                <label for="professeurSelect"></label>
        			
				<select id="professeur" name="professeur" required>
					<option value="">-- Sélectionner un professeur --</option>
					
					<?php   // Générer les options dynamiquement en PHP 
						
						try {						
							// Requête SQL pour récupérer les identifiants, noms et prénoms des professeurs
							$get_info = "SELECT nom, prenom FROM professeurs";
							$stmt = $bdd->prepare($get_info);
							$stmt->execute();

							// Récupérer les résultats sous forme de tableau associatif
							while ($professeur = $stmt->fetch(PDO::FETCH_ASSOC)) {
								// Utiliser htmlspecialchars pour empêcher les injections XSS
								$nom = htmlspecialchars($professeur['nom'], ENT_QUOTES, 'UTF-8');
								$prenom = htmlspecialchars($professeur['prenom'], ENT_QUOTES, 'UTF-8');
								
								echo "<option value='professeur'>$nom | $prenom</option>";
							}							
						} 
						catch (PDOException $e) 
						{
							echo "Erreur de chargement des professeur: " . $e->getMessage(); // Afficher l'erreur PDO
						} 
					?>
				</select>
				
                <button type="submit" name="delete">Supprimer le professeur</button>
            </form>
		</div>
<br><hr><br>		
		<div class="form-container">
			<form action="" method="POST">
				<h2>Ajout de professeur</h2>

				<label for="nom">Nom du professeur</label>
				<input type="text" id="nom" name="nom" required>

				<label for="prenom">Prénom du professeur</label>
				<input type="text" id="prenom" name="prenom" required>
				
				<label for="email">E-mail du professeur</label>
				<input type="text" id="email" name="email" required>
				
				<label for="identifiant">Identifiant du professeur</label>
				<input type="text" id="identifiant" name="identifiant" required>
				
				<label for="nom">Mot de passe du professeur</label>
				<input type="text" id="mdp" name="mdp" required>
				

				<button type="submit" name="add">Ajouter le professeur</button>
			</form>
		</div>
    </div>
</body>
</html>

<?php  // Ajout d'un nouveau professeur
//Vérifier que le bouton ajouter a été cliqué
if (isset($_POST['add'])) {
	if ($_POST && count($_POST)
			&& array_key_exists('nom', $_POST) && array_key_exists('prenom', $_POST) && array_key_exists('email', $_POST)) && array_key_exists('identifiant', $_POST)) && array_key_exists('mdp', $_POST)
			&& !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['identifiant']) && !empty($_POST['mdp'])) {
		
		if ($nom === false) {
			$message = "Erreur : nom doit être un entier valide.";
		} 
		else {
			$credits = filter_var($_POST['credits'], FILTER_VALIDATE_INT);
			if ($credits === false) {
				$message = "Erreur : le nombre de crédits doit être un entier valide.";
			} 
			else {
				$nom = trim($_POST['nom']);  // Supprime les espaces au début et la fin de la chaîne
				if (strlen($nom) > 255) {
					$message = "Erreur : le nom du professeur est trop long.";
				} 
				else {
					// Requête d'insertion du professeur dans la table
					try {
						$sql = "INSERT INTO professeur (nom, nom, credits) VALUES (:nom, :nom, :credits)";
						$stmt = $bdd->prepare($sql);
						$stmt->bindParam(':nom', $nom);
						$stmt->bindParam(':nom', $nom);
						$stmt->bindParam(':credits', $credits);
						$stmt->execute();

						echo "<p style='color: green;'>professeur ajouté avec succès !</p>";
					} 
					catch (PDOException $e) {
						echo "<p style='color: red;'>Erreur lors de l'ajout du professeur : " . $e->getMessage() . "</p>";
					} 
				}
			}
		}
	}
	else {
		$message = "Veuillez remplir tous les champs du formulaire.";
	}
}
	
	
			// Suppression d'un professeur
if (isset($_POST['delete'])) {
	if (!empty($_POST['professeur'])) {
    
		$identifiant = htmlspecialchars($_POST['identifiant'], ENT_QUOTES, 'UTF-8');
		    
		if ($identifiant === false) {
			$message = "Erreur : le code du professeur sélectionné est invalide.";
		}
		else {
			try {
				$sql = "DELETE FROM professeur WHERE identifiant = :identifiant";
				$stmt = $bdd->prepare($sql);
				$stmt->bindParam(':identifiant', $identifiant, PDO::PARAM_INT);
				$stmt->execute();

				if ($stmt->rowCount() > 0) {
					$message = "professeur supprimé avec succès !";
				} else {
					$message = "Aucun professeur trouvé avec ce code.";
				}
			} 
			catch (PDOException $e) {
				$message = "Erreur lors de la suppression du professeur : " . $e->getMessage();
			}
		}
	}
	else {
		$message = "Veuillez sélectionner un professeur à supprimer.";
	}
}
?>