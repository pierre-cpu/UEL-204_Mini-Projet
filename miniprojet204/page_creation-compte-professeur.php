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

        $password = $_POST['mot_de_passe_prof'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $requeteinscriptionprofesseurs = $bdd->prepare('INSERT INTO professeurs (nom, prenom, email, identifiant, motdepasse) 
        VALUES (:nom, :prenom, :email, :identifiant, :motdepasse)');
        $requeteinscriptionprofesseurs->execute(array(
           
            'nom' => $_POST['nom_prof'],
            'prenom' => $_POST['prenom_prof'],
            'email' => $_POST['email_prof'],
            'identifiant' => $_POST['identifiant_prof'],
            'motdepasse' => $hashed_password
            ));
        echo 'Vous avez été ajouté comme nouvel utilisateur professeur.  <a href="page_connexion.php">Vous pouvez vous connecter ici</a>';
        $requeteinscriptionprofesseurs->closeCursor();

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


            <label for="nom_prof">Nom</label>
            <input type="text" id="nom_prof" name="nom_prof" required>

            <label for="prenom_prof">Prénom</label>
            <input type="text" id="prenom_prof" name="prenom_prof" required>

            <label for="email_prof">E-mail</label>
            <input type="email" id="email_prof" name="email_prof" required>

            <label for="identifiant_prof">Identifiant</label>
            <input type="text" id="identifiant_prof" name="identifiant_prof" required>

            <label for="mot_de_passe_prof">Mot de passe</label>
            <input type="password" id="mot_de_passe_prof" name="mot_de_passe_prof" required>

            <button type="submit">Soumettre</button>
        </form>
    </div>
    
</body>

</html>