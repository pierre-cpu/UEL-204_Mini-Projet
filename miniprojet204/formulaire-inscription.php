<!-- inscription.html -->
 <?php


 include_once("inc.function.php");
 
     
     
     

     if($_POST && count($_POST)){
	inscriptionprof();

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
            <h2>Inscription</h2>
            <label for="username_etudiant">Nom d'utilisateur</label>
            <input type="text" id="username_etudiant" name="username_etudiant" required>
            
            <label for="password_etudiant">Mot de passe</label>
            <input type="password_etudiant" id="password_etudiant" name="password_etudiant" required>
            
            <button type="submit">Soumettre</button>
        </form>
    </div>
    <div class="container">
        <form action="" method="POST">
            <h2>Inscription</h2>
            <label for="username_professeur">Nom d'utilisateur</label>
            <input type="text" id="username_professeur" name="username_professeur" required>
            
            <label for="password_professeur">Mot de passe</label>
            <input type="password_professeur" id="password_professeur" name="password_professeur" required>
            
            <button type="submit">Soumettre</button>
        </form>
    </div>
<?php 

?>
</body>
</html>
