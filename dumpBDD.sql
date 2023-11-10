-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: havreArpenteurs
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Articles`
--

DROP TABLE IF EXISTS `Articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Articles` (
  `id_A` int(11) NOT NULL AUTO_INCREMENT,
  `title_A` varchar(50) NOT NULL,
  `image_A` varchar(50) NOT NULL,
  `shortContent_A` text NOT NULL,
  `longContent_A` text,
  `creationDate_A` datetime NOT NULL,
  `modifDate_A` datetime DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_A`),
  KEY `FK_Articles_Users` (`id_U`),
  CONSTRAINT `FK_Articles_Users` FOREIGN KEY (`id_U`) REFERENCES `Users` (`id_U`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Articles`
--

LOCK TABLES `Articles` WRITE;
/*!40000 ALTER TABLE `Articles` DISABLE KEYS */;
INSERT INTO `Articles` VALUES (1,'Article','uploads/article1.png','erfezf zef zefze fze f zef ze<br>','','2019-08-29 19:51:35',NULL,1),(2,'Article au pif paf','uploads/article2.jpg','<p>Et interdum acciderat, ut siquid in penetrali secreto nullo \r\nciterioris vitae ministro praesente paterfamilias uxori susurrasset in \r\naurem, velut Amphiarao referente aut Marcio, quondam vatibus inclitis, \r\npostridie disceret imperator. ideoque etiam parietes arcanorum soli \r\nconscii timebantur.</p>','<p>Illud tamen te esse admonitum volo, primum ut qualis es talem te esse\r\n omnes existiment ut, quantum a rerum turpitudine abes, tantum te a \r\nverborum libertate seiungas; deinde ut ea in alterum ne dicas, quae cum \r\ntibi falso responsa sint, erubescas. Quis est enim, cui via ista non \r\npateat, qui isti aetati atque etiam isti dignitati non possit quam velit\r\n petulanter, etiamsi sine ulla suspicione, at non sine argumento male \r\ndicere? Sed istarum partium culpa est eorum, qui te agere voluerunt; \r\nlaus pudoris tui, quod ea te invitum dicere videbamus, ingenii, quod \r\nornate politeque dixisti.</p>\r\n<p>Eodem tempore etiam Hymetii praeclarae indolis viri negotium est \r\nactitatum, cuius hunc novimus esse textum. cum Africam pro consule \r\nregeret Carthaginiensibus victus inopia iam lassatis, ex horreis Romano \r\npopulo destinatis frumentum dedit, pauloque postea cum provenisset \r\nsegetum copia, integre sine ulla restituit mora.</p>','2019-09-11 15:01:51','2019-09-11 15:02:11',1);
/*!40000 ALTER TABLE `Articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `id_Cat` int(11) NOT NULL AUTO_INCREMENT,
  `name_Cat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_Cat`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'Magic - Commander'),(2,'Magic - Modern'),(3,'Magic - Standard'),(4,'Yu-gi-oh'),(5,'Sortie cinéma'),(6,'Jeu de rôle'),(7,'Jeu de société'),(8,'Autre');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `id_C` int(11) NOT NULL AUTO_INCREMENT,
  `title_C` varchar(50) NOT NULL,
  `content_C` text NOT NULL,
  `creationDate_C` datetime NOT NULL,
  `modifDate_C` datetime DEFAULT NULL,
  `id_A` int(11) DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_E` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_C`),
  KEY `FK_Comments_Articles` (`id_A`),
  KEY `FK_Comments_Users0` (`id_U`),
  KEY `FK_Comments_Events1` (`id_E`),
  CONSTRAINT `FK_Comments_Articles` FOREIGN KEY (`id_A`) REFERENCES `Articles` (`id_A`) ON DELETE SET NULL,
  CONSTRAINT `FK_Comments_Events1` FOREIGN KEY (`id_E`) REFERENCES `Events` (`id_E`) ON DELETE SET NULL,
  CONSTRAINT `FK_Comments_Users0` FOREIGN KEY (`id_U`) REFERENCES `Users` (`id_U`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (1,'','Ceci est un commentaire<br>','2019-08-29 18:12:13',NULL,NULL,1,1),(5,'','Commentaire article 1 avec modif<br>','2019-08-29 19:55:57','2019-08-29 20:00:26',1,1,NULL),(6,'','Commentaire event 1<br>','2019-08-29 19:58:05',NULL,NULL,1,1),(7,'','Ceci est mon commentaire !','2019-09-02 14:17:45',NULL,NULL,1,3),(8,'','plop','2019-09-03 14:01:15',NULL,1,1,NULL),(9,'Ceci est un titre','Je ne sais pas quoi dire mais je mets tout de même un commentaire.Alors voila le commentaire, maintenant il faudra le placer correctement en mode responsive.','2019-09-11 17:21:32',NULL,2,1,NULL),(10,'Titre du commentaire','Je ne sais pas quoi dire mais je mets tout de même un commentaire.Alors \r\nvoila le commentaire, maintenant il faudra le placer correctement en \r\nmode responsive.','2019-09-11 17:23:06','2019-09-12 09:46:13',NULL,1,4),(11,'','<div>Test de commentaire avec mise en page.</div><div>Voila voila !<br></div>','2019-09-12 10:39:05',NULL,NULL,1,4);
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Events`
--

DROP TABLE IF EXISTS `Events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Events` (
  `id_E` int(11) NOT NULL AUTO_INCREMENT,
  `title_E` varchar(50) NOT NULL,
  `image_E` varchar(50) NOT NULL,
  `shortContent_E` text NOT NULL,
  `longContent_E` text,
  `dateEvent_E` datetime NOT NULL,
  `creationDate_E` datetime NOT NULL,
  `modifDate_E` datetime DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_Cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_E`),
  KEY `FK_Events_Users` (`id_U`),
  KEY `FK_Events_Category` (`id_Cat`),
  CONSTRAINT `FK_Events_Category` FOREIGN KEY (`id_Cat`) REFERENCES `Category` (`id_Cat`) ON DELETE SET NULL,
  CONSTRAINT `FK_Events_Users` FOREIGN KEY (`id_U`) REFERENCES `Users` (`id_U`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Events`
--

LOCK TABLES `Events` WRITE;
/*!40000 ALTER TABLE `Events` DISABLE KEYS */;
INSERT INTO `Events` VALUES (1,'Event','uploads/event1.png','zeazeaze azeaze azeadazedz e<br>','','2020-12-05 08:00:00','2019-08-29 18:07:59',NULL,1,4),(2,'Event 2','uploads/event2.png','<div style=\"text-align: center;\"><b>zerzerze rzerze rze rz er r</b></div><div style=\"text-align: center;\"><b><br></b></div><div style=\"text-align: left;\">De la mise en page bien propre !<br><b></b></div>','','2019-10-28 12:00:00','2019-08-29 19:58:39','2019-09-10 09:28:31',1,3),(3,'Un titre !','uploads/event3.png','<p>Excogitatum est super his, ut homines quidam ignoti, vilitate</p><p> ipsa \r\nparum cavendi ad colligendos rumores per Antiochiae latera cuncta \r\ndestinarentur relaturi quae audirent. hi peragranter et dissimulanter \r\nhonoratorum circulis adsistendo pervadendoque divites domus egentium \r\nhabitu quicquid noscere poterant vel audire latenter intromissi per \r\nposticas in regiam nuntiabant, id observantes conspiratione concordi, ut <br></p><p><br></p><p>fingerent quaedam et cognita duplicarent in peius, laudes vero \r\nsupprimerent Caesaris, quas invitis conpluribus formido malorum \r\ninpendentium exprimebat.</p>','<p>Excogitatum est super his, ut homines quidam ignoti, vilitate ipsa \r\nparum cavendi ad colligendos rumores per Antiochiae latera cuncta \r\ndestinarentur relaturi quae audirent. hi peragranter et dissimulanter \r\nhonoratorum circulis adsistendo pervadendoque divites domus egentium \r\nhabitu quicquid noscere poterant vel audire latenter intromissi per \r\nposticas in regiam nuntiabant, id observantes conspiratione concordi, ut <br></p><p><br></p><p>fingerent quaedam et cognita duplicarent in peius, laudes vero \r\nsupprimerent Caesaris, quas invitis conpluribus formido malorum \r\ninpendentium exprimebat.</p>','2019-09-07 12:00:00','2019-08-30 10:02:20','2019-08-30 11:35:59',1,1),(4,'Event au pif paf','uploads/event4.jpg','<p>Quam ob rem circumspecta cautela observatum est deinceps et cum edita\r\n montium petere coeperint grassatores, loci iniquitati milites cedunt. \r\nubi autem in planitie potuerint reperiri, quod contingit adsidue, nec \r\nexsertare lacertos nec crispare permissi tela, quae vehunt bina vel \r\nterna, pecudum ritu inertium trucidantur.</p>','<p>Quam ob rem circumspecta cautela observatum est deinceps et cum edita\r\n montium petere coeperint grassatores, loci iniquitati milites cedunt. \r\nubi autem in planitie potuerint reperiri, quod contingit adsidue, nec \r\nexsertare lacertos nec crispare permissi tela, quae vehunt bina vel \r\nterna, pecudum ritu inertium trucidantur.</p>','2019-10-09 19:30:00','2019-09-11 15:04:02','2019-09-11 15:04:15',1,1);
/*!40000 ALTER TABLE `Events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Registered`
--

DROP TABLE IF EXISTS `Registered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Registered` (
  `id_R` int(11) NOT NULL AUTO_INCREMENT,
  `date_R` datetime NOT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_E` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_R`),
  KEY `FK_Registered_Users` (`id_U`),
  KEY `FK_Registered_Events` (`id_E`),
  CONSTRAINT `FK_Registered_Events` FOREIGN KEY (`id_E`) REFERENCES `Events` (`id_E`) ON DELETE SET NULL,
  CONSTRAINT `FK_Registered_Users` FOREIGN KEY (`id_U`) REFERENCES `Users` (`id_U`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Registered`
--

LOCK TABLES `Registered` WRITE;
/*!40000 ALTER TABLE `Registered` DISABLE KEYS */;
INSERT INTO `Registered` VALUES (2,'2019-09-03 15:12:14',1,3);
/*!40000 ALTER TABLE `Registered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `id_R` int(11) NOT NULL AUTO_INCREMENT,
  `name_R` varchar(50) NOT NULL,
  PRIMARY KEY (`id_R`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (1,'Inscrit'),(2,'Membre'),(3,'Modérateur'),(4,'Administrateur');
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id_U` int(11) NOT NULL AUTO_INCREMENT,
  `userName_U` varchar(60) NOT NULL,
  `lastName_U` varchar(50) DEFAULT NULL,
  `firstName_U` varchar(50) DEFAULT NULL,
  `password_U` varchar(60) NOT NULL,
  `email_U` varchar(50) NOT NULL,
  `birthDate_U` date DEFAULT NULL,
  `phone_U` varchar(10) DEFAULT NULL,
  `streetNumber_U` varchar(10) DEFAULT NULL,
  `address_U` varchar(50) DEFAULT NULL,
  `additionalAddress_U` varchar(100) DEFAULT NULL,
  `zipCode_U` varchar(10) DEFAULT NULL,
  `city_U` varchar(50) DEFAULT NULL,
  `creationDate_U` date NOT NULL,
  `status_U` int(11) NOT NULL,
  `activationKey_U` varchar(32) NOT NULL,
  `recuperationKey_U` varchar(32) DEFAULT NULL,
  `id_R` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_U`),
  KEY `FK_Users_Roles` (`id_R`),
  CONSTRAINT `FK_Users_Roles` FOREIGN KEY (`id_R`) REFERENCES `Roles` (`id_R`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Yolak','','','$2y$10$1z1q/ekCg/VvkGdYzascOuu/E0DpKm4/Z6H2Jitt0JELBqWv.c/7C','test@test.fr',NULL,'','','','','','','2019-08-29',1,'',NULL,4),(2,'Bob','','Bob','$2y$10$y.CoFwcVCMQbfpf9fVeZH.ei4AItWQh3B0yoIoSWJBTY02Qc3L.sO','bob@bob.fr',NULL,'','','','','','','2019-08-30',0,'',NULL,2),(4,'Membre','','','$2y$10$vCfKYhHra46wPj/8GtCCm.DMmuQ.eR9.Ofkj2tHm2y4eCt1XwAe8m','test@test.fr',NULL,'','','','','','','2019-08-30',0,'',NULL,2),(5,'Modo','','','$2y$10$wEjspPhVLrgO5Z8q3VtBz.OLrIE/VC0K1DICqADanL/hzXWAZz/aS','test@test.fr',NULL,'','','','','','','2019-08-30',0,'',NULL,3),(7,'Tester','','','$2y$10$5txzuFGYT4bte2WHAbxeE.sRuILGW.xTwdqRFh/Z2GDLkWeetZ2Qu','test@test.fr',NULL,'','','','','','','2019-09-10',0,'bcbab8306c0ca2a0ed0743b31c2e4c17',NULL,1),(11,'Mail','','','$2y$10$KTP6.gPVsyhiGZZ0EWdK0ewPX1qPT0cR8lN4D3UfFYXLnGqMTeAWW','havrearpenteurs@gmail.com',NULL,'','','','','','','2019-09-10',1,'1ec0d549ba45dd00ac36314a6838b37f','',1),(12,'Psymantis','Hinard','Sébastien','$2y$10$y3QhaX0giiNk4TtKNjqDO.a33mWgyH8J.edQ33Ka2XlIE61yzAY06','se.hinard@gmail.com','1982-11-16','0676791616','27','rue Albert Gaudry','','80090','Amiens','2019-09-10',1,'006db2a717cddb179b4e9fb1d01dd651',NULL,1),(19,'Plop','Plop','Plop','$2y$10$mmd3KVt96T7XqpjJEtao7.e8jk2tbk.8TGylSzPMMr40MxgDL8tU.','baguet.mickael@gmail.com',NULL,'','','','','','','2019-09-11',1,'5588fc01619038e67fc8b8dffe515d25',NULL,1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-12 15:01:53
