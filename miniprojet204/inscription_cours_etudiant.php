<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
				<!-- Les options seront générées dynamiquement en PHP -->
				<?php
					
					// Paramètres de la connexion
					$servername = "localhost";  
					$username = "universite";         
					$password = "universite";             
					$dbname = "universite";     

					try {
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						// Requête SQL pour récupérer les cours
						$sql = "SELECT code_uel, nom FROM cours";
						$stmt = $conn->prepare($sql);
						$stmt->execute();

						// Récupérer les résultats sous forme de tableau associatif
						$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

						// Vérifier si des cours ont été récupérés
						if ($courses && count($courses) > 0) {
							echo "<pre>"; // Format lisible pour afficher le tableau
							print_r($courses); // Afficher les données des cours
							echo "</pre>";

							// Afficher chaque cours dans une option
							foreach ($courses as $cours) {
								echo "<option value='" . $cours['code_uel'] . "'>" . $cours['nom'] . "</option>";
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
						// Fermer la connexion
						$conn = null;
					}
					
				?>
				
			</select>
			
			<button type="submit">S'inscrire</button>
		</form>
	</div>
</body>
</html>