-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : sam. 06 fév. 2021 à 10:26
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manga_universe`
--

-- --------------------------------------------------------

--
-- Structure de la table `animes`
--

DROP TABLE IF EXISTS `animes`;
CREATE TABLE IF NOT EXISTS `animes` (
  `id_anime` int(11) NOT NULL AUTO_INCREMENT,
  `date_sortie_a` date NOT NULL,
  `nbr_saison` int(11) NOT NULL DEFAULT 1,
  `nbr_episode` int(11) NOT NULL DEFAULT 1,
  `resume_anime` text NOT NULL,
  `couverture_anime` char(250) DEFAULT NULL,
  `id_oeuvre` int(11) NOT NULL,
  PRIMARY KEY (`id_anime`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `remarque` text NOT NULL,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `id_oeuvre` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `remarque`, `id_utilisateur`, `id_oeuvre`) VALUES
(1, 'c\'est un très bon manga ', 5, 5),
(2, 'il merite d\'etre dans le top classement ', 5, 5),
(4, 'super oeuvre', 5, 5),
(9, 'dfgdfgdf dfdfhghgg hdghghgd ghhdh ', 2, 1),
(10, 'dfgdfgdf fgdf gdfg dfdgf dgfd  ', 2, 2),
(11, 'dfgdf g dfgfgf  fgf dd gdfg ddgdfg g fgdfg', 2, 3),
(12, 'sds ss sgggffg fgdfd f ', 2, 4),
(13, 'pokemeon attraper les tous ', 2, 9);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_favoris` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `id_oeuvre` int(11) NOT NULL,
  PRIMARY KEY (`id_favoris`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favoris`, `id_utilisateur`, `id_oeuvre`) VALUES
(7, 5, 5),
(8, 5, 8),
(9, 5, 2),
(19, 1, 1),
(20, 1, 5),
(21, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `id_oeuvre` int(11) NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mangas`
--

DROP TABLE IF EXISTS `mangas`;
CREATE TABLE IF NOT EXISTS `mangas` (
  `id_manga` int(11) NOT NULL AUTO_INCREMENT,
  `date_sortie_m` date NOT NULL,
  `nbr_chapitre` int(11) NOT NULL DEFAULT 1,
  `resume_manga` text NOT NULL,
  `id_oeuvre` int(11) NOT NULL,
  PRIMARY KEY (`id_manga`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mangas`
--

INSERT INTO `mangas` (`id_manga`, `date_sortie_m`, `nbr_chapitre`, `resume_manga`, `id_oeuvre`) VALUES
(1, '1997-01-01', 995, 'L\'histoire suit les aventures de Monkey D. Luffy, un garçon dont le corps a acquis les propriétés du caoutchouc après avoir mangé par inadvertance un fruit du démon. Avec son équipage de pirates, appelé l\'équipage de Chapeau de paille, Luffy explore Grand Line à la recherche du trésor ultime connu sous le nom de « One Piece » afin de devenir le prochain roi des pirates. ', 1),
(2, '1984-01-01', 403, 'Dragon Ball raconte le parcours de Son Goku, depuis l\'enfance jusqu\'à l\'âge adulte. Accompagné de nombreux personnages, il cherche à plusieurs reprises les sept Dragon Balls. Il s\'agit de boules de cristal magiques qui permettent, si elles sont réunies, de faire apparaître le dragon Shenron, capable d\'exaucer le souhait que quiconque prononce face à lui, grâce à une formule spécifique. Tout au long de sa vie, Son Goku est amené à combattre des adversaires de plus en plus forts, dont certains deviennent des alliés.', 2),
(3, '1968-01-01', 300, 'le personnage connu sous le pseudonyme de « Golgo 13 » se rapproche d\'un James Bond japonais, mais en plus immoral et sombre réf. nécessaire. C\'est un sniper d\'élite qui ne rate jamais sa cible. Il sait se servir de toutes sortes d\'armes, mais il est habitué à utiliser un fusil d\'assaut M-16 A2 modifié. Sans être un playboy, il ne lui arrive jamais de coucher deux fois avec la même femme', 3),
(4, '1999-01-01', 500, 'L\'origine de Naruto se déroule dans un monde rétro-futuriste où, bien que de nombreuses technologies modernes aient vu le jour, les ninjas et les samouraïs sont restés de véritables puissances militaires. Chaque pays a un village, qui représente la force militaire du pays, dirigé par un Kage (prononcé Kagué). Les villages, à travers leurs ninjas, se livrent des guerres les uns aux autres, à petite ou grande échelle, que ce soit pour obtenir des caractéristiques avantageuses propres aux villages ennemis, ou pour soumettre un autre village et gagner en puissance.', 4),
(5, '1994-01-01', 343, 'Shinichi Kudo est un jeune détective lycéen âgé de 17 ans fréquemment associé avec la police. Lors d\'une visite dans un parc d\'attractions en compagnie de son amie d\'enfance, Ran Mouri, il surprend discrètement une conversation privée entre deux individus Gin et Vodka appartenant à une mystérieuse organisation criminelle dont chaque membre est habillé en noir. Repéré puis assommé, il est contraint d\'avaler un nouveau poison l APTX 4869 mis au point par cette organisation, avant d\'être laissé pour mort. Ce poison, censé le tuer sans laisser de traces, le fait régresser sous son ancienne apparence physique de petit garçon âgé de six ans à cause d\'un rare et inconnu effet secondaire', 5),
(6, '1973-01-01', 254, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 6),
(7, '1990-01-01', 345, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 7),
(8, '1976-01-01', 563, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 8),
(9, '1997-01-01', 465, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 9),
(10, '1983-01-01', 565, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 10),
(11, '1994-01-01', 563, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 11),
(12, '1995-01-01', 567, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 12),
(13, '1984-01-01', 565, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 13),
(14, '1975-01-01', 563, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 14),
(15, '1990-01-01', 764, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 15),
(16, '1981-01-01', 300, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 16),
(17, '1992-01-01', 456, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 17),
(18, '2009-01-01', 464, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 18),
(19, '2016-01-01', 345, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede.', 19),
(22, '2020-11-10', 200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled i', 41);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

DROP TABLE IF EXISTS `oeuvres`;
CREATE TABLE IF NOT EXISTS `oeuvres` (
  `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` char(150) NOT NULL,
  `auteur` char(150) NOT NULL,
  `couverture_oeuvre` varchar(255) NOT NULL,
  `date_ajout` datetime NOT NULL,
  `type_oeuvre` char(10) NOT NULL,
  PRIMARY KEY (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `oeuvres`
--

INSERT INTO `oeuvres` (`id_oeuvre`, `titre`, `auteur`, `couverture_oeuvre`, `date_ajout`, `type_oeuvre`) VALUES
(1, 'One Piece', 'Eiichiro Oda', 'https://ekladata.com/jnlr5gyGmZGDk9HjWE1Rmn_ylIw.jpg', '2020-11-22 00:36:00', 'manga'),
(2, 'Dragon bal', 'Akira Toriyama', 'https://www.manga-news.com/public/images/vols/dragon-ball-z-cycle-1-1-glenat.jpg', '2020-11-22 00:36:00', 'manga'),
(3, 'Golgo 13', 'Takao Saito', 'https://www.nautiljon.com/images/manga_volumes/11/91/mini/golgo_13_vol_197934319.jpg', '2020-11-22 00:36:00', 'manga'),
(4, 'Naruto', 'Masashi Kishimoto', 'https://www.decitre.fr/gi/21/9782505000921FS.gif', '2020-11-22 00:36:00', 'manga'),
(5, 'Detective conan', 'gosho Aoyama', 'https://cdn1.booknode.com/book_cover/1005/full/detective-conan-tome-1-1004808.jpg', '2020-11-22 00:36:00', 'manga'),
(6, 'Black Jack', 'Osamu Tezuka', 'https://www.bdtheque.com/repupload/T/T_49801.JPG', '2020-11-22 00:36:00', 'manga'),
(7, 'Slam Dunk', 'Takehiko Inoue', 'https://images-na.ssl-images-amazon.com/images/I/71IWWxu6uIL.jpg', '2020-11-22 00:36:00', 'manga'),
(8, 'Kochira Katsushika-ku Kameari kōen-mae hashutsujo', 'Osamu Akimoto', 'https://www.manga-news.com/public/images/dvd/koichi-kame-anime2016-dvd-import.jpg', '2020-11-22 00:36:00', 'manga'),
(9, 'Pokémon', 'Hidenori Kusaka', 'https://media.senscritique.com/media/000007013741/source_big/Pokemon_La_Grande_Aventure.jpg', '2020-11-22 00:36:00', 'manga'),
(10, 'Oishinbo', 'Tetsu Kariya et Akira Hanasaki', 'https://cdn1.booknode.com/book_cover/2375/oishinbo_tome_10-2374632-264-432.jpg', '2020-11-22 00:36:00', 'manga'),
(11, 'Bleach', 'Tite Kubo', 'https://www.bdfugue.com/media/catalog/product/cache/1/image/400x/17f82f742ffe127f42dca9de82fb58b1/9/7/9782344020388_1_75.jpg', '2020-11-22 00:36:00', 'manga'),
(12, 'JoJo\'s Bizarre Adventure', 'Hirohiko Araki', 'https://media.senscritique.com/media/000019368128/source_big/Battle_Tendency_Vol_6_Jojo_s_Bizarre_Adventure_Saison_2_tome.jpg', '2020-11-22 00:36:00', 'manga'),
(13, 'Astro Boy', 'Osamu Tezuka', 'https://www.bdfugue.com/media/catalog/product/cache/1/image/400x/17f82f742ffe127f42dca9de82fb58b1/9/7/9782723431552_1_75.JPG', '2020-11-22 00:36:00', 'manga'),
(14, 'Doraemon', 'Fujiko Fujio', 'https://www.bdfugue.com/media/catalog/product/cache/1/image/400x/17f82f742ffe127f42dca9de82fb58b1/9/7/9782505006978_1_75_2.jpg', '2020-11-22 00:36:00', 'manga'),
(15, 'Ken le Survivant', 'Buronson et Tetsuo Hara', 'https://www.bedetheque.com/media/Couvertures/Ken01.jpg', '2020-11-22 00:36:00', 'manga'),
(16, 'Touch', 'Mitsuru Adachi', 'https://www.manga-news.com/public/images/vols/touch_12.jpg', '2020-11-22 00:36:00', 'manga'),
(17, 'Les Enquêtes de Kindaichi', 'Yōzaburō Kanari, Seimaru Amagi et Fumiya Satō', 'https://img.livraddict.com/covers/193/193176/couv41119146.jpg', '2020-11-22 00:36:00', 'manga'),
(18, 'L\'Attaque des Titans', 'Hajime Isayama', 'https://www.bdfugue.com/media/catalog/product/cache/1/image/400x/17f82f742ffe127f42dca9de82fb58b1/9/7/9782811648763_1_75.jpg', '2020-11-22 00:36:00', 'manga'),
(19, 'Demon Slayer', 'Koyoharu Gotōge', 'https://www.manga-news.com/public/images/vols/demon-slayer-3-panini.jpg', '2020-11-22 00:36:00', 'manga'),
(41, 'fake', 'uriel', 'https://www.photoreview.com.au/wp-content/uploads/2019/05/rholliday_chall_Film-Noir-1-FIRST_RUNNER-UP.jpg', '2020-11-29 23:58:25', 'manga');

-- --------------------------------------------------------

--
-- Structure de la table `profil_acces`
--

DROP TABLE IF EXISTS `profil_acces`;
CREATE TABLE IF NOT EXISTS `profil_acces` (
  `id_acces` int(11) NOT NULL AUTO_INCREMENT,
  `status_adm` char(20) DEFAULT NULL,
  `ajout_contenu` tinyint(1) DEFAULT 0,
  `sup_contenu` tinyint(1) DEFAULT 0,
  `sup_commentaire` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_acces`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil_acces`
--

INSERT INTO `profil_acces` (`id_acces`, `status_adm`, `ajout_contenu`, `sup_contenu`, `sup_commentaire`) VALUES
(1, 'createur', 1, 1, 1),
(2, 'moderateur', 1, 0, 1),
(3, 'membre', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_inscription` date NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `id_acces` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_acces` (`id_acces`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `pseudo`, `date_naissance`, `date_inscription`, `mail`, `mdp`, `id_acces`) VALUES
(1, 'alpha', 'omega', 'creator', '1999-09-09', '2020-11-01', 'boss@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1),
(2, 'ugo', 'godo', 'moderator', '1999-09-09', '2020-11-03', 'xxx@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 2),
(3, 'boul', 'bill', 'gado', '2000-01-01', '2020-11-10', 'boul@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 3),
(4, 'goerge', 'dfdfd', 'sdff', '2016-08-08', '2020-11-04', 'geoge@lacatholille.fr', '098f6bcd4621d373cade4e832627b4f6', 3),
(5, 'sambiani', 'uriel', 'usertest', '2000-06-03', '2020-11-10', 'uriel@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 3),
(6, 'mob', 'bob', 'boubou', '2016-08-08', '2020-11-06', 'bob@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 3),
(9, 'larson', 'nicky', 'xyz', '1995-06-06', '2020-11-28', 'xyz@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animes`
--
ALTER TABLE `animes`
  ADD CONSTRAINT `animes_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `mangas`
--
ALTER TABLE `mangas`
  ADD CONSTRAINT `mangas_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id_oeuvre`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_acces`) REFERENCES `profil_acces` (`id_acces`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
