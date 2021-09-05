-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: localhost    Database: pharma
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caisse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `motif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int DEFAULT NULL,
  `sortie` int DEFAULT NULL,
  `solde` int DEFAULT NULL,
  `date_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caisse`
--

LOCK TABLES `caisse` WRITE;
/*!40000 ALTER TABLE `caisse` DISABLE KEYS */;
INSERT INTO `caisse` VALUES (7,'Dépôt',25000000,0,25000000,'2020-10-04'),(8,'Livraison: Doliprane',0,625000,-625000,'2020-10-04'),(11,'Vente: Efferalgan',16500,0,16500,'2020-10-04'),(12,'Achat de stylo',0,3000,-3000,'2020-10-04'),(13,'Vente: Efferalgan',16500,0,16500,'2020-10-04'),(14,'Vente: Paracétamol',1000,0,1000,'2020-10-04'),(15,'logement',0,50000,-50000,'2020-10-04'),(16,'don',500000,0,500000,'2020-10-04'),(17,'Vente: Doliprane',12500,0,12500,'2020-12-13'),(18,'Vente: Efferalgan',33000,0,33000,'2020-12-13'),(19,'Vente: Paracétamol',1000,0,1000,'2020-12-13'),(20,'Livraison: Efferalgan',0,750000,-750000,'2021-02-04'),(21,'Vente: Paracétamol',20000,0,20000,'2021-02-08'),(22,'Vente: Efferalgan',22500,0,22500,'2021-02-26'),(23,'Livraison: Paracétamol',0,60000,-60000,'2021-09-05');
/*!40000 ALTER TABLE `caisse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'C001','Client au comptant','Client au comptant',NULL,NULL),(2,'C002','pharmacie lafiab','pharmacie lafiab','faladjie','56454745');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int NOT NULL,
  `date_commande_at` datetime NOT NULL,
  `produits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_35D4282CFB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_35D4282CFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandes`
--

LOCK TABLES `commandes` WRITE;
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
INSERT INTO `commandes` VALUES (11,3,1,1,'2021-02-04 00:00:00','a:4:{s:8:\"produits\";a:1:{i:1;a:5:{s:8:\"quantite\";i:500;s:4:\"prix\";i:1500;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),(12,3,0,2,'2021-02-04 00:00:00','a:4:{s:8:\"produits\";a:2:{i:3;a:4:{s:8:\"quantite\";i:200;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";}i:4;a:4:{s:8:\"quantite\";i:900;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),(13,3,0,3,'2020-10-04 00:00:00','a:4:{s:8:\"produits\";a:1:{i:4;a:4:{s:8:\"quantite\";i:700;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";}}s:13:\"idFournisseur\";i:1;s:17:\"numeroFournisseur\";s:4:\"F001\";s:14:\"nomFournisseur\";s:16:\"Cheiknei Diawara\";}'),(16,3,1,5,'2021-09-05 00:00:00','a:4:{s:8:\"produits\";a:1:{i:4;a:5:{s:8:\"quantite\";i:400;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";i:150;}}s:13:\"idFournisseur\";i:3;s:17:\"numeroFournisseur\";s:4:\"F003\";s:14:\"nomFournisseur\";s:10:\"mousa JEAN\";}');
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20200923200627','2020-09-23 20:06:54',1310),('DoctrineMigrations\\Version20200923202224','2020-09-23 20:23:04',1301),('DoctrineMigrations\\Version20200924173200','2020-09-24 17:32:25',8619),('DoctrineMigrations\\Version20200926093535','2020-09-26 09:35:56',2979),('DoctrineMigrations\\Version20201003210630','2020-10-03 21:06:55',4589),('DoctrineMigrations\\Version20201003225541','2020-10-03 22:56:05',1780),('DoctrineMigrations\\Version20201004091306','2020-10-04 09:18:31',719),('DoctrineMigrations\\Version20201004093221','2020-10-04 09:32:33',1282),('DoctrineMigrations\\Version20201004105130','2020-10-04 10:51:42',1356),('DoctrineMigrations\\Version20210208222503','2021-02-08 22:27:36',5126),('DoctrineMigrations\\Version20210208223421','2021-02-08 22:34:37',2598),('DoctrineMigrations\\Version20210209190623','2021-02-09 19:07:26',8589),('DoctrineMigrations\\Version20210209191352','2021-02-09 19:14:25',3065);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance_at` datetime NOT NULL,
  `lieu_naissance` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_embauche_at` datetime NOT NULL,
  `fonction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_assurance_maladie` int DEFAULT NULL,
  `type_contrat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_contrat_at` datetime NOT NULL,
  `situation_familiale` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_enfant` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A94BC0F0FB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_A94BC0F0FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` VALUES (1,'EMP001','Diakité','Yoro','1990-12-15 00:00:00','Bamako','Kalaban Coro','Malienne','Monsieur','2020-09-24 00:00:00','Directeur Commercial','76201526','yoro@gmail.com','Permanent',258,'CDI','2020-09-24 00:00:00','Marié(e)',2,6),(2,'EMP002','Dembélé','Mamourou','1990-01-01 00:00:00','Sikasso','Bamako Coura','Malienne','Monsieur','2019-10-03 00:00:00','Vendeur','78211254','mamourou@gmail.com','Vaccataire',2,'CDD','2019-10-03 00:00:00','Madame',0,NULL),(3,'M001','MAMOU','Awa','1984-01-01 00:00:00','Bamako','LAFIABOUGOU','Malienne','Mademoiselle','2020-10-02 00:00:00','Secretaire','45655214','awa@gmail.com','Permanent',2,'CDI','2020-10-02 00:00:00','Madame',0,NULL),(4,'M002','Mama','eve','1990-03-04 00:00:00','bangui','BAMBARI','Centrafricaine','Madame','2020-10-04 00:00:00','comptable','56854785','mama@yahoo.fr','Vaccataire',3,'CDD','2020-10-04 00:00:00','Marié(e)',1,NULL);
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `famille`
--

DROP TABLE IF EXISTS `famille`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `famille` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `famille`
--

LOCK TABLES `famille` WRITE;
/*!40000 ALTER TABLE `famille` DISABLE KEYS */;
/*!40000 ALTER TABLE `famille` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familles`
--

