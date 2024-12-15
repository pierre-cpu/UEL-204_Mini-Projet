<!-- inscription.html -->
<?php



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
        $requeteinscriptionprof = $bdd->prepare('INSERT INTO professeurs (nom, prenom, email, identifiant, motdepasse) 
        VALUES (:nom, :prenom, :email, :identifiant, :motdepasse)');
        $requeteinscriptionprof->execute(array(
            'nom' => $_POST['username'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'identifiant' => $_POST['identifiant'],
            'motdepasse' => $_POST['password']
            ));
        echo '<div>Vous avez été ajouté comme nouvel utilisateur professeur. <a href="page_connexion.php">Vous pouvez vous connecter ici</a></div>';
        $requeteinscriptionprof->closeCursor();

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
            <h2>Inscription Professeur</h2>

            <label for="identifiant">Identifiant</label>
            <input type="text" id="identifiant" name="identifiant" required>

            <label for="username">Nom</label>
            <input type="text" id="username" name="username" required>

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Soumettre</button>
        </form>
    </div>


    
</body>

</html>