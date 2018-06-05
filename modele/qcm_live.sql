-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Octobre 2016 à 00:48
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `qcm_live`
--

-- --------------------------------------------------------

--
-- Structure de la table `bilan`
--

CREATE TABLE `bilan` (
  `id_bilan` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etu` int(11) NOT NULL,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login_etu` text COLLATE utf8_bin NOT NULL,
  `pass` text COLLATE utf8_bin NOT NULL,
  `matricule` int(8) NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_grpe` int(11) NOT NULL,
  `num_grpe` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_prof` int(11) NOT NULL,
  `nom` text COLLATE utf8_bin NOT NULL,
  `prenom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `login` text COLLATE utf8_bin NOT NULL,
  `pass` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_quest` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `titre` text COLLATE utf8_bin NOT NULL,
  `texte` text COLLATE utf8_bin NOT NULL,
  `bmultiple` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_rep` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `texte_rep` text COLLATE utf8_bin NOT NULL,
  `bvalide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat` (
  `id_res` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `id_rep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id_session` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `titre_sess` text COLLATE utf8_bin NOT NULL,
  `id_grpe` int(11) NOT NULL,
  `date_sess` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `bAutorise` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id_theme` int(11) NOT NULL,
  `descr_theme` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bilan`
--
ALTER TABLE `bilan`
  ADD PRIMARY KEY (`id_bilan`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etu`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_grpe`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_prof`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_quest`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_rep`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`id_res`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bilan`
--
ALTER TABLE `bilan`
  MODIFY `id_bilan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_quest` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_grpe` int(11) NOT NULL AUTO_INCREMENT;
  
  
INSERT INTO `etudiant` (`nom`, `prenom`, `email`, `login_etu`, `pass`, `matricule`, `num_grpe`) VALUES
('DOS SANTOS', 'Julien', 'julien.dossantos@gmail.com', 'DOSSANTOS1', 'jdetu1', '11', 1),
('TABARE', 'Rubin', 'rubin.tabare@gmail.com', 'TABARE1', 'rtetu2', '12', 1),
('DJAMAA', 'Pauline', 'pauline.djaama@gmail.com', 'DJAMAA1', 'popodu37', '13', 1),
('TANIER', 'Melodie', 'melodie.tanier@gmail.com', 'TANIER1', 'mtetu4', '14', 1),
('KANTAR', 'Osman', 'osman.kantar@gmail.com', 'KANTAR1', 'oketu5', '15', 1),
('CARON', 'Fabien', 'fabien.caron@gmail.com', 'CARON1', 'fcetu6', '16', 1),
('WANG', 'Antoine', 'antoinewang@gmail.com', 'WANG1', 'awetu7', '17', 1),
('MARTIN', 'Julien', 'martin.julien@gmail.com', 'MARTIN1', 'jmetu8', '21', 2),
('ROBBIE', 'Margot', 'robbie.margot@gmail.com', 'ROBBIE1', 'mretu9', '22', 2),
('SMITH', 'Will', 'smith.will@gmail.com', 'SMITH1', 'wsetu10', '23', 2),
('FOX', 'Megan', 'fox.megan@gmail.com', 'FOX1', 'mfetu11', '24', 2),
('WATSON', 'Emma', 'watson.emma@gmail.com', 'WATSON1', 'ewetu12', '25', 2),
('BAKER', 'Simon', 'baker.simon@gmail.com', 'BAKER1', 'sbetu13', '26', 2),
('MESSI', 'Leo', 'messi.leo@gmail.com', 'MESSI1', 'lmetu14', '27', 2),
('LOPEZ', 'Jennifer', 'jennifer.lopez@gmail.com', 'LOPEZ1', 'jletu16', '31', 3),
('CHOPRA', 'Priyanka', 'priyanka.chopra@gmail.com', 'CHOPRA1', 'pcetu17', '32', 3),
('GRANDE', 'Arianna', 'arianna.grande@gmail.com', 'GRANDE1', 'agetu18', '33', 3),
('ANDERSON', 'Pamela', 'pamela.anderson@gmail.com', 'ANDERSON1', 'paetu19', '34', 3),
('JACKMAN', 'Hugh', 'hugh.jackman@gmail.com', 'JACKMAN1', 'hjetu20', '35', 3),
('RONALDO', 'Christiano', 'christiano.ronaldo@gmail.com', 'RONALDO7', 'CR7', '36', 3),
('DICAPRIO', 'Leonardo', 'leonardo.dicaprio@gmail.com', 'DICAPRIO1', 'ldetu22', '37', 3);

INSERT INTO `groupe` (`num_grpe`) VALUES
("101"),
("102"),
("103");
  
INSERT INTO `professeur` (`nom`, `prenom`, `email`, `login`, `pass`) VALUES
('DUPONT', 'Luc', 'Dupont.Luc@gmail.com', 'ldupont', 'ldprof1'),
('DURANT', 'Jule', 'Durant.Jule@gmail.com', 'jdurant', 'jdprof2'),
('ROBERT', 'Florianne', 'Robert.Florianne@gmail.com', 'frobert', 'frprof3'),
('BLANCHE', 'Juliette', 'Blanche.Juliette@gmail.com', 'jblanche', 'jbprof4');

INSERT INTO `question` (`id_theme`, `titre`, `texte`, `bmultiple`) VALUES
(2, 1, "Qui est l'actrice principale ?", false),
(2, 2, "Combien d'episodes comporte la 1ere saison ?", false),
(2, 3, "Ou se deroule la serie ?", true),
(2, 4, "Cette serie a-t-elle ete recompensee de maniere officielle (prix, distinctions particulieres) ?", false),
(2, 5, "Quelle a ete la date de premiere diffusion aux Etats Unis ?", false),
(1, 1, "A quelle age pouvons-nous passer le permis 125cc ?", false),
(1, 2, "A quelle age pouvons-nous passer le permis A2 ?", false),
(1, 3, "Combien de temps faut-il pour passer du permis A2 a A ?", false),
(1, 4, "Quelles sont les marques de motos ?", true),
(1, 5, "En motoGP, quel(s) pilote(s) a (ont) chute afin que Marquez devienne champion du monde ?", true);

INSERT INTO `reponse` (`id_quest`, `texte_rep`, `bvalide`) VALUES
(1, "Prinyanka CHOPRA", true),
(1, "Margot ROBBIE", false),
(1, "Megan FOX", false),
(2, "10 ou moins", false),
(2, "11 ou plus", true),
(3, "Quantico", true),
(3, "San Francsico", false),
(3, "New-York", true),
(4, "Oui", true),
(4, "Non", false),
(5, "27 Septembre 2015", true),
(5, "27 Novembre 2015", false),
(5, "27 Decembre 2015", false),
(6, "14 ans", false),
(6, "15 ans", false),
(6, "16 ans", true),
(7, "17 ans", false),
(7, "18 ans", true),
(7, "19 ans", false),
(8, "6 mois", false),
(8, "1 an", false),
(8, "2 ans", true),
(9, "Kawasaki", true),
(9, "BMW", true),
(9, "Renault", false),
(9, "Yamaha", true),
(10, "Valentino Rossi", true),
(10, "Jorge Lorenzo", true),
(10, "Daniel Pedrosa", false);


INSERT INTO `theme` (`descr_theme`) VALUES
("Moto"),
("Quantico");

  
  
  

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
