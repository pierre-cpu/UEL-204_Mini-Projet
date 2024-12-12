
<?php


/*fonctionalités générales */
// Param�tres de connexion
   
// Connexion de l'utilisateur à la base de donnée mysql (paramètres à modifier selon la base de donnée et l'utilisateur//





/*ajouter un cours dans la table cours (pour les profs)*/
function addcourse() {
	
	$requeteajoutcours = $bdd->prepare('INSERT INTO cours (Code_UEL, Nom, credits) VALUES (:Code_UEL, :Nom, :credits)');
	$requeteajoutcours->execute(array(
		'Code_UEL' => '', //a emplacer par variable $_POST[''] correspondant au nom du champ du formualire
		'Nom' => '', //a emplacer par variable $_POST[''] correspondant au nom du champ du formualire
		'credits' => '' //a emplacer par variable $_POST[''] correspondant au nom du champ du formualire
		
	
		));
	echo 'Le nouveau cours a été ajouté dans la table cours.';
	$requeteajoutcours->closeCursor();
}


/* Inscription d'un prof dans la base de donnée. Ne peut-on  pas mettre $satut en parametre 
 et remplacer professeur par ette varialbe, qui prendra soit étudiant soit professeur en valeur ? 
 faudra aussi considérer al différence ce champ num_etudiant et id_professeur. En attendant, je fais une fonction étudiant à part ci dplus bas*/

function inscriptionprof(){
	
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

	$requeteinscriptionprof = $bdd->prepare('INSERT INTO professeurs (id_prof, Nom, Prenom, email, identifiant, motdepasse) 
	VALUES (:id_prof, :Nom, :Prenom, :email, :identifiant, :motdepasse)');
	$requeteinscriptionprof->execute(array(
		'id_prof' => '', //a compléter avec la variable correspondant au nom du champ de formulaire
		'Nom' => $_POST['username'],
		'Prenom' => '',
		'email' => '',
		'identifiant' => '',
		'motdepasse' => $_POST['password']
		));
	echo 'Vous avez été ajouté comme nouvel utilisateur professeur.';
	$requeteinscriptionprof->closeCursor();
}
   
/* function inscription étudiant */

function inscriptionetud(){


	$requeteinscriptionetud = $bdd->prepare('INSERT INTO Etudiant (num_etudiant, Nom, Prenom, email, identifiant, mot_de_passe) 
	VALUES (:num_etudiant, :Nom, :Prenom, :email, :identifiant, :mot_de_passe)');
	$requeteinscriptionetud->execute(array(
		'num_etudiant' => '', //a compléter avec la variable correspondant au nom du champ de formulaire
		'Nom' => '',
		'Prenom' => '',
		'email' => '',
		'identifiant' => '',
		'mot_de_passe' => ''
		));
	echo 'Vous avez été ajouté comme nouvel utilisateur étudiant.';
	$requeteinscriptionetud->closeCursor();
}

/*inscription d'un étudiant à un cours */
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
function inscriptioncours() {
$requeteinscriptioncours = $bdd->prepare('INSERT INTO Inscription (num_etudiant, CODE_UEL, Date)  
	VALUES (:num_etudiant, :CODE_UEL, :Date)');
	$requeteinscriptioncours->execute(array(
		'num_etudiant' => '', //a compléter avec la variable correspondant au nom du champ de formulaire
		'CODE_UEL' => '',
		'Date' => ''
		));
	echo 'Vous avez été ajouté au cours $CODE_UEL.';
	$requeteinscriptionprof->closeCursor();
	}








//fonctions relative à l'ouverture d'une session

/*fonction connextion d'un utilisateur à une session 
-- ajouter si l'utilsiateur n'est pas inscrit*/

       
	function setConnecte($utilisateur, $mdp){
		$_SESSION['utilisateur']	=	$utilisateur;
		$_SESSION['mdp']	=	$mdp;
	}

/* vérifier q'un utilisateur est connecté à la SESSION
            */
	function isConnecte(){
		if($_SESSION 
			&& count($_SESSION) 
				&& array_key_exists('utilisateur', $_SESSION)
					&& !empty($_SESSION['utilisateur'])){
			return true;
		}else{
			return false;
		}
	}

/* deconnexion */  
	function setDeconnecte(){
		session_destroy();
		unset($_SESSION);
		// header('Location: ../index.php');
		exit;
	}





 