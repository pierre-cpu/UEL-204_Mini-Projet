<?php 
	session_start(); 
	// Paramètres de connexion
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite";
	
	// Connexion à la bdd
	$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

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
        <form action="login_process.php" method="POST">
            <h2>Connexion</h2>
            
            <!-- Choix du type d'utilisateur -->
            <label for="user_type">Je suis :</label>
            <div id="user_type">
                <input type="radio" id="etudiant" name="user_type" value="etudiant" required>
                <label for="etudiant">Étudiant</label>
                
                <input type="radio" id="professeur" name="user_type" value="professeur" required>
                <label for="professeur">Professeur</label>
				
				<input type="radio" id="administrateur" name="user_type" value="administrateur" required>
                <label for="administrateur">Administrateur</label>
            </div>
            
            <!-- Champs de connexion -->
            <label for="username">Identifiant</label>
            <input type="text" id="username" name="Identifiant" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
        
        <!-- Lien vers la page d'inscription -->
        <p class="signup-link">
            Pas encore inscrit ? <a href="page_ceation-compte.php">Créer un compte</a>
        </p>
    </div>
</body>
</html>

<?php

	if ($_POST && array_key_exists('identifiant', $_POST) && array_key_exists('password', $_POST) && !empty($_POST['identifiant']) && !empty($_POST['password'])) {
		// récupérer l'identifiant et le mot de passe donné
		$identifiant = htmlspecialchars($_POST['identifiant'], ENT_QUOTES, 'UTF-8'); 
        $m_d_p = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
		
		// Si connecté comme étudiant
		if (array_key_exists('etudiant', $_POST) && !empty($_POST['etudiant'])) {
			$check_id = $bdd->prepare('SELECT * FROM etudiants WHERE identifiant=?');
			$check_id->execute([$identifiant]);
			$utilisateur = $check_id->fetch();
			
			if ($utilisateur) {
				$get_motdepasse = $bdd->prepare("SELECT motdepasse FROM etudiants WHERE identifiant = :m_d_p");
				$get_motdepasse->bindParam(':m_d_p', $m_d_p, PDO::PARAM_STR);
				
				$get_motdepasse->execute();
				
				$valid_mdp = $get_motdepasse->fetch(PDO::FETCH_ASSOC);
				
				if (!($valid_mdp[motdepasse] === $m_d_p)) {
					echo ' mot de passe incorrect';
				}
				else{
					//ouverture de la session 
					$_SESSION['identifiant'] = $identifiant;
					$_SESSION['mdp'] = $m_d_p;
					$_SESSION['statut'] = 'etudiant';

				echo 'Vous êtes maintenant connecté comme ' . $identifiant . ' <br><a href="">se diriger vers la page d\'accueil</a>';
				}
			}	
		}
		else{
			echo 'Identifiant incorrect';
		}
		
		// Si connecté comme professeur
		if (array_key_exists('professeur', $_POST) && !empty($_POST['professeur'])) {
			$check_id = $bdd->prepare('SELECT * FROM professeurs WHERE identifiant=?');
			$check_id->execute([$identifiant]);
			$utilisateur = $check_id->fetch();
			// vérification que l'identifiant existe dans la base de donnée dans la table professeurs

			$check_id = $bdd->prepare('SELECT * FROM professeurs WHERE identifiant=?'); 
			$check_id->execute([$identifiant]); // récupérer dans la table des champs où le nom correspond au nom d'utilsiateur fourni
			$utilisateur = $check_id->fetch(); // rendre ces données accessibles
			// condition où des données aec ce nom existent
			if ($utilisateur) {
				echo 'identifiant correct';
				
				// si le nom de l'utilisateur existe, récupération du mot de passe enregistré dans la base de donné qui correspond à ce nom

				$get_motdepasse = $bdd->prepare('SELECT motdepasse FROM professeurs WHERE nom = ?');
				$get_motdepasse->execute(array($_POST['identifiant']
						));
				$_user = $get_motdepasse->fetch();
				$mdpdata = $_user['motdepasse'];

				// vérification de la correspondance entre mot de passe dans la base de donnée et le nom d'utilsiateur donné

				if (!($mdpdata === $m_d_p)) {
					echo ' mot de passe incorrect';
				}else{

				 //ouverture de la session 
				
					$_SESSION['identifiant'] = $_POST['nom'];
					$_SESSION['mdp'] = $_POST['password'];
					$_SESSION['statut'] = 'professeur';
				   
				echo 'Vous êtes maintenant connecté comme '.$_POST["identifiant"].' <br><a href="">se diriger vers la page d\'accueil</a>';

				}
			}
			//condition où des données avec ce nom n'existent pas
			else{
				echo 'nom d\'utilisateur incorrect';
			}
		}
		
		// Si connecté comme Administrateur
		if (array_key_exists('administrateur', $_POST) && !empty($_POST['administrateur'])) {
			$check_id = $bdd->prepare('SELECT * FROM administrateurs WHERE identifiant=?');
			$check_id->execute([$identifiant]);
			$utilisateur = $check_id->fetch();
			
			if ($utilisateur) {
				$get_motdepasse = $bdd->prepare("SELECT motdepasse FROM administrateurs WHERE identifiant = :m_d_p");
				$get_motdepasse->bindParam(':m_d_p', $m_d_p, PDO::PARAM_STR);
				
				$get_motdepasse->execute();
				
				$valid_mdp = $get_motdepasse->fetch(PDO::FETCH_ASSOC);
				
				if (!($valid_mdp[motdepasse] === $m_d_p)) {
					echo ' mot de passe incorrect';
				}
				else{
					//ouverture de la session 
					$_SESSION['identifiant'] = $identifiant;
					$_SESSION['mdp'] = $m_d_p;
					$_SESSION['statut'] = 'administrateur';
					
				echo 'Vous êtes maintenant connecté comme ' . $identifiant . ' <br><a href="">se diriger vers la page d\'accueil</a>';
				}
			}	
		}
		else{
			echo 'Identifiant incorrect';
		}
	}
?>