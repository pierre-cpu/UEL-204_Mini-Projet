<?php 
// ouverture de la session
session_start();



// verification de la session

if($_SESSION 
&& count($_SESSION) 
    && array_key_exists('utilisateur', $_SESSION)
        && !empty($_SESSION['utilisateur'])){ 
            
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

//récupérer la liste des nomdes des étudiants
$listeetudiants = array();

$etudiantsrequest = $bdd->query('SELECT nom FROM etudiants');
while ($data = $etudiantsrequest->fetch())
	{
		array_push($listeetudiants, $data["nom"]);
    };

//récupérer la liste des cours

$listecours = array();

$coursrequest = $bdd->query('SELECT code_uel FROM cours');
while ($data = $coursrequest->fetch())
	{
		array_push($listecours, $data["code_uel"]);
    };


// envoyer les informations dans les tables de la bdd après l'envoi du formulaire
    // ajouter la note
if ($_POST) {


    $evaluation = $bdd->prepare('INSERT INTO note (note) VALUE (note= :note)');
    $evaluation->execute (array('note'=>$_POST['note']))
   ;
}

// ajouter des types d'évaluation
$requeteevaluation = $bdd->prepare('INSERT INTO evaluation (code_uel, type, intitule, coeficient) 
        VALUES (:code_uel, :type, :intitule, :coeficient)');
        $requeteevaluation->execute(array(
            'code_uel' => '', //a compléter avec la variable correspondant au nom du champ de formulaire
            'type' => $_POST['username'],
            'intitule' => '',
            'coeficient' => ''
            ));
        $requeteinscriptionprof->closeCursor();
?>

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
            <h2>Gestion des Notes pour <span id="matiere"><?php echo $_SESSION['utilisateur'] ?></span></h2>
            
            <form action="POST">
            <label for="evaluation-code_uel"><input type="text" id="evaluation-code_uel" name="evaluation-code_uel"></input>
            </form>
            
            <form method="POST" id="notesForm">
                <table>
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Cours</th>
                            <th>Évaluation</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="etudiant-1" class="etudiant">
                            <td>
                            <select id="etudiant" name="etudiant" min="0" max="20" step="0.5" value="" required>
                                <?php foreach($listeetudiants as $nom) {
                                echo '<option value="">'.$nom.'</option>';}?>
                                    
                                </select>
                            </td>
                            
                               
                            </td>
                            <td>
                                <select id="cours" name="cours" min="0" max="20" step="0.5" value="" required>
                                <?php foreach($listecours as $nom) {
                                echo '<option value="">'.$nom.'</option>';}?>
                                </select>
                            </td>
                             <!-- Sélection de l'intitulé de l'évaluation -->
                             <td>
                             <select id="evaluation-1" name="evaluation" required>
                                    <option value="examen_final">Examen final</option>
                                    <option value="projet">Projet</option>
                                    <option value="devoir">Devoir à rendre</option>
                                </select>
                            <td>
                                <input type="number" id="note-1" name="note" min="0" max="20" step="0.5" value="" required>
                            </td>
                            <td>
                                <textarea id="commentaire-1" name="commentaire" placeholder="Ajouter un commentaire..."></textarea>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <button type="submit">Enregistrer les Notes</button>
            </form>
            <br>
                <button id="manageCoursesBtn">Gérer mes cours
                <a href="gerer_cours.html"></a>
            </button>
        </div>
    </div>
</body>
</html>

<?php }
else { echo "Vous devez d'abord vous connecter.";}

?>