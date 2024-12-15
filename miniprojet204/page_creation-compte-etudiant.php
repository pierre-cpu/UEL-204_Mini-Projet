<!-- inscription.html -->
<?php

session_start();

$serveur  = "localhost:3306";
$database = "universite";
$user     = "universite";
$password = "universite";

try
{	
    
    $bdd=new PDO('mysql:host='.$serveur.';charset=utf8;dbname='.$database.'',$user,$password);
    
    
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    die('<strong>Erreur d�tect�e !!! </strong> : ' . $e->getMessage());
}

     
     
     

     if($_POST && count($_POST)){

        $password = $_POST['mot_de_passe_etudiant'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $requeteinscriptionetudiants = $bdd->prepare('INSERT INTO etudiants (numero_etudiant, nom, prenom, email, identifiant, motdepasse) 
        VALUES (:numero_etudiant, :nom, :prenom, :email, :identifiant, :motdepasse)');
        $requeteinscriptionetudiants->execute(array(
            'numero_etudiant' => $_POST['numero_etudiant'],
            'nom' => $_POST['nom_etudiant'],
            'prenom' => $_POST['prenom_etudiant'],
            'email' => $_POST['email_etudiant'],
            'identifiant' => $_POST['identifiant_etudiant'],
            'motdepasse' => $hashed_password
            ));
        echo 'Vous avez été ajouté comme nouvel utilisateur étudiant.  <a href="page_connexion.php">Vous pouvez vous connecter ici</a>';
        $requeteinscriptionetudiants->closeCursor();

    }
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<div class="container">
        <form action="" method="POST">
            <h2>Inscription Etudiant</h2>

            <label for="numero_etudiant">Numero étudiant</label>
            <input type="text" id="numero_etudiant" name="numero_etudiant" required>

            <label for="nom_etudiant">Nom</label>
            <input type="text" id="nom_etudiant" name="nom_etudiant" required>

            <label for="prenom_etudiant">Prénom</label>
            <input type="text" id="prenom_etudiant" name="prenom_etudiant" required>

            <label for="email_etudiant">E-mail</label>
            <input type="email" id="email_etudiant" name="email_etudiant" required>

            <label for="identifiant_etudiant">Identifiant</label>
            <input type="text" id="identifiant_etudiant" name="identifiant_etudiant" required>

            <label for="mot_de_passe_etudiant">Mot de passe</label>
            <input type="password" id="mot_de_passe_etudiant" name="mot_de_passe_etudiant" required>

            <button type="submit">Soumettre</button>
        </form>
    </div>
    
</body>

</html>