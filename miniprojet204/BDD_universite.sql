-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 déc. 2024 à 19:39
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

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
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`nom`, `identifiant`, `motdepasse`) VALUES
('Pierre', 'pierre', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW'),
('Malo', 'malo', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW'),
('Maiwenn', 'maiwenn', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW'),
('Jacques', 'jacques', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW'),
('universite', 'universite', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW'),
('universite', 'universite', '$2y$10$l7kMThUskam7HkeARqT3aO0ozlo5HX4eCm7kxN1iyXGhTD.MxI0TW');

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
  `motdepasse` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`numero_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`numero_etudiant`, `nom`, `prenom`, `email`, `identifiant`, `motdepasse`) VALUES
('INE00000001', 'Dupont', 'Alice', 'alice.dupont@example.com', 'dupont1', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000002', 'Martin', 'Lucas', 'lucas.martin@example.com', 'martin2', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000003', 'Bernard', 'Chloé', 'chloe.bernard@example.com', 'bernard3', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000004', 'Thomas', 'Louis', 'louis.thomas@example.com', 'thomas4', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000005', 'Petit', 'Emma', 'emma.petit@example.com', 'petit5', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000006', 'Robert', 'Léo', 'leo.robert@example.com', 'robert6', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000007', 'Richard', 'Mia', 'mia.richard@example.com', 'richard7', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000008', 'Durand', 'Gabriel', 'gabriel.durand@example.com', 'durand8', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000009', 'Moreau', 'Sofia', 'sofia.moreau@example.com', 'moreau9', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000010', 'Laurent', 'Noah', 'noah.laurent@example.com', 'laurent10', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000011', 'Simon', 'Anna', 'anna.simon@example.com', 'simon11', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000012', 'Michel', 'Hugo', 'hugo.michel@example.com', 'michel12', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000013', 'Lefevre', 'Lina', 'lina.lefevre@example.com', 'lefevre13', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000014', 'Mercier', 'Ethan', 'ethan.mercier@example.com', 'mercier14', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000015', 'Garnier', 'Julie', 'julie.garnier@example.com', 'garnier15', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000016', 'Faure', 'Mathis', 'mathis.faure@example.com', 'faure16', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000017', 'Chevalier', 'Camille', 'camille.chevalier@example.com', 'chevalier17', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000018', 'Blanc', 'Nathan', 'nathan.blanc@example.com', 'blanc18', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000019', 'Muller', 'Zoé', 'zoe.muller@example.com', 'muller19', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000020', 'Morin', 'Jules', 'jules.morin@example.com', 'morin20', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000021', 'Roux', 'Alice', 'alice.roux@example.com', 'roux21', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000022', 'Fournier', 'Tom', 'tom.fournier@example.com', 'fournier22', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000023', 'Girard', 'Léa', 'lea.girard@example.com', 'girard23', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000024', 'Clement', 'Oscar', 'oscar.clement@example.com', 'clement24', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000025', 'Perrin', 'Lucie', 'lucie.perrin@example.com', 'perrin25', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000026', 'Renaud', 'Adam', 'adam.renaud@example.com', 'renaud26', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000027', 'Dumas', 'Chloé', 'chloe.dumas@example.com', 'dumas27', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000028', 'Brun', 'Alex', 'alex.brun@example.com', 'brun28', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000029', 'Gauthier', 'Sarah', 'sarah.gauthier@example.com', 'gauthier29', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO'),
('INE00000030', 'Bourgeois', 'Liam', 'liam.bourgeois@example.com', 'bourgeois30', '$2y$10$hDa89gg.r.AtHygzCJoji.FI2C4F69tjzvlSdT6kQ2kfosUp8.ipO');

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
  `coeficient` float NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_eval`),
  KEY `cours` (`code_uel`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations`
--

INSERT INTO `evaluations` (`id_eval`, `code_uel`, `type`, `intitule`, `coeficient`, `date`) VALUES
(1, 200, 'questionnaire', 'Evaluation 623', 1, '2024-12-14'),
(2, 200, 'questionnaire', 'Evaluation 726', 0.5, '2024-10-14'),
(3, 200, 'questionnaire', 'Evaluation 991', 2, '2025-01-18'),
(4, 201, 'contrôle_continu', 'Evaluation 512', 1, '2025-06-11'),
(5, 201, 'evaluation_finale', 'Evaluation 811', 0.25, '2025-05-27'),
(6, 201, 'evaluation_finale', 'Evaluation 6', 1, '2024-11-08'),
(7, 202, 'questionnaire', 'Evaluation 98', 2, '2025-04-30'),
(8, 202, 'contrôle_continu', 'Evaluation 82', 0.5, '2024-12-15'),
(9, 202, 'questionnaire', 'Evaluation 660', 2, '2025-02-09'),
(10, 203, 'evaluation_finale', 'Evaluation 181', 1, '2025-01-20'),
(11, 203, 'evaluation_finale', 'Evaluation 258', 0.5, '2025-03-30'),
(12, 203, 'evaluation_finale', 'Evaluation 279', 2, '2025-02-14'),
(13, 204, 'contrôle_continu', 'Evaluation 365', 0.25, '2025-02-17'),
(14, 204, 'questionnaire', 'Evaluation 804', 2, '2024-11-07'),
(15, 204, 'questionnaire', 'Evaluation 62', 1, '2024-12-02'),
(16, 205, 'contrôle_continu', 'Evaluation 947', 1, '2025-01-16'),
(17, 205, 'contrôle_continu', 'Evaluation 8', 1, '2025-02-04'),
(18, 205, 'contrôle_continu', 'Evaluation 601', 0.25, '2024-11-22'),
(19, 206, 'evaluation_finale', 'Evaluation 615', 1, '2025-03-05'),
(20, 206, 'evaluation_finale', 'Evaluation 488', 2, '2024-12-12'),
(21, 206, 'questionnaire', 'Evaluation 53', 1, '2025-05-27'),
(22, 207, 'evaluation_finale', 'Evaluation 259', 0.5, '2025-03-01'),
(23, 207, 'evaluation_finale', 'Evaluation 389', 1, '2025-05-30'),
(24, 207, 'evaluation_finale', 'Evaluation 66', 1, '2025-02-11'),
(25, 208, 'contrôle_continu', 'Evaluation 125', 2, '2025-02-20'),
(26, 208, 'contrôle_continu', 'Evaluation 339', 1, '2025-03-17'),
(27, 208, 'questionnaire', 'Evaluation 772', 1, '2025-05-22'),
(28, 209, 'evaluation_finale', 'Evaluation 108', 2, '2025-01-31'),
(29, 209, 'questionnaire', 'Evaluation 67', 2, '2024-10-12'),
(30, 209, 'evaluation_finale', 'Evaluation 104', 0.5, '2025-03-23'),
(31, 210, 'evaluation_finale', 'Evaluation 103', 1, '2024-10-20'),
(32, 210, 'questionnaire', 'Evaluation 632', 0.5, '2025-06-08'),
(33, 210, 'contrôle_continu', 'Evaluation 702', 1, '2024-10-05'),
(34, 211, 'contrôle_continu', 'Evaluation 681', 1, '2024-12-19'),
(35, 211, 'questionnaire', 'Evaluation 917', 1, '2025-06-02'),
(36, 211, 'contrôle_continu', 'Evaluation 471', 0.5, '2025-02-12'),
(37, 212, 'evaluation_finale', 'Evaluation 890', 1, '2024-12-23'),
(38, 212, 'contrôle_continu', 'Evaluation 262', 0.25, '2025-01-30'),
(39, 212, 'evaluation_finale', 'Evaluation 289', 1, '2025-01-13'),
(40, 213, 'questionnaire', 'Evaluation 828', 1, '2024-12-19'),
(41, 213, 'evaluation_finale', 'Evaluation 343', 2, '2025-03-28'),
(42, 213, 'questionnaire', 'Evaluation 786', 0.25, '2025-06-19'),
(43, 214, 'evaluation_finale', 'Evaluation 971', 2, '2025-04-04'),
(44, 214, 'evaluation_finale', 'Evaluation 366', 1, '2025-01-07'),
(45, 214, 'questionnaire', 'Evaluation 887', 0.25, '2025-03-02'),
(46, 215, 'questionnaire', 'Evaluation 470', 1, '2025-02-23'),
(47, 215, 'contrôle_continu', 'Evaluation 35', 1, '2024-11-14'),
(48, 215, 'contrôle_continu', 'Evaluation 580', 2, '2025-06-11'),
(49, 216, 'questionnaire', 'Evaluation 866', 1, '2024-11-09'),
(50, 216, 'contrôle_continu', 'Evaluation 30', 1, '2024-10-08'),
(51, 216, 'evaluation_finale', 'Evaluation 907', 2, '2024-10-08'),
(52, 217, 'evaluation_finale', 'Evaluation 944', 0.5, '2024-10-10'),
(53, 217, 'evaluation_finale', 'Evaluation 211', 2, '2025-01-05'),
(54, 217, 'contrôle_continu', 'Evaluation 51', 0.5, '2024-12-07'),
(55, 218, 'evaluation_finale', 'Evaluation 454', 2, '2024-12-08'),
(56, 218, 'contrôle_continu', 'Evaluation 365', 0.25, '2025-04-24'),
(57, 218, 'evaluation_finale', 'Evaluation 711', 2, '2025-01-24'),
(58, 219, 'questionnaire', 'Evaluation 303', 2, '2025-03-13'),
(59, 219, 'questionnaire', 'Evaluation 447', 1, '2025-03-03'),
(60, 219, 'questionnaire', 'Evaluation 252', 1, '2025-05-04');

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

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`code_uel`, `numero_etudiant`, `date`) VALUES
(209, 'INE00000003', '2024-01-18 23:00:00'),
(210, 'INE00000003', '2024-12-09 23:00:00'),
(218, 'INE00000003', '2024-07-26 22:00:00'),
(219, 'INE00000003', '2024-01-08 23:00:00'),
(216, 'INE00000001', '2024-05-25 22:00:00'),
(210, 'INE00000001', '2024-12-06 23:00:00'),
(208, 'INE00000001', '2024-06-20 22:00:00'),
(204, 'INE00000001', '2024-07-23 22:00:00'),
(203, 'INE00000001', '2024-05-23 22:00:00'),
(200, 'INE00000001', '2024-04-14 22:00:00'),
(218, 'INE00000002', '2024-04-04 22:00:00'),
(217, 'INE00000002', '2024-06-06 22:00:00'),
(215, 'INE00000002', '2024-05-20 22:00:00'),
(211, 'INE00000002', '2024-08-19 22:00:00'),
(210, 'INE00000002', '2024-01-06 23:00:00'),
(208, 'INE00000002', '2024-03-04 23:00:00'),
(207, 'INE00000002', '2024-10-31 23:00:00'),
(206, 'INE00000002', '2024-08-23 22:00:00'),
(205, 'INE00000002', '2024-09-23 22:00:00'),
(200, 'INE00000002', '2024-09-17 22:00:00'),
(219, 'INE00000003', '2024-05-20 22:00:00'),
(218, 'INE00000003', '2024-10-11 22:00:00'),
(214, 'INE00000003', '2024-10-01 22:00:00'),
(213, 'INE00000003', '2024-06-03 22:00:00'),
(211, 'INE00000003', '2024-11-12 23:00:00'),
(210, 'INE00000003', '2024-01-24 23:00:00'),
(209, 'INE00000003', '2024-09-19 22:00:00'),
(206, 'INE00000003', '2024-05-31 22:00:00'),
(205, 'INE00000003', '2024-11-29 23:00:00'),
(204, 'INE00000003', '2024-04-30 22:00:00'),
(217, 'INE00000004', '2024-11-28 23:00:00'),
(216, 'INE00000004', '2024-07-24 22:00:00'),
(215, 'INE00000004', '2024-02-04 23:00:00'),
(214, 'INE00000004', '2024-10-10 22:00:00'),
(212, 'INE00000004', '2024-08-08 22:00:00'),
(211, 'INE00000004', '2024-09-09 22:00:00'),
(210, 'INE00000004', '2024-08-26 22:00:00'),
(209, 'INE00000004', '2024-03-09 23:00:00'),
(206, 'INE00000004', '2024-12-26 23:00:00'),
(204, 'INE00000004', '2024-05-17 22:00:00'),
(201, 'INE00000004', '2024-12-01 23:00:00'),
(215, 'INE00000005', '2024-06-19 22:00:00'),
(212, 'INE00000005', '2024-07-31 22:00:00'),
(211, 'INE00000005', '2024-07-06 22:00:00'),
(208, 'INE00000005', '2024-10-26 22:00:00'),
(204, 'INE00000005', '2024-07-27 22:00:00'),
(203, 'INE00000005', '2024-05-23 22:00:00'),
(202, 'INE00000005', '2024-04-05 22:00:00'),
(201, 'INE00000005', '2024-02-16 23:00:00'),
(218, 'INE00000006', '2024-11-06 23:00:00'),
(217, 'INE00000006', '2024-11-15 23:00:00'),
(216, 'INE00000006', '2024-10-31 23:00:00'),
(215, 'INE00000006', '2024-07-15 22:00:00'),
(214, 'INE00000006', '2024-03-14 23:00:00'),
(211, 'INE00000006', '2024-05-22 22:00:00'),
(210, 'INE00000006', '2024-05-07 22:00:00'),
(209, 'INE00000006', '2024-07-29 22:00:00'),
(208, 'INE00000006', '2024-11-03 23:00:00'),
(206, 'INE00000006', '2024-06-23 22:00:00'),
(203, 'INE00000006', '2024-11-15 23:00:00'),
(201, 'INE00000006', '2024-12-07 23:00:00'),
(200, 'INE00000006', '2024-01-23 23:00:00'),
(219, 'INE00000007', '2024-07-01 22:00:00'),
(218, 'INE00000007', '2024-04-26 22:00:00'),
(217, 'INE00000007', '2024-02-05 23:00:00'),
(215, 'INE00000007', '2024-07-11 22:00:00'),
(214, 'INE00000007', '2024-05-07 22:00:00'),
(212, 'INE00000007', '2024-03-03 23:00:00'),
(211, 'INE00000007', '2024-10-23 22:00:00'),
(210, 'INE00000007', '2024-07-17 22:00:00'),
(208, 'INE00000007', '2024-04-14 22:00:00'),
(204, 'INE00000007', '2024-10-21 22:00:00'),
(203, 'INE00000007', '2024-03-07 23:00:00'),
(201, 'INE00000007', '2024-06-25 22:00:00'),
(218, 'INE00000008', '2024-11-18 23:00:00'),
(217, 'INE00000008', '2024-12-16 23:00:00'),
(216, 'INE00000008', '2024-02-27 23:00:00'),
(211, 'INE00000008', '2024-11-27 23:00:00'),
(208, 'INE00000008', '2024-01-29 23:00:00'),
(207, 'INE00000008', '2024-08-29 22:00:00'),
(206, 'INE00000008', '2024-01-28 23:00:00'),
(203, 'INE00000008', '2024-05-24 22:00:00'),
(200, 'INE00000008', '2024-10-01 22:00:00'),
(219, 'INE00000009', '2024-07-30 22:00:00'),
(218, 'INE00000009', '2024-08-23 22:00:00'),
(215, 'INE00000009', '2024-06-28 22:00:00'),
(214, 'INE00000009', '2024-07-11 22:00:00'),
(213, 'INE00000009', '2024-02-27 23:00:00'),
(210, 'INE00000009', '2024-03-17 23:00:00'),
(202, 'INE00000009', '2024-07-29 22:00:00'),
(200, 'INE00000009', '2024-04-06 22:00:00'),
(219, 'INE00000010', '2024-08-03 22:00:00'),
(218, 'INE00000010', '2024-03-01 23:00:00'),
(217, 'INE00000010', '2024-01-22 23:00:00'),
(215, 'INE00000010', '2024-10-16 22:00:00'),
(213, 'INE00000010', '2024-10-18 22:00:00'),
(212, 'INE00000010', '2024-08-11 22:00:00'),
(211, 'INE00000010', '2024-09-01 22:00:00'),
(210, 'INE00000010', '2024-07-06 22:00:00'),
(204, 'INE00000010', '2024-07-25 22:00:00'),
(202, 'INE00000010', '2024-04-15 22:00:00'),
(201, 'INE00000010', '2024-10-02 22:00:00'),
(215, 'INE00000011', '2024-11-26 23:00:00'),
(209, 'INE00000011', '2024-04-07 22:00:00'),
(204, 'INE00000011', '2024-08-16 22:00:00'),
(202, 'INE00000011', '2024-04-30 22:00:00'),
(200, 'INE00000011', '2024-10-09 22:00:00'),
(219, 'INE00000012', '2024-11-17 23:00:00'),
(217, 'INE00000012', '2024-02-03 23:00:00'),
(214, 'INE00000012', '2024-10-23 22:00:00'),
(210, 'INE00000012', '2024-10-14 22:00:00'),
(209, 'INE00000012', '2024-07-05 22:00:00'),
(207, 'INE00000012', '2024-03-11 23:00:00'),
(206, 'INE00000012', '2024-06-09 22:00:00'),
(200, 'INE00000012', '2024-08-13 22:00:00'),
(219, 'INE00000013', '2024-10-08 22:00:00'),
(218, 'INE00000013', '2024-01-04 23:00:00'),
(217, 'INE00000013', '2024-09-26 22:00:00'),
(216, 'INE00000013', '2024-08-29 22:00:00'),
(215, 'INE00000013', '2024-02-07 23:00:00'),
(213, 'INE00000013', '2024-07-11 22:00:00'),
(210, 'INE00000013', '2024-05-01 22:00:00'),
(209, 'INE00000013', '2024-02-02 23:00:00'),
(206, 'INE00000013', '2024-06-12 22:00:00'),
(205, 'INE00000013', '2024-12-19 23:00:00'),
(203, 'INE00000013', '2024-07-02 22:00:00'),
(202, 'INE00000013', '2024-08-13 22:00:00'),
(201, 'INE00000013', '2024-07-29 22:00:00'),
(200, 'INE00000013', '2024-01-13 23:00:00'),
(217, 'INE00000014', '2024-06-12 22:00:00'),
(215, 'INE00000014', '2024-02-19 23:00:00'),
(212, 'INE00000014', '2024-05-01 22:00:00'),
(210, 'INE00000014', '2024-04-06 22:00:00'),
(209, 'INE00000014', '2024-04-30 22:00:00'),
(206, 'INE00000014', '2024-11-10 23:00:00'),
(205, 'INE00000014', '2024-04-24 22:00:00'),
(204, 'INE00000014', '2024-12-25 23:00:00'),
(202, 'INE00000014', '2024-12-26 23:00:00'),
(218, 'INE00000015', '2024-12-27 23:00:00'),
(215, 'INE00000015', '2024-12-26 23:00:00'),
(213, 'INE00000015', '2024-12-19 23:00:00'),
(212, 'INE00000015', '2024-11-17 23:00:00'),
(211, 'INE00000015', '2024-07-04 22:00:00'),
(210, 'INE00000015', '2024-11-25 23:00:00'),
(209, 'INE00000015', '2024-12-28 23:00:00'),
(207, 'INE00000015', '2024-04-04 22:00:00'),
(202, 'INE00000015', '2024-04-24 22:00:00'),
(219, 'INE00000016', '2024-10-17 22:00:00'),
(218, 'INE00000016', '2024-01-17 23:00:00'),
(217, 'INE00000016', '2024-11-01 23:00:00'),
(216, 'INE00000016', '2024-01-21 23:00:00'),
(213, 'INE00000016', '2024-10-09 22:00:00'),
(212, 'INE00000016', '2024-09-13 22:00:00'),
(210, 'INE00000016', '2024-03-12 23:00:00'),
(205, 'INE00000016', '2024-11-14 23:00:00'),
(204, 'INE00000016', '2024-10-09 22:00:00'),
(203, 'INE00000016', '2024-04-05 22:00:00'),
(201, 'INE00000016', '2024-12-27 23:00:00'),
(218, 'INE00000017', '2024-03-03 23:00:00'),
(215, 'INE00000017', '2024-11-19 23:00:00'),
(213, 'INE00000017', '2024-11-30 23:00:00'),
(212, 'INE00000017', '2024-12-04 23:00:00'),
(211, 'INE00000017', '2024-11-20 23:00:00'),
(209, 'INE00000017', '2024-08-31 22:00:00'),
(208, 'INE00000017', '2024-08-31 22:00:00'),
(207, 'INE00000017', '2024-05-05 22:00:00'),
(200, 'INE00000017', '2024-09-19 22:00:00'),
(215, 'INE00000018', '2024-07-27 22:00:00'),
(214, 'INE00000018', '2024-09-09 22:00:00'),
(212, 'INE00000018', '2024-10-03 22:00:00'),
(211, 'INE00000018', '2024-09-17 22:00:00'),
(208, 'INE00000018', '2024-04-17 22:00:00'),
(207, 'INE00000018', '2024-05-02 22:00:00'),
(205, 'INE00000018', '2024-10-18 22:00:00'),
(204, 'INE00000018', '2024-12-26 23:00:00'),
(200, 'INE00000018', '2024-07-19 22:00:00'),
(219, 'INE00000019', '2024-10-11 22:00:00'),
(218, 'INE00000019', '2024-04-01 22:00:00'),
(216, 'INE00000019', '2024-12-03 23:00:00'),
(214, 'INE00000019', '2024-11-12 23:00:00'),
(213, 'INE00000019', '2024-07-25 22:00:00'),
(212, 'INE00000019', '2024-03-26 23:00:00'),
(211, 'INE00000019', '2024-06-20 22:00:00'),
(210, 'INE00000019', '2024-08-25 22:00:00'),
(209, 'INE00000019', '2024-11-07 23:00:00'),
(207, 'INE00000019', '2024-04-23 22:00:00'),
(206, 'INE00000019', '2024-01-01 23:00:00'),
(205, 'INE00000019', '2024-01-27 23:00:00'),
(204, 'INE00000019', '2024-05-13 22:00:00'),
(203, 'INE00000019', '2024-08-12 22:00:00'),
(202, 'INE00000019', '2024-12-24 23:00:00'),
(219, 'INE00000020', '2024-01-26 23:00:00'),
(217, 'INE00000020', '2024-05-25 22:00:00'),
(216, 'INE00000020', '2024-10-13 22:00:00'),
(213, 'INE00000020', '2024-09-24 22:00:00'),
(212, 'INE00000020', '2024-04-23 22:00:00'),
(211, 'INE00000020', '2024-05-09 22:00:00'),
(206, 'INE00000020', '2024-11-06 23:00:00'),
(202, 'INE00000020', '2024-03-09 23:00:00'),
(201, 'INE00000020', '2024-05-20 22:00:00'),
(200, 'INE00000020', '2024-05-15 22:00:00'),
(210, 'INE00000021', '2024-09-15 22:00:00'),
(209, 'INE00000021', '2024-06-03 22:00:00'),
(208, 'INE00000021', '2024-12-29 23:00:00'),
(207, 'INE00000021', '2024-09-17 22:00:00'),
(206, 'INE00000021', '2024-08-02 22:00:00'),
(205, 'INE00000021', '2024-10-18 22:00:00'),
(204, 'INE00000021', '2024-03-23 23:00:00'),
(200, 'INE00000021', '2024-09-27 22:00:00'),
(219, 'INE00000022', '2024-01-11 23:00:00'),
(217, 'INE00000022', '2024-12-04 23:00:00'),
(215, 'INE00000022', '2024-07-18 22:00:00'),
(214, 'INE00000022', '2024-12-15 23:00:00'),
(211, 'INE00000022', '2024-02-24 23:00:00'),
(210, 'INE00000022', '2024-11-14 23:00:00'),
(207, 'INE00000022', '2024-12-03 23:00:00'),
(206, 'INE00000022', '2024-01-03 23:00:00'),
(205, 'INE00000022', '2024-04-07 22:00:00'),
(204, 'INE00000022', '2024-04-25 22:00:00'),
(203, 'INE00000022', '2024-10-12 22:00:00'),
(202, 'INE00000022', '2024-12-17 23:00:00'),
(217, 'INE00000023', '2024-06-22 22:00:00'),
(210, 'INE00000023', '2024-06-26 22:00:00'),
(209, 'INE00000023', '2024-01-03 23:00:00'),
(208, 'INE00000023', '2024-07-29 22:00:00'),
(207, 'INE00000023', '2024-11-13 23:00:00'),
(206, 'INE00000023', '2024-08-15 22:00:00'),
(204, 'INE00000023', '2024-07-04 22:00:00'),
(203, 'INE00000023', '2024-09-02 22:00:00'),
(201, 'INE00000023', '2024-11-02 23:00:00'),
(219, 'INE00000024', '2024-03-06 23:00:00'),
(216, 'INE00000024', '2024-05-22 22:00:00'),
(203, 'INE00000024', '2024-05-29 22:00:00'),
(201, 'INE00000024', '2024-11-16 23:00:00'),
(217, 'INE00000025', '2024-02-29 23:00:00'),
(214, 'INE00000025', '2024-03-09 23:00:00'),
(212, 'INE00000025', '2024-06-13 22:00:00'),
(211, 'INE00000025', '2024-09-11 22:00:00'),
(207, 'INE00000025', '2024-02-20 23:00:00'),
(205, 'INE00000025', '2024-08-06 22:00:00'),
(203, 'INE00000025', '2024-07-31 22:00:00'),
(202, 'INE00000025', '2024-02-12 23:00:00'),
(201, 'INE00000025', '2024-10-31 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `numero_etudiant` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_eval` int DEFAULT NULL,
  `note` float NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  KEY `evaluation` (`id_eval`),
  KEY `etudiant` (`numero_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`numero_etudiant`, `id_eval`, `note`, `commentaire`) VALUES
('INE00000003', 13, 11, ''),
('INE00000003', 14, 6, ''),
('INE00000003', 15, 15, ''),
('INE00000003', 16, 5, ''),
('INE00000003', 17, 9, ''),
('INE00000003', 18, 7, ''),
('INE00000003', 19, 13, ''),
('INE00000003', 20, 20, ''),
('INE00000003', 21, 17, ''),
('INE00000003', 28, 18, ''),
('INE00000003', 29, 12, ''),
('INE00000003', 30, 5, ''),
('INE00000003', 31, 9, ''),
('INE00000003', 32, 11, ''),
('INE00000003', 33, 18, ''),
('INE00000003', 34, 20, ''),
('INE00000003', 35, 13, ''),
('INE00000003', 36, 7, ''),
('INE00000003', 40, 5, ''),
('INE00000003', 41, 17, ''),
('INE00000003', 42, 9, ''),
('INE00000003', 43, 13, ''),
('INE00000003', 44, 5, ''),
('INE00000003', 45, 6, ''),
('INE00000003', 55, 8, ''),
('INE00000003', 56, 18, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeurs`
--

INSERT INTO `professeurs` (`id_prof`, `nom`, `prenom`, `email`, `identifiant`, `motdepasse`) VALUES
(1, 'universite', '', '', '', '$2y$10$0DiJHPCgU1PJI'),
(2, 'Durand', 'Marc', 'marc.durand@example.com', 'durand1', '$2y$10$0DiJHPCgU1PJI'),
(3, 'Petit', 'Sophie', 'sophie.petit@example.com', 'petit2', '$2y$10$0DiJHPCgU1PJI'),
(4, 'Roux', 'Jean', 'jean.roux@example.com', 'roux3', '$2y$10$0DiJHPCgU1PJI'),
(5, 'Lemoine', 'Claire', 'claire.lemoine@example.com', 'lemoine4', '$2y$10$0DiJHPCgU1PJI'),
(6, 'Garnier', 'Paul', 'paul.garnier@example.com', 'garnier5', '$2y$10$0DiJHPCgU1PJI'),
(7, 'Morel', 'Julie', 'julie.morel@example.com', 'morel6', '$2y$10$0DiJHPCgU1PJI'),
(8, 'Lambert', 'Pierre', 'pierre.lambert@example.com', 'lambert7', '$2y$10$0DiJHPCgU1PJI'),
(9, 'Chevalier', 'Anne', 'anne.chevalier@example.com', 'chevalier8', '$2y$10$0DiJHPCgU1PJI'),
(10, 'Muller', 'Thomas', 'thomas.muller@example.com', 'muller9', '$2y$10$0DiJHPCgU1PJI'),
(11, 'Blanc', 'Camille', 'camille.blanc@example.com', 'blanc10', '$2y$10$0DiJHPCgU1PJI'),
(12, 'Fontaine', 'Luc', 'luc.fontaine@example.com', 'fontaine11', '$2y$10$0DiJHPCgU1PJI'),
(13, 'Perrin', 'Elise', 'elise.perrin@example.com', 'perrin12', '$2y$10$0DiJHPCgU1PJI'),
(14, 'Faure', 'Antoine', 'antoine.faure@example.com', 'faure13', '$2y$10$0DiJHPCgU1PJI'),
(15, 'Simon', 'Laura', 'laura.simon@example.com', 'simon14', '$2y$10$0DiJHPCgU1PJI'),
(16, 'Richard', 'Hugo', 'hugo.richard@example.com', 'richard15', '$2y$10$0DiJHPCgU1PJI');

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
