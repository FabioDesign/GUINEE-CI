/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ambagnci_db
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `actions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `position` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actions`
--

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` VALUES
(1,'Voir',1),
(2,'Ajouter',2),
(3,'Modifier',3),
(4,'Activer/Désactiver',5),
(5,'Supprimer',6),
(6,'Transmettre',7),
(7,'Valider',8),
(8,'Rejeter',9),
(9,'Imprimer',11),
(10,'Récupérer',10),
(11,'Dupliquer',4);
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annual_stats`
--

DROP TABLE IF EXISTS `annual_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `annual_stats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `years` year(4) NOT NULL,
  `amount` decimal(15,0) NOT NULL DEFAULT 0,
  `paid` int(11) NOT NULL DEFAULT 0,
  `free` int(11) NOT NULL DEFAULT 0,
  `created` int(11) NOT NULL DEFAULT 0,
  `transmitted` int(11) NOT NULL DEFAULT 0,
  `validated` int(11) NOT NULL DEFAULT 0,
  `rejected` int(11) NOT NULL DEFAULT 0,
  `recovered` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consulat_id` bigint(20) unsigned NOT NULL,
  `document_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `annual_stats_agency_id_document_id_years_unique` (`consulat_id`,`document_id`,`years`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annual_stats`
--

LOCK TABLES `annual_stats` WRITE;
/*!40000 ALTER TABLE `annual_stats` DISABLE KEYS */;
INSERT INTO `annual_stats` VALUES
(1,2026,45000,3,0,2,3,2,0,1,'2026-08-08 07:46:15',NULL,1,4),
(2,2026,15000,3,0,1,1,1,0,0,'2026-08-08 07:46:36',NULL,1,3),
(3,2026,40000,2,1,2,2,2,0,2,'2026-08-08 07:47:35',NULL,1,10),
(4,2026,25000,1,0,1,1,1,0,0,'2026-08-08 07:51:10',NULL,1,5);
/*!40000 ALTER TABLE `annual_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `demand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES
(1,'documents/20260714/fbb78733-1f29-4983-a4d5-cebcecab4aae/0HiByI6Q9KqFdUUILBslf4A53NZGI2PysnEPUFu0.pdf',6,1),
(2,'documents/20260715/1b82be4b-2673-4047-bbe5-e6226022f480/KPmVN93VOELxgrcbgzTQ6LKFVrJno56TVZZfD2AT.jpg',5,2),
(3,'documents/20260719/1b82be4b-2673-4047-bbe5-e6226022f480/Br97Z9P0XztXR3LCV5cvXq7EbHZnqiZlSD7ZHvPB.pdf',6,3),
(4,'documents/20260719/1b82be4b-2673-4047-bbe5-e6226022f480/sjtnxTembjAOuHdYPR1BulGNuDcRHq6Jw9sS91DA.pdf',5,3),
(5,'documents/20260724/8712387d-816e-4ccd-b6a8-31b3ea62821a/AcuFFiA6SRMxJS5zVta0Y6a1WgK096TJl9BBGCRH.jpg',6,4),
(6,'documents/20260724/1b82be4b-2673-4047-bbe5-e6226022f480/JFUrscK7BNa5vhjcq0Azht3P6TtrQyT0QKzbZDEs.jpg',4,5),
(7,'documents/20260724/1b82be4b-2673-4047-bbe5-e6226022f480/Uiifndkg2nGsFAtHisMGwKMPyHFYgEnQDgW9LGYs.pdf',6,5),
(8,'documents/20260724/1b82be4b-2673-4047-bbe5-e6226022f480/SolgJhXRICDIIHtJ6QlyzsQx7KfBGN3vnsVGlQJl.jpg',5,5),
(10,'documents/20260802/fbb78733-1f29-4983-a4d5-cebcecab4aae/R4WyeVH4F80OrZfLn9RM9xIJoI8qUgnLXKZSSlhp.jpg',6,6),
(11,'documents/20260903/8712387d-816e-4ccd-b6a8-31b3ea62821a/5d6FhhdW26zS4hi0fus3sqxtXgT8sbjc5yZ65BHe.jpg',6,7),
(12,'documents/20260908/1b82be4b-2673-4047-bbe5-e6226022f480/x8MNJ9lrNSfJS5jnhVmAP9qjUoBb5xBkoHLofr5c.jpg',1,8),
(13,'documents/20260908/8712387d-816e-4ccd-b6a8-31b3ea62821a/0JxitddQ9XlSKMfCAqhnAMeBq3r17ETbrLFZZwMa.png',1,9),
(14,'documents/20260908/8712387d-816e-4ccd-b6a8-31b3ea62821a/lWFPNWxRBDQKMXjnCL8dt5mLdI6MwnU0SvbSLqQe.jpg',6,9),
(15,'documents/20260908/8712387d-816e-4ccd-b6a8-31b3ea62821a/ZtifcS6e4K7OA0QAqmHqkUhDwr5wYO33Bw80dNt6.jpg',5,10);
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_trails`
--

DROP TABLE IF EXISTS `audit_trails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `profil` varchar(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `action` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `avatar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consulat_id` int(11) NOT NULL DEFAULT 0,
  `profile_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=600 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trails`
--

LOCK TABLES `audit_trails` WRITE;
/*!40000 ALTER TABLE `audit_trails` DISABLE KEYS */;
INSERT INTO `audit_trails` VALUES
(1,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-03 14:40:47','2026-08-03 14:40:47',1,1),
(2,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-03 14:40:48','2026-08-03 14:40:48',1,1),
(3,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-03 14:43:12','2026-08-03 14:43:12',1,1),
(4,'FABRICE OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-03 14:43:47','2026-08-03 14:43:47',1,1),
(5,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-07 18:19:10','2026-08-07 18:19:10',1,1),
(6,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:19:11','2026-08-07 18:19:11',1,1),
(7,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:19:18','2026-08-07 18:19:18',1,1),
(8,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:21:48','2026-08-07 18:21:48',1,1),
(9,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:24:02','2026-08-07 18:24:02',1,1),
(10,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:24:24','2026-08-07 18:24:24',1,1),
(11,'FABRICE OGOU','Administrateur','Gestion des Profils','Deconnecter','info','avatars/homme.jpg','2026-08-07 18:24:41','2026-08-07 18:24:41',1,1),
(12,'Désirée OGOU EPSE KAMENAN','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-07 18:24:56','2026-08-07 18:24:56',1,3),
(13,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:24:56','2026-08-07 18:24:56',1,3),
(14,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:29:26','2026-08-07 18:29:26',1,3),
(15,'Désirée OGOU EPSE KAMENAN','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-07 18:29:31','2026-08-07 18:29:31',1,3),
(16,'Désirée OGOU EPSE KAMENAN','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-07 18:29:41','2026-08-07 18:29:41',1,3),
(17,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:29:42','2026-08-07 18:29:42',1,3),
(18,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:30:10','2026-08-07 18:30:10',1,3),
(19,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-07 18:37:42','2026-08-07 18:37:42',1,1),
(20,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:37:42','2026-08-07 18:37:42',1,1),
(21,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-07 18:37:49','2026-08-07 18:37:49',1,1),
(22,'FABRICE OGOU','Administrateur','Profil: Agent','Modifier','warning','avatars/homme.jpg','2026-08-07 18:37:59','2026-08-07 18:37:59',1,1),
(23,'FABRICE OGOU','Administrateur','Modification du Profil','Deconnecter','info','avatars/homme.jpg','2026-08-07 18:38:15','2026-08-07 18:38:15',1,1),
(24,'Désirée OGOU EPSE KAMENAN','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-07 18:38:24','2026-08-07 18:38:24',1,3),
(25,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:38:59','2026-08-07 18:38:59',1,3),
(26,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:51:00','2026-08-07 18:51:00',1,3),
(27,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:52:10','2026-08-07 18:52:10',1,3),
(28,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:52:46','2026-08-07 18:52:46',1,3),
(29,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:53:33','2026-08-07 18:53:33',1,3),
(30,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:53:46','2026-08-07 18:53:46',1,3),
(31,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:53:59','2026-08-07 18:53:59',1,3),
(32,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:54:23','2026-08-07 18:54:23',1,3),
(33,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:54:49','2026-08-07 18:54:49',1,3),
(34,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:56:37','2026-08-07 18:56:37',1,3),
(35,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 18:57:07','2026-08-07 18:57:07',1,3),
(36,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:03:06','2026-08-07 19:03:06',1,3),
(37,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:28:50','2026-08-07 19:28:50',1,3),
(38,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:29:00','2026-08-07 19:29:00',1,3),
(39,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:29:00','2026-08-07 19:29:00',1,3),
(40,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:29:00','2026-08-07 19:29:00',1,3),
(41,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:29:00','2026-08-07 19:29:00',1,3),
(42,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:29:00','2026-08-07 19:29:00',1,3),
(43,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:30:13','2026-08-07 19:30:13',1,3),
(44,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:36:37','2026-08-07 19:36:37',1,3),
(45,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 19:38:10','2026-08-07 19:38:10',1,3),
(46,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:10:05','2026-08-07 20:10:05',1,3),
(47,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:28:11','2026-08-07 20:28:11',1,3),
(48,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:30:09','2026-08-07 20:30:09',1,3),
(49,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:30:42','2026-08-07 20:30:42',1,3),
(50,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:47:39','2026-08-07 20:47:39',1,3),
(51,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:50:28','2026-08-07 20:50:28',1,3),
(52,'Désirée OGOU EPSE KAMENAN','Agent','Document consulaire: CERTIFICAT DE NATIONALITE','Récupérer','info','avatars/femme.jpg','2026-08-07 20:51:45','2026-08-07 20:51:45',1,3),
(53,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:51:48','2026-08-07 20:51:48',1,3),
(54,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:56:59','2026-08-07 20:56:59',1,3),
(55,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:57:46','2026-08-07 20:57:46',1,3),
(56,'Désirée OGOU EPSE KAMENAN','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 20:58:11','2026-08-07 20:58:11',1,3),
(57,'Désirée OGOU EPSE KAMENAN','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 21:12:42','2026-08-07 21:12:42',1,3),
(58,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 21:12:46','2026-08-07 21:12:46',1,3),
(59,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 21:14:13','2026-08-07 21:14:13',1,3),
(60,'Désirée OGOU EPSE KAMENAN','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-07 21:14:17','2026-08-07 21:14:17',1,3),
(61,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-08 05:17:54','2026-08-08 05:17:54',1,1),
(62,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:17:54','2026-08-08 05:17:54',1,1),
(63,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:17:57','2026-08-08 05:17:57',1,1),
(64,'FABRICE OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:34:03','2026-08-08 05:34:03',1,1),
(65,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:34:05','2026-08-08 05:34:05',1,1),
(66,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:53:46','2026-08-08 05:53:46',1,1),
(67,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:54:34','2026-08-08 05:54:34',1,1),
(68,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:57:27','2026-08-08 05:57:27',1,1),
(69,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 05:59:04','2026-08-08 05:59:04',1,1),
(70,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:00:07','2026-08-08 06:00:07',1,1),
(71,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:00:22','2026-08-08 06:00:22',1,1),
(72,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:01:05','2026-08-08 06:01:05',1,1),
(73,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:01:39','2026-08-08 06:01:39',1,1),
(74,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:01:52','2026-08-08 06:01:52',1,1),
(75,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:02:03','2026-08-08 06:02:03',1,1),
(76,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:04:32','2026-08-08 06:04:32',1,1),
(77,'FABRICE OGOU','Administrateur','Détail du document consulaire','Deconnecter','info','avatars/homme.jpg','2026-08-08 06:10:06','2026-08-08 06:10:06',1,1),
(78,'Ahou N\'ZUE EPSE OGOU','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-08 06:10:20','2026-08-08 06:10:20',1,3),
(79,'Ahou N\'ZUE EPSE OGOU','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-08 06:10:20','2026-08-08 06:10:20',1,3),
(80,'Ahou N\'ZUE EPSE OGOU','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-08 06:10:40','2026-08-08 06:10:40',1,3),
(81,'Ahou N\'ZUE EPSE OGOU','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-08 06:11:40','2026-08-08 06:11:40',1,3),
(82,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-08 06:11:53','2026-08-08 06:11:53',1,1),
(83,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:11:53','2026-08-08 06:11:53',1,1),
(84,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:11:57','2026-08-08 06:11:57',1,1),
(85,'FABRICE OGOU','Administrateur','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-08-08 06:12:17','2026-08-08 06:12:17',1,1),
(86,'Ahou N\'ZUE EPSE OGOU','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-08 06:12:28','2026-08-08 06:12:28',1,3),
(87,'Ahou N\'ZUE EPSE OGOU','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-08 06:12:28','2026-08-08 06:12:28',1,3),
(88,'Ahou N\'ZUE EPSE OGOU','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-08-08 06:12:56','2026-08-08 06:12:56',1,3),
(89,'FRANCK OGOU','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-08 06:13:25','2026-08-08 06:13:25',1,2),
(90,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:13:25','2026-08-08 06:13:25',1,2),
(91,'FRANCK OGOU','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:13:28','2026-08-08 06:13:28',1,2),
(92,'FRANCK OGOU','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:14:12','2026-08-08 06:14:12',1,2),
(93,'FRANCK OGOU','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:15:07','2026-08-08 06:15:07',1,2),
(94,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:15:22','2026-08-08 06:15:22',1,2),
(95,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 06:18:39','2026-08-08 06:18:39',1,2),
(96,'FRANCK OGOU','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 07:10:38','2026-08-08 07:10:38',1,2),
(97,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 07:11:40','2026-08-08 07:11:40',1,2),
(98,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 07:57:38','2026-08-08 07:57:38',1,2),
(99,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 08:00:27','2026-08-08 08:00:27',1,2),
(100,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 08:04:12','2026-08-08 08:04:12',1,2),
(101,'FRANCK OGOU','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-08 08:04:39','2026-08-08 08:04:39',1,2),
(102,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-13 23:36:08','2026-08-13 23:36:08',1,1),
(103,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-13 23:36:08','2026-08-13 23:36:08',1,1),
(104,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-13 23:41:50','2026-08-13 23:41:50',1,1),
(105,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-13 23:51:47','2026-08-13 23:51:47',1,1),
(106,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 00:08:08','2026-08-14 00:08:08',1,1),
(107,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 00:11:40','2026-08-14 00:11:40',1,1),
(108,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 00:24:55','2026-08-14 00:24:55',1,1),
(109,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-14 05:10:27','2026-08-14 05:10:27',1,1),
(110,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 05:10:27','2026-08-14 05:10:27',1,1),
(111,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 05:10:33','2026-08-14 05:10:33',1,1),
(112,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 05:16:04','2026-08-14 05:16:04',1,1),
(113,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 05:18:11','2026-08-14 05:18:11',1,1),
(114,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:04:04','2026-08-14 06:04:04',1,1),
(115,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:05:37','2026-08-14 06:05:37',1,1),
(116,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:06:00','2026-08-14 06:06:00',1,1),
(117,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:08:53','2026-08-14 06:08:53',1,1),
(118,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:10:11','2026-08-14 06:10:11',1,1),
(119,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:10:34','2026-08-14 06:10:34',1,1),
(120,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:10:53','2026-08-14 06:10:53',1,1),
(121,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:11:57','2026-08-14 06:11:57',1,1),
(122,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:12:20','2026-08-14 06:12:20',1,1),
(123,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:13:45','2026-08-14 06:13:45',1,1),
(124,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:14:56','2026-08-14 06:14:56',1,1),
(125,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:57:33','2026-08-14 06:57:33',1,1),
(126,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 06:59:26','2026-08-14 06:59:26',1,1),
(127,'FABRICE OGOU','Administrateur','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-08-14 07:01:03','2026-08-14 07:01:03',1,1),
(128,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-14 07:01:48','2026-08-14 07:01:48',1,2),
(129,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 07:01:48','2026-08-14 07:01:48',1,2),
(130,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 07:02:30','2026-08-14 07:02:30',1,2),
(131,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-14 19:21:50','2026-08-14 19:21:50',1,1),
(132,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-14 19:21:51','2026-08-14 19:21:51',1,1),
(133,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-16 07:34:51','2026-08-16 07:34:51',1,1),
(134,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 07:34:52','2026-08-16 07:34:52',1,1),
(135,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 07:36:01','2026-08-16 07:36:01',1,1),
(136,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 07:36:31','2026-08-16 07:36:31',1,1),
(137,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 08:02:29','2026-08-16 08:02:29',1,1),
(138,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 08:03:05','2026-08-16 08:03:05',1,1),
(139,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 08:03:09','2026-08-16 08:03:09',1,1),
(140,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-16 11:03:36','2026-08-16 11:03:36',1,1),
(141,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 11:03:36','2026-08-16 11:03:36',1,1),
(142,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 11:03:50','2026-08-16 11:03:50',1,1),
(143,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 11:05:37','2026-08-16 11:05:37',1,1),
(144,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 11:26:28','2026-08-16 11:26:28',1,1),
(145,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 11:27:32','2026-08-16 11:27:32',1,1),
(146,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:22:42','2026-08-16 12:22:42',1,1),
(147,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:23:03','2026-08-16 12:23:03',1,1),
(148,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:23:18','2026-08-16 12:23:18',1,1),
(149,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:23:38','2026-08-16 12:23:38',1,1),
(150,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:39:56','2026-08-16 12:39:56',1,1),
(151,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:41:35','2026-08-16 12:41:35',1,1),
(152,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:42:05','2026-08-16 12:42:05',1,1),
(153,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:42:10','2026-08-16 12:42:10',1,1),
(154,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:45:45','2026-08-16 12:45:45',1,1),
(155,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:53:46','2026-08-16 12:53:46',1,1),
(156,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:53:55','2026-08-16 12:53:55',1,1),
(157,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:54:36','2026-08-16 12:54:36',1,1),
(158,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 12:55:06','2026-08-16 12:55:06',1,1),
(159,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 13:01:28','2026-08-16 13:01:28',1,1),
(160,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:00:13','2026-08-16 14:00:13',1,1),
(161,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:13:30','2026-08-16 14:13:30',1,1),
(162,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:15:53','2026-08-16 14:15:53',1,1),
(163,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:17:45','2026-08-16 14:17:45',1,1),
(164,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:38:06','2026-08-16 14:38:06',1,1),
(165,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:39:06','2026-08-16 14:39:06',1,1),
(166,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:40:24','2026-08-16 14:40:24',1,1),
(167,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:40:48','2026-08-16 14:40:48',1,1),
(168,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:41:21','2026-08-16 14:41:21',1,1),
(169,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:42:54','2026-08-16 14:42:54',1,1),
(170,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:44:35','2026-08-16 14:44:35',1,1),
(171,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:46:54','2026-08-16 14:46:54',1,1),
(172,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:47:59','2026-08-16 14:47:59',1,1),
(173,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:51:11','2026-08-16 14:51:11',1,1),
(174,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:53:23','2026-08-16 14:53:23',1,1),
(175,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 14:53:56','2026-08-16 14:53:56',1,1),
(176,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 15:00:44','2026-08-16 15:00:44',1,1),
(177,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 15:01:39','2026-08-16 15:01:39',1,1),
(178,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 15:02:41','2026-08-16 15:02:41',1,1),
(179,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 15:03:05','2026-08-16 15:03:05',1,1),
(180,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 15:19:23','2026-08-16 15:19:23',1,1),
(181,'FABRICE OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:37:05','2026-08-16 16:37:05',1,1),
(182,'FABRICE OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:39:49','2026-08-16 16:39:49',1,1),
(183,'FABRICE OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:40:48','2026-08-16 16:40:48',1,1),
(184,'FABRICE OGOU','Administrateur','Gestion des utilisateurs','Deconnecter','info','avatars/homme.jpg','2026-08-16 16:40:54','2026-08-16 16:40:54',1,1),
(185,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-16 16:45:39','2026-08-16 16:45:39',1,1),
(186,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:45:39','2026-08-16 16:45:39',1,1),
(187,'FABRICE OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:45:49','2026-08-16 16:45:49',1,1),
(188,'FABRICE OGOU','Administrateur','Consulat: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:46:10','2026-08-16 16:46:10',1,1),
(189,'FABRICE OGOU','Administrateur','Ville: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:46:21','2026-08-16 16:46:21',1,1),
(190,'FABRICE OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:46:41','2026-08-16 16:46:41',1,1),
(191,'FABRICE OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:46:52','2026-08-16 16:46:52',1,1),
(192,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:48:20','2026-08-16 16:48:20',1,1),
(193,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:49:58','2026-08-16 16:49:58',1,1),
(194,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:50:38','2026-08-16 16:50:38',1,1),
(195,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:51:47','2026-08-16 16:51:47',1,1),
(196,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:52:58','2026-08-16 16:52:58',1,1),
(197,'FABRICE OGOU','Administrateur','Document consulaire: CERTIFICAT DE NATIONALITE','Récupérer','info','avatars/homme.jpg','2026-08-16 16:54:46','2026-08-16 16:54:46',1,1),
(198,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:54:47','2026-08-16 16:54:47',1,1),
(199,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:56:16','2026-08-16 16:56:16',1,1),
(200,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:57:54','2026-08-16 16:57:54',1,1),
(201,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 16:59:28','2026-08-16 16:59:28',1,1),
(202,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 17:02:39','2026-08-16 17:02:39',1,1),
(203,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 17:03:24','2026-08-16 17:03:24',1,1),
(204,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 17:36:17','2026-08-16 17:36:17',1,1),
(205,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:06:30','2026-08-16 18:06:30',1,1),
(206,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:40:34','2026-08-16 18:40:34',1,1),
(207,'FABRICE OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:51:55','2026-08-16 18:51:55',1,1),
(208,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:52:00','2026-08-16 18:52:00',1,1),
(209,'FABRICE OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:54:26','2026-08-16 18:54:26',1,1),
(210,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 18:54:29','2026-08-16 18:54:29',1,1),
(211,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-16 23:30:26','2026-08-16 23:30:26',1,1),
(212,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 23:30:26','2026-08-16 23:30:26',1,1),
(213,'FABRICE OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 23:48:41','2026-08-16 23:48:41',1,1),
(214,'FABRICE OGOU','Administrateur','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-08-16 23:48:50','2026-08-16 23:48:50',1,1),
(215,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-16 23:49:15','2026-08-16 23:49:15',1,3),
(216,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-16 23:49:15','2026-08-16 23:49:15',1,3),
(217,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-16 23:49:28','2026-08-16 23:49:28',1,3),
(218,'FABRICE OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-16 23:49:41','2026-08-16 23:49:41',1,1),
(219,'FABRICE OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 23:49:41','2026-08-16 23:49:41',1,1),
(220,'FABRICE OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-16 23:49:46','2026-08-16 23:49:46',1,1),
(221,'FABRICE OGOU','Administrateur','Gestion des Profils','Deconnecter','info','avatars/homme.jpg','2026-08-17 00:07:09','2026-08-17 00:07:09',1,1),
(222,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-17 01:58:22','2026-08-17 01:58:22',1,1),
(223,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 01:58:22','2026-08-17 01:58:22',1,1),
(224,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 01:58:30','2026-08-17 01:58:30',1,1),
(225,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 01:58:53','2026-08-17 01:58:53',1,1),
(226,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 03:24:41','2026-08-17 03:24:41',1,1),
(227,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 03:24:53','2026-08-17 03:24:53',1,1),
(228,'Fabrice OGOU','Administrateur','Profil: Administrateur','Modifier','warning','avatars/homme.jpg','2026-08-17 03:26:15','2026-08-17 03:26:15',1,1),
(229,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 03:26:19','2026-08-17 03:26:19',1,1),
(230,'Fabrice OGOU','Administrateur','Profil: Agent','Modifier','warning','avatars/homme.jpg','2026-08-17 03:27:28','2026-08-17 03:27:28',1,1),
(231,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 03:27:32','2026-08-17 03:27:32',1,1),
(232,'Fabrice OGOU','Administrateur','Profil: Consul','Modifier','warning','avatars/homme.jpg','2026-08-17 03:28:26','2026-08-17 03:28:26',1,1),
(233,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-17 17:38:40','2026-08-17 17:38:40',1,1),
(234,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:38:40','2026-08-17 17:38:40',1,1),
(235,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:39:41','2026-08-17 17:39:41',1,1),
(236,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:40:05','2026-08-17 17:40:05',1,1),
(237,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:40:19','2026-08-17 17:40:19',1,1),
(238,'Fabrice OGOU','Administrateur','Profil: Agent','Modifier','warning','avatars/homme.jpg','2026-08-17 17:45:17','2026-08-17 17:45:17',1,1),
(239,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:45:25','2026-08-17 17:45:25',1,1),
(240,'Fabrice OGOU','Administrateur','Profil: Consul','Modifier','warning','avatars/homme.jpg','2026-08-17 17:46:20','2026-08-17 17:46:20',1,1),
(241,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 17:46:26','2026-08-17 17:46:26',1,1),
(242,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:39:31','2026-08-17 19:39:31',1,1),
(243,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:39:45','2026-08-17 19:39:45',1,1),
(244,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:41:05','2026-08-17 19:41:05',1,1),
(245,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:41:14','2026-08-17 19:41:14',1,1),
(246,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:41:31','2026-08-17 19:41:31',1,1),
(247,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:41:55','2026-08-17 19:41:55',1,1),
(248,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 19:42:06','2026-08-17 19:42:06',1,1),
(249,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 20:54:18','2026-08-17 20:54:18',1,1),
(250,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 21:01:15','2026-08-17 21:01:15',1,1),
(251,'Fabrice OGOU','Administrateur','Document: CARTE D\'IDENTITE CONSULAIRE','Modifier','warning','avatars/homme.jpg','2026-08-17 21:02:48','2026-08-17 21:02:48',1,1),
(252,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 21:02:55','2026-08-17 21:02:55',1,1),
(253,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 21:21:17','2026-08-17 21:21:17',1,1),
(254,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-17 22:11:20','2026-08-17 22:11:20',1,1),
(255,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-18 01:13:53','2026-08-18 01:13:53',1,1),
(256,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:13:53','2026-08-18 01:13:53',1,1),
(257,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:13:59','2026-08-18 01:13:59',1,1),
(258,'Fabrice OGOU','Administrateur','Utilisateur: CAMARA EPSE CISSE FATOUMATA','Modifier','warning','avatars/homme.jpg','2026-08-18 01:14:19','2026-08-18 01:14:19',1,1),
(259,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:14:48','2026-08-18 01:14:48',1,1),
(260,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:15:36','2026-08-18 01:15:36',1,1),
(261,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:15:51','2026-08-18 01:15:51',1,1),
(262,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:17:16','2026-08-18 01:17:16',1,1),
(263,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:18:33','2026-08-18 01:18:33',1,1),
(264,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 01:18:58','2026-08-18 01:18:58',1,1),
(265,'Fabrice OGOU','Administrateur','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-08-18 01:19:16','2026-08-18 01:19:16',1,1),
(266,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-18 01:22:26','2026-08-18 01:22:26',1,3),
(267,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:22:27','2026-08-18 01:22:27',1,3),
(268,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:30:36','2026-08-18 01:30:36',1,3),
(269,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:33:13','2026-08-18 01:33:13',1,3),
(270,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:40:52','2026-08-18 01:40:52',1,3),
(271,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:41:47','2026-08-18 01:41:47',1,3),
(272,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:43:11','2026-08-18 01:43:11',1,3),
(273,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:45:48','2026-08-18 01:45:48',1,3),
(274,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:47:12','2026-08-18 01:47:12',1,3),
(275,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 01:56:34','2026-08-18 01:56:34',1,3),
(276,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:00:49','2026-08-18 02:00:49',1,3),
(277,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:14:58','2026-08-18 02:14:58',1,3),
(278,'FATOUMATA CAMARA EPSE CISSE','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-18 02:15:12','2026-08-18 02:15:12',1,3),
(279,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-18 02:15:41','2026-08-18 02:15:41',1,3),
(280,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:15:41','2026-08-18 02:15:41',1,3),
(281,'MARIAMA SYLLA EPSE BAH','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:16:46','2026-08-18 02:16:46',1,3),
(282,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:17:16','2026-08-18 02:17:16',1,3),
(283,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-18 02:17:21','2026-08-18 02:17:21',1,3),
(284,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-18 02:17:33','2026-08-18 02:17:33',1,2),
(285,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:17:33','2026-08-18 02:17:33',1,2),
(286,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:17:37','2026-08-18 02:17:37',1,2),
(287,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-08-18 02:17:43','2026-08-18 02:17:43',1,2),
(288,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-08-18 02:17:55','2026-08-18 02:17:55',1,3),
(289,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-08-18 02:17:55','2026-08-18 02:17:55',1,3),
(290,'FATOUMATA CAMARA EPSE CISSE','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-08-18 02:25:03','2026-08-18 02:25:03',1,3),
(291,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-18 02:25:26','2026-08-18 02:25:26',1,1),
(292,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:25:26','2026-08-18 02:25:26',1,1),
(293,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:25:30','2026-08-18 02:25:30',1,1),
(294,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:31:06','2026-08-18 02:31:06',1,1),
(295,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:32:56','2026-08-18 02:32:56',1,1),
(296,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:35:34','2026-08-18 02:35:34',1,1),
(297,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 02:39:38','2026-08-18 02:39:38',1,1),
(298,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-18 20:45:36','2026-08-18 20:45:36',1,1),
(299,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 20:45:36','2026-08-18 20:45:36',1,1),
(300,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 20:54:35','2026-08-18 20:54:35',1,1),
(301,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 20:54:50','2026-08-18 20:54:50',1,1),
(302,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 20:55:37','2026-08-18 20:55:37',1,1),
(303,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 20:57:57','2026-08-18 20:57:57',1,1),
(304,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 21:03:03','2026-08-18 21:03:03',1,1),
(305,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 21:05:02','2026-08-18 21:05:02',1,1),
(306,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 21:05:16','2026-08-18 21:05:16',1,1),
(307,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-18 21:05:28','2026-08-18 21:05:28',1,1),
(308,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-19 07:46:05','2026-08-19 07:46:05',1,1),
(309,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 07:46:05','2026-08-19 07:46:05',1,1),
(310,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 07:51:17','2026-08-19 07:51:17',1,1),
(311,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 07:54:23','2026-08-19 07:54:23',1,1),
(312,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:47:57','2026-08-19 08:47:57',1,1),
(313,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:48:40','2026-08-19 08:48:40',1,1),
(314,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:49:44','2026-08-19 08:49:44',1,1),
(315,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:50:06','2026-08-19 08:50:06',1,1),
(316,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:50:48','2026-08-19 08:50:48',1,1),
(317,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:51:32','2026-08-19 08:51:32',1,1),
(318,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:53:30','2026-08-19 08:53:30',1,1),
(319,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-19 08:54:25','2026-08-19 08:54:25',1,1),
(320,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-08-25 06:02:54','2026-08-25 06:02:54',1,1),
(321,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 06:02:55','2026-08-25 06:02:55',1,1),
(322,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 06:07:43','2026-08-25 06:07:43',1,1),
(323,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 07:53:11','2026-08-25 07:53:11',1,1),
(324,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 07:56:39','2026-08-25 07:56:39',1,1),
(325,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:09:48','2026-08-25 08:09:48',1,1),
(326,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:11:20','2026-08-25 08:11:20',1,1),
(327,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:12:01','2026-08-25 08:12:01',1,1),
(328,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:13:25','2026-08-25 08:13:25',1,1),
(329,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:44:40','2026-08-25 08:44:40',1,1),
(330,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:56:10','2026-08-25 08:56:10',1,1),
(331,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:56:55','2026-08-25 08:56:55',1,1),
(332,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 08:58:57','2026-08-25 08:58:57',1,1),
(333,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 09:00:02','2026-08-25 09:00:02',1,1),
(334,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 09:01:53','2026-08-25 09:01:53',1,1),
(335,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 09:03:17','2026-08-25 09:03:17',1,1),
(336,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 09:05:06','2026-08-25 09:05:06',1,1),
(337,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:10:20','2026-08-25 10:10:20',1,1),
(338,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:15:05','2026-08-25 10:15:05',1,1),
(339,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:17:55','2026-08-25 10:17:55',1,1),
(340,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:18:06','2026-08-25 10:18:06',1,1),
(341,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:18:16','2026-08-25 10:18:16',1,1),
(342,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:33:57','2026-08-25 10:33:57',1,1),
(343,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 10:46:42','2026-08-25 10:46:42',1,1),
(344,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:05:43','2026-08-25 11:05:43',1,1),
(345,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:06:01','2026-08-25 11:06:01',1,1),
(346,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:06:14','2026-08-25 11:06:14',1,1),
(347,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:09:43','2026-08-25 11:09:43',1,1),
(348,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:13:03','2026-08-25 11:13:03',1,1),
(349,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:13:57','2026-08-25 11:13:57',1,1),
(350,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:17:02','2026-08-25 11:17:02',1,1),
(351,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:17:07','2026-08-25 11:17:07',1,1),
(352,'Fabrice OGOU','Administrateur','Ville: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:17:11','2026-08-25 11:17:11',1,1),
(353,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:17:16','2026-08-25 11:17:16',1,1),
(354,'Fabrice OGOU','Administrateur','Ville: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:06','2026-08-25 11:18:06',1,1),
(355,'Fabrice OGOU','Administrateur','Consulat: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:09','2026-08-25 11:18:09',1,1),
(356,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:12','2026-08-25 11:18:12',1,1),
(357,'Fabrice OGOU','Administrateur','Utilisateur: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:15','2026-08-25 11:18:15',1,1),
(358,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:19','2026-08-25 11:18:19',1,1),
(359,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:22','2026-08-25 11:18:22',1,1),
(360,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:18:27','2026-08-25 11:18:27',1,1),
(361,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:19:51','2026-08-25 11:19:51',1,1),
(362,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-08-25 11:21:04','2026-08-25 11:21:04',1,1),
(363,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-02 22:55:58','2026-09-02 22:55:58',1,3),
(364,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-02 22:55:59','2026-09-02 22:55:59',1,3),
(365,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-02 22:56:44','2026-09-02 22:56:44',1,3),
(366,'FATOUMATA CAMARA EPSE CISSE','Agent','Document consulaire: ADN25MA0500007/AGCI/0926','Ajouter','success','avatars/femme.jpg','2026-09-03 00:21:46','2026-09-03 00:21:46',1,3),
(367,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 00:21:58','2026-09-03 00:21:58',1,3),
(368,'FATOUMATA CAMARA EPSE CISSE','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-09-03 00:53:58','2026-09-03 00:53:58',1,3),
(369,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-03 00:54:35','2026-09-03 00:54:35',1,3),
(370,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 00:54:35','2026-09-03 00:54:35',1,3),
(371,'MARIAMA SYLLA EPSE BAH','Agent','Demande: ACTE DE NOTORIETE','Transmettre','info','avatars/femme.jpg','2026-09-03 01:23:20','2026-09-03 01:23:20',1,3),
(372,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 01:23:59','2026-09-03 01:23:59',1,3),
(373,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 09:14:35','2026-09-03 09:14:35',1,2),
(374,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 09:14:35','2026-09-03 09:14:35',1,2),
(375,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 09:16:08','2026-09-03 09:16:08',1,2),
(376,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:02:02','2026-09-03 10:02:02',1,2),
(377,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-09-03 10:02:23','2026-09-03 10:02:23',1,2),
(378,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 10:02:34','2026-09-03 10:02:34',1,1),
(379,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:02:34','2026-09-03 10:02:34',1,1),
(380,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:02:38','2026-09-03 10:02:38',1,1),
(381,'Fabrice OGOU','Administrateur','Modification du Profil','Deconnecter','info','avatars/homme.jpg','2026-09-03 10:03:19','2026-09-03 10:03:19',1,1),
(382,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 10:03:27','2026-09-03 10:03:27',1,1),
(383,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:03:27','2026-09-03 10:03:27',1,1),
(384,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:03:30','2026-09-03 10:03:30',1,1),
(385,'Fabrice OGOU','Administrateur','Détail du document consulaire','Deconnecter','info','avatars/homme.jpg','2026-09-03 10:03:39','2026-09-03 10:03:39',1,1),
(386,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-03 10:03:51','2026-09-03 10:03:51',1,3),
(387,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 10:03:52','2026-09-03 10:03:52',1,3),
(388,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-03 10:03:56','2026-09-03 10:03:56',1,3),
(389,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 10:04:04','2026-09-03 10:04:04',1,2),
(390,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:04:04','2026-09-03 10:04:04',1,2),
(391,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 10:04:06','2026-09-03 10:04:06',1,2),
(392,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 14:13:37','2026-09-03 14:13:37',1,2),
(393,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 15:05:27','2026-09-03 15:05:27',1,2),
(394,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 16:05:56','2026-09-03 16:05:56',1,2),
(395,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-09-03 16:14:22','2026-09-03 16:14:22',1,2),
(396,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-03 16:14:40','2026-09-03 16:14:40',1,3),
(397,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 16:14:41','2026-09-03 16:14:41',1,3),
(398,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 16:31:43','2026-09-03 16:31:43',1,3),
(399,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-03 16:32:29','2026-09-03 16:32:29',1,3),
(400,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 16:32:48','2026-09-03 16:32:48',1,2),
(401,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 16:32:48','2026-09-03 16:32:48',1,2),
(402,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 16:32:55','2026-09-03 16:32:55',1,2),
(403,'ALPHA KEITA','Consul','Document consulaire: ACTE DE NOTORIETE','Valider','info','avatars/homme.jpg','2026-09-03 19:04:10','2026-09-03 19:04:10',1,2),
(404,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 19:04:48','2026-09-03 19:04:48',1,2),
(405,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 19:13:42','2026-09-03 19:13:42',1,2),
(406,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 19:28:48','2026-09-03 19:28:48',1,2),
(407,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-09-03 19:29:08','2026-09-03 19:29:08',1,2),
(408,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-03 19:29:20','2026-09-03 19:29:20',1,3),
(409,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 19:29:20','2026-09-03 19:29:20',1,3),
(410,'FATOUMATA CAMARA EPSE CISSE','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-03 19:29:50','2026-09-03 19:29:50',1,3),
(411,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-03 19:30:03','2026-09-03 19:30:03',1,3),
(412,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 19:30:03','2026-09-03 19:30:03',1,3),
(413,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 19:32:32','2026-09-03 19:32:32',1,3),
(414,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-03 19:43:44','2026-09-03 19:43:44',1,3),
(415,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-03 19:51:27','2026-09-03 19:51:27',1,3),
(416,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-03 19:51:39','2026-09-03 19:51:39',1,1),
(417,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-03 19:51:39','2026-09-03 19:51:39',1,1),
(418,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-05 04:44:11','2026-09-05 04:44:11',1,3),
(419,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:44:11','2026-09-05 04:44:11',1,3),
(420,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:50:45','2026-09-05 04:50:45',1,3),
(421,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:51:04','2026-09-05 04:51:04',1,3),
(422,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:51:55','2026-09-05 04:51:55',1,3),
(423,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:52:34','2026-09-05 04:52:34',1,3),
(424,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 04:52:54','2026-09-05 04:52:54',1,3),
(425,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 05:31:01','2026-09-05 05:31:01',1,3),
(426,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 05:50:44','2026-09-05 05:50:44',1,3),
(427,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 05:51:10','2026-09-05 05:51:10',1,3),
(428,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 05:51:29','2026-09-05 05:51:29',1,3),
(429,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 06:03:07','2026-09-05 06:03:07',1,3),
(430,'MARIAMA SYLLA EPSE BAH','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 06:06:57','2026-09-05 06:06:57',1,3),
(431,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 06:07:02','2026-09-05 06:07:02',1,3),
(432,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:04:02','2026-09-05 07:04:02',1,3),
(433,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:13:14','2026-09-05 07:13:14',1,3),
(434,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:13:38','2026-09-05 07:13:38',1,3),
(435,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:13:49','2026-09-05 07:13:49',1,3),
(436,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:13:58','2026-09-05 07:13:58',1,3),
(437,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:44:13','2026-09-05 07:44:13',1,3),
(438,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:46:44','2026-09-05 07:46:44',1,3),
(439,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 07:49:59','2026-09-05 07:49:59',1,3),
(440,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 08:20:40','2026-09-05 08:20:40',1,3),
(441,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 08:24:02','2026-09-05 08:24:02',1,3),
(442,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-05 08:28:26','2026-09-05 08:28:26',1,3),
(443,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-06 07:09:06','2026-09-06 07:09:06',1,3),
(444,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-06 07:09:06','2026-09-06 07:09:06',1,3),
(445,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-07 23:26:20','2026-09-07 23:26:20',1,1),
(446,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:26:20','2026-09-07 23:26:20',1,1),
(447,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:26:27','2026-09-07 23:26:27',1,1),
(448,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:26:54','2026-09-07 23:26:54',1,1),
(449,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:30:07','2026-09-07 23:30:07',1,1),
(450,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:45:05','2026-09-07 23:45:05',1,1),
(451,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:51:53','2026-09-07 23:51:53',1,1),
(452,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:54:00','2026-09-07 23:54:00',1,1),
(453,'Fabrice OGOU','Administrateur','Document: CERTIFICAT DE NATIONALITE','Modifier','warning','avatars/homme.jpg','2026-09-07 23:55:00','2026-09-07 23:55:00',1,1),
(454,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-07 23:55:29','2026-09-07 23:55:29',1,1),
(455,'Fabrice OGOU','Administrateur','Pièce à fournir: PHOTO D\'IDENTITE','Ajouter','success','avatars/homme.jpg','2026-09-08 00:04:41','2026-09-08 00:04:41',1,1),
(456,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 00:04:47','2026-09-08 00:04:47',1,1),
(457,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 00:05:00','2026-09-08 00:05:00',1,1),
(458,'Fabrice OGOU','Administrateur','Document: ATTESTATION D\'IDENTITE','Modifier','warning','avatars/homme.jpg','2026-09-08 00:05:15','2026-09-08 00:05:15',1,1),
(459,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 00:09:21','2026-09-08 00:09:21',1,1),
(460,'Fabrice OGOU','Administrateur','Pièce à fournir: SIGNATURE ELECTRONIQUE','Ajouter','success','avatars/homme.jpg','2026-09-08 01:02:42','2026-09-08 01:02:42',1,1),
(461,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 01:02:46','2026-09-08 01:02:46',1,1),
(462,'Fabrice OGOU','Administrateur','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 01:56:08','2026-09-08 01:56:08',1,1),
(463,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 01:56:48','2026-09-08 01:56:48',1,1),
(464,'Fabrice OGOU','Administrateur','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 01:57:20','2026-09-08 01:57:20',1,1),
(465,'Fabrice OGOU','Administrateur','Document: CARTE D\'IDENTITE CONSULAIRE','Modifier','warning','avatars/homme.jpg','2026-09-08 01:57:53','2026-09-08 01:57:53',1,1),
(466,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 01:58:09','2026-09-08 01:58:09',1,1),
(467,'Fabrice OGOU','Administrateur','Ajout d\'une demande','Deconnecter','info','avatars/homme.jpg','2026-09-08 01:59:57','2026-09-08 01:59:57',1,1),
(468,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 02:00:16','2026-09-08 02:00:16',1,3),
(469,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 02:00:16','2026-09-08 02:00:16',1,3),
(470,'MARIAMA SYLLA EPSE BAH','Agent','Document consulaire: ADN18OC2000008/AGCI/0926','Ajouter','success','avatars/femme.jpg','2026-09-08 02:25:12','2026-09-08 02:25:12',1,3),
(471,'MARIAMA SYLLA EPSE BAH','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 02:25:20','2026-09-08 02:25:20',1,3),
(472,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 02:25:22','2026-09-08 02:25:22',1,3),
(473,'MARIAMA SYLLA EPSE BAH','Agent','Demande: ACTE DE NOTORIETE','Transmettre','info','avatars/femme.jpg','2026-09-08 02:29:42','2026-09-08 02:29:42',1,3),
(474,'MARIAMA SYLLA EPSE BAH','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-09-08 02:29:49','2026-09-08 02:29:49',1,3),
(475,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 02:30:27','2026-09-08 02:30:27',1,2),
(476,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 02:30:27','2026-09-08 02:30:27',1,2),
(477,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 02:32:09','2026-09-08 02:32:09',1,2),
(478,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 02:33:41','2026-09-08 02:33:41',1,2),
(479,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 02:43:07','2026-09-08 02:43:07',1,2),
(480,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-09-08 02:59:13','2026-09-08 02:59:13',1,2),
(481,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 03:00:15','2026-09-08 03:00:15',1,3),
(482,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 03:00:15','2026-09-08 03:00:15',1,3),
(483,'FATOUMATA CAMARA EPSE CISSE','Agent','Document consulaire: ADI30SE8500009/AGCI/0926','Ajouter','success','avatars/femme.jpg','2026-09-08 03:01:43','2026-09-08 03:01:43',1,3),
(484,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 03:01:48','2026-09-08 03:01:48',1,3),
(485,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: ATTESTATION D\'IDENTITE','Transmettre','info','avatars/femme.jpg','2026-09-08 03:01:56','2026-09-08 03:01:56',1,3),
(486,'FATOUMATA CAMARA EPSE CISSE','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-09-08 03:10:09','2026-09-08 03:10:09',1,3),
(487,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 03:10:21','2026-09-08 03:10:21',1,2),
(488,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:10:21','2026-09-08 03:10:21',1,2),
(489,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:10:32','2026-09-08 03:10:32',1,2),
(490,'ALPHA KEITA','Consul','Document consulaire: ATTESTATION D\'IDENTITE','Valider','info','avatars/homme.jpg','2026-09-08 03:12:49','2026-09-08 03:12:49',1,2),
(491,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:12:55','2026-09-08 03:12:55',1,2),
(492,'ALPHA KEITA','Consul','Pièces à fournir: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:25:57','2026-09-08 03:25:57',1,2),
(493,'ALPHA KEITA','Consul','Document: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:26:03','2026-09-08 03:26:03',1,2),
(494,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:39:23','2026-09-08 03:39:23',1,2),
(495,'ALPHA KEITA','Consul','Document consulaire: ATTESTATION D\'IDENTITE','Valider','info','avatars/homme.jpg','2026-09-08 03:40:00','2026-09-08 03:40:00',1,2),
(496,'ALPHA KEITA','Consul','Document consulaire: ATTESTATION D\'IDENTITE','Valider','info','avatars/homme.jpg','2026-09-08 03:53:16','2026-09-08 03:53:16',1,2),
(497,'ALPHA KEITA','Consul','Document consulaire: ATTESTATION D\'IDENTITE','Valider','info','avatars/homme.jpg','2026-09-08 03:58:17','2026-09-08 03:58:17',1,2),
(498,'ALPHA KEITA','Consul','Détail du document consulaire','Deconnecter','info','avatars/homme.jpg','2026-09-08 03:59:06','2026-09-08 03:59:06',1,2),
(499,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 03:59:21','2026-09-08 03:59:21',1,1),
(500,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:59:21','2026-09-08 03:59:21',1,1),
(501,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 03:59:32','2026-09-08 03:59:32',1,1),
(502,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 04:00:23','2026-09-08 04:00:23',1,1),
(503,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 04:02:50','2026-09-08 04:02:50',1,1),
(504,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 04:05:10','2026-09-08 04:05:10',1,1),
(505,'Fabrice OGOU','Administrateur','Tableau de bord','Deconnecter','info','avatars/homme.jpg','2026-09-08 04:05:21','2026-09-08 04:05:21',1,1),
(506,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 04:28:41','2026-09-08 04:28:41',1,1),
(507,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 04:28:41','2026-09-08 04:28:41',1,1),
(508,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 04:28:50','2026-09-08 04:28:50',1,1),
(509,'FATOUMATA CAMARA EPSE CISSE','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 09:48:17','2026-09-08 09:48:17',1,3),
(510,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 09:48:17','2026-09-08 09:48:17',1,3),
(511,'FATOUMATA CAMARA EPSE CISSE','Agent','Document consulaire: CNR30MR1500010/AGCI/0926','Ajouter','success','avatars/femme.jpg','2026-09-08 10:09:16','2026-09-08 10:09:16',1,3),
(512,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 10:09:26','2026-09-08 10:09:26',1,3),
(513,'FATOUMATA CAMARA EPSE CISSE','Agent','Demande: CERTIFICAT DE NON REMARIAGE','Transmettre','info','avatars/femme.jpg','2026-09-08 10:18:23','2026-09-08 10:18:23',1,3),
(514,'FATOUMATA CAMARA EPSE CISSE','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-09-08 10:18:32','2026-09-08 10:18:32',1,3),
(515,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 10:18:43','2026-09-08 10:18:43',1,2),
(516,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:18:43','2026-09-08 10:18:43',1,2),
(517,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:18:50','2026-09-08 10:18:50',1,2),
(518,'ALPHA KEITA','Consul','Document consulaire: CERTIFICAT DE NON REMARIAGE','Valider','info','avatars/homme.jpg','2026-09-08 10:19:24','2026-09-08 10:19:24',1,2),
(519,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:19:31','2026-09-08 10:19:31',1,2),
(520,'ALPHA KEITA','Consul','Gestion des demandes consulaires','Deconnecter','info','avatars/homme.jpg','2026-09-08 10:19:35','2026-09-08 10:19:35',1,2),
(521,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 10:19:59','2026-09-08 10:19:59',1,3),
(522,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 10:19:59','2026-09-08 10:19:59',1,3),
(523,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-08 10:27:45','2026-09-08 10:27:45',1,3),
(524,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 10:27:55','2026-09-08 10:27:55',1,2),
(525,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:27:55','2026-09-08 10:27:55',1,2),
(526,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:27:59','2026-09-08 10:27:59',1,2),
(527,'ALPHA KEITA','Consul','Document consulaire: CERTIFICAT DE NON REMARIAGE','Valider','info','avatars/homme.jpg','2026-09-08 10:28:32','2026-09-08 10:28:32',1,2),
(528,'ALPHA KEITA','Consul','Détail du document consulaire','Deconnecter','info','avatars/homme.jpg','2026-09-08 10:29:05','2026-09-08 10:29:05',1,2),
(529,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 10:29:18','2026-09-08 10:29:18',1,3),
(530,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 10:29:19','2026-09-08 10:29:19',1,3),
(531,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 10:50:38','2026-09-08 10:50:38',1,3),
(532,'MARIAMA SYLLA EPSE BAH','Agent','Détail du document consulaire','Deconnecter','info','avatars/femme.jpg','2026-09-08 10:50:50','2026-09-08 10:50:50',1,3),
(533,'ALPHA KEITA','Consul','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-08 10:51:00','2026-09-08 10:51:00',1,2),
(534,'ALPHA KEITA','Consul','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:51:00','2026-09-08 10:51:00',1,2),
(535,'ALPHA KEITA','Consul','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-08 10:51:05','2026-09-08 10:51:05',1,2),
(536,'ALPHA KEITA','Consul','Document consulaire: CERTIFICAT DE NON REMARIAGE','Valider','info','avatars/homme.jpg','2026-09-08 10:51:37','2026-09-08 10:51:37',1,2),
(537,'ALPHA KEITA','Consul','Détail du document consulaire','Deconnecter','info','avatars/homme.jpg','2026-09-08 10:51:47','2026-09-08 10:51:47',1,2),
(538,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 10:51:57','2026-09-08 10:51:57',1,3),
(539,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 10:51:57','2026-09-08 10:51:57',1,3),
(540,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-08 19:33:06','2026-09-08 19:33:06',1,3),
(541,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 19:33:06','2026-09-08 19:33:06',1,3),
(542,'MARIAMA SYLLA EPSE BAH','Agent','Document: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 19:35:02','2026-09-08 19:35:02',1,3),
(543,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-08 20:08:47','2026-09-08 20:08:47',1,3),
(544,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-09 07:22:45','2026-09-09 07:22:45',1,3),
(545,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-09 07:22:46','2026-09-09 07:22:46',1,3),
(546,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-10 00:58:48','2026-09-10 00:58:48',1,3),
(547,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-10 00:58:48','2026-09-10 00:58:48',1,3),
(548,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-10 07:14:24','2026-09-10 07:14:24',1,3),
(549,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-10 07:14:25','2026-09-10 07:14:25',1,3),
(550,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-11 06:03:20','2026-09-11 06:03:20',1,3),
(551,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-11 06:03:20','2026-09-11 06:03:20',1,3),
(552,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-15 23:30:02','2026-09-15 23:30:02',1,3),
(553,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-15 23:30:02','2026-09-15 23:30:02',1,3),
(554,'MARIAMA SYLLA EPSE BAH','Agent','Demandes','Connecter','info','avatars/femme.jpg','2026-09-29 17:31:27','2026-09-29 17:31:27',1,3),
(555,'MARIAMA SYLLA EPSE BAH','Agent','Demande: Liste','Consulter','primary','avatars/femme.jpg','2026-09-29 17:31:27','2026-09-29 17:31:27',1,3),
(556,'MARIAMA SYLLA EPSE BAH','Agent','Gestion des demandes consulaires','Deconnecter','info','avatars/femme.jpg','2026-09-29 17:31:35','2026-09-29 17:31:35',1,3),
(557,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-29 17:31:43','2026-09-29 17:31:43',1,1),
(558,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-29 17:31:43','2026-09-29 17:31:43',1,1),
(559,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-29 17:31:48','2026-09-29 17:31:48',1,1),
(560,'Fabrice OGOU','Administrateur','Profil: Liste','Consulter','primary','avatars/homme.jpg','2026-09-29 17:37:37','2026-09-29 17:37:37',1,1),
(561,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-29 19:16:13','2026-09-29 19:16:13',1,1),
(562,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-09-30 03:09:08','2026-09-30 03:09:08',1,1),
(563,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-09-30 03:09:08','2026-09-30 03:09:08',1,1),
(564,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-09-30 03:09:12','2026-09-30 03:09:12',1,1),
(565,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-05 23:35:19','2026-10-05 23:35:19',1,1),
(566,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-05 23:35:20','2026-10-05 23:35:20',1,1),
(567,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-05 23:40:23','2026-10-05 23:40:23',1,1),
(568,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-05 23:47:17','2026-10-05 23:47:17',1,1),
(569,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-05 23:47:49','2026-10-05 23:47:49',1,1),
(570,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-07 01:19:42','2026-10-07 01:19:42',1,1),
(571,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 01:19:42','2026-10-07 01:19:42',1,1),
(572,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 01:19:54','2026-10-07 01:19:54',1,1),
(573,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-07 15:22:37','2026-10-07 15:22:37',1,1),
(574,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 15:22:37','2026-10-07 15:22:37',1,1),
(575,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 15:22:41','2026-10-07 15:22:41',1,1),
(576,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-07 22:19:37','2026-10-07 22:19:37',1,1),
(577,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 22:19:37','2026-10-07 22:19:37',1,1),
(578,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-07 22:19:41','2026-10-07 22:19:41',1,1),
(579,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-08 18:39:30','2026-10-08 18:39:30',1,1),
(580,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-08 18:39:31','2026-10-08 18:39:31',1,1),
(581,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-08 18:39:35','2026-10-08 18:39:35',1,1),
(582,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-09 00:23:43','2026-10-09 00:23:43',1,1),
(583,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-09 00:23:43','2026-10-09 00:23:43',1,1),
(584,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-09 00:23:47','2026-10-09 00:23:47',1,1),
(585,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-16 20:38:03','2026-10-16 20:38:03',1,1),
(586,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-16 20:38:04','2026-10-16 20:38:04',1,1),
(587,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-16 20:43:39','2026-10-16 20:43:39',1,1),
(588,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-17 04:53:04','2026-10-17 04:53:04',1,1),
(589,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-17 04:53:05','2026-10-17 04:53:05',1,1),
(590,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-17 04:53:11','2026-10-17 04:53:11',1,1),
(591,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-18 06:33:41','2026-10-18 06:33:41',1,1),
(592,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-18 06:33:41','2026-10-18 06:33:41',1,1),
(593,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-18 06:33:46','2026-10-18 06:33:46',1,1),
(594,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-18 19:01:34','2026-10-18 19:01:34',1,1),
(595,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-18 19:01:34','2026-10-18 19:01:34',1,1),
(596,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-18 19:01:38','2026-10-18 19:01:38',1,1),
(597,'Fabrice OGOU','Administrateur','Tableau de bord','Connecter','info','avatars/homme.jpg','2026-10-19 00:44:53','2026-10-19 00:44:53',1,1),
(598,'Fabrice OGOU','Administrateur','Tableau de bord: Liste','Consulter','primary','avatars/homme.jpg','2026-10-19 00:44:54','2026-10-19 00:44:54',1,1),
(599,'Fabrice OGOU','Administrateur','Demande: Liste','Consulter','primary','avatars/homme.jpg','2026-10-19 00:44:59','2026-10-19 00:44:59',1,1);
/*!40000 ALTER TABLE `audit_trails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulats`
--

DROP TABLE IF EXISTS `consulats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `consulats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `label` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulats`
--

LOCK TABLES `consulats` WRITE;
/*!40000 ALTER TABLE `consulats` DISABLE KEYS */;
INSERT INTO `consulats` VALUES
(1,'fb89ed84-b2ce-4850-a99e-956f54584682','ABIDJAN',1,'2026-06-10 01:06:53','2026-06-23 20:10:33',NULL,1,1,NULL,41),
(2,'668a3561-fbfa-4595-a742-6d3c848eb246','BOUAKE',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(3,'27ab8275-1533-4a9f-b2f1-a9824d9c3e31','BAMAKO',1,'2026-06-10 06:44:56','2026-06-23 20:10:49',NULL,1,1,NULL,85),
(4,'417642e2-d8a3-4e59-a309-ce34b51b16c8','DAKAR',1,'2026-07-30 01:56:34','2026-07-30 01:57:14',NULL,1,1,NULL,114);
/*!40000 ALTER TABLE `consulats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `alpha` char(2) NOT NULL,
  `code` varchar(10) NOT NULL,
  `embassy` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES
(1,'Afghanistan','Afghane','af','93',0),
(2,'Afrique du Sud','Sud-Africaine','za','27',0),
(3,'Albanie','Albanaise','al','355',0),
(4,'Algérie','Algérienne','dz','213',0),
(5,'Allemagne','Allemande','de','49',0),
(6,'Andorre','Andorrane','ad','376',0),
(7,'Angola','Angolaise','ao','244',0),
(8,'Arabie saoudite','Saoudienne','sa','966',0),
(9,'Argentine','Argentine','ar','54',0),
(10,'Arménie','Arménienne','am','374',0),
(11,'Australie','Australienne','au','61',0),
(12,'Autriche','Autrichienne','at','43',0),
(13,'Azerbaïdjan','Azerbaïdjanaise','az','994',0),
(14,'Bahreïn','Bahreïnie','bh','973',0),
(15,'Bangladesh','Bangladeshie','bd','880',0),
(16,'Belgique','Belge','be','32',0),
(17,'Bénin','Béninoise','bj','229',0),
(18,'Bhoutan','Bhoutanaise','bt','975',0),
(19,'Biélorussie','Biélorusse','by','375',0),
(20,'Bolivie','Bolivienne','bo','591',0),
(21,'Bosnie-Herzégovine','Bosnienne','ba','387',0),
(22,'Botswana','Botswanaise','bw','267',0),
(23,'Brésil','Brésilienne','br','55',0),
(24,'Bulgarie','Bulgare','bg','359',0),
(25,'Burkina Faso','Burkinabè','bf','226',0),
(26,'Burundi','Burundaise','bi','257',0),
(27,'Cambodge','Cambodgienne','kh','855',0),
(28,'Cameroun','Camerounaise','cm','237',0),
(29,'Canada','Canadienne','ca','1',0),
(30,'Cap-Vert','Cap-Verdienne','cv','238',0),
(31,'Chili','Chilienne','cl','56',0),
(32,'Chine','Chinoise','cn','86',0),
(33,'Chypre','Chypriote','cy','357',0),
(34,'Colombie','Colombienne','co','57',0),
(35,'Comores','Comorienne','km','269',0),
(36,'Congo (Brazzaville)','Congolaise','cg','242',0),
(37,'Congo (Kinshasa)','Congolaise (RDC)','cd','243',0),
(38,'Corée du Nord','Nord-Coréenne','kp','850',0),
(39,'Corée du Sud','Sud-Coréenne','kr','82',0),
(40,'Costa Rica','Costaricienne','cr','506',0),
(41,'Côte d’Ivoire','Ivoirienne','ci','225',1),
(42,'Croatie','Croate','hr','385',0),
(43,'Cuba','Cubaine','cu','53',0),
(44,'Danemark','Danoise','dk','45',0),
(45,'Djibouti','Djiboutienne','dj','253',0),
(46,'Égypte','Égyptienne','eg','20',0),
(47,'Émirats arabes unis','Émiratie','ae','971',0),
(48,'Équateur','Équatorienne','ec','593',0),
(49,'Érythrée','Érythréenne','er','291',0),
(50,'Espagne','Espagnole','es','34',0),
(51,'Estonie','Estonienne','ee','372',0),
(52,'États-Unis','Américaine','us','1',0),
(53,'Éthiopie','Éthiopienne','et','251',0),
(54,'Finlande','Finlandaise','fi','358',0),
(55,'France','Française','fr','33',0),
(56,'Gabon','Gabonaise','ga','241',0),
(57,'Gambie','Gambienne','gm','220',0),
(58,'Géorgie','Géorgienne','ge','995',0),
(59,'Ghana','Ghanéenne','gh','233',0),
(60,'Grèce','Grecque','gr','30',0),
(61,'Guinée','Guinéenne','gn','224',0),
(62,'Haïti','Haïtienne','ht','509',0),
(63,'Honduras','Hondurienne','hn','504',0),
(64,'Hongrie','Hongroise','hu','36',0),
(65,'Inde','Indienne','in','91',0),
(66,'Indonésie','Indonésienne','id','62',0),
(67,'Irak','Irakienne','iq','964',0),
(68,'Iran','Iranienne','ir','98',0),
(69,'Irlande','Irlandaise','ie','353',0),
(70,'Islande','Islandaise','is','354',0),
(71,'Israël','Israélienne','il','972',0),
(72,'Italie','Italienne','it','39',0),
(73,'Japon','Japonaise','jp','81',0),
(74,'Jordanie','Jordanienne','jo','962',0),
(75,'Kenya','Kényane','ke','254',0),
(76,'Koweït','Koweïtienne','kw','965',0),
(77,'Laos','Laotienne','la','856',0),
(78,'Lettonie','Lettone','lv','371',0),
(79,'Liban','Libanaise','lb','961',0),
(80,'Libye','Libyenne','ly','218',0),
(81,'Lituanie','Lituanienne','lt','370',0),
(82,'Luxembourg','Luxembourgeoise','lu','352',0),
(83,'Madagascar','Malgache','mg','261',0),
(84,'Malaisie','Malaisienne','my','60',0),
(85,'Mali','Malienne','ml','223',0),
(86,'Maroc','Marocaine','ma','212',0),
(87,'Mexique','Mexicaine','mx','52',0),
(88,'Monaco','Monégasque','mc','377',0),
(89,'Mongolie','Mongole','mn','976',0),
(90,'Mozambique','Mozambicaine','mz','258',0),
(91,'Namibie','Namibienne','na','264',0),
(92,'Népal','Népalaise','np','977',0),
(93,'Niger','Nigérienne','ne','227',0),
(94,'Nigeria','Nigériane','ng','234',0),
(95,'Norvège','Norvégienne','no','47',0),
(96,'Nouvelle-Zélande','Néo-Zélandaise','nz','64',0),
(97,'Ouganda','Ougandaise','ug','256',0),
(98,'Ouzbékistan','Ouzbèke','uz','998',0),
(99,'Pakistan','Pakistanaise','pk','92',0),
(100,'Panama','Panaméenne','pa','507',0),
(101,'Paraguay','Paraguayenne','py','595',0),
(102,'Pays-Bas','Néerlandaise','nl','31',0),
(103,'Pérou','Péruvienne','pe','51',0),
(104,'Philippines','Philippine','ph','63',0),
(105,'Pologne','Polonaise','pl','48',0),
(106,'Portugal','Portugaise','pt','351',0),
(107,'Qatar','Qatarie','qa','974',0),
(108,'REPUBLIQUE centrafricaine','Centrafricaine','cf','236',0),
(109,'REPUBLIQUE dominicaine','Dominicaine','do','1',0),
(110,'Roumanie','Roumaine','ro','40',0),
(111,'Royaume-Uni','Britannique','gb','44',0),
(112,'Russie','Russe','ru','7',0),
(113,'Rwanda','Rwandaise','rw','250',0),
(114,'Sénégal','Sénégalaise','sn','221',0),
(115,'Serbie','Serbe','rs','381',0),
(116,'Sierra Leone','Sierra-Léonaise','sl','232',0),
(117,'Singapour','Singapourienne','sg','65',0),
(118,'Slovaquie','Slovaque','sk','421',0),
(119,'Slovénie','Slovène','si','386',0),
(120,'Somalie','Somalienne','so','252',0),
(121,'Soudan','Soudanaise','sd','249',0),
(122,'Soudan du Sud','Sud-Soudanaise','ss','211',0),
(123,'Sri Lanka','Sri Lankaise','lk','94',0),
(124,'Suède','Suédoise','se','46',0),
(125,'Suisse','Suisse','ch','41',0),
(126,'Syrie','Syrienne','sy','963',0),
(127,'Tanzanie','Tanzanienne','tz','255',0),
(128,'Tchad','Tchadienne','td','235',0),
(129,'Thaïlande','Thaïlandaise','th','66',0),
(130,'Tunisie','Tunisienne','tn','216',0),
(131,'Turquie','Turque','tr','90',0),
(132,'Ukraine','Ukrainienne','ua','380',0),
(133,'Uruguay','Uruguayenne','uy','598',0),
(134,'Venezuela','Vénézuélienne','ve','58',0),
(135,'Viêt Nam','Vietnamienne','vn','84',0),
(136,'Yémen','Yéménite','ye','967',0),
(137,'Zambie','Zambienne','zm','260',0),
(138,'Zimbabwe','Zimbabwéenne','zw','263',0);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demands`
--

DROP TABLE IF EXISTS `demands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `demands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `number` tinyint(4) NOT NULL,
  `copy` tinyint(4) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `motif` text DEFAULT NULL,
  `path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `transmitted_at` timestamp NULL DEFAULT NULL,
  `validated_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `recovered_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `transmitted_by` bigint(20) unsigned DEFAULT NULL,
  `validated_by` bigint(20) unsigned DEFAULT NULL,
  `rejected_by` bigint(20) unsigned DEFAULT NULL,
  `recovered_by` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `consulat_id` bigint(20) unsigned NOT NULL,
  `document_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demands_code_unique` (`reference`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demands`
--

LOCK TABLES `demands` WRITE;
/*!40000 ALTER TABLE `demands` DISABLE KEYS */;
INSERT INTO `demands` VALUES
(1,'3dc468e5-50b5-4aaf-b69f-88be0b87b099','ADN15MA2000001/AGCI/0726',5,2,30000,NULL,'storage/demands/20260701/a37b3cea-0478-4ad3-8f73-bdd66456253c/ADNwjZVYc4H5m1rJ.pdf',2,'2026-07-30 08:00:00','2026-07-01 22:34:00','2026-08-14 06:59:03',NULL,'2026-07-28 19:29:42','2026-07-28 19:29:49',NULL,'2026-07-30 10:00:00',4,1,NULL,4,2,NULL,4,5,1,4),
(2,'5da06d8c-fdfe-434f-a4a9-a47616279145','ADI05JA9500002/AGCI/0726',2,3,15000,'','storage/demands/20260706/f58cfa32-6016-4959-9eda-27460f64a32f/ADIji3UhgQvHdtSp.pdf',2,'2026-07-31 08:00:00','2026-07-06 02:07:54','2026-08-14 06:58:40',NULL,'2026-07-28 19:27:21','2026-07-28 19:27:27',NULL,NULL,3,1,NULL,3,2,NULL,NULL,6,1,3),
(3,'8c63fe72-0b41-4193-a463-bbd5622b8505','CDN25AO0500003/AGCI/0726',5,1,0,NULL,'storage/demands/20260719/4498e15b-1107-4f99-95eb-36979e1b9e92/CDNZUKVvQWtBT1kx.pdf',2,'2026-07-27 08:00:00','2026-07-19 08:46:10','2026-08-14 06:58:18',NULL,'2026-07-28 19:25:04','2026-07-20 10:25:12',NULL,'2026-07-27 10:45:12',4,1,NULL,4,2,NULL,3,7,1,10),
(4,'472ca09c-bef5-4e14-956c-29195c32afb2','ADN20AV9500004/AGCI/0726',4,1,15000,NULL,'storage/demands/20260724/4f1703fd-b2ca-420e-83ca-50c65f8347cf/ADNiaUD4NHMFTr5Q.pdf',2,'2026-07-29 08:00:00','2026-07-22 19:27:09','2026-08-14 06:57:56',NULL,'2026-07-28 19:20:37','2026-07-28 19:20:58',NULL,NULL,4,1,NULL,3,2,NULL,NULL,8,1,4),
(5,'0285d5b2-7c7d-4407-9448-0628201ba385','CDC15AV9500005/AGCI/0726',3,1,25000,NULL,'storage/demands/20260615/7df52ec2-9190-4787-9929-7eb83f8a7483/CDC6wP7ifCSWnNu8.pdf',2,'2026-07-29 08:00:00','2026-07-24 22:46:15','2026-08-14 06:59:26',NULL,'2026-07-28 19:56:47','2026-07-28 19:56:57',NULL,NULL,3,1,NULL,3,2,NULL,NULL,9,1,5),
(6,'3846f279-5af5-4c5b-a2b2-0f3af26c817a','CDN30NO8500006/AGCI/0826',3,2,40000,NULL,'storage/demands/20260802/954a2656-d173-4b02-ab99-e7a98b5cb290/CDNyZbNIcE8Vh1ft.pdf',2,'2026-08-04 08:00:00','2026-08-02 02:50:32','2026-08-16 16:54:46',NULL,'2026-08-02 03:00:18','2026-08-02 03:00:50',NULL,'2026-08-10 14:20:00',3,1,NULL,4,2,NULL,1,11,1,10),
(7,'77581b39-55a0-446a-accf-c9161e630e0b','ADN25MA0500007/AGCI/0926',4,2,30000,NULL,'storage/demands/20260903/89591e91-cdb1-4caa-b039-10dc4983b050/ADNLqniURXTkbQSD.pdf',2,'2026-09-08 00:00:00','2026-09-03 00:21:45','2026-09-03 19:04:10',NULL,'2026-09-03 01:23:20','2026-09-03 19:03:42',NULL,NULL,4,2,NULL,3,2,NULL,NULL,12,1,4),
(8,'51345abd-99f6-469c-ab54-77e1a3d75773','ADN18OC2000008/AGCI/0926',4,3,45000,NULL,NULL,1,NULL,'2026-09-08 02:25:12','2026-09-08 02:29:42',NULL,'2026-09-08 02:29:42',NULL,NULL,NULL,3,3,NULL,3,NULL,NULL,NULL,4,1,4),
(9,'7c829258-4aeb-40fa-bce7-e021e9f374b2','ADI30SE8500009/AGCI/0926',2,4,20000,NULL,'storage/demands/20260908/954a2656-d173-4b02-ab99-e7a98b5cb290/ADIdExDTCRlA51ec.pdf',2,'2026-09-14 00:00:00','2026-09-08 03:01:43','2026-09-08 03:58:17',NULL,'2026-09-08 03:01:56','2026-09-08 03:57:46',NULL,NULL,4,2,NULL,4,2,NULL,NULL,11,1,3),
(10,'c3781e83-9600-4e8e-bf26-eca31b2065a1','CNR30MR1500010/AGCI/0926',3,2,20000,NULL,'storage/demands/20260908/97378936-9dc4-448c-8356-ed0f27ebb7dc/CNRCH0sT8EGNlV6f.pdf',2,'2026-09-10 00:00:00','2026-09-08 10:09:16','2026-09-08 10:51:37',NULL,'2026-09-08 10:18:23','2026-09-08 10:51:13',NULL,NULL,4,2,NULL,4,2,NULL,NULL,13,1,6);
/*!40000 ALTER TABLE `demands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_files`
--

DROP TABLE IF EXISTS `doc_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `doc_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doc_files_file_id_document_id_unique` (`file_id`,`document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_files`
--

LOCK TABLES `doc_files` WRITE;
/*!40000 ALTER TABLE `doc_files` DISABLE KEYS */;
INSERT INTO `doc_files` VALUES
(22,5,10),
(25,5,1),
(4,5,2),
(23,1,3),
(6,6,4),
(7,4,5),
(8,6,5),
(9,5,5),
(13,5,6),
(12,6,6),
(14,6,7),
(15,5,7),
(16,6,8),
(17,5,8),
(18,2,8),
(19,6,9),
(20,2,9),
(24,6,3),
(26,1,1),
(27,2,1);
/*!40000 ALTER TABLE `doc_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `icone` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `number` tinyint(4) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES
(1,'8e2d428e-27bd-47cf-9c91-3a60ffc21447','CIC','far fa-address-card','CARTE D\'IDENTITE CONSULAIRE',10000,5,'Une carte d\'identité consulaire (ou carte consulaire) est un document officiel délivré par une ambassade ou un consulat à ses citoyens qui résident ou séjournent dans un pays étranger. Elle atteste de l\'immatriculation de son titulaire auprès des services consulaires de son pays d\'origine.',1,'2026-06-12 04:13:18','2026-08-17 21:02:48',NULL,1,1,NULL),
(2,'96f27152-e740-416b-a845-a46d986176ad','CDI','far fa-address-card','CERTIFICAT D\'INDIVIDUALITE',10000,3,'Le certificat d\'individualité est un document administratif ou judiciaire qui prouve que deux documents portant des informations différentes (nom orthographié différemment, inversion de prénoms, etc.) appartiennent bel et bien à une seule et même personne.',1,'2026-06-17 18:36:11','2026-06-17 18:36:11',NULL,1,NULL,NULL),
(3,'f238c156-7d53-401a-afc9-201bd0b91779','ADI','far fa-address-card','ATTESTATION D\'IDENTITE',5000,2,'L\'attestation d\'identité est un document administratif provisoire permettant de justifier de votre identité et de vos droits dans l\'attente de votre Carte Nationale d\'Identité (CNI).',1,'2026-06-17 18:40:35','2026-06-17 18:40:35',NULL,1,NULL,NULL),
(4,'033df05d-9ef0-4152-9cd5-203801a6ce21','ADN','far fa-address-card','ACTE DE NOTORIETE',15000,4,'Un acte de notoriété est un document authentique, rédigé par un notaire, qui sert à prouver un fait ou un droit dont la justification exacte est impossible ou difficile à obtenir par des documents officiels.',1,'2026-06-23 20:36:19','2026-06-23 20:36:19',NULL,1,NULL,NULL),
(5,'7c68070e-fcc3-4f83-8e5e-fce9c3d2f44f','CDC','far fa-address-card','CERTIFICAT DE CELIBAT',25000,3,'Un certificat de célibat est un document administratif officiel délivré pour prouver qu\'une personne n\'est pas engagée dans les liens d\'un mariage actuel.',1,'2026-07-24 19:31:40','2026-07-24 19:31:40',NULL,4,NULL,NULL),
(6,'33ea0bb6-6bcb-49e1-947b-1f5124fe4955','CNR','far fa-address-card','CERTIFICAT DE NON REMARIAGE',10000,3,'Le certificat de non-remariage est un document officiel qui prouve qu\'une personne veuve ou divorcée ne s\'est pas remariée depuis.',1,'2026-07-29 02:26:17','2026-07-29 02:38:48',NULL,1,1,NULL),
(7,'db2c905c-c92a-4ad6-838f-f91ac4b3bf31','CBC','far fa-address-card','CERTIFICAT DE BONNE CONDUITE',15000,2,'Un certificat de bonne conduite est un document officiel qui atteste l\'absence de condamnation pénale ou prouve la bonne moralité d\'une personne.',1,'2026-07-29 02:46:00','2026-08-02 20:39:12',NULL,1,1,NULL),
(8,'6f9115b8-a2c8-4e19-9750-72ba3f9b5f63','CCM','far fa-address-card','CERTIFICAT DE CAPACITE MATRIMONIALE',20000,3,'Le certificat de capacité matrimoniale (ou certificat de capacité à mariage / CCAM) est un document officiel qui prouve qu\'une personne remplit toutes les conditions légales pour se marier.',1,'2026-07-29 15:26:12','2026-07-29 15:26:12',NULL,1,NULL,NULL),
(9,'f64d08fe-c97e-4ab7-b6d1-24f67a5a79de','TDV','far fa-address-card','TITRE DE VOYAGE',10000,3,'Un titre de voyage est un document officiel d\'identité tenant lieu de passeport. Il est délivré à une personne qui ne peut pas obtenir un passeport de son pays d\'origine, le plus souvent en raison de son statut de réfugié, de protégé subsidiaire ou d\'apatride.',1,'2026-07-29 15:32:33','2026-07-29 15:32:33',NULL,1,NULL,NULL),
(10,'05cbf4f9-9e6a-488d-b77b-29b68c5ff142','CDN','far fa-address-card','CERTIFICAT DE NATIONALITE',20000,5,'Le certificat de nationalité est un document juridique officiel délivré par les autorités publiques d\'un pays qui atteste légalement de la nationalité d\'un individu.',1,'2026-06-12 04:13:18','2026-06-12 04:13:18',NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `label` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES
(6,'3eb4339f-b5a9-4d40-9bd7-244f89c0f7a9','CARTE D\'IDENTITE NATIONALE','specimens/sqeHXgRGQkClYD4fb9w5dsh7HMGRrnf8JKVrMiN6.jpg',1,'2026-06-10 17:58:30','2026-06-11 12:34:39',NULL,1,1,NULL),
(7,'cfcca318-cb74-4b17-878b-2905244ce06f','PASSEPORT','specimens/7UoQsx2DAvMd0hND74cPvgePerBeLexbuSxN6AcF.jpg',1,'2026-06-11 10:29:24','2026-06-11 10:29:24',NULL,1,NULL,NULL),
(3,'3af0c6b4-a7da-453c-ac98-9efee2cb9cc1','CARTE D\'ELECTEUR','specimens/vY69KeVl9xnYC7LujAviWjiqoBG1bOSte8tBU1A1.jpg',1,'2026-06-11 12:32:15','2026-06-11 12:32:15',NULL,1,NULL,NULL),
(4,'51f82473-5960-4eba-8722-f90ae153ae16','CARTE D\'IDENTITE CONSULAIRE','specimens/TJ7De5VetLUANSnpHWtaAYNar3j7Y2mD3RP7NQGb.jpg',1,'2026-06-11 12:32:41','2026-06-11 12:32:41',NULL,1,NULL,NULL),
(5,'f2c0d844-eae5-4673-b5c7-fac458174af1','EXTRAIT DE NAISSANCE','specimens/Af4hFC5KLfrpkKwiBflTZ1sVaPUrPt1icPK9zX87.jpg',1,'2026-06-17 18:13:37','2026-06-17 18:13:37',NULL,1,NULL,NULL),
(1,'8a00d0ca-925c-4ae9-8325-56a468818d6d','PHOTO D\'IDENTITE','specimens/7cgx27XXkXSXpsimxCtz3V8rFMjXJepaUcfAxXcH.jpg',1,'2026-09-08 00:04:41','2026-09-08 00:04:41',NULL,1,NULL,NULL),
(2,'c4ac1e23-a09c-490a-a581-6f8c5ad7ed5b','SIGNATURE ELECTRONIQUE','specimens/CQTrlBoQkUXYTUzK32enxunUB8BHN4qKO2661rW5.png',1,'2026-09-08 01:02:42','2026-09-08 01:02:42',NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_actions`
--

DROP TABLE IF EXISTS `menu_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_actions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_actions_menu_id_action_id_unique` (`menu_id`,`action_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_actions`
--

LOCK TABLES `menu_actions` WRITE;
/*!40000 ALTER TABLE `menu_actions` DISABLE KEYS */;
INSERT INTO `menu_actions` VALUES
(1,1,1),
(2,2,1),
(3,2,2),
(4,2,3),
(5,2,11),
(6,2,6),
(7,2,7),
(8,2,8),
(9,2,10),
(10,2,9),
(11,3,1),
(12,3,2),
(13,3,3),
(14,3,4),
(15,3,5),
(16,4,1),
(17,4,2),
(18,4,3),
(19,4,4),
(20,4,5),
(21,5,1),
(22,5,2),
(23,5,3),
(24,5,4),
(25,5,5),
(26,6,1),
(27,6,2),
(28,6,3),
(29,6,4),
(30,6,5),
(31,7,1),
(32,7,2),
(33,7,3),
(34,7,4),
(35,7,5),
(36,8,1),
(37,8,2),
(38,8,3),
(39,8,4),
(40,8,5),
(41,9,1);
/*!40000 ALTER TABLE `menu_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `target` varchar(50) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `position` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES
(1,'Tableau de bord','dashboard','ki-element-7',1,1),
(2,'Demandes','demands','ki-calendar-8',2,1),
(3,'Documents','documents','ki-abstract-26',3,1),
(4,'Pièces à fournir','files','ki-abstract-25',4,1),
(5,'Villes','towns','ki-bank',5,1),
(6,'Consulats','consulats','ki-call',6,1),
(7,'Profils','profiles','ki-map',7,1),
(8,'Utilisateurs','users','ki-address-book',8,1),
(9,'Piste d\'audit','audit_trails','ki-code',9,1);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2026_03_15_025530_create_users_table',1),
(2,'2026_03_15_025535_create_profiles_table',1),
(3,'2026_03_15_025540_create_actions_table',1),
(4,'2026_03_15_025545_create_menus_table',1),
(5,'2026_03_15_025550_create_permissions_table',1),
(6,'2026_03_15_025555_create_demands_table_1',1),
(7,'2026_03_15_030510_create_menu_actions_table',1),
(8,'2026_03_15_031040_create_documents_table',1),
(9,'2026_03_15_031520_create_attachments_table',1),
(10,'2026_03_15_031535_create_files_table',1),
(11,'2026_03_15_032040_create_towns_table',1),
(12,'2026_03_15_032510_create_logs_table',1),
(13,'2026_06_09_103010_create_countries.table',1),
(14,'2026_06_09_141050_create_agencies_table',1),
(15,'2026_06_11_095010_create_doc_files_table',2),
(16,'2026_03_15_025555_create_demands_table',3),
(17,'2026_07_16_205540_create_roles_table',4),
(18,'2026_07_21_101630_create_sp_list_demands_procedure_1',5),
(19,'2026_07_27_120010_create_annual_stats_table',6),
(20,'2026_07_27_120525_create_monthly_stats_table',6),
(21,'2026_07_27_121050_create_trigger_valid_demands',7),
(22,'2026_07_27_121545_create_sp_get_stats_data',8),
(23,'2026_07_29_224005_create_sp_chart_docs_stats_procedure_1',9),
(24,'2026_07_29_224005_create_sp_chart_documents_procedure_1',10),
(25,'2026_07_29_224005_create_sp_chart_documents_procedure_2',11),
(26,'2026_06_09_141050_create_consulats_table',12),
(27,'2026_07_21_101630_create_sp_list_demands_procedure_2',12),
(28,'2026_07_27_121050_create_valid_demands_trigger',12),
(29,'2026_07_27_121545_create_sp_get_stats_data_procedure_2',12),
(30,'2026_07_29_224005_create_sp_chart_documents_procedure_3',12),
(31,'2026_07_21_101630_create_sp_list_demands_procedure',13),
(32,'2026_07_27_121545_create_sp_get_stats_data_procedure',13),
(33,'2026_07_29_224005_create_sp_chart_documents_procedure',13),
(34,'2026_07_21_101630_create_sp_get_dmds_data_procedure',14),
(35,'2026_07_29_224005_create_sp_chart_docs_procedure',14),
(36,'2026_03_15_032510_create_audit_trails_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_stats`
--

DROP TABLE IF EXISTS `monthly_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `monthly_stats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `months` tinyint(4) NOT NULL,
  `years` year(4) NOT NULL,
  `amount` decimal(15,0) NOT NULL DEFAULT 0,
  `paid` int(11) NOT NULL DEFAULT 0,
  `free` int(11) NOT NULL DEFAULT 0,
  `created` int(11) NOT NULL DEFAULT 0,
  `transmitted` int(11) NOT NULL DEFAULT 0,
  `validated` int(11) NOT NULL DEFAULT 0,
  `rejected` int(11) NOT NULL DEFAULT 0,
  `recovered` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consulat_id` bigint(20) unsigned NOT NULL,
  `document_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `monthly_stats_agency_id_document_id_months_years_unique` (`consulat_id`,`document_id`,`months`,`years`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_stats`
--

LOCK TABLES `monthly_stats` WRITE;
/*!40000 ALTER TABLE `monthly_stats` DISABLE KEYS */;
INSERT INTO `monthly_stats` VALUES
(1,7,2026,45000,3,0,2,2,2,0,1,'2026-08-08 07:46:15',NULL,1,4),
(2,7,2026,15000,3,0,1,1,1,0,0,'2026-08-08 07:46:36',NULL,1,3),
(3,7,2026,0,0,1,1,1,1,0,1,'2026-08-08 07:47:35',NULL,1,10),
(4,7,2026,25000,1,0,1,1,1,0,0,'2026-08-08 07:51:10',NULL,1,5),
(5,8,2026,40000,2,0,1,1,1,0,1,'2026-08-08 07:51:15',NULL,1,10),
(6,9,2026,0,0,0,0,1,0,0,0,'2026-09-03 01:23:20',NULL,1,4);
/*!40000 ALTER TABLE `monthly_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_menu_id_action_id_profile_id_unique` (`menu_id`,`action_id`,`profile_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,1,1,1),
(2,2,1,1),
(3,2,2,1),
(4,2,3,1),
(5,2,11,1),
(6,2,6,1),
(7,2,7,1),
(8,2,8,1),
(9,2,10,1),
(10,2,9,1),
(11,3,1,1),
(12,3,2,1),
(13,3,3,1),
(14,3,4,1),
(15,3,5,1),
(16,4,1,1),
(17,4,2,1),
(18,4,3,1),
(19,4,4,1),
(20,4,5,1),
(21,5,1,1),
(22,5,2,1),
(23,5,3,1),
(24,5,4,1),
(25,5,5,1),
(26,6,1,1),
(27,6,2,1),
(28,6,3,1),
(29,6,4,1),
(30,6,5,1),
(31,7,1,1),
(32,7,2,1),
(33,7,3,1),
(34,7,4,1),
(35,7,5,1),
(36,8,1,1),
(37,8,2,1),
(38,8,3,1),
(39,8,5,1),
(40,9,1,1),
(41,2,1,3),
(42,2,2,3),
(43,2,3,3),
(44,2,11,3),
(45,2,6,3),
(46,2,10,3),
(47,2,9,3),
(48,3,1,3),
(49,3,2,3),
(50,3,3,3),
(51,4,1,3),
(52,4,2,3),
(53,4,3,3),
(54,5,1,3),
(55,5,2,3),
(56,5,3,3),
(57,6,1,3),
(58,6,2,3),
(59,6,3,3),
(60,1,1,2),
(61,2,1,2),
(62,2,7,2),
(63,2,8,2),
(64,3,1,2),
(65,3,4,2),
(66,3,5,2),
(67,4,1,2),
(68,4,4,2),
(69,4,5,2),
(70,5,1,2),
(71,5,4,2),
(72,5,5,2),
(73,6,1,2),
(74,6,4,2),
(75,6,5,2),
(76,8,1,2),
(77,8,4,2),
(78,8,5,2),
(79,9,1,2);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `role_id` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES
(1,'4f3465d4-0626-4265-a502-2550b100d683','Administrateur','Administrateur du système.',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,1),
(2,'f46c11c4-27d2-40d9-b258-bca78a843d71','Consul','Consul de l\'Ambassade',1,'2026-06-10 01:09:05','2026-08-03 04:41:55',NULL,1,1,NULL,2),
(3,'74ce6a8d-71b2-47a0-a2ee-534a3972ab91','Agent','Agent de l\'Ambassade',1,'2026-06-10 02:00:14','2026-08-03 04:41:38',NULL,1,1,NULL,3);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'Admin'),
(2,'Consul'),
(3,'Agent'),
(4,'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `towns`
--

DROP TABLE IF EXISTS `towns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `towns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `label` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `towns`
--

LOCK TABLES `towns` WRITE;
/*!40000 ALTER TABLE `towns` DISABLE KEYS */;
INSERT INTO `towns` VALUES
(1,'43434344-6ce1-4f1a-8c3c-5853565aa02a','CONAKRY',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,61),
(2,'0f0c4fd4-ff6f-4963-b795-ca6841d6c43c','COCODY (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(3,'1d4fa094-3740-423a-9b5b-563e2809d136','PLATEAU (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(4,'9aeadba2-01c7-48f5-89b1-72df3fc1d184','YOPOUGON (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(5,'ea6f4877-2fc8-44bd-9d82-0d633ea1c9eb','MARCORY (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(6,'cc9d5309-3cf4-4bc4-8937-d9b7bb95565a','ABOBO (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(7,'34af717b-753d-4bda-9588-d12e12a18e68','ATTECOUBE (ABIDJAN)',1,'2026-06-10 01:06:53','2026-08-02 20:28:42',NULL,1,1,NULL,41),
(8,'1fbe970c-a2f7-4590-98a1-9aed18be7400','ADJAME (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(9,'b30f5b70-3196-4ddf-b293-204bdabdd88f','KOUMASSI (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(10,'6f79acdc-46dd-4891-9fad-fc1e8bd4df2c','PORT-BOUET (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(11,'aa0f308f-0321-4f99-b84d-bb248bd7bd43','TREICHVILLE (ABIDJAN)',1,'2026-06-10 01:06:53','2026-06-10 01:06:53',NULL,1,NULL,NULL,41),
(12,'5671182c-653d-417c-a347-e11409c99990','BAMAKO',1,'2026-06-10 06:39:35','2026-08-02 20:38:54',NULL,1,1,NULL,85),
(13,'e3e87cce-0a66-4cca-8ca5-fd78aa6427ae','KANKAN',1,'2026-07-30 01:58:05','2026-07-30 01:58:05',NULL,1,NULL,NULL,61);
/*!40000 ALTER TABLE `towns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `civility` varchar(5) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `phone_code` varchar(5) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_at` timestamp NULL DEFAULT NULL,
  `birthday_at` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `hairs` varchar(255) DEFAULT NULL,
  `complexion` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `particular_sign` varchar(255) DEFAULT NULL,
  `father_fullname` varchar(255) DEFAULT NULL,
  `mother_fullname` varchar(255) DEFAULT NULL,
  `person_fullname` varchar(255) DEFAULT NULL,
  `person_code` varchar(5) DEFAULT NULL,
  `person_number` varchar(255) DEFAULT NULL,
  `person_address` varchar(255) DEFAULT NULL,
  `arrival_at` date DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `stamp` text DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `blocked_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `blocked_by` bigint(20) unsigned DEFAULT NULL,
  `activated_by` bigint(20) unsigned DEFAULT NULL,
  `town_id` int(11) NOT NULL,
  `consulat_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT 0,
  `embassy_id` int(11) DEFAULT 0,
  `nationality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'fbb78733-1f29-4983-a4d5-cebcecab4aae','M.','OGOU','Fabrice','M','225','0102030405','fabio225@yopmail.com','$2y$12$DQStIzY8kJLc1XQieu0gS.fhak.NHkKB27H5HVqMxDBDvbz6yWzzm','2026-08-17 17:30:36','1990-05-15','Cocody','1.75','Brun','Clair','Ingénieur','Riviera Anono, Abidjan','Sportif','Léon OGOU','Apo KOUASSI','JB OGOU','225','0102030406','10 rue de Cocody, 75001 Abidjan','2000-04-30',NULL,NULL,NULL,'2026-10-19 00:44:53',0,1,'2026-06-10 01:06:53','2026-10-19 00:44:53',NULL,'2026-08-17 17:30:36',NULL,1,1,NULL,NULL,1,2,1,1,41,41),
(2,'3c706870-8d10-48c9-a247-375c54e9997c','M.','KEITA','ALPHA OUMAR','M','225','0101439969','falex@yopmail.com','$2y$12$ThBQc83faBQmNZTNm3bQV./hXw09w38HkrJHWJi3lhRy7YsKwgQhe','2026-06-10 13:28:29','2026-07-22','KOUMASSI PRODOMO','1.80M','CREPUS','CLAIR','POLICIER','MARCORY BORIBANA','RAS','OGOU ASSI LEON','KOUASSI APO','OGOU JEAN-BAPTISTE','225','0102030405','ANONO VILLAGE','2026-07-22',NULL,'','','2026-09-08 10:51:00',0,1,'2026-06-10 13:28:29','2026-09-08 10:51:00',NULL,NULL,NULL,1,2,NULL,NULL,NULL,9,1,2,41,41),
(3,'1b82be4b-2673-4047-bbe5-e6226022f480','Mme','SYLLA EPSE BAH','MARIAMA','F','225','0203040506','dez@yopmail.com','$2y$12$ThBQc83faBQmNZTNm3bQV./hXw09w38HkrJHWJi3lhRy7YsKwgQhe','2026-07-03 04:39:25','2005-10-18','Résidentiel','1.80m','Crépus','Noir','Sage-Femme','Treichville - Cité du port','RAS','OGOU Assi Léon','ASSI Chépie Agathe','Fabrice Ogou','225','2250102030405','Cocody - Riviera 2','2025-05-10',NULL,'','','2026-09-29 17:31:26',0,1,'2026-07-03 04:39:29','2026-09-29 17:31:26',NULL,NULL,NULL,1,3,NULL,NULL,NULL,5,1,3,41,41),
(4,'8712387d-816e-4ccd-b6a8-31b3ea62821a','Mme','CAMARA EPSE CISSE','FATOUMATA','F','225','0708296231','tino@yopmail.com','$2y$12$Ra9f0WI85tZVOG5asAm6GO07KThiJebTqkLspBy2mchmkcyiASAz6','2026-07-10 05:03:29','2020-10-18','PLATEAU - RESIDENTIEL','1.60M','NOIR','CLAIR','COMPTABLE','ANONO VILLAGE - COCODY','RAS','N\'ZUE ARISTIDE','YAO BERNADETTE','N\'ZUE EUDE','225','0102030405','YOPOUGON','2025-05-15',NULL,'','','2026-09-08 09:48:17',1,1,'2026-07-10 05:03:32','2026-09-08 09:48:17',NULL,NULL,NULL,1,4,NULL,NULL,NULL,3,1,3,41,41),
(5,'a37b3cea-0478-4ad3-8f73-bdd66456253c','M.','BARRY','AMARA LAMAH','M','224','601234567','malick@gmail.com',NULL,NULL,'2020-05-15','CONAKRY','1M85','NOIR','CLAIR','CONSUL','ANGRE - COCODY','RAS','BARRY DJAKARIDJA','BAMBA ASSIETOU','BARRY DJAKARIDJA','224','612345678','YOPOUGON','2025-07-10',NULL,NULL,NULL,NULL,0,0,'2026-07-14 22:34:00','2026-07-14 22:34:00',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1,NULL,0,0,61),
(6,'f58cfa32-6016-4959-9eda-27460f64a32f','Mme','BALDE EPSE SIDIBE','AISSATOU','F','225','0908070605','',NULL,NULL,'2015-01-15','COCODY','1M75','NOIR','NOIR','SAGE-FEMME','ABOBO','RAS','ASSI FRANCOIS','ASSI CHEPIE AGATHE','ASSI JEAN EUDE','225','0908020304','YOPOUGON','2025-10-10',NULL,NULL,NULL,NULL,0,0,'2026-07-15 02:07:54','2026-07-15 02:07:54',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,2,NULL,0,0,41),
(7,'4498e15b-1107-4f99-95eb-36979e1b9e92','Mlle','CONDE','AICHA FATIMA','F','224','612345678','rokiata@gmail.com',NULL,NULL,'2005-08-25','ABOBO ANADOR','1M50','NOIR','CLAIR','COMMERCANTE','ABOBO SOGEPHIA','RAS','BAMBA LAMINE','KANDIA FATOUMATA','OGOU ASSI FRANCK','225','0101439969','MARCORY BORIBANA','2025-10-10',NULL,NULL,NULL,NULL,0,0,'2026-07-19 08:46:10','2026-07-19 08:46:10',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,6,NULL,0,0,61),
(8,'4f1703fd-b2ca-420e-83ca-50c65f8347cf','M.','KABA','BALLO NAMORY','M','224','623456789','sidiki@yopmail.com',NULL,NULL,'1995-04-20','CITE DU PORT','1M75','NOIR','CLAIR','COMMERCIAL','KOUMASSI - TERMINUS 32','RAS','DEMBELE AROUNA','BAMBA KARIDJATOU','FABRICE OGOU','225','5544332211','RIVIERA - ANONO','2025-05-10',NULL,NULL,NULL,NULL,0,0,'2026-07-24 19:27:09','2026-07-24 19:27:09',NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,11,NULL,0,0,61),
(9,'7df52ec2-9190-4787-9929-7eb83f8a7483','M.','FOFANA','GANDO ISSAKA','M','224','634567890','saliou@yopmail.com',NULL,NULL,'1995-04-15','KANKAN','1M75','NOIR','CLAIR','PROFESSEUR DE MATHEMATIQUES','PORT-BOUET','GRAND DE TAILLE','SALIOU TOURE','DJELIKABA BINTOU','MAMADOU ANTONIO SOUARE','225','5566778899','ANGRE CHU','2025-10-15',NULL,NULL,NULL,NULL,0,0,'2026-07-24 22:46:15','2026-07-24 22:46:15',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,1,NULL,0,0,61),
(10,'60d67a14-8a82-44fb-a02a-15264923125d','M.','DIAKITE','BAMBA MORY','M','225','6655443322','elvis@gmail.com','$2y$12$9PHlu8q65xXIk7eWSJ5cluKAnybG9oz8PC.qmJAXmyDgwDxK9J/BG','2026-07-30 01:43:32','2026-07-30','WILLIAMVILLE','1M85','NOIR','CLAIR','GENDARME','AGBOVILLE','RAS','OGOU ASSI LEON','ASSI CHEPIE AGATHE','OGOU JEAN-BAPTISTE','225','8877665544','AIR FRANCE - BOUAKE','2020-05-30',NULL,'','',NULL,0,1,'2026-07-30 01:43:32','2026-07-30 01:44:35',NULL,NULL,NULL,1,1,NULL,NULL,NULL,8,2,2,41,41),
(11,'954a2656-d173-4b02-ab99-e7a98b5cb290','M.','DIALLO','MAMADOU OURY','M','225','5577889922','diallo@gmail.com',NULL,NULL,'1985-09-30','KINDIA','1M50','NOIR','CLAIR','PROFESSEUR','DABOU','RAS','DIALLO SEKOU','SYLLA AMINATA','KEITA OUSMANE','224','652233445','YOMOU - GUINEE','2020-07-20',NULL,NULL,NULL,NULL,0,0,'2026-08-02 02:32:14','2026-09-08 03:01:43',NULL,NULL,NULL,1,4,NULL,NULL,NULL,13,NULL,0,0,61),
(12,'89591e91-cdb1-4caa-b039-10dc4983b050','M.','KABA','ABDOURAHAMANE LAMINE','M','225','0304050607','kaba10@yopmail.com',NULL,NULL,'2005-05-25','KINDIA','1M10','NOIR','NOIR','MACON','ABOBO SAMAKE','RAS','KEITA LOUIS TAMBA','CAMARA CLARICE KOLOU','THIAM AMARA LAMAH','224','62345678','BOKE','2025-09-10',NULL,NULL,NULL,NULL,0,0,'2026-09-03 00:21:45','2026-09-03 00:21:45',NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,13,NULL,0,0,61),
(13,'97378936-9dc4-448c-8356-ed0f27ebb7dc','Mme','SOW EPSE THIAM','MAMAISSATA','F','225','0405060708','sow@yopmail.com',NULL,NULL,'2015-03-30','NABA','1M55','NOIR','CLAIR','COMPTABLE','COCODY - RIVIERA 2','RAS','SOW SOULEYMANE','DUMAS YALIKHATOU','SOUMAH KOUROUMA','224','610102039','DABOU','2020-10-15',NULL,NULL,NULL,NULL,0,0,'2026-09-08 10:09:16','2026-09-08 10:09:16',NULL,NULL,NULL,4,NULL,NULL,NULL,NULL,1,NULL,0,0,61);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ambagnci_db'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_chart_docs_data` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_uca1400_ai_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_chart_docs_data`(
                IN p_consulat_id BIGINT,
			    IN p_start_date DATE,
			    IN p_end_date DATE
			)
BEGIN
			
			    /*
			    |--------------------------------------------------------------------------
			    | Validation des dates
			    |--------------------------------------------------------------------------
			    */
			    IF p_start_date IS NULL OR p_end_date IS NULL THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début et la date de fin sont obligatoires.';
			    END IF;
			
			    IF p_start_date > p_end_date THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début ne peut pas être supérieure à la date de fin.';
			    END IF;
			
				/*
			    |--------------------------------------------------------------------------
			    | Statistiques des documents
			    |--------------------------------------------------------------------------
			    */
                SELECT
                    doc.id,
                    doc.label,
                    COALESCE(SUM(dmd.copy), 0) AS total
                FROM documents doc
                LEFT JOIN demands AS dmd
			        ON dmd.document_id = doc.id
			        AND dmd.consulat_id = p_consulat_id
			        AND dmd.status = 2
			        AND dmd.validated_at >= p_start_date
			        AND dmd.validated_at < DATE_ADD(p_end_date, INTERVAL 1 DAY)
                WHERE doc.status = 1
                GROUP BY doc.id, doc.label
                ORDER BY doc.label ASC;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_dmds_data` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_uca1400_ai_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_dmds_data`(
                IN p_user_id BIGINT
            )
BEGIN
                DECLARE v_role_id TINYINT;
                DECLARE v_consulat_id INT;

                
                SELECT
                    p.role_id,
                    u.consulat_id
                INTO
                    v_role_id,
                    v_consulat_id
                FROM users u
                INNER JOIN profiles p ON p.id = u.profile_id
                WHERE u.id = p_user_id
                  AND u.deleted_at IS NULL
                LIMIT 1;

                
                IF v_role_id = 1 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.consulat_id = v_consulat_id
                    AND dmd.deleted_at IS NULL
                    ORDER BY dmd.created_at DESC;

                
                ELSEIF v_role_id = 2 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                      AND dmd.status != 0
                    ORDER BY dmd.created_at DESC;

                
                ELSEIF v_role_id = 3 THEN
                    SELECT
                        doc.id,
                        dmd.uuid,
                        dmd.number,
                        dmd.price,
                        dmd.copy,
                        dmd.status,
                        dmd.delivered_at,
                        dmd.recovered_at,
                        dmd.path,
                        CONCAT_WS(' ', usr.civility, usr.firstname, usr.lastname) AS username,
                        doc.label AS label
                    FROM demands dmd
                    INNER JOIN users usr ON usr.id = dmd.user_id
                    INNER JOIN documents doc ON doc.id = dmd.document_id
                    WHERE dmd.deleted_at IS NULL
                      AND dmd.consulat_id = v_consulat_id
                    ORDER BY dmd.created_at DESC;

                END IF;

            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_stats_data` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_uca1400_ai_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_stats_data`(
                IN p_consulat_id INT,
			    IN p_document_id INT,
			    IN p_start_date DATE,
			    IN p_end_date DATE
			)
BEGIN
			
			    /*
			    |--------------------------------------------------------------------------
			    | Validation des dates
			    |--------------------------------------------------------------------------
			    */
			    IF p_start_date IS NULL OR p_end_date IS NULL THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début et la date de fin sont obligatoires.';
			    END IF;
			
			    IF p_start_date > p_end_date THEN
			        SIGNAL SQLSTATE '45000'
			        SET MESSAGE_TEXT = 'La date de début ne peut pas être supérieure à la date de fin.';
			    END IF;
			
			
			    /*
			    |--------------------------------------------------------------------------
			    | Statistiques
			    |--------------------------------------------------------------------------
			    */
			    SELECT
			        COALESCE(SUM(d.price), 0) AS amount,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.price <> 0 THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS paid,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.price = 0 THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS free,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.created_at IS NOT NULL THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS created,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.transmitted_at IS NOT NULL THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS transmitted,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.validated_at IS NOT NULL THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS validated,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.rejected_at IS NOT NULL THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS rejected,			
			        COALESCE(SUM(
			            CASE
			                WHEN d.recovered_at IS NOT NULL THEN d.copy
			                ELSE 0
			            END
			        ), 0) AS recovered			
			    FROM demands AS d
			    WHERE d.consulat_id = p_consulat_id			
		      	AND (
		            p_document_id IS NULL
		            OR d.document_id = p_document_id
		          )			
		      	AND d.created_at >= p_start_date			
		      	AND d.created_at < DATE_ADD(p_end_date, INTERVAL 1 DAY);
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-10-19  9:45:25
