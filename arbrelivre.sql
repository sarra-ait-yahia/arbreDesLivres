-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 03 juil. 2020 à 10:01
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `arbrelivre`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `avis_text` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF06702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_livre_id`, `avis_text`, `note`, `auteur_nom`, `auteur_prenom`, `date_ecriture`) VALUES
(41, 1, 'Une lecture bouleversante. Certes pas une grande oeuvre littéraire, mais la force de cette histoire suffit à nous ébranler.\r\nBetty est américaine, mariée à un médecin d\'origine iranienne, Bozorg Mahmoody, bien intégré aux États-Unis. Ils ont une petite fille, Mahtob, et coulent des jours heureux. Mais les problèmes politiques aigus entre les États-Unis et l\'Iran vont faire vaciller ce bel édifice.', 4, 'Ait Yahia', 'Sarra', '2020-06-30 11:57:18'),
(42, 1, 'omment critiquer ce genre de livres où l\'on a pas vraiment notre mot à dire...?\r\nComment lire ces pages, ces phrases, ces mots sans se sentir intruse et spectatrice d\'un spectacle terrible de part sa réalité et horrifiant de part son existence ?\r\nTout ce que je peux dire c\'est que la ressemblance de ce récit avec d\'autres témoignages que j\'ai lus m\'effraie et m\'horripile... Quand je lis ces histoires, un arrière goût amer me rappelle sans cesse que le monde ne tourne vraiment pas rond.\r\nJ\'ai arrêté d\'essayer de comprendre l\'humanité. L\'Homme est mauvais de nature. Et c\'est pas prêt de changer...', 4, 'Mekedem', 'Sara', '2020-06-30 11:58:40'),
(43, 1, 'Jamais sans ma fille est un des premiers  ouvrages de témoignage sur fond de séquestration dans un pays islamique. Les livres de ce genre se sont par la suite multiplié, au point de le rendre, pour ma part, indigeste.\r\nIci il s\'agit d\'une femme américaine, mariée à un médecin d\'origine iranienne avec lequel elle a une petite fille. Ce qui devait être un simple voyage pour faire connaissance avec la famille dudit mari devient un piège qui se referme sur Betty et Mahtob. de retour chez lui, son mari change du tout au tout et se montre violent et dégradant envers son épouse.\r\nA travers le témoignage de cette femme courageuse, on assiste à un choc des cultures entre l\'Amérique des libertés et une société islamique verrouillée par la religion depuis la Révolution de 1979. La période à laquelle la famille Mahmoody arrive en Iran se place dans un contexte particulièrement sensible. En effet, la guerre entre les deux pays voisins, Iran et Irak, fait rage depuis plusieurs années. Comme on peut le lire, Téhéran est à portée de bombardements et la vie dans cette capitale s\'avère dangereuse. de plus, l\'Amérique est conspuée par les Iraniens, accusée de soutenir et d\'armer l\'ennemi irakien. Une circonstance aggravante pour l\'Américaine Betty.\r\nJ\'ai lu ce livre lorsque j\'étais au collège et ce fut également un choc pour moi de découvrir la condition de la femme en Iran, les interdits qui lui sont imposés; ainsi que l\'état de la société en général qui proie sous le joug de la charia, toujours sur le coup d\'une intervention des milices islamiques. J\'ai grandi dans une famille où la religion ou l\'athéisme relevait du choix de chacun. J\'ai appris alors ce qu\'était que le fondamentalisme qui, au final, dévalorise l\'islam comme elle le fait avec toutes les autres religions.\r\nLes épreuves traversées par Betty Mahmoody et les descriptions qu\'elle donne de l\'Iran ont fait éclater, d\'une certaine façon, ma vision du monde et des réalités. En cela, ce fut une lecture fort instructive et enr', 2, 'Ait Yahia', 'Sarra', '2020-06-30 12:12:05'),
(44, 1, 'Ils prendront votre argent, vous amèneront à la frontière, ils vous violeront, vous tueront, ou bien vous vendront aux autorités.\r\nMais les mises en garde n\'ont plus cours. Mes choix sont clairs.\r\nVendredi, je peux prendre un avion vers l\'Amérique et rentrer chez moi, retrouver mon confort, sans jamais revoir ma fille. Ou bien, demain, je peux prendre ma fille par la main et entamer le voyage le plus dangereux que je puisse imaginer.\r\n\r\nEn fait il n\'y a pas de choix. Je mourrai dans les montagnes qui séparent l\'Iran du Pakistan, ou je ramènerai ma fille saine et sauve en Amérique.', 0, 'Mekedem', 'Sara', '2020-06-30 12:25:35'),
(45, 1, '3 août 1984... Dans l\'avion qui l\'emmène à Téhéran avec son mari, d\'origine iranienne, et sa fille, pour quinze jours de vacances, Betty a le sentiment d\'avoir commis une erreur irréparable... Quelques jours plus tard, son existence bascule dans le cauchemar. Le verdict tombe : \"Tu ne quitteras jamais l\'Iran ! Tu y resteras jusqu\'à ta mort.\" En proie au pouvoir insondable du fanatisme religieux, son mari se transforme en geôlier. Elle n\'a désormais qu\'un objectif : rentrer chez elle, aux Etats-Unis, avec sa fille. Quitter ce pays déchiré par la guerre et les outrances archaïques : ce monde incohérent où la femme n\'existe pas. Pour reconquérir sa liberté, Betty mènera deux ans de lutte incessante. Humiliations, séquestration, chantage, violences physiques et morales. Rien ne lui sera épargné.', 4, 'Ait', 'Sara', '2020-06-30 13:06:13'),
(46, 1, 'Je me dis que je suis en train de commettre une erreur, que je voudrais pouvoir sauter de cet avion à la minute. Je m\'enferme dans le cabinet de toilette et jette un oeil dans le miroir, pour apercevoir une femme au dernier stade de la panique. Je viens tout juste d\'avoir trente-neuf ans, et à cet âge une femme devrait avoir sa vie en main. Je me demande comment j\'ai pu en perdre le contrôle...', 5, 'Mekedem', 'Sara', '2020-06-30 13:06:49');

-- --------------------------------------------------------

--
-- Structure de la table `citation`
--

DROP TABLE IF EXISTS `citation`;
CREATE TABLE IF NOT EXISTS `citation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `auteur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FABD9C7E6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `citation`
--

INSERT INTO `citation` (`id`, `id_livre_id`, `auteur`, `text`, `rapporteur_nom`, `rapporteur_prenom`, `date_ecriture`) VALUES
(1, 1, 'Betty Mahmoudy', 'L\'incertitude augmente la tension mais entretient l\'excitation de l\'espoir.', 'Ait Yahia', 'Sarra', '2020-06-30 12:48:57'),
(2, 1, 'Betty Mahmoudy', 'Si je ne sors pas d\'ici, personne jamais n\'en sortira. Si je ne sors pas d\'ici, je mourrai sous ce voile.', 'Mekedem', 'Sara', '2020-06-30 12:52:37');

-- --------------------------------------------------------

--
-- Structure de la table `code_barre`
--

DROP TABLE IF EXISTS `code_barre`;
CREATE TABLE IF NOT EXISTS `code_barre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DBB68876702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `code_barre`
--

