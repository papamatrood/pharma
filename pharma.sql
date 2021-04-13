-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 avr. 2021 à 16:35
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pharma`
--

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

CREATE TABLE `caisse` (
  `id` int(11) NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL,
  `date_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`id`, `motif`, `entre`, `sortie`, `solde`, `date_at`, `reference`) VALUES
(7, 'Dépôt', 25000000, 0, 25000000, '2020-10-04', NULL),
(8, 'Livraison: Doliprane', 0, 625000, -625000, '2020-10-04', NULL),
(9, 'Livraison: Efferalgan', 0, 825000, -825000, '2020-10-04', NULL),
(11, 'Vente: Efferalgan', 16500, 0, 16500, '2020-10-04', 1),
(12, 'Achat de stylo', 0, 3000, -3000, '2020-10-04', NULL),
(13, 'Vente: Efferalgan', 16500, 0, 16500, '2020-10-04', 2),
(14, 'Vente: Paracétamol', 1000, 0, 1000, '2020-10-04', 3),
(15, 'logement', 0, 50000, -50000, '2020-10-04', NULL),
(16, 'don', 500000, 0, 500000, '2020-10-04', NULL),
(17, 'Vente: Doliprane', 12500, 0, 12500, '2020-12-13', 4),
(18, 'Vente: Efferalgan', 33000, 0, 33000, '2020-12-13', 5),
(19, 'Vente: Paracétamol', 1000, 0, 1000, '2020-12-13', 5),
(42, 'Vente: Efferalgan', 127500, 0, 127500, '2021-03-16', 6),
(43, 'Vente: Doliprane', 62500, 0, 62500, '2021-03-16', 6),
(50, 'Vente: Efferalgan', 150000, 0, 150000, '2021-03-17', 7),
(51, 'Vente: Paracétamol', 30000, 0, 30000, '2021-03-17', 7),
(52, 'Vente: Doliprane', 375000, 0, 375000, '2021-03-17', 7);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int(11) NOT NULL,
  `date_commande_at` datetime NOT NULL,
  `produits` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `utilisateur_id`, `valider`, `reference`, `date_commande_at`, `produits`) VALUES