DROP TABLE IF EXISTS `familles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familles`
--

LOCK TABLES `familles` WRITE;
/*!40000 ALTER TABLE `familles` DISABLE KEYS */;
INSERT INTO `familles` VALUES (1,'F001','Générique'),(3,'F002','Famille 2'),(4,'F003','aspic'),(5,'F004','Nouvelle famille');
/*!40000 ALTER TABLE `familles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fournisseurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseurs`
--

LOCK TABLES `fournisseurs` WRITE;
/*!40000 ALTER TABLE `fournisseurs` DISABLE KEYS */;
INSERT INTO `fournisseurs` VALUES (1,'Cheiknei','Diawara','F001','Tomikorobougou','76201544'),(2,'Oumar','Sangaré','F002','Badjalan 1','75402062'),(3,'mousa','JEAN','F003','ACI2000','45585745'),(4,'Mariam','Traoré','F004','Banconi','78775423');
/*!40000 ALTER TABLE `fournisseurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `famille_id` int DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unitaire` double NOT NULL,
  `date_peremption_at` datetime NOT NULL,
  `nom_fabricant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forme` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BE2DDF8C97A77B84` (`famille_id`),
  CONSTRAINT `FK_BE2DDF8C97A77B84` FOREIGN KEY (`famille_id`) REFERENCES `familles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produits`
--

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` VALUES (1,1,'EFF','Efferalgan',1500,'2021-09-25 00:00:00','Pharmacie du Mali','Sirop',845),(3,1,'DOL','Doliprane',1250,'2021-09-26 00:00:00','Pharmacie du Mali','Sirop',5480),(4,3,'PARA','Paracétamol',150,'2022-02-12 00:00:00','Pharmacie du Mali','Sirop',1180);
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salaires`
--

DROP TABLE IF EXISTS `salaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employe_id` int DEFAULT NULL,
  `nombre_heure` int DEFAULT NULL,
  `taux_horaire` double DEFAULT NULL,
  `salaire_base` int NOT NULL,
  `prime` int DEFAULT NULL,
  `avantage` int DEFAULT NULL,
  `salaire_brut` int NOT NULL,
  `salaire_net` int NOT NULL,
  `cotisation_social` int NOT NULL,
  `mois` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_718524441B65292` (`employe_id`),
  CONSTRAINT `FK_718524441B65292` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salaires`
--

LOCK TABLES `salaires` WRITE;
/*!40000 ALTER TABLE `salaires` DISABLE KEYS */;
INSERT INTO `salaires` VALUES (5,1,0,0,1500000,25000,35000,1560000,1482000,78000,'Octobre 2020'),(6,2,240,2000,20000,8000,1500,29500,28025,1475,'Octobre 2020'),(7,1,240,2000,500000,50000,15000,565000,536750,28250,'Octobre 2020'),(8,4,240,2000,500000,1500,50000,551500,523925,27575,'Octobre 2020'),(9,2,240,2000,20000,1500,1500,23000,21850,1150,'Décembre 2020'),(10,3,240,2000,1500000,8,35000,1535008,1458257,76750,'Décembre 2020');
/*!40000 ALTER TABLE `salaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entre` int DEFAULT NULL,
  `sortie` int DEFAULT NULL,
  `situation` int DEFAULT NULL,
  `date_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (1,'DOL','Doliprane',500,0,5497,'2020-10-04'),(4,'EFF','Efferalgan',0,10,890,'2020-10-04'),(5,'EFF','Efferalgan',0,10,880,'2020-10-04'),(6,'PARA','Paracétamol',0,10,990,'2020-10-04'),(7,'DOL','Doliprane',0,10,5480,'2020-12-13'),(8,'EFF','Efferalgan',0,20,860,'2020-12-13'),(9,'PARA','Paracétamol',0,10,980,'2020-12-13'),(10,'EFF','Efferalgan',500,0,860,'2021-02-04'),(11,'PARA','Paracétamol',0,200,780,'2021-02-08'),(12,'EFF','Efferalgan',0,15,845,'2021-02-26'),(13,'PARA','Paracétamol',400,0,1180,'2021-09-05');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_497B315ED37CC8AC` (`nom_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (3,'admin1','[]','$2y$12$jSC271Koo3DeX1d.5CTCbu/vnp3flxezlqd77KYqQ1gWpfXJ5ArVq','admin1@gmail.com','ROLE_ADMIN'),(4,'admin2','[]','$2y$12$V6om2OnWINYlseY.xxaBHeUMCgfO4m2L9MvOOLOHRg2OPdsSgMB22','admin2@gmail.com','ROLE_PHARMACIEN'),(5,'user1','[]','$2y$12$n7PWvCnB3Kqw/S7ydr429OGKQFbRb4HyVqGN016Zntwjuwwjopkk2','user1@gmail.com','ROLE_USER'),(6,'admintest','[]','$2y$12$UqJLMLEw9UONMDkXZIj.iezFUB4OkzrlWjnVJUDaXXhI6Fc9b64bC','yoro@gmail.com','ROLE_PHARMACIEN');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `reference` int NOT NULL,
  `date_vente_at` datetime NOT NULL,
  `produits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_64EC489AFB88E14F` (`utilisateur_id`),
  CONSTRAINT `FK_64EC489AFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventes`
--

LOCK TABLES `ventes` WRITE;
/*!40000 ALTER TABLE `ventes` DISABLE KEYS */;
INSERT INTO `ventes` VALUES (3,3,1,1,'2020-10-04 00:00:00','a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),(4,3,1,2,'2020-10-04 00:00:00','a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:5:\"16500\";s:3:\"net\";s:5:\"16500\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),(5,3,1,3,'2020-10-04 00:00:00','a:6:{s:8:\"produits\";a:1:{i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:9:\"Plaquette\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}'),(6,3,1,4,'2020-12-13 00:00:00','a:6:{s:8:\"produits\";a:1:{i:3;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:3;s:11:\"codeProduit\";s:3:\"DOL\";s:18:\"designationProduit\";s:9:\"Doliprane\";s:4:\"prix\";s:4:\"1250\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"12500\";s:3:\"net\";s:5:\"12500\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),(7,3,1,5,'2020-12-13 00:00:00','a:6:{s:8:\"produits\";a:2:{i:1;a:9:{s:8:\"quantite\";i:20;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1650\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"33000\";s:3:\"net\";s:5:\"33000\";}i:4;a:9:{s:8:\"quantite\";i:10;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:4:\"1000\";s:3:\"net\";s:4:\"1000\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),(8,3,1,6,'2021-02-08 00:00:00','a:6:{s:8:\"produits\";a:1:{i:4;a:9:{s:8:\"quantite\";i:200;s:9:\"idProduit\";i:4;s:11:\"codeProduit\";s:4:\"PARA\";s:18:\"designationProduit\";s:12:\"Paracétamol\";s:4:\"prix\";s:3:\"100\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"20000\";s:3:\"net\";s:5:\"20000\";}}s:8:\"idClient\";i:1;s:12:\"numeroClient\";s:4:\"C001\";s:9:\"nomClient\";s:37:\"Client au comptant Client au comptant\";s:7:\"adresse\";s:0:\"\";s:9:\"telephone\";s:0:\"\";}'),(9,3,1,7,'2021-02-26 21:01:11','a:6:{s:8:\"produits\";a:1:{i:1;a:9:{s:8:\"quantite\";i:15;s:9:\"idProduit\";i:1;s:11:\"codeProduit\";s:3:\"EFF\";s:18:\"designationProduit\";s:10:\"Efferalgan\";s:4:\"prix\";s:4:\"1500\";s:6:\"remise\";s:1:\"0\";s:9:\"emballage\";s:6:\"Boîte\";s:4:\"brut\";s:5:\"22500\";s:3:\"net\";s:5:\"22500\";}}s:8:\"idClient\";i:2;s:12:\"numeroClient\";s:4:\"C002\";s:9:\"nomClient\";s:33:\"pharmacie lafiab pharmacie lafiab\";s:7:\"adresse\";s:8:\"faladjie\";s:9:\"telephone\";s:8:\"56454745\";}');
/*!40000 ALTER TABLE `ventes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-05 11:07:27
