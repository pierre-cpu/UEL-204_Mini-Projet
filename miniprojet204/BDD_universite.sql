-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 déc. 2024 à 15:17
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `universite`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `identifiant` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `motdepasse` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`nom`, `identifiant`, `motdepasse`) VALUES
('Pierre', 'pierre', 'passpierre'),
('Malo', 'malo', 'passmalo'),
('Maiwenn', 'maiwenn', 'passmaiwenn'),
('Jacques', 'jacques', 'passjacques'),
('universite', 'universite', 'universite'),
('universite', 'universite', 'universite');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `code_uel` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `credits` int NOT NULL,
  PRIMARY KEY (`code_uel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`code_uel`, `nom`, `credits`) VALUES
(200, 'Introduction à la programmation', 5),
(201, 'Web dynamique et bases de données', 10),
(202, 'Conception d\'interfaces utilisateur (UI/UX)', 5),
(203, 'Réseaux informatiques', 3),
(204, 'Programmation orientée objet', 5),
(205, 'Introduction à l\'intelligence artificielle', 3),
(206, 'Systèmes d\'exploitation', 5),
(207, 'Gestion de projets informatiques', 3),
(208, 'Développement d\'applications mobiles', 10),
(209, 'Algorithmique avancée', 5),
(210, 'Sécurité des systèmes informatiques', 5),
(211, 'Analyse de données et statistiques', 3),
(212, 'Frameworks JavaScript modernes', 5),
(213, 'Création de contenu multimédia', 3),
(214, 'Design graphique et typographie', 5),
(215, 'E-commerce et marketing digital', 3),
(216, 'Développement de jeux vidéo', 10),
(217, 'Méthodes agiles en développement', 5),
(218, 'Bases de données avancées', 5),
(219, 'Web dynamique et bases de données', 6);

-- --------------------------------------------------------

--
-- Structure de la table `enseignements`
--

DROP TABLE IF EXISTS `enseignements`;
CREATE TABLE IF NOT EXISTS `enseignements` (
  `id_prof` int DEFAULT NULL,
  `code_uel` int DEFAULT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  KEY `prof` (`id_prof`),
  KEY `cours` (`code_uel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `numero_etudiant` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifiant` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`numero_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`numero_etudiant`, `nom`, `prenom`, `email`, `identifiant`, `motdepasse`) VALUES
