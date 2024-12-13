<?php 
	session_start();
	$_SESSION['statut'] = 'etudiant';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container_accueil">
        <h1>Bienvenue dans l'Académie</h1>
        <h2>Choisissez une action</h2>
        <div class="role-menu">
		
		<!-- Section pour les étudiants -->
		<?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'etudiant'): ?>
            
            <div class="role-section">
                <h3>Étudiant</h3>
                <ul>
                    <li><a href="inscription_cours_etudiant.php">S'inscrire à un cours</a></li>
                    <li><a href="page_consulter-notes.php">Consulter ses notes</a></li>
                </ul>
            </div>
		<?php endif; ?>
		
		<!-- Section pour les professeurs -->
		<?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'professeur'): ?>
            
            <div class="role-section">
                <h3>Professeur</h3>
                <ul>
                    <li><a href="prof-creation-evaluation.php">Ajouter / Supprimer une Evaluation</a></li>
                    <li><a href="prof-notes.php">Éditer les notes des étudiants</a></li>
                </ul>
            </div>
		<?php endif; ?>
		
        <!-- Section pour l'administrateur -->
		<?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'administrateur'): ?>
            <div class="role-section">
                <h3>Admin</h3>
                <ul>
                    <li><a href="gestion_etudiants.html">Gestion des étudiants</a></li>
                    <li><a href="gestion_professeurs.html">Gestion des professeurs</a></li>
                    <li><a href="autre.html">Autres fonctionnalités</a></li>
                </ul>
            </div>
		<?php endif; ?>
		
        </div>
    </div>
</body>
</html>
