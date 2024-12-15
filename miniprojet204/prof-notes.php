<?php 
// ouverture de la session
session_start();


// verification de la session

if($_SESSION 
&& count($_SESSION) 
    && array_key_exists('identifiant', $_SESSION)
        && !empty($_SESSION['identifiant'])){ 
            
        // connection à la base de donnée
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
    die('<strong>Erreur détectée !!! </strong> : ' . $e->getMessage());
}

//récupérer la liste des nom des des étudiants
$listeetudiants = array();

$etudiantsrequest = $bdd->query('SELECT numero_etudiant FROM etudiants');
while ($data = $etudiantsrequest->fetch())
	{
		array_push($listeetudiants, $data["numero_etudiant"]);
    };



   // récupération de la liste des evaluations disponibles
   $listeevaluations = array();

   $evaluationsrequest = $bdd->query('SELECT id_eval FROM evaluations');
   while ($data = $evaluationsrequest->fetch()) {
       array_push($listeevaluations, $data["id_eval"]);
   }
   ;

 


// envoyer les informations dans les tables de la bdd après l'envoi du formulaire
    // ajouter la note
if ($_POST) {
    
 //inséter les notes dans le tableau note
 var_dump($_POST);
 $note=$_POST['note'];
 $idetudiant=$_POST['etudiant'];
 $idvaluation=$_POST['evaluation'];
 $commentaire=$_POST['commentaire'];

 

    $evaluation = $bdd->prepare('INSERT INTO notes (note, commentaire)
     VALUE (note= :note, commentaire= :commentaire)');
    $evaluation->execute (array(
      /* 'numero_etudiant'=>$_POST['etudiant'],
        'id_eval'=>,*/
        'note'=>$note,
        'commentaire'=>$commentaire
        
        
        ))
   ;
} ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Notes - Université</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <!-- Section principale -->
        <div class="form-container">
            <h2>Gestion des Notes pour <span id="matiere"><?php echo $_SESSION['identifiant'] ?></span></h2>
            
        
            
            <form method="POST" id="notesForm">
                <table>
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Évaluation</th>

                            <th>Note</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="etudiant-1" class="etudiant">
                            <td>
                            <select id="etudiant" name="etudiant"  value="etudiant" required>
                                <?php foreach($listeetudiants as $nom) {
                                echo '<option value="'.$nom.'">'.$nom.'</option>';}?>
                                    
                                </select>
                            </td>
                            
                               
                            </td>
                            <td>
                            <select id="evaluation" name="evaluation" value="evaluation" required>
                                <?php foreach($listeevaluations as $evaluationid) {
                                echo '<option value="'.$evaluationid.'">'.$evaluationid.'</option>';}?>
                                    
                                </select>
                            </td>
                             
                             
                            <td>
                                <input type="number" id="note" name="note" min="0" max="20" step="0.5" value="note" required>
                            </td>
                            <td>
                                <textarea id="commentaire" name="commentaire" value="commentaire" placeholder="Ajouter un commentaire..."></textarea>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <button type="submit">Enregistrer les Notes</button>
            </form>
            <div class="role-section">
                <a href="deconnexion-session.php">  Pour vous déconneter, cliquez ici.</a>
                        </div>
        </div>
    </div>
</body>
</html>

<?php }
else { echo "Vous devez d'abord vous connecter.";}

?>