INSERT INTO `code_barre` (`id`, `id_livre_id`, `code`, `rapporteur_nom`, `rapporteur_prenom`) VALUES
(1, 1, '9782744076008', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `conseil`
--

DROP TABLE IF EXISTS `conseil`;
CREATE TABLE IF NOT EXISTS `conseil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `conseil_text` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F3F06816702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conseil`
--

INSERT INTO `conseil` (`id`, `id_livre_id`, `conseil_text`, `rapporteur_nom`, `rapporteur_prenom`) VALUES
(1, 3, 'conseil', 'Ait', 'sarra');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `message`) VALUES
(20, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Test d\'envoie de message'),
(21, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Test d\'envoie de message 2'),
(22, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'test 3'),
(23, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'mail test');

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
('DoctrineMigrations\\Version20200621135221', '2020-06-21 15:52:38', 962),
('DoctrineMigrations\\Version20200621203436', '2020-06-21 22:34:45', 1555),
('DoctrineMigrations\\Version20200625183219', '2020-06-25 18:32:31', 358),
('DoctrineMigrations\\Version20200625223601', '2020-06-25 22:36:05', 266),
('DoctrineMigrations\\Version20200626213537', '2020-06-26 21:35:49', 101),
('DoctrineMigrations\\Version20200628222540', '2020-06-28 22:25:53', 183),
('DoctrineMigrations\\Version20200629221627', '2020-06-29 22:16:36', 208),
('DoctrineMigrations\\Version20200629235357', '2020-06-29 23:54:04', 268),
('DoctrineMigrations\\Version20200630124352', '2020-06-30 12:44:00', 202),
('DoctrineMigrations\\Version20200630133851', '2020-06-30 13:38:56', 147),
('DoctrineMigrations\\Version20200630153804', '2020-06-30 15:38:09', 141);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `intitule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8698A766702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id`, `id_livre_id`, `intitule`, `type`, `auteur_nom`, `auteur_prenom`, `fichier`) VALUES
(1, 1, 'article', 'Article sur le livre', 'Ait', 'sarra', '3f6d24d6522cc3da29a05687e8c5b871.pdf'),
(6, 1, 'article', 'Article sur le livre', 'Ait', 'sarra', '5716c33fc7c508e2ad2df7c29716c24a.docx'),
(7, 1, 'article', 'Article sur le livre', 'Ait', 'sarra', 'abbe228571ff352ebc2271550c46a04e.png'),
(8, 1, 'article', 'Article sur le livre', 'Ait', 'sarra', '12ed95628b92c3abd4bf2d9e6e760566.mpga');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `intitule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `rappoteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B26681E6702C95E` (`id_livre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `intitule` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisateur` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` date NOT NULL,
  `rapporteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapporteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8244BE226702C95E` (`id_livre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045F6702C95E` (`id_livre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_id` int(11) NOT NULL,
  `titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editeur` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee` date NOT NULL,
  `resume` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F9979F37AE5` (`id_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `id_user_id`, `titre`, `auteur`, `type`, `editeur`, `annee`, `resume`) VALUES
(1, 1, 'Jamais sans ma fille', 'Betty Mahmoudy', 'Biographie', 'Saint Martin\'s Press', '1991-01-01', '3 août 1984... Dans l\'avion qui l\'emmène à Téhéran avec son mari, d\'origine iranienne, et sa fille, pour quinze jours de vacances, Betty a le sentiment d\'avoir commis une erreur irréparable... Quelques jours plus tard, son existence bascule dans le cauchemar. Le verdict tombe : \"Tu ne quitteras jamais l\'Iran ! Tu y resteras jusqu\'à ta mort.\" En proie au pouvoir insondable du fanatisme religieux, son mari se transforme en geôlier. Elle n\'a désormais qu\'un objectif : rentrer chez elle, aux Etats-Unis, avec sa fille. Quitter ce pays déchiré par la guerre et les outrances archaïques : ce monde incohérent où la femme n\'existe pas. Pour reconquérir sa liberté, Betty mènera deux ans de lutte incessante. Humiliations, séquestration, chantage, violences physiques et morales. Rien ne lui sera épargné.'),
(3, 1, 'Le Dernier vœux: Sorceleur 1', 'Andrzej Sapkowski', 'Fantasy', 'Hardigan', '2009-01-01', 'Geralt de Riv est un homme inquiétant, un mutant devenu le parfait assassin grâce à la magie et à un long entraînement. En ces temps obscurs, ogres, goules et vampires pullulent, et les magiciens sont des manipulateurs experts. \r\n\r\nContre ces menaces, il faut un tueur à gages à la hauteur, et Geralt est plus qu\'un guerrier ou un mage. C\'est un sorceleur. Au cours de ses aventures, il rencontrera une magicienne capricieuse aux charmes vénéneux, un troubadour paillard au grand cœur... et, au terme de sa quête, peut-être réalisera-t-il son dernier vœu : retrouver son humanité perdue.'),
(8, 2, 'essaie', 'Cepadues', 'manuel', 'Hardigan', '2010-09-12', 'DFGHJKLKJHGFX'),
(9, 3, 'l\'étranger', 'Albert Camus', 'polar', 'Hardigan', '1966-08-12', 'un livre'),
(21, 2, 'Le Dernier vœu: Sorceleur 2', 'Cepadues', 'Fantasy', 'Hardigan', '2019-09-02', 'gjk');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_livre_id`, `auteur_nom`, `auteur_prenom`, `mail`, `question`, `date_ecriture`) VALUES
(1, 1, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Quel est le métier du mari de Betty ?', '2020-06-30 13:43:28'),
(2, 1, 'Mekedem', 'Sara', 'sarraait12891@gmail.com', 'Ellen est une femme qui vient également des Etats-Unis, ce qui fait du bien à Betty qui se fait vite amie avec elle. Mais d\'où vient-elle précisément ?', '2020-06-30 18:03:40'),
(3, 1, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Qu\'a gardé Betty en cachette pendant toute la durée de son emprisonnement, étant sûre que ça lui servirait ?', '2020-06-30 18:16:34'),
(4, 1, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Qu\'a gardé Betty en cachette pendant toute la durée de son emprisonnement, étant sûre que ça lui servirait ?', '2020-06-30 18:17:24'),
(5, 1, 'Ait Yahia', 'Sarra', 'sarraait12891@gmail.com', 'Quelle pauvre nièce de la famille de Moody meurt en tombant d\'un balcon ?', '2020-06-30 18:19:30'),
(6, 1, 'Ait Yahia', 'Sarra', 'sarra.ait-yahia@etu.univ-paris1.fr', 'Qu\'a gardé Betty en cachette pendant toute la durée de son emprisonnement, étant sûre que ça lui servirait ?', '2020-06-30 18:56:08');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `id_question_id` int(11) NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5FB6DEC76702C95E` (`id_livre_id`),
  KEY `IDX_5FB6DEC76353B48` (`id_question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_livre_id`, `id_question_id`, `auteur_nom`, `auteur_prenom`, `mail`, `reponse`, `date_ecriture`) VALUES
(1, 1, 1, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Il était médecin', '2020-06-30 17:56:39'),
(2, 1, 2, 'Zayati', 'Sarra', 'sarra.ait-yahia@etu.univ-paris1.fr', 'Du Texas, là où a travaillé Moody pendant un temps.', '2020-06-30 18:43:32'),
(6, 1, 2, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', 'Du Michigan, près de chez les parents de Betty', '2020-06-30 18:54:00'),
(7, 1, 2, 'Ait Yahia', 'Sarra', 'sarra.ait-yahia@etu.univ-paris1.fr', 'Du Kentucky', '2020-06-30 18:57:55'),
(8, 1, 2, 'Zayati', 'Nerjess', 'nerjes@gmail.com', 'De l\'Iran', '2020-06-30 18:58:37'),
(9, 1, 2, 'Mekedem', 'Sarra', 'saraMekedem.fr@gmail.fr', 'De France', '2020-06-30 18:59:14'),
(10, 1, 2, 'Mekdem', 'Oumaima', 'sarah_12891@hotmail.fr', 'd\'Afghanistan', '2020-06-30 18:59:49'),
(14, 1, 3, 'Ait Yahia', 'Sarra', 'sarra.ait-yahia@etu.univ-paris1.fr', 'Son passeport américain', '2020-06-30 19:09:54'),
(15, 1, 1, 'Mekedem', 'Sarra', 'mekedemsara@gmail.com', 'Il était avocat', '2020-07-02 21:52:15'),
(16, 1, 1, 'Zayati', 'Nerjess', 'nerjess@gmail.com', 'Il était enseignant', '2020-07-02 21:54:52');

-- --------------------------------------------------------

--
-- Structure de la table `son`
--

DROP TABLE IF EXISTS `son`;
CREATE TABLE IF NOT EXISTS `son` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `son` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E199342C6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `son`
--

INSERT INTO `son` (`id`, `id_livre_id`, `nom`, `son`, `auteur_nom`, `auteur_prenom`, `description`) VALUES
(11, 21, 'witcher', 'LeDerniervœuSorceleur2MainSon.mpga', 'Ait Yahia', 'Sarra', 'fghjk');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date_naissance`) VALUES
(1, 'sarah_12891@hotmail.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TjBYTnRjbndxcUZGa0JDZA$BR8P7VFjUmvQRc0lpAOBuB44f7MRcMcQ19wWOcTs3g0', 'Ait Yahia', 'Sarra', '1991-08-12 00:00:00'),
(2, 'sarra_12891@hotmail.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Znp4ckU5YVBiRk8uL0R0eQ$g89VbMA8IPaIL5LOkg8OI9u8a+Xn47MzOigyi000P3w', 'Ait Yahia', 'Sarra', '1991-08-12 00:00:00'),
(3, 'saraMekedem@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NDZqUVpNYUpMR0JDelNxag$5GES3v8UP5zuwUboQWZRLGl5x8OTkJsgu2TrMD65PYM', 'Mekedem', 'Sara', '1997-06-08 00:00:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF06702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `citation`
--
ALTER TABLE `citation`
  ADD CONSTRAINT `FK_FABD9C7E6702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `code_barre`
--
ALTER TABLE `code_barre`
  ADD CONSTRAINT `FK_3DBB68876702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `conseil`
--
ALTER TABLE `conseil`
  ADD CONSTRAINT `FK_3F3F06816702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_D8698A766702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681E6702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `FK_8244BE226702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F6702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F9979F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E6702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC76353B48` FOREIGN KEY (`id_question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_5FB6DEC76702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `son`
--
ALTER TABLE `son`
  ADD CONSTRAINT `FK_E199342C6702C95E` FOREIGN KEY (`id_livre_id`) REFERENCES `livre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
