<!-- inscription.html -->
<?php


include_once("inc.function.php");





if ($_POST && count($_POST)) {
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
    <div class="container">
        <form action="" method="POST">
            <h2>Inscription Professeur</h2>

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
    <?php

    ?>
</body>

</html>