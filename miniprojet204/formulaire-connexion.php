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

// la personne rentre son mot de passe et son nom utilisateur ce qui va donner une valeur à $_POST['nom'] et $_POST['password']


// vérification dans la table correspondante (étudiant ou professeur) si le nom d'utilsiateur existe et si le mot de passe correspond
        //condition que la variable $_POST existe
if ($_POST) {
    
    $utilisateur = $_POST['nom']; // récupérer le nom d'utilisateur donné

    // vérification que le nom de l'utilisateur existe dans la base de donnée dans la table professeurs

    $verificationutilisateur = $bdd->prepare('SELECT * FROM professeurs WHERE nom=?'); 
    $verificationutilisateur->execute([$utilisateur]); // récupérer dans la table des champs où le nom correspond au nom d'utilsiateur fourni
    $utilisateur = $verificationutilisateur->fetch(); // rendre ces données accessibles
    // condition où des données aec ce nom existent
    if ($utilisateur) {
        echo 'nom correct';
        
        // si le nom de l'utilisateur existe, récupération du mot de passe enregistré dans la base de donné qui correspond à ce nom

        $requetemotdepasse = $bdd->prepare('SELECT motdepasse FROM professeurs WHERE nom = ?');
        $requetemotdepasse->execute(array($_POST['nom']
                ));
        $_user = $requetemotdepasse->fetch();
        $mdpdata = $_user['motdepasse'];

        // vérification de la correspondance entre mot de passe dans la base de donnée et le nom d'utilsiateur donné

        if (!($mdpdata === $_POST['password'])) {
            echo ' mot de passe incorrect';
        }else{

         //ouverture de la session 
        
            $_SESSION['utilisateur']	=	$_POST['nom'];
            $_SESSION['mdp']	=	$_POST['password'];

           
        echo 'Vous êtes maintenant connecté comme '.$_POST["nom"].' <br><a href="">se diriger vers la page d\'accueil</a>';

        }



        

    }
    //condition où des données avec ce nom n'existent pas
    else{
        echo 'nom d\'utilisateur incorrect';
    }
}
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
        <form method="POST">
            <h2>Connexion</h2>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="nom" required>
            
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
