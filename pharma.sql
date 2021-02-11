-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 31 jan. 2021 à 10:18
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pharma`
--

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL,
  `date_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`id`, `motif`, `entre`, `sortie`, `solde`, `date_at`) VALUES
(7, 'Dépôt', 25000000, 0, 25000000, '2020-10-04'),
(8, 'Livraison: Doliprane', 0, 625000, -625000, '2020-10-04'),
(9, 'Livraison: Efferalgan', 0, 825000, -825000, '2020-10-04'),
(11, 'Vente: Efferalgan', 16500, 0, 16500, '2020-10-04'),
(12, 'Achat de stylo', 0, 3000, -3000, '2020-10-04'),
(13, 'Vente: Efferalgan', 16500, 0, 16500, '2020-10-04'),
(14, 'Vente: Paracétamol', 1000, 0, 1000, '2020-10-04'),
(15, 'logement', 0, 50000, -50000, '2020-10-04'),
(16, 'don', 500000, 0, 500000, '2020-10-04'),
(17, 'Vente: Doliprane', 12500, 0, 12500, '2020-12-13'),
(18, 'Vente: Efferalgan', 33000, 0, 33000, '2020-12-13'),
(19, 'Vente: Paracétamol', 1000, 0, 1000, '2020-12-13');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `numero`, `prenom`, `nom`, `adresse`, `telephone`) VALUES
(1, 'C001', 'Client au comptant', 'Client au comptant', NULL, NULL),
(2, 'C002', 'pharmacie lafiab', 'pharmacie lafiab', 'faladjie', '56454745');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int(11) NOT NULL,
  `date_commande_at` datetime NOT NULL,
  `produits` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_35D4282CFB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `valider`, `reference`, `date_commande_at`, `produits`) VALUES
