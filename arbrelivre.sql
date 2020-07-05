-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 05 juil. 2020 à 21:40
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_livre_id`, `avis_text`, `note`, `auteur_nom`, `auteur_prenom`, `date_ecriture`) VALUES
(57, 22, 'Je me débrouille, dit le sorceleur en le regardant droit dans les yeux. Je me débrouille à peu près. Parce qu\'il le faut. Parce que je n\'ai pas le choix. Parce que j\'ai vaincu en moi l\'orgueil et la fierté de ma différence; parce que l\'ai compris que l\'orgueil et la fierté, même si c\'est une arme contre la différence, sont une défense pitoyable. \n\r\nParce que j\'ai compris que le soleil brille autrement. Parce que les choses changent et que ce n\'est pas moi le pivot de ces changements. Le soleil brille autrement et continuera à briller, il ne sert à rien de chercher à le décrocher, comme la lune. Il faut accepter la vérité, l\'elfe, c\'est une chose qu\'il faut apprendre à faire.', 4, 'Ait Yahia', 'Sarra', '2020-07-05 20:49:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `citation`
--

INSERT INTO `citation` (`id`, `id_livre_id`, `auteur`, `text`, `rapporteur_nom`, `rapporteur_prenom`, `date_ecriture`) VALUES
(3, 22, 'Andrzej Sapkowski', '— Quand la Vivette vient, le terre fleurit et enfante, et si grand est son pouvoir que toutes les créatures naissent avec exubérance. Chaque peuple lui fait des offrandes de sa bonne récolte, dans le vain espoir que c\'est son domaine et non pas celui d\'un autre que la Vivette viendra visiter. Car ils disent aussi qu\'un jour, pour sa fin, la Vivette s\'installera parmi le peuple qui dominera les autres. Mais ce ne sont que des histoires de bonne femme. Car les presque sages disent que la Vivette n\'aime que la Terre, qu\'elle aime tout ce qui y pousse et y vit pareillement, sans faire de différence, qu\'elle aime le petit pommier sauvage et le ver le plus chétif. À ses yeux, aucun peuple n\'a plus d\'importance que le plus frêle des pommiers sauvages, car enfin ils finiront tous par disparaître un jour et leur succèderont d\'autres tribus. Alors qu\'elle, la Vivette, est éternelle. Elle a été et sera toujours, dans les siècles des siècles.\n\r\np.284', 'Ait Yahia', 'Sarra', '2020-07-05 20:52:23');

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DBB68876702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F3F06816702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20200630153804', '2020-06-30 15:38:09', 141),
('DoctrineMigrations\\Version20200703121945', '2020-07-03 12:20:10', 580),
('DoctrineMigrations\\Version20200703142520', '2020-07-03 14:25:26', 147),
('DoctrineMigrations\\Version20200703174156', '2020-07-03 17:42:06', 173),
('DoctrineMigrations\\Version20200703185032', '2020-07-03 18:50:38', 276),
('DoctrineMigrations\\Version20200703191528', '2020-07-03 19:16:38', 216),
('DoctrineMigrations\\Version20200703194327', '2020-07-03 19:43:33', 88),
('DoctrineMigrations\\Version20200703195327', '2020-07-03 19:53:38', 181),
('DoctrineMigrations\\Version20200703195613', '2020-07-03 19:56:35', 208),
('DoctrineMigrations\\Version20200704151706', '2020-07-04 15:17:16', 407);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_livre_id` int(11) NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur_prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8698A766702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B26681E6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8244BE226702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045F6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F9979F37AE5` (`id_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `id_user_id`, `titre`, `auteur`, `type`, `editeur`, `annee`, `resume`, `date_ecriture`) VALUES
(22, 4, 'The Witcher Sorceleur: Le Dernier Voeu', 'Andrzej Sapkowski', 'Fantasy Poche', 'Milady', '2011-04-01', 'Geralt de Riv est un homme inquiétant, un mutant devenu le parfait assassin grâce à la magie et à un long entraînement. En ces temps obscurs, ogres, goules et vampires pullulent, et les magiciens sont des manipulateurs experts. \n\r\n Contre ces menaces, il faut un tueur à gages à la hauteur, et Geralt est plus qu\'un guerrier ou un mage. C\'est un sorceleur. Au cours de ses aventures, il rencontrera une magicienne capricieuse aux charmes vénéneux, un troubadour paillard au grand coeur... et, au terme de sa quête, peut-être réalisera-t-il son dernier voeu: retrouver son humanité perdue.', '2020-07-05 20:46:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_livre_id`, `auteur_nom`, `auteur_prenom`, `mail`, `question`, `date_ecriture`) VALUES
(8, 22, 'Ait Yahia', 'Sarra', 'sarah_12891@hotmail.fr', '\"The Witcher\" (Netflix) : quel est le \"dernier vœu\" de Geralt de Riv ?', '2020-07-05 21:37:41');

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
  `date_ecriture` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E199342C6702C95E` (`id_livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `son`
--

INSERT INTO `son` (`id`, `id_livre_id`, `nom`, `son`, `auteur_nom`, `auteur_prenom`, `description`, `date_ecriture`) VALUES
(16, 22, 'Toss A Coin To Your Witcher (INSTRUMENTAL VERSION)', 'TheWitcherSorceleurLeDernierVoeuMainSon.mpga', 'Ait Yahia', 'Sarra', 'Musique du film \"the witcher\", version instrumentale.', '2020-07-05 20:46:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date_naissance`) VALUES
(4, 'sarah_12891@hotmail.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$YXhJRjZmc1gyRC41eVNhcg$G4wBW2hRrspwW0QqtCQ/l+xKZbId+pWeYDyg8rrAUkA', 'Ait Yahia', 'Sarra', '1991-08-12 00:00:00');

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
