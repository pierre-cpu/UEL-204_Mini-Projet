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
        <form action="" method="POST">
            <h2>Connexion </h2>
            
            <!-- Choix du type d'utilisateur <label for="user_type">Je suis :</label> -->
            
            <div id="user_type">
                <input type="radio" id="etudiant" name="user_type" value="etudiants" required>
                <label for="etudiant">Étudiant</label>
                
                <input type="radio" id="professeur" name="user_type" value="professeurs" required>
                <label for="professeur">Professeur</label>
				
				<input type="radio" id="administrateur" name="user_type" value="administrateurs" required>
                <label for="administrateur">Administrateur</label>
            </div> 
            
            <!-- Champs de connexion -->
            <label for="username">Identifiant</label>
            <input type="text" id="username" name="identifiant" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
        
        <!-- Lien vers la page d'inscription -->
        <p class="signup-link">
            Pas encore inscrit ? <a href="page_creation-compte-etudiant.php">Créer un compte en tant qu'étudiant</a><br>
			<a href="page_creation-compte-professeur.php">Créer un compte en tant que professeur</a>
        </p>
    </div>
</body>
</html>

<?php
if ($_POST && isset($_POST['identifiant'], $_POST['password'], $_POST['user_type'])) {

	echo $_POST['identifiant'];
	echo $_POST['password'];
	echo $_POST['user_type'];
    // Récupérer les données du formulaire
    $identifiant = htmlspecialchars($_POST['identifiant'], ENT_QUOTES, 'UTF-8'); 
    $m_d_p = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $user_type = $_POST['user_type']; // Récupérer le type d'utilisateur (professeur, administrateur, etc.)

    // Choisir la table selon le type d'utilisateur
    $table = '';
    if ($user_type === 'professeurs') {
        $table = 'professeurs';
    } elseif ($user_type === 'administrateurs') {
        $table = 'administrateurs';
    } elseif ($user_type === 'etudiants') {
        $table = 'etudiants';
    } else {
        echo 'Type d\'utilisateur inconnu.';
        exit;
    }


    // Vérification de l'identifiant
    $check_id = $bdd->prepare("SELECT * FROM $table WHERE identifiant = ?");
    $check_id->execute([$identifiant]);
    $utilisateur = $check_id->fetch(PDO::FETCH_ASSOC);



    if ($utilisateur) {
        // Vérification du mot de passe
        if (password_verify($m_d_p, $utilisateur['motdepasse'])) {
            // Connexion réussie
            $_SESSION['identifiant'] = $identifiant;
            $_SESSION['statut'] = $user_type;

            echo 'Vous êtes maintenant connecté comme ' . htmlspecialchars($identifiant) . 
                 ' <br><a href="page_accueil_prof-etudiant-administrateur.php">Se diriger vers la page d\'accueil</a>';
        } else {
            echo 'Mot de passe incorrect.';
        }
    } else {
        echo 'Identifiant incorrect.';
    }
} else {
    echo 'Veuillez remplir tous les champs.';
} 

?>