(11, 3, 1, 1, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:1;a:5:{s:8:\"quantite\";i:500;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";i:1650;}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),
(12, 3, 0, 2, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:3;a:5:{s:8:\"quantite\";i:500;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";i:1250;}}s:13:\"idFournisseur\";i:2;s:17:\"numeroFournisseur\";s:4:\"F002\";s:14:\"nomFournisseur\";s:14:\"Oumar Sangaré\";}'),
(13, 3, 0, 3, '2020-10-04 00:00:00', 'a:4:{s:8:\"produits\";a:1:{i:4;a:4:{s:8:\"quantite\";i:700;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),
(14, 3, 1, 4, '2021-03-15 00:00:00', 'a:4:{s:8:\"produits\";a:2:{i:4;a:5:{s:8:\"quantite\";i:2000;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";i:150;}i:1;a:5:{s:8:\"quantite\";i:5000;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";i:1500;}}s:13:\"idFournisseur\";i:3;s:17:\"numeroFournisseur\";s:4:\"F003\";s:14:\"nomFournisseur\";s:13:\"Mousa Tangara\";}');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
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
('DoctrineMigrations\\Version20201004105130', '2020-10-04 10:51:42', 1356),
('DoctrineMigrations\\Version20210208222503', '2021-02-26 16:18:04', 53),
('DoctrineMigrations\\Version20210208223421', '2021-02-26 16:18:04', 59),
('DoctrineMigrations\\Version20210209190623', '2021-02-26 16:18:04', 37),
('DoctrineMigrations\\Version20210209191352', '2021-02-26 16:18:04', 59),
('DoctrineMigrations\\Version20210317091004', '2021-03-17 09:10:17', 69),
('DoctrineMigrations\\Version20210317095535', '2021-03-17 09:56:00', 44),
('DoctrineMigrations\\Version20210412094306', '2021-04-12 09:43:32', 81);

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `id` int(11) NOT NULL,
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
  `utilisateur_id` int(11) DEFAULT NULL,
  `salaire_base` double DEFAULT NULL,
  `salaire_brut` double DEFAULT NULL,
  `salaire_net` double DEFAULT NULL,
  `avantage` double DEFAULT NULL,
  `prime` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id`, `matricule`, `nom`, `prenom`, `date_naissance_at`, `lieu_naissance`, `adresse`, `nationalite`, `civilite`, `date_embauche_at`, `fonction`, `telephone`, `email`, `categorie`, `numero_assurance_maladie`, `type_contrat`, `date_contrat_at`, `situation_familiale`, `nombre_enfant`, `utilisateur_id`, `salaire_base`, `salaire_brut`, `salaire_net`, `avantage`, `prime`) VALUES
(1, 'EMP001', 'DIAKITE', 'Yoro', '1990-12-15 00:00:00', 'Bamako', 'Kalaban Coro', 'Malienne', 'Monsieur', '2020-09-24 00:00:00', 'Directeur Commercial', '76201526', 'yoro@gmail.com', 'Permanent', 258, 'CDI', '2020-09-24 00:00:00', 'Marié(e)', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'EMP002', 'Dembélé', 'Mamourou', '1990-01-01 00:00:00', 'Sikasso', 'Bamako Coura', 'Malienne', 'Monsieur', '2019-10-03 00:00:00', 'Vendeur', '78211254', 'mamourou@gmail.com', 'Vaccataire', 2, 'CDD', '2019-10-03 00:00:00', 'Madame', 0, 5, NULL, NULL, NULL, NULL, NULL),
(3, 'M001', 'MAMOU', 'Awa', '1984-01-01 00:00:00', 'Bamako', 'LAFIABOUGOU', 'Malienne', 'Mademoiselle', '2020-10-02 00:00:00', 'Secretaire', '45655214', 'awa@gmail.com', 'Permanent', 2, 'CDI', '2020-10-02 00:00:00', 'Madame', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'M002', 'Mama', 'eve', '1990-03-04 00:00:00', 'bangui', 'BAMBARI', 'Centrafricaine', 'Madame', '2020-10-04 00:00:00', 'comptable', '56854785', 'mama@yahoo.fr', 'Vaccataire', 3, 'CDD', '2020-10-04 00:00:00', 'Marié(e)', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'M099', 'Tamboura', 'Amadou', '1991-03-09 00:00:00', 'Bamako', 'Bamako Coura', 'Malienne', 'Monsieur', '2020-01-06 00:00:00', 'Vendeur', '75261879', 'tamboura@gmail.com', 'Vaccataire', 2145885, 'CDD', '2020-01-06 00:00:00', 'Célibataire', 0, NULL, 600000, 630000, 598500, 10000, 20000),
(7, 'M097', 'Tounkara', 'Mariam', '1990-01-01 00:00:00', 'Sikasso', 'Kabala', 'Malienne', 'Monsieur', '2021-02-08 00:00:00', 'Vendeuse', '75261855', 'mariam@gmail.com', 'Permanent', 2145886, 'Stage', '2021-02-08 00:00:00', 'Marié(e)', 2, NULL, 400000, 620000, 589000, 200000, 20000);

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `familles`
--

CREATE TABLE `familles` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `prenom`, `nom`, `numero`, `adresse`, `telephone`) VALUES
(1, 'Cheiknei', 'Diawara', 'F001', 'Tomikorobougou', '76201544'),
(2, 'Oumar', 'Sangaré', 'F002', 'Badjalan 1', '75402062'),
(3, 'Mousa', 'Tangara', 'F003', 'ACI2000', '42002800');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `famille_id` int(11) DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unitaire` double NOT NULL,
  `date_peremption_at` datetime NOT NULL,
  `nom_fabricant` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `famille_id`, `code`, `designation`, `prix_unitaire`, `date_peremption_at`, `nom_fabricant`, `forme`, `quantite`) VALUES
(1, 1, 'EFF', 'Efferalgan', 1500, '2021-09-25 00:00:00', 'Pharmacie du Mali', 'Sirop', 9),
(3, 1, 'DOL', 'Doliprane', 1250, '2021-09-26 00:00:00', 'Pharmacie du Mali', 'Sirop', 4293),
(4, 3, 'PARA', 'Paracétamol', 150, '2021-10-04 00:00:00', 'Pharmacie du Mali', 'Sirop', 2295);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salaires`
--

CREATE TABLE `salaires` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `mois` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salaires`
--

