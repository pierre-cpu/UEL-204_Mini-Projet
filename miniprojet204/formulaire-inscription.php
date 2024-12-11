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
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Soumettre</button>
        </form>
    </div>

<?php 

test

?>
</body>
</html>
