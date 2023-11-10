-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 19 sep. 2019 à 13:12
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
-- Base de données :  `havrearpenteurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_A` int(11) NOT NULL AUTO_INCREMENT,
  `title_A` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_A` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortContent_A` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `longContent_A` text COLLATE utf8mb4_unicode_ci,
  `creationDate_A` datetime NOT NULL,
  `modifDate_A` datetime DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_A`),
  KEY `FK_Articles_Users` (`id_U`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_A`, `title_A`, `image_A`, `shortContent_A`, `longContent_A`, `creationDate_A`, `modifDate_A`, `id_U`) VALUES
(1, 'Arrivé du site !', 'uploads/article1.jpg', '<p>C\'est avec une grande joie que je vous annonce l\'arrivé de notre site internet !</p><p>Après plusieurs mois de dur labeur, de sang, de cris et de larmes, il est enfin (presque) prêt !</p><p>Plusieurs fonctionnalités seront présentes, notamment l\'accès à des articles, à des événements et la possibilité de les commenter. Je rentrerais plus dans les détails en dessous.</p><p>Ceci est la première version du site et des améliorations sont à prévoir alors si vous rencontrez des problèmes lors de votre navigation n\'hésitez pas à nous prévenir par mail (lehavredesarpenteurs@free.fr) ou par message sur&nbsp;<a href=\"https://www.facebook.com/HavredesArpenteurs/\">notre Facebook</a>&nbsp;et nous ferons de notre possible pour résoudre ce problème.</p>', 'Si vous lisez ceci c\'est que vous voulez en apprendre plus sur les fonctionnalités de notre site.<p>Alors dans l\'ordre :</p><p><ul><li>Inscription</li></ul><p>Vous aurez la possibilité de vous inscrire sur le site. Cela vous permettra de vous inscrire et de participer aux différents événements et articles grâce à la partie commentaire.</p><p><p><ul><li>Article</li></ul><p>Des articles vous seront proposé vous permettant de connaitre nos avis sur divers sujets, d\'être au courant de choses importantes liées à l\'association.</p><ul><li>Événement<br></li></ul><p>Nos divers événements seront disponibles afin que vous aillez une meilleure visibilité sur celles-ci. Vous aurez la possibilité (si vous êtes inscrit) de vous y inscrire et/ou de partager votre avis via les commentaires.</p></p></p></p>', '2019-09-18 17:37:02', '2019-09-19 13:10:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_Cat` int(11) NOT NULL AUTO_INCREMENT,
  `name_Cat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_Cat`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_Cat`, `name_Cat`) VALUES
(1, 'Magic - Commander'),
(2, 'Magic - Modern'),
(3, 'Magic - Standard'),
(4, 'Yu-gi-oh'),
(5, 'Sortie cinéma'),
(6, 'Jeu de rôle'),
(7, 'Jeu de société'),
(8, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_C` int(11) NOT NULL AUTO_INCREMENT,
  `title_C` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_C` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `creationDate_C` datetime NOT NULL,
  `modifDate_C` datetime DEFAULT NULL,
  `id_A` int(11) DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_E` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_C`),
  KEY `FK_Comments_Articles` (`id_A`),
  KEY `FK_Comments_Users0` (`id_U`),
  KEY `FK_Comments_Events1` (`id_E`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_C`, `title_C`, `content_C`, `creationDate_C`, `modifDate_C`, `id_A`, `id_U`, `id_E`) VALUES
(1, 'Un commentaire', 'Ceci est le corps de mon commentaire !', '2019-09-19 12:15:13', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_E` int(11) NOT NULL AUTO_INCREMENT,
  `title_E` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_E` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortContent_E` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `longContent_E` text COLLATE utf8mb4_unicode_ci,
  `dateEvent_E` datetime NOT NULL,
  `creationDate_E` datetime NOT NULL,
  `modifDate_E` datetime DEFAULT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_Cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_E`),
  KEY `FK_Events_Users` (`id_U`),
  KEY `FK_Events_Category` (`id_Cat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_E`, `title_E`, `image_E`, `shortContent_E`, `longContent_E`, `dateEvent_E`, `creationDate_E`, `modifDate_E`, `id_U`, `id_Cat`) VALUES
