<?php
// ouverture de la session
session_start();



// verification de la session

if($_SESSION 
&& count($_SESSION) 
    && array_key_exists('identifiant', $_SESSION)
        && !empty($_SESSION['identifiant']))
 
 {
    

    // connection à la base de donnée
    $serveur = "localhost:3306";
    $database = "universite";
    $user = "universite";
    $password = "universite";

    try {

        $bdd = new PDO('mysql:host=' . $serveur . ';charset=utf8;dbname=' . $database . '', $user, $password);


        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('<strong>Erreur détectée !!! </strong> : ' . $e->getMessage());
    }




    // envoie des infos du formulaire dans la table evaluation de la bdd

    if ($_POST) {

    

       $requeteevaluation = $bdd->prepare('INSERT INTO evaluations (code_uel, intitule, coeficient, type, date) 
        VALUES (:code_uel, :intitule, :coeficient, :type, :date)');
        $requeteevaluation->execute(
            array(
                'code_uel' => $_POST['code_uel'],
                'intitule' => $_POST['intitule'],
                'coeficient' => $_POST['coeficient'],
                'type' => $_POST['type'],
                'date' => $_POST['date']
            )
        );
        echo "Evaluation ajoutée avec succès";
        $requeteevaluation->closeCursor();
    } 

    // récupération de la liste des codes uel des cours
    $listecours = array();

    $coursrequest = $bdd->query('SELECT code_uel FROM cours');
    while ($data = $coursrequest->fetch()) {
        array_push($listecours, $data["code_uel"]);
    }
    ;
    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création des évaluations - Université</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="main-container">
            <!-- Section principale -->
            <div class="form-container">
            <h2><span id="matiere">Création des évaluations pour <?php echo $_SESSION['identifiant'] ?>.
                    
        </span></h2>

                <form method="POST">
                    <fieldset>
                        <legend>Créer une evaluation </legend>
                        <label for="code_uel">UEL du cours pour l'évaluation</label>
                        
                        <?php echo '<FORM method="POST" action="">';
                        echo '<select class="select-size" id="cours" name="code_uel" min="0" max="20" step="0.5" value="code_uel"
                            required>';
                        foreach ($listecours as $nom) {
                                echo '<option value="'.$nom.'">'.$nom.'</option>';
                            }

                        echo '</select> </form>'; ?>

                        <label for="intitule">Donner un intitulé pour l'évaluation</label>
                        <input class="select-size2" type="text" id="intitule" name="intitule"></input>

                        <label for="coeficient">Donner un coeficient pour l'évaluation</label>
                        <input class="select-size2" type="text" id="coeficient" name="coeficient"></input>

                        <label for="type">Précisez le type d'évaluation</label>
                        <select class="select-size" id="type" name="type" min="0" max="20" step="0.5" value="" required>
                            <option value="Devoir sur table">Devoir sur table</option>
                            <option value="Devoir maison">Devoir maison</option>

                        </select>
                        <label for="date">Précisez la date</label>
                        <input class="select-size2" type="date" name="date" min="0" max="20" step="0.5" value="" required>
                        </input>

                        <button type="submit">Envoyer</button>
                    </fieldset>
                </form>


            </div>
            <div class="role-section">
                <a href="deconnexion-session.php">  Pour vous déconneter, cliquez ici.</a>
                        </div>
        </div>
    </body>

    </html>

<?php } else {
    echo "Vous devez d'abord vous connecter.";
}

?>