-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 mai 2024 à 14:45
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `resources_relationnelles`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `ACT_ID` int(11) NOT NULL COMMENT 'Identifiant de l''activité',
  `ACT_DUREE` int(11) DEFAULT NULL COMMENT 'Durée de l''activité',
  `ACT_RES_ID` int(11) NOT NULL COMMENT 'Identifiant de la ressource'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des activités';

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`ACT_ID`, `ACT_DUREE`, `ACT_RES_ID`) VALUES
(1, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `administrer`
--

CREATE TABLE `administrer` (
  `ADM_ID` int(11) NOT NULL COMMENT 'Identifiant de la table Administrer',
  `ADM_MOTIF` varchar(50) DEFAULT NULL COMMENT 'Motif',
  `ADM_DATE` date DEFAULT NULL COMMENT 'Date de la création',
  `ADM_ETAT` varchar(1) DEFAULT NULL COMMENT 'État',
  `ADM_ID_UTI` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `ADM_ID_ADM` int(11) NOT NULL COMMENT 'Identifiant de l''administrateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrer`
--

INSERT INTO `administrer` (`ADM_ID`, `ADM_MOTIF`, `ADM_DATE`, `ADM_ETAT`, `ADM_ID_UTI`, `ADM_ID_ADM`) VALUES
(1, 'Désactivation du compte Johann', '2024-01-22', 'I', 3, 3),
(2, 'Réactivation du compte Johann', '2024-01-22', 'A', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `APP_ID` int(11) NOT NULL COMMENT 'Identifiant de la table Appartenir',
  `APP_ID_REL` int(11) NOT NULL COMMENT 'Identifiant de la relation',
  `APP_ID_RES` int(11) NOT NULL COMMENT 'Identifiant de la ressource'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de liaison entre les relations et les ressources';

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`APP_ID`, `APP_ID_REL`, `APP_ID_RES`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 4),
(4, 2, 5),
(7, 2, 7);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `CAT_ID` int(11) NOT NULL COMMENT 'Identifiant de la catégorie',
  `CAT_NOM` varchar(50) DEFAULT NULL COMMENT 'Nom de la catégorie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`CAT_ID`, `CAT_NOM`) VALUES
(1, 'Intelligence émotionnelle'),
(2, 'Qualité de vie'),
(3, 'Développement personnel');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `COM_ID` int(11) NOT NULL COMMENT 'Identifiant du commentaire',
  `COM_CONTENU` text DEFAULT NULL COMMENT 'Contenu du commentaire',
  `COM_ID_COMMENTAIRE_REPONDU` int(11) DEFAULT NULL COMMENT 'Identifiant du commentaire répondu',
  `COM_VISIBILITE` varchar(1) DEFAULT NULL COMMENT 'Visibilité du commentaire',
  `COM_UTI_ID` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `COM_RES_ID` int(11) NOT NULL COMMENT 'Identifiant de la ressource',
  `COM_TSP_CRE` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Timestamp de création du commentaire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des commentaires';

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`COM_ID`, `COM_CONTENU`, `COM_ID_COMMENTAIRE_REPONDU`, `COM_VISIBILITE`, `COM_UTI_ID`, `COM_RES_ID`, `COM_TSP_CRE`) VALUES
(1, 'Bravo pour ta ressource Johann !', NULL, 'A', 3, 1, '2024-02-09 12:28:05'),
(2, 'Ceci est un jolie commentaire :D', NULL, 'A', 27, 2, '2024-03-07 07:25:16'),
(3, 'Et ça c\'est ma réponse', 2, 'A', 27, 2, '2024-03-07 07:25:32'),
(6, 'Merci pour cette ressource Jean, elle est très utile !', NULL, 'A', 42, 4, '2024-04-01 08:48:56'),
(7, 'Mais de rien et merci pour ton commentaire Michel !', 6, 'A', 41, 4, '2024-04-01 08:50:12'),
(8, 'Super ! ', NULL, 'A', 40, 4, '2024-04-01 08:58:53'),
(9, 'J\'apprécie cette vidéo.', NULL, 'A', 40, 3, '2024-04-01 09:01:04'),
(10, 'Je ne te permet pas ! ', 1, 'A', 27, 1, '2024-04-05 09:26:06'),
(11, 'Nouveau commentaire', NULL, 'I', 27, 5, '2024-05-03 07:04:23'),
(24, 'Test intégration commentaire ajouté', NULL, 'A', 3, 1, '2024-05-03 11:11:08'),
(25, 'Test intégration commentaire ajouté', NULL, 'A', 3, 1, '2024-05-03 11:14:13'),
(26, 'Test intégration commentaire ajouté', NULL, 'A', 3, 1, '2024-05-03 11:32:47'),
(39, 'Test intégration commentaire ajouté', NULL, 'A', 3, 1, '2024-05-27 07:01:17'),
(40, 'Test intégration commentaire ajouté', NULL, 'A', 3, 1, '2024-05-28 07:40:37'),
(41, 'Test commentaire contenu', NULL, 'A', 3, 1, '2024-05-28 10:31:32');

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

CREATE TABLE `discussion` (
  `DIS_ID` int(11) NOT NULL COMMENT 'Identifiant de la discussion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des discussions';

-- --------------------------------------------------------

--
-- Structure de la table `echanger`
--

CREATE TABLE `echanger` (
  `ECH_ID` int(11) NOT NULL COMMENT 'Identifiant de l''échange',
  `ECH_CON` text DEFAULT NULL COMMENT 'Contenu de l''échange',
  `ECH_ACT_ID` int(11) NOT NULL COMMENT 'Identifiant de l''activité',
  `ECH_UTI_ID` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de liaison entre les activités et les utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `exploiter`
--

CREATE TABLE `exploiter` (
  `EXP_ID` int(11) NOT NULL COMMENT 'Identifiant de la table EXPLOITER',
  `EXP_EXPLOITE` varchar(1) DEFAULT NULL COMMENT 'Ressource exploitée O/N',
  `EXP_FAVORISE` varchar(1) DEFAULT NULL COMMENT 'Ressource en favoris O/N',
  `EXP_RES_ID` int(11) NOT NULL COMMENT 'Identifiant de la ressource',
  `EXP_UTI_ID` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de liaison entre les utilisateurs et les ressources';

--
-- Déchargement des données de la table `exploiter`
--

INSERT INTO `exploiter` (`EXP_ID`, `EXP_EXPLOITE`, `EXP_FAVORISE`, `EXP_RES_ID`, `EXP_UTI_ID`) VALUES
(1, 'O', 'O', 1, 3),
(2, 'N', 'N', 2, 27),
(3, 'N', 'O', 4, 40),
(4, 'N', 'O', 4, 41),
(5, 'N', 'O', 4, 42),
(8, 'O', 'O', 7, 40),
(9, 'N', 'O', 6, 40);

-- --------------------------------------------------------

--
-- Structure de la table `factories`
--

CREATE TABLE `factories` (
  `id` int(9) NOT NULL,
  `name` varchar(31) NOT NULL,
  `uid` varchar(31) NOT NULL,
  `class` varchar(63) NOT NULL,
  `icon` varchar(31) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `factories`
--

INSERT INTO `factories` (`id`, `name`, `uid`, `class`, `icon`, `summary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test Factory', 'test001', 'Factories\\Tests\\NewFactory', 'fas fa-puzzle-piece', 'Longer sample text for testing', NULL, '2024-05-29 12:07:39', '2024-05-29 12:07:39'),
(2, 'Widget Factory', 'widget', 'Factories\\Tests\\WidgetPlant', 'fas fa-puzzle-piece', 'Create widgets in your factory', NULL, NULL, NULL),
(3, 'Evil Factory', 'evil-maker', 'Factories\\Evil\\MyFactory', 'fas fa-book-dead', 'Abandon all hope, ye who enter here', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(14, '2020-02-22-222222', 'Tests\\Support\\Database\\Migrations\\ExampleMigration', 'tests', 'Tests\\Support', 1716984459, 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `REL_ID` int(11) NOT NULL COMMENT 'Identifiant de la relation',
  `REL_TYPE` varchar(50) DEFAULT NULL COMMENT 'Type de relation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`REL_ID`, `REL_TYPE`) VALUES
(1, 'Soi'),
(2, 'Amis et communautés'),
(3, 'Famille : Parents / Enfants / Fratrie');

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `RES_ID` int(11) NOT NULL COMMENT 'Identifiant de la ressource',
  `RES_NOM` varchar(50) DEFAULT NULL COMMENT 'Nom de la ressource',
  `RES_VALIDE` varchar(1) DEFAULT NULL COMMENT 'Ressource validée O/N',
  `RES_ETAT` varchar(1) DEFAULT NULL COMMENT 'État de la ressource',
  `RES_CONTENU` text DEFAULT NULL COMMENT 'Contenu de la ressource',
  `RES_TYPE` varchar(50) DEFAULT NULL COMMENT 'Type de la ressource',
  `RES_DATE_CREATION` date DEFAULT NULL COMMENT 'Date de création de la ressource',
  `RES_DATE_MODIFICATION` date DEFAULT NULL COMMENT 'Date de modification de la ressource',
  `RES_UTI_ID` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `RES_CAT_ID` int(11) NOT NULL COMMENT 'Identifiant de la catégorie de ressource'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table des ressources';

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`RES_ID`, `RES_NOM`, `RES_VALIDE`, `RES_ETAT`, `RES_CONTENU`, `RES_TYPE`, `RES_DATE_CREATION`, `RES_DATE_MODIFICATION`, `RES_UTI_ID`, `RES_CAT_ID`) VALUES
(1, 'Reconnaître ses émotions', 'O', 'A', 'L’objectif de cet exercice est de reconnaître les émotions sur soi. Pour ce faire, nous noterons dans un\r\npetit cahier prévu à cet effet, à des moments prédéfinis de la journée, comment nous nous sentons\r\némotionnellement. Quelle émotion nous habite ? Cette émotion est-elle positive ou négative ? Avec\r\nquelle force ? Quel a été le facteur déclencheur ?\r\nNous répèterons la démarche durant une semaine.\r\nAprès une semaine, reprenons nos notes et identifions avec un marqueur les émotions que nous\r\nressentons le plus souvent, si elles sont positives ou négatives et quel type de facteur déclencheur est\r\nobservé le plus souvent.\r\nPour conclure, demandons-nous si nos émotions auraient pu être différentes et si la situation en aurait\r\nété changée', 'Exercices / Atelier', '2024-01-22', '2024-01-22', 3, 1),
(2, 'Son - Barre de métal', 'O', 'A', 'https://www.youtube.com/watch?v=1U2CPg42_OM', 'Vidéo', '2024-03-05', '2024-03-05', 3, 2),
(3, 'Emission ARTE : Travail | Travail, Salaire', 'O', 'A', 'https://www.youtube.com/watch?v=CuWpuhBEr_Y', 'Vidéo', '2024-03-05', '2024-03-05', 41, 2),
(4, 'Partager des moments de vie en famille', 'O', 'A', 'Carte défi : lors de votre prochaine sortie, refuser de boire de l’alcool et observer les réactions de vos\r\namis. Assumez votre choix et notez les émotions ressenties.', 'Défi', '2024-04-01', '2024-04-01', 41, 3),
(5, 'Le rire au travail et l’éthique', 'O', 'A', 'Dans cet article, nous souhaitons apporter des éléments de réponse à la question du rire dans les situations professionnelles. Notre objectif est d’orienter les travaux de recherche portant plus globalement sur l’éthique au travail, mais aussi de fournir des repères pour le développement des pratiques de management.', 'Defi', '2024-04-02', '2024-04-02', 40, 2),
(6, 'Mieux s’informer pour être un citoyen avisé', 'O', 'A', 'Comme parents, comment pouvez-vous amener votre enfant à mieux s’informer? Les trois compétences clés à développer sont les suivantes : vérifier la source, vérifier l’affirmation et retracer l’information à la source', 'Defi', '2024-04-02', '2024-04-02', 40, 1),
(7, 'titre', 'O', 'A', '<p>zerez<strong>aezae</strong></p>', 'Document informatif', '2024-04-02', '2024-04-02', 40, 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `ROL_ID` int(11) NOT NULL COMMENT 'Identifiant du rôle',
  `ROL_NOM` varchar(50) DEFAULT NULL COMMENT 'Libellé du rôle'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ROL_ID`, `ROL_NOM`) VALUES
(1, 'Administrateur'),
(2, 'Modérateur'),
(3, 'Utilisateur classique');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `UTI_ID` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `UTI_CIVILITE` varchar(5) DEFAULT NULL COMMENT 'Civilité de l''utilisateur',
  `UTI_NOM` varchar(50) DEFAULT NULL COMMENT 'Nom de l''utilisateur',
  `UTI_PRENOM` varchar(50) DEFAULT NULL COMMENT 'Prénom de l''utilisateur',
  `UTI_ADRESSE` text DEFAULT NULL COMMENT 'Adresse de l''utilisateur',
  `UTI_CP` varchar(7) DEFAULT NULL COMMENT 'Code postal de l''utilisateur',
  `UTI_VILLE` varchar(50) DEFAULT NULL COMMENT 'Ville de l''utilisateur',
  `UTI_NUM_TEL` varchar(20) DEFAULT NULL COMMENT 'Numéro de téléphone de l''utilisateur',
  `UTI_MAIL` varchar(255) DEFAULT NULL COMMENT 'Mail de l''utilisateur',
  `UTI_ETAT` varchar(1) DEFAULT NULL COMMENT 'État de l''utilisateur',
  `UTI_MDP` varchar(60) DEFAULT NULL COMMENT 'Mot de passe de l''utilisateur',
  `UTI_DATE_CREATION` date DEFAULT NULL COMMENT 'Date de création de l''utilisateur',
  `UTI_DATE_NAISSANCE` date DEFAULT NULL COMMENT 'Date de naissance l''utilisateur',
  `UTI_ID_ROL` int(11) NOT NULL COMMENT 'Identifiant du rôle',
  `UTI_ACT_ID` int(11) DEFAULT NULL COMMENT 'Identifiant de l''activité'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`UTI_ID`, `UTI_CIVILITE`, `UTI_NOM`, `UTI_PRENOM`, `UTI_ADRESSE`, `UTI_CP`, `UTI_VILLE`, `UTI_NUM_TEL`, `UTI_MAIL`, `UTI_ETAT`, `UTI_MDP`, `UTI_DATE_CREATION`, `UTI_DATE_NAISSANCE`, `UTI_ID_ROL`, `UTI_ACT_ID`) VALUES
(3, 'M', 'DIETRICH', 'Johann', '2 allées des Foulons', '67380', 'Lingolsheim', '060606060606', 'jodiet@hotmail.fr', 'A', 'kartoffel', '2024-01-22', '2003-01-01', 1, NULL),
(27, 'M', 'MATHIS', 'Florian', '11 rue du commandant l\'Herminiere', '67640', 'Fegersheim', '0641243833', 'florian.mathis@viacesi.fr', 'A', '$2y$10$T2eEbhEelT1DZVigBmVrI.yTnE6fse.Uvl/emAVmM6v0zprRlYpVS', '2024-02-09', '1999-03-20', 1, NULL),
(40, 'M', 'VONVILLE', 'Clet', '68 Rue du Chemin de Fer', '68108', 'Grentzingen', '0606060606', 'vonville.clet@gmail.com', 'A', '$2y$10$T2eEbhEelT1DZVigBmVrI.yTnE6fse.Uvl/emAVmM6v0zprRlYpVS', '2024-02-09', '2001-01-21', 2, NULL),
(41, 'M', 'BERNARD', 'Jean', '110 route de Bischwiller', '67300 ', 'Schiltigheim', '0645953831', 'jean.bernard@gmail.com', 'A', '$2y$10$T2eEbhEelT1DZVigBmVrI.yTnE6fse.Uvl/emAVmM6v0zprRlYpVS', '2024-02-09', '1980-01-01', 2, NULL),
(42, 'M', 'SCHMITT', 'Michel', '37 route de Bischwiller', '67800 ', '67800 ', '0695305813', 'michel.schmitt@gmail.com', 'A', '$2y$10$T2eEbhEelT1DZVigBmVrI.yTnE6fse.Uvl/emAVmM6v0zprRlYpVS', '2024-02-09', '1998-03-02', 3, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`ACT_ID`),
  ADD KEY `FK_Activite_RESSOURCES` (`ACT_RES_ID`);

--
-- Index pour la table `administrer`
--
ALTER TABLE `administrer`
  ADD PRIMARY KEY (`ADM_ID`),
  ADD KEY `FK_Utilisateur_ADMINISTRER` (`ADM_ID_UTI`),
  ADD KEY `FK_Administrateur_ADMINISTRER` (`ADM_ID_ADM`);

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`APP_ID`),
  ADD KEY `FK_Appartenir_RELATION` (`APP_ID_REL`),
  ADD KEY `FK_Appartenir_RESSOURCE` (`APP_ID_RES`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`COM_ID`),
  ADD KEY `FK_Commentaire_UTILISATEUR` (`COM_UTI_ID`),
  ADD KEY `FK_Commentaire_RESSOURCE` (`COM_RES_ID`);

--
-- Index pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`DIS_ID`);

--
-- Index pour la table `echanger`
--
ALTER TABLE `echanger`
  ADD PRIMARY KEY (`ECH_ID`),
  ADD KEY `FK_Echanger_UTILISATEUR` (`ECH_UTI_ID`),
  ADD KEY `FK_Echanger_ACTIVITES` (`ECH_ACT_ID`);

--
-- Index pour la table `exploiter`
--
ALTER TABLE `exploiter`
  ADD PRIMARY KEY (`EXP_ID`),
  ADD KEY `FK_Exploite_UTILISATEUR` (`EXP_UTI_ID`);

--
-- Index pour la table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `uid` (`uid`),
  ADD KEY `deleted_at_id` (`deleted_at`,`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`REL_ID`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`RES_ID`),
  ADD KEY `FK_Ressource_UTILISATEUR` (`RES_UTI_ID`),
  ADD KEY `FK_Ressource_CATEGORIE` (`RES_CAT_ID`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ROL_ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`UTI_ID`),
  ADD KEY `FK_Utilisateur_ROLE` (`UTI_ID_ROL`),
  ADD KEY `FK_Utilisateur_ACTIVITE` (`UTI_ACT_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `ACT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''activité', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `administrer`
--
ALTER TABLE `administrer`
  MODIFY `ADM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la table Administrer', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `appartenir`
--
ALTER TABLE `appartenir`
  MODIFY `APP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la table Appartenir', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la catégorie', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `COM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du commentaire', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `DIS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la discussion';

--
-- AUTO_INCREMENT pour la table `echanger`
--
ALTER TABLE `echanger`
  MODIFY `ECH_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''échange';

--
-- AUTO_INCREMENT pour la table `exploiter`
--
ALTER TABLE `exploiter`
  MODIFY `EXP_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la table EXPLOITER', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `REL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la relation', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `RES_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la ressource', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `ROL_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du rôle', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `UTI_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''utilisateur', AUTO_INCREMENT=53;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `FK_Activite_RESSOURCE` FOREIGN KEY (`ACT_ID`) REFERENCES `ressource` (`RES_ID`),
  ADD CONSTRAINT `FK_Activite_RESSOURCES` FOREIGN KEY (`ACT_RES_ID`) REFERENCES `ressource` (`RES_ID`);

--
-- Contraintes pour la table `administrer`
--
ALTER TABLE `administrer`
  ADD CONSTRAINT `FK_Administrateur_ADMINISTRER` FOREIGN KEY (`ADM_ID_ADM`) REFERENCES `utilisateur` (`UTI_ID`),
  ADD CONSTRAINT `FK_Utilisateur_ADMINISTRER` FOREIGN KEY (`ADM_ID_UTI`) REFERENCES `utilisateur` (`UTI_ID`);

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `FK_Appartenir_RELATION` FOREIGN KEY (`APP_ID_REL`) REFERENCES `relation` (`REL_ID`),
  ADD CONSTRAINT `FK_Appartenir_RESSOURCE` FOREIGN KEY (`APP_ID_RES`) REFERENCES `ressource` (`RES_ID`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_Commentaire_RESSOURCE` FOREIGN KEY (`COM_RES_ID`) REFERENCES `ressource` (`RES_ID`),
  ADD CONSTRAINT `FK_Commentaire_UTILISATEUR` FOREIGN KEY (`COM_UTI_ID`) REFERENCES `utilisateur` (`UTI_ID`);

--
-- Contraintes pour la table `echanger`
--
ALTER TABLE `echanger`
  ADD CONSTRAINT `FK_Echanger_ACTIVITE` FOREIGN KEY (`ECH_ACT_ID`) REFERENCES `activite` (`ACT_ID`),
  ADD CONSTRAINT `FK_Echanger_ACTIVITES` FOREIGN KEY (`ECH_ACT_ID`) REFERENCES `activite` (`ACT_ID`),
  ADD CONSTRAINT `FK_Echanger_UTILISATEUR` FOREIGN KEY (`ECH_UTI_ID`) REFERENCES `utilisateur` (`UTI_ID`);

--
-- Contraintes pour la table `exploiter`
--
ALTER TABLE `exploiter`
  ADD CONSTRAINT `FK_Exploite_RESSOURCE` FOREIGN KEY (`EXP_RES_ID`) REFERENCES `ressource` (`RES_ID`),
  ADD CONSTRAINT `FK_Exploite_UTILISATEUR` FOREIGN KEY (`EXP_UTI_ID`) REFERENCES `utilisateur` (`UTI_ID`);

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `FK_Ressource_CATEGORIE` FOREIGN KEY (`RES_CAT_ID`) REFERENCES `categorie` (`CAT_ID`),
  ADD CONSTRAINT `FK_Ressource_UTILISATEUR` FOREIGN KEY (`RES_UTI_ID`) REFERENCES `utilisateur` (`UTI_ID`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_ACTIVITE` FOREIGN KEY (`UTI_ACT_ID`) REFERENCES `activite` (`ACT_ID`),
  ADD CONSTRAINT `FK_Utilisateur_ROLE` FOREIGN KEY (`UTI_ID_ROL`) REFERENCES `role` (`ROL_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