(1, 'Participation ZAP Monthly', 'uploads/event1.jpg', '<p>[ZAP monthly] Duel Commander 100 joueurs le 20 octobre !</p><p>Bonjour à tous :)</p><p>Voici le second tournoi de l\'année 2019-2020 ! Dépêchez vous de vous inscrire avant qu\'on n\'ait plus de place !</p><p>Au programme comme d\'habitude illustrateurs, altérateurs, boutiques et buvette !</p><p><a href=\"http://tiny.cc/c63xcz\">LIEN ICI</a></p>', '', '2019-10-20 09:00:00', '2019-09-18 17:52:02', '2019-09-19 12:26:26', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `registered`
--

DROP TABLE IF EXISTS `registered`;
CREATE TABLE IF NOT EXISTS `registered` (
  `id_R` int(11) NOT NULL AUTO_INCREMENT,
  `date_R` datetime NOT NULL,
  `id_U` int(11) DEFAULT NULL,
  `id_E` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_R`),
  KEY `FK_Registered_Users` (`id_U`),
  KEY `FK_Registered_Events` (`id_E`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_R` int(11) NOT NULL AUTO_INCREMENT,
  `name_R` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_R`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_R`, `name_R`) VALUES
(1, 'Inscrit'),
(2, 'Membre'),
(3, 'Modérateur'),
(4, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_U` int(11) NOT NULL AUTO_INCREMENT,
  `userName_U` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName_U` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstName_U` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_U` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_U` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthDate_U` date DEFAULT NULL,
  `phone_U` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streetNumber_U` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_U` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additionalAddress_U` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipCode_U` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_U` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creationDate_U` date NOT NULL,
  `status_U` int(11) NOT NULL,
  `activationKey_U` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recuperationKey_U` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_R` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_U`),
  KEY `FK_Users_Roles` (`id_R`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_U`, `userName_U`, `lastName_U`, `firstName_U`, `password_U`, `email_U`, `birthDate_U`, `phone_U`, `streetNumber_U`, `address_U`, `additionalAddress_U`, `zipCode_U`, `city_U`, `creationDate_U`, `status_U`, `activationKey_U`, `recuperationKey_U`, `id_R`) VALUES
(1, 'Yolak', '', '', '$2y$10$jRaNkuJp3R75HwZ1Efu/CuLqY0z65POtt/gqL2FWZFuVbVjAkItVi', 'baguet.mickael@gmail.com', NULL, '', '', '', '', '', '', '2019-09-17', 1, '0dc424cab303c85dc2e1e58eb46afb26', NULL, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_Articles_Users` FOREIGN KEY (`id_U`) REFERENCES `users` (`id_U`) ON DELETE SET NULL;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_Comments_Articles` FOREIGN KEY (`id_A`) REFERENCES `articles` (`id_A`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Comments_Events1` FOREIGN KEY (`id_E`) REFERENCES `events` (`id_E`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Comments_Users0` FOREIGN KEY (`id_U`) REFERENCES `users` (`id_U`) ON DELETE SET NULL;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_Events_Category` FOREIGN KEY (`id_Cat`) REFERENCES `category` (`id_Cat`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Events_Users` FOREIGN KEY (`id_U`) REFERENCES `users` (`id_U`) ON DELETE SET NULL;

--
-- Contraintes pour la table `registered`
--
ALTER TABLE `registered`
  ADD CONSTRAINT `FK_Registered_Events` FOREIGN KEY (`id_E`) REFERENCES `events` (`id_E`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_Registered_Users` FOREIGN KEY (`id_U`) REFERENCES `users` (`id_U`) ON DELETE SET NULL;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_Roles` FOREIGN KEY (`id_R`) REFERENCES `roles` (`id_R`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