('INE00000001', 'Dupont', 'Alice', 'alice.dupont@example.com', 'dupont1', 'password1'),
('INE00000002', 'Martin', 'Lucas', 'lucas.martin@example.com', 'martin2', 'password2'),
('INE00000003', 'Bernard', 'Chloé', 'chloe.bernard@example.com', 'bernard3', 'password3'),
('INE00000004', 'Thomas', 'Louis', 'louis.thomas@example.com', 'thomas4', 'password4'),
('INE00000005', 'Petit', 'Emma', 'emma.petit@example.com', 'petit5', 'password5'),
('INE00000006', 'Robert', 'Léo', 'leo.robert@example.com', 'robert6', 'password6'),
('INE00000007', 'Richard', 'Mia', 'mia.richard@example.com', 'richard7', 'password7'),
('INE00000008', 'Durand', 'Gabriel', 'gabriel.durand@example.com', 'durand8', 'password8'),
('INE00000009', 'Moreau', 'Sofia', 'sofia.moreau@example.com', 'moreau9', 'password9'),
('INE00000010', 'Laurent', 'Noah', 'noah.laurent@example.com', 'laurent10', 'password10'),
('INE00000011', 'Simon', 'Anna', 'anna.simon@example.com', 'simon11', 'password11'),
('INE00000012', 'Michel', 'Hugo', 'hugo.michel@example.com', 'michel12', 'password12'),
('INE00000013', 'Lefevre', 'Lina', 'lina.lefevre@example.com', 'lefevre13', 'password13'),
('INE00000014', 'Mercier', 'Ethan', 'ethan.mercier@example.com', 'mercier14', 'password14'),
('INE00000015', 'Garnier', 'Julie', 'julie.garnier@example.com', 'garnier15', 'password15'),
('INE00000016', 'Faure', 'Mathis', 'mathis.faure@example.com', 'faure16', 'password16'),
('INE00000017', 'Chevalier', 'Camille', 'camille.chevalier@example.com', 'chevalier17', 'password17'),
('INE00000018', 'Blanc', 'Nathan', 'nathan.blanc@example.com', 'blanc18', 'password18'),
('INE00000019', 'Muller', 'Zoé', 'zoe.muller@example.com', 'muller19', 'password19'),
('INE00000020', 'Morin', 'Jules', 'jules.morin@example.com', 'morin20', 'password20'),
('INE00000021', 'Roux', 'Alice', 'alice.roux@example.com', 'roux21', 'password21'),
('INE00000022', 'Fournier', 'Tom', 'tom.fournier@example.com', 'fournier22', 'password22'),
('INE00000023', 'Girard', 'Léa', 'lea.girard@example.com', 'girard23', 'password23'),
('INE00000024', 'Clement', 'Oscar', 'oscar.clement@example.com', 'clement24', 'password24'),
('INE00000025', 'Perrin', 'Lucie', 'lucie.perrin@example.com', 'perrin25', 'password25'),
('INE00000026', 'Renaud', 'Adam', 'adam.renaud@example.com', 'renaud26', 'password26'),
('INE00000027', 'Dumas', 'Chloé', 'chloe.dumas@example.com', 'dumas27', 'password27'),
('INE00000028', 'Brun', 'Alex', 'alex.brun@example.com', 'brun28', 'password28'),
('INE00000029', 'Gauthier', 'Sarah', 'sarah.gauthier@example.com', 'gauthier29', 'password29'),
('INE00000030', 'Bourgeois', 'Liam', 'liam.bourgeois@example.com', 'bourgeois30', 'password30');

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id_eval` int NOT NULL AUTO_INCREMENT,
  `code_uel` int NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `coeficient` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_eval`),
  KEY `cours` (`code_uel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `code_uel` int DEFAULT NULL,
  `numero_etudiant` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL,
  KEY `cours` (`code_uel`),
  KEY `etudiant` (`numero_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `numero_etudiant` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_eval` int DEFAULT NULL,
  `note` int NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  KEY `evaluation` (`id_eval`),
  KEY `etudiant` (`numero_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

DROP TABLE IF EXISTS `professeurs`;
CREATE TABLE IF NOT EXISTS `professeurs` (
  `id_prof` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifiant` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeurs`
--

INSERT INTO `professeurs` (`id_prof`, `nom`, `prenom`, `email`, `identifiant`, `motdepasse`) VALUES
(1, 'universite', '', '', '', 'universite'),
(2, 'Durand', 'Marc', 'marc.durand@example.com', 'durand1', 'passprof1'),
(3, 'Petit', 'Sophie', 'sophie.petit@example.com', 'petit2', 'passprof2'),
(4, 'Roux', 'Jean', 'jean.roux@example.com', 'roux3', 'passprof3'),
(5, 'Lemoine', 'Claire', 'claire.lemoine@example.com', 'lemoine4', 'passprof4'),
(6, 'Garnier', 'Paul', 'paul.garnier@example.com', 'garnier5', 'passprof5'),
(7, 'Morel', 'Julie', 'julie.morel@example.com', 'morel6', 'passprof6'),
(8, 'Lambert', 'Pierre', 'pierre.lambert@example.com', 'lambert7', 'passprof7'),
(9, 'Chevalier', 'Anne', 'anne.chevalier@example.com', 'chevalier8', 'passprof8'),
(10, 'Muller', 'Thomas', 'thomas.muller@example.com', 'muller9', 'passprof9'),
(11, 'Blanc', 'Camille', 'camille.blanc@example.com', 'blanc10', 'passprof10'),
(12, 'Fontaine', 'Luc', 'luc.fontaine@example.com', 'fontaine11', 'passprof11'),
(13, 'Perrin', 'Elise', 'elise.perrin@example.com', 'perrin12', 'passprof12'),
(14, 'Faure', 'Antoine', 'antoine.faure@example.com', 'faure13', 'passprof13'),
(15, 'Simon', 'Laura', 'laura.simon@example.com', 'simon14', 'passprof14'),
(16, 'Richard', 'Hugo', 'hugo.richard@example.com', 'richard15', 'passprof15');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enseignements`
--
ALTER TABLE `enseignements`
  ADD CONSTRAINT `enseignements_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professeurs` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enseignements_ibfk_2` FOREIGN KEY (`code_uel`) REFERENCES `cours` (`code_uel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`code_uel`) REFERENCES `cours` (`code_uel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `cours` FOREIGN KEY (`code_uel`) REFERENCES `cours` (`code_uel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etudiant` FOREIGN KEY (`numero_etudiant`) REFERENCES `etudiants` (`numero_etudiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `_etudiant` FOREIGN KEY (`numero_etudiant`) REFERENCES `etudiants` (`numero_etudiant`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `evaluation` FOREIGN KEY (`id_eval`) REFERENCES `evaluations` (`id_eval`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
