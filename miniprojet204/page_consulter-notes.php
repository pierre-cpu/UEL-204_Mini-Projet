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
$get_info = $bdd->prepare("SELECT numero_etudiant FROM etudiants WHERE identifiant = :identifiant");
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
			<select class="select-size" id="code_uel" name="code_uel" required>
				<option value="">-- Sélectionnez un cours --</option>

				<?php   // Générer les options dynamiquement en PHP 
				
				try {
					// Requête SQL pour récupérer les code_uel des cours
					$get_uel = $bdd->prepare("SELECT code_uel FROM inscriptions WHERE numero_etudiant = :identifiant");
					$get_uel->bindParam(':identifiant', $etudiant['numero_etudiant'], PDO::PARAM_STR);
					$get_uel->execute();

					// Requête SQL pour récupérer les cours par code_uel
					while ($courses = $get_uel->fetch(PDO::FETCH_ASSOC)) {

						$get_cours = $bdd->prepare("SELECT code_uel, nom FROM cours WHERE code_uel = :code_uel");
						$get_cours->bindParam(':code_uel', $courses['code_uel'], PDO::PARAM_STR);
						$get_cours->execute();

						$cours = $get_cours->fetch(PDO::FETCH_ASSOC);

						$code_uel = htmlspecialchars($cours['code_uel'], ENT_QUOTES, 'UTF-8');
						$nom = htmlspecialchars($cours['nom'], ENT_QUOTES, 'UTF-8');

						echo "<option value='$code_uel'>$code_uel | $nom</option>";
					}
				} catch (PDOException $e) {
					echo "Erreur : " . $e->getMessage(); // Afficher l'erreur PDO
				}
				?>
			</select>
			<button type="submit">Voir les notes</button>
		</form>
	</div>

	<div class="table-container">
		<?php
		if ($_POST && array_key_exists('code_uel', $_POST) && !empty($_POST['code_uel'])) {
			$code_uel = $_POST['code_uel'];

			try {
				// Requête SQL pour récupérer les évaluations
				$get_evals = $bdd->prepare("SELECT id_eval, type, intitule, coeficient, date FROM evaluations WHERE code_uel = :code_uel");
				$get_evals->bindParam(':code_uel', $code_uel, PDO::PARAM_STR);
				$get_evals->execute();

				// Début du tableau
				echo "<table class='tableau-evaluation'>";
				echo "<tr><th>Type</th><th>Intitulé</th><th>Coefficient</th><th>Date</th><th>Note</th><th>Commentaire</th></tr>";

				while ($eval = $get_evals->fetch(PDO::FETCH_ASSOC)) {
					// Récupération des notes
					$get_note = $bdd->prepare("SELECT note, commentaire FROM notes WHERE id_eval = :id_eval AND numero_etudiant = :etudiant");
					$get_note->bindParam(':id_eval', $eval['id_eval'], PDO::PARAM_STR);
					$get_note->bindParam(':etudiant', $etudiant['numero_etudiant'], PDO::PARAM_STR);
					$get_note->execute();

					$note_data = $get_note->fetch(PDO::FETCH_ASSOC);
					$note = isset($note_data['note']) ? htmlspecialchars($note_data['note'], ENT_QUOTES, 'UTF-8') : 'Aucune note';
					$commentaire = isset($note_data['commentaire']) ? htmlspecialchars($note_data['commentaire'], ENT_QUOTES, 'UTF-8') : 'Pas de commentaire';

					// Ligne du tableau
					echo "<tr class='ligne-tableau'>
                    <td class='colonne-type'>" . htmlspecialchars($eval['type'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td class='colonne-intitule'>" . htmlspecialchars($eval['intitule'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td class='colonne-coef'>" . htmlspecialchars($eval['coeficient'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td class='colonne-date'>" . htmlspecialchars($eval['date'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td class='colonne-note'>$note/20</td>
                    <td class='colonne-commentaire'>$commentaire</td>
                </tr>";
				}

				echo "</table>";
			} catch (PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		} else {
			echo "Veuillez sélectionner un cours pour voir vos notes.";
		}
		?>
	</div>
</body>

</html>

<?php
// Fermer la connexion
$bdd = null;
?>