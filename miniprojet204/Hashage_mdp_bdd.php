<?php /*
// Paramètres de connexion
	$servername = "localhost";  
	$username = "universite";         
	$password = "universite";             
	$dbname = "universite";
	
	// Connexion à la bdd
	$bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Récupérer tous les administrateur avec leurs mots de passe actuels
    $stmt = $bdd->query("SELECT identifiant, motdepasse FROM professeurs");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        // Hacher le mot de passe actuel
        $hashed_password = password_hash($user['motdepasse'], PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $update_stmt = $bdd->prepare("UPDATE professeurs SET motdepasse = :hashed_password WHERE identifiant = :id");
        $update_stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindParam(':id', $user['identifiant'], PDO::PARAM_INT);
        $update_stmt->execute();
    }

    echo "Tous les mots de passe ont été hachés avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}