INSERT INTO `salaires` (`id`, `employe_id`, `mois`) VALUES
(5, 1, 'Octobre 2020'),
(6, 2, 'Octobre 2020'),
(7, 1, 'Octobre 2020'),
(8, 4, 'Octobre 2020'),
(9, 2, 'Décembre 2020'),
(10, 3, 'Décembre 2020'),
(11, 6, 'Avril 2021');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `situation` int(11) DEFAULT NULL,
  `date_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `code`, `designation`, `entre`, `sortie`, `situation`, `date_at`, `reference`) VALUES
(1, 'DOL', 'Doliprane', 500, 0, 5497, '2020-10-04', NULL),
(2, 'EFF', 'Efferalgan', 500, 0, 900, '2020-10-04', NULL),
(4, 'EFF', 'Efferalgan', 0, 10, 890, '2020-10-04', NULL),
(5, 'EFF', 'Efferalgan', 0, 10, 880, '2020-10-04', NULL),
(6, 'PARA', 'Paracétamol', 0, 10, 990, '2020-10-04', NULL),
(7, 'DOL', 'Doliprane', 0, 10, 5480, '2020-12-13', NULL),
(8, 'EFF', 'Efferalgan', 0, 20, 860, '2020-12-13', NULL),
(9, 'PARA', 'Paracétamol', 0, 10, 980, '2020-12-13', NULL),
(12, 'PARA', 'Paracétamol', 2000, 0, 2980, '2021-03-15', NULL),
(13, 'EFF', 'Efferalgan', 5000, 0, 5860, '2021-03-15', NULL),
(14, 'EFF', 'Efferalgan', 0, 860, 5000, '2021-03-15', NULL),
(15, 'EFF', 'Efferalgan', 0, 860, 4140, '2021-03-16', NULL),
(16, 'PARA', 'Paracétamol', 0, 10, 2970, '2021-03-16', NULL),
(17, 'EFF', 'Efferalgan', 0, 800, 3340, '2021-03-16', NULL),
(18, 'PARA', 'Paracétamol', 0, 15, 2955, '2021-03-16', NULL),
(30, 'EFF', 'Efferalgan', 0, 85, 1485, '2021-03-16', 6),
(31, 'DOL', 'Doliprane', 0, 50, 5203, '2021-03-16', 6),
(38, 'EFF', 'Efferalgan', 0, 100, 1185, '2021-03-17', 7),
(39, 'PARA', 'Paracétamol', 0, 200, 2295, '2021-03-17', 7),
(40, 'DOL', 'Doliprane', 0, 300, 4293, '2021-03-17', 7);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `roles`, `password`, `email`, `role`) VALUES
(3, 'admin1', '[]', '$2y$12$jSC271Koo3DeX1d.5CTCbu/vnp3flxezlqd77KYqQ1gWpfXJ5ArVq', 'admin1@gmail.com', 'ROLE_ADMIN'),
(4, 'admin2', '[]', '$2y$12$V6om2OnWINYlseY.xxaBHeUMCgfO4m2L9MvOOLOHRg2OPdsSgMB22', 'admin2@gmail.com', 'ROLE_PHARMACIEN'),
(5, 'mamourou', '[]', '$2y$12$WHMgcALnE9sdok4EjcL9keFKzqX0F9kzTLdNsXRGFq/eH67EulhwG', 'mamourou@gmail.com', 'ROLE_PHARMACIEN');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int(11) NOT NULL,
  `date_vente_at` datetime NOT NULL,
  `produits` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `utilisateur_id`, `valider`, `reference`, `date_vente_at`, `produits`) VALUES
(3, 3, 1, 1, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(4, 3, 1, 2, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),
(5, 3, 1, 3, '2020-10-04 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),
(6, 3, 1, 4, '2020-12-13 00:00:00', 'a:6:{s:8:\"produits\";a:1:{i:3;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";s:4:\"1250\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"12500\";s:3:\"net\";s:5:\"12500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(7, 3, 1, 5, '2020-12-13 00:00:00', 'a:6:{s:8:\"produits\";a:2:{i:1;a:9:{s:8:\"quantite\";i:20;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"33000\";s:3:\"net\";s:5:\"33000\";}i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(8, 3, 1, 6, '2021-03-16 16:20:27', 'a:6:{s:8:\"produits\";a:2:{i:1;a:9:{s:8:\"quantite\";i:85;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1500\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:6:\"127500\";s:3:\"net\";s:6:\"127500\";}i:3;a:9:{s:8:\"quantite\";i:50;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";s:4:\"1250\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"62500\";s:3:\"net\";s:5:\"62500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),
(9, 3, 1, 7, '2021-03-17 10:18:23', 'a:6:{s:8:\"produits\";a:3:{i:1;a:9:{s:8:\"quantite\";i:100;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1500\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:6:\"150000\";s:3:\"net\";s:6:\"150000\";}i:4;a:9:{s:8:\"quantite\";i:200;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"150\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"30000\";s:3:\"net\";s:5:\"30000\";}i:3;a:9:{s:8:\"quantite\";i:300;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";s:4:\"1250\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:6:\"375000\";s:3:\"net\";s:6:\"375000\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caisse`
--
ALTER TABLE `caisse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35D4282CFB88E14F` (`utilisateur_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A94BC0F0FB88E14F` (`utilisateur_id`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `familles`
--
ALTER TABLE `familles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE2DDF8C97A77B84` (`famille_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `salaires`
--
ALTER TABLE `salaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_718524441B65292` (`employe_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_497B315ED37CC8AC` (`nom_utilisateur`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_64EC489AFB88E14F` (`utilisateur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caisse`
--
ALTER TABLE `caisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `familles`
--
ALTER TABLE `familles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salaires`
--
ALTER TABLE `salaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282CFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `FK_A94BC0F0FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

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
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `FK_64EC489AFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