(11, 3, 1, 1, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:1;a:5:{s:8:\"quantite\";i:500;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";i:1650;}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),
(12, 3, 0, 2, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:3;a:5:{s:8:\"quantite\";i:500;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";i:1250;}}s:13:\"idFournisseur\";i:2;s:17:\"numeroFournisseur\";s:4:\"F002\";s:14:\"nomFournisseur\";s:14:\"Oumar Sangaré\";}'),
(13, 3, 0, 3, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:4;a:4:{s:8:\"quantite\";i:700;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200923200627', '2020-09-23 20:06:54', 1310),
('DoctrineMigrations\\Version20200923202224', '2020-09-23 20:23:04', 1301),
('DoctrineMigrations\\Version20200924173200', '2020-09-24 17:32:25', 8619),
('DoctrineMigrations\\Version20200926093535', '2020-09-26 09:35:56', 2979),
('DoctrineMigrations\\Version20201003210630', '2020-10-03 21:06:55', 4589),
('DoctrineMigrations\\Version20201003225541', '2020-10-03 22:56:05', 1780),
('DoctrineMigrations\\Version20201004091306', '2020-10-04 09:18:31', 719),
('DoctrineMigrations\\Version20201004093221', '2020-10-04 09:32:33', 1282),
('DoctrineMigrations\\Version20201004105130', '2020-10-04 10:51:42', 1356);

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance_at` datetime NOT NULL,
  `lieu_naissance` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_embauche_at` datetime NOT NULL,
  `fonction` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_assurance_maladie` int(11) DEFAULT NULL,
  `type_contrat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_contrat_at` datetime NOT NULL,
  `situation_familiale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_enfant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id`, `matricule`, `nom`, `prenom`, `date_naissance_at`, `lieu_naissance`, `adresse`, `nationalite`, `civilite`, `date_embauche_at`, `fonction`, `telephone`, `email`, `categorie`, `numero_assurance_maladie`, `type_contrat`, `date_contrat_at`, `situation_familiale`, `nombre_enfant`) VALUES
(1, 'EMP001', 'Diakité', 'Yoro', '1990-12-15 00:00:00', 'Bamako', 'Kalaban Coro', 'Malienne', 'Monsieur', '2020-09-24 00:00:00', 'Directeur Commercial', '76201526', 'yoro@gmail.com', 'Permanent', 258, 'CDI', '2020-09-24 00:00:00', 'Marié(e)', 2),
(2, 'EMP002', 'Dembélé', 'Mamourou', '1990-01-01 00:00:00', 'Sikasso', 'Bamako Coura', 'Malienne', 'Monsieur', '2019-10-03 00:00:00', 'Vendeur', '78211254', 'mamourou@gmail.com', 'Vaccataire', 2, 'CDD', '2019-10-03 00:00:00', 'Madame', 0),
(3, 'M001', 'MAMOU', 'Awa', '1984-01-01 00:00:00', 'Bamako', 'LAFIABOUGOU', 'Malienne', 'Mademoiselle', '2020-10-02 00:00:00', 'Secretaire', '45655214', 'awa@gmail.com', 'Permanent', 2, 'CDI', '2020-10-02 00:00:00', 'Madame', 0),
(4, 'M002', 'Mama', 'eve', '1990-03-04 00:00:00', 'bangui', 'BAMBARI', 'Centrafricaine', 'Madame', '2020-10-04 00:00:00', 'comptable', '56854785', 'mama@yahoo.fr', 'Vaccataire', 3, 'CDD', '2020-10-04 00:00:00', 'Marié(e)', 1);

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

DROP TABLE IF EXISTS `famille`;
CREATE TABLE IF NOT EXISTS `famille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `familles`
--

DROP TABLE IF EXISTS `familles`;
CREATE TABLE IF NOT EXISTS `familles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `familles`
--

INSERT INTO `familles` (`id`, `code`, `nom`) VALUES
(1, 'F001', 'Générique'),
(3, 'F002', 'Famille 2'),
(4, 'f004', 'aspic');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `prenom`, `nom`, `numero`, `adresse`, `telephone`) VALUES
(1, 'Cheiknei', 'Diawara', 'F001', 'Tomikorobougou', '76201544'),
(2, 'Oumar', 'Sangaré', 'F002', 'Badjalan 1', '75402062'),
(3, 'mousa', 'JEAN', 'f003', 'ACI2000', '45585745');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille_id` int(11) DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unitaire` double NOT NULL,
  `date_peremption_at` datetime NOT NULL,
  `nom_fabricant` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BE2DDF8C97A77B84` (`famille_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `famille_id`, `code`, `designation`, `prix_unitaire`, `date_peremption_at`, `nom_fabricant`, `forme`, `quantite`) VALUES
(1, 1, 'EFF', 'Efferalgan', 1650, '2021-09-25 00:00:00', 'Pharmacie du Mali', 'Sirop', 860),
(3, 1, 'DOL', 'Doliprane', 1250, '2021-09-26 00:00:00', 'Pharmacie du Mali', 'Sirop', 5480),
(4, 3, 'PARA', 'Paracétamol', 100, '2021-10-04 00:00:00', 'Pharmacie du Mali', 'Sirop', 980);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salaires`
--

DROP TABLE IF EXISTS `salaires`;
CREATE TABLE IF NOT EXISTS `salaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) DEFAULT NULL,
  `nombre_heure` int(11) DEFAULT NULL,
  `taux_horaire` double DEFAULT NULL,
  `salaire_base` int(11) NOT NULL,
  `prime` int(11) DEFAULT NULL,
  `avantage` int(11) DEFAULT NULL,
  `salaire_brut` int(11) NOT NULL,
  `salaire_net` int(11) NOT NULL,
  `cotisation_social` int(11) NOT NULL,
  `mois` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_718524441B65292` (`employe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salaires`
--

INSERT INTO `salaires` (`id`, `employe_id`, `nombre_heure`, `taux_horaire`, `salaire_base`, `prime`, `avantage`, `salaire_brut`, `salaire_net`, `cotisation_social`, `mois`) VALUES
(5, 1, 0, 0, 1500000, 25000, 35000, 1560000, 1482000, 78000, 'Octobre 2020'),
(6, 2, 240, 2000, 20000, 8000, 1500, 29500, 28025, 1475, 'Octobre 2020'),
(7, 1, 240, 2000, 500000, 50000, 15000, 565000, 536750, 28250, 'Octobre 2020'),
(8, 4, 240, 2000, 500000, 1500, 50000, 551500, 523925, 27575, 'Octobre 2020'),
(9, 2, 240, 2000, 20000, 1500, 1500, 23000, 21850, 1150, 'Décembre 2020'),
(10, 3, 240, 2000, 1500000, 8, 35000, 1535008, 1458257, 76750, 'Décembre 2020');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `situation` int(11) DEFAULT NULL,
  `date_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `code`, `designation`, `entre`, `sortie`, `situation`, `date_at`) VALUES
(1, 'DOL', 'Doliprane', 500, 0, 5497, '2020-10-04'),
(2, 'EFF', 'Efferalgan', 500, 0, 900, '2020-10-04'),
(4, 'EFF', 'Efferalgan', 0, 10, 890, '2020-10-04'),
(5, 'EFF', 'Efferalgan', 0, 10, 880, '2020-10-04'),
(6, 'PARA', 'Paracétamol', 0, 10, 990, '2020-10-04'),
(7, 'DOL', 'Doliprane', 0, 10, 5480, '2020-12-13'),
(8, 'EFF', 'Efferalgan', 0, 20, 860, '2020-12-13'),
(9, 'PARA', 'Paracétamol', 0, 10, 980, '2020-12-13');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_497B315ED37CC8AC` (`nom_utilisateur`),
  KEY `IDX_497B315E1B65292` (`employe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `roles`, `password`, `email`, `employe_id`, `role`) VALUES
(3, 'admin1', '[]', '$2y$12$jSC271Koo3DeX1d.5CTCbu/vnp3flxezlqd77KYqQ1gWpfXJ5ArVq', 'admin1@gmail.com', NULL, 'ROLE_ADMIN'),
(4, 'admin2', '[]', '$2y$12$V6om2OnWINYlseY.xxaBHeUMCgfO4m2L9MvOOLOHRg2OPdsSgMB22', 'admin2@gmail.com', NULL, 'ROLE_PHARMACIEN');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int(11) NOT NULL,
  `date_vente_at` datetime NOT NULL,
  `produits` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_64EC489AFB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `utilisateur_id`, `valider`, `reference`, `date_vente_at`, `produits`) VALUES
(3, 3, 1, 1, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(4, 3, 1, 2, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),
(5, 3, 1, 3, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),
(6, 3, 1, 4, '2020-12-13 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:3;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";s:4:\"1250\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"12500\";s:3:\"net\";s:5:\"12500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(7, 3, 1, 5, '2020-12-13 00:00:00', 'a:6:{s:8:\"produits\";a:2:{i:1;a:9:{s:8:\"quantite\";i:20;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"33000\";s:3:\"net\";s:5:\"33000\";}i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282CFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C97A77B84` FOREIGN KEY (`famille_id`) REFERENCES `familles` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `salaires`
--
ALTER TABLE `salaires`
  ADD CONSTRAINT `FK_718524441B65292` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_497B315E1B65292` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `FK_64EC489AFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
