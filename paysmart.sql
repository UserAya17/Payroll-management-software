-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 09:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paysmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE `absence` (
  `idAbsence` int(11) NOT NULL,
  `dateJour` datetime NOT NULL,
  `valide` varchar(11) NOT NULL,
  `dureeAbsence` int(11) NOT NULL,
  `justification` varchar(100) NOT NULL,
  `justificationImage` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`idAbsence`, `dateJour`, `valide`, `dureeAbsence`, `justification`, `justificationImage`, `idUser`) VALUES
(1, '2023-12-22 09:00:00', '1', 24, 'maladie', '', 4),
(2, '2023-12-22 09:00:00', '1', 72, 'la mort', '', 1),
(3, '2023-12-22 09:00:00', '1', 355, 'accouchement', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `affectation`
--

CREATE TABLE `affectation` (
  `idaffec` int(11) NOT NULL,
  `idRub` int(11) DEFAULT NULL,
  `idFiliale` int(11) DEFAULT NULL,
  `idRegle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affectation`
--

INSERT INTO `affectation` (`idaffec`, `idRub`, `idFiliale`, `idRegle`) VALUES
(44, 9, 1, 37),
(45, 3, 1, 44),
(46, 2, 1, 43),
(47, 7, 1, 50),
(50, 10, 1, NULL),
(51, 9, 1, 40),
(52, 1, NULL, 51);

-- --------------------------------------------------------

--
-- Table structure for table `bulltin`
--

CREATE TABLE `bulltin` (
  `id` int(11) NOT NULL,
  `matricule` varchar(16) NOT NULL,
  `dateAjout` datetime NOT NULL,
  `date` date NOT NULL,
  `CIMR` float NOT NULL,
  `CNSS` float NOT NULL,
  `AMO` float NOT NULL,
  `IGR` float NOT NULL,
  `ABSENCE` float NOT NULL,
  `SALAIRENET` float NOT NULL,
  `CONGE` float NOT NULL,
  `HS` float NOT NULL,
  `ALLOCATION` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulltin`
--

INSERT INTO `bulltin` (`id`, `matricule`, `dateAjout`, `date`, `CIMR`, `CNSS`, `AMO`, `IGR`, `ABSENCE`, `SALAIRENET`, `CONGE`, `HS`, `ALLOCATION`) VALUES
(76, 'Q0979', '2023-06-23 10:51:57', '2023-01-01', 1000, 200, 674.98, 123.56, -100, -400, 0, 3000, 1200),
(77, 'Q0979', '2023-06-23 11:05:16', '2023-01-01', 1000, 200, 674.98, 123.56, -100, -400, 0, 3000, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `condition_regle`
--

CREATE TABLE `condition_regle` (
  `idcond` int(11) NOT NULL,
  `condition_R` varchar(100) DEFAULT NULL,
  `affectation` varchar(100) DEFAULT NULL,
  `idRegle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condition_regle`
--

INSERT INTO `condition_regle` (`idcond`, `condition_R`, `affectation`, `idRegle`) VALUES
(14, 'SALAIREDEBASE > 1000', 'Valeur = 100', 40),
(15, 'SALAIREDEBASE < 1000', 'Valeur = 1000', 40);

-- --------------------------------------------------------

--
-- Table structure for table `conge`
--

CREATE TABLE `conge` (
  `id` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `dureeConge` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `valide` varchar(10) NOT NULL,
  `dateDemande` date NOT NULL,
  `end_datetime` datetime NOT NULL,
  `description` varchar(100) NOT NULL,
  `idUser` varchar(11) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conge`
--

INSERT INTO `conge` (`id`, `start_datetime`, `dureeConge`, `type`, `valide`, `dateDemande`, `end_datetime`, `description`, `idUser`, `title`) VALUES
(1, '2023-05-03 00:00:00', 15, 1, 'valider', '2021-05-03', '2023-05-18 00:00:00', 'le conge pour vous est ', 'Q0979', ''),
(2, '2023-05-15 00:00:00', 7, 1, 'valider', '2023-05-02', '2023-05-23 00:00:00', 'Votre conge est valide madame bonne vacances', 'Q0979', 'damande conge'),
(5, '2023-06-07 16:02:00', 4, 0, 'valider', '2023-06-06', '2023-06-10 16:02:00', 'ok bonne vacance', 'A123', ''),
(6, '2023-06-13 22:27:00', 3, 1, 'refuser', '2023-06-13', '2023-06-16 22:28:00', 'non', 'Q0979', ''),
(7, '2023-06-14 13:06:00', 2, 0, 'en_cours', '2023-06-14', '2023-06-16 13:06:00', '', 'Q0979', ''),
(8, '2023-06-14 13:07:00', 1, 1, 'en_cours', '2023-06-14', '2023-06-15 13:08:00', '', 'Q0979', ''),
(9, '2023-06-14 16:46:00', 3, 1, 'en_cours', '2023-06-14', '2023-06-17 16:46:00', '', 'A1234', ''),
(10, '2023-06-14 16:46:00', 3, 1, 'en_cours', '2023-06-14', '2023-06-17 16:46:00', '', 'A1234', ''),
(11, '2023-06-14 17:02:00', 3, 1, 'en_cours', '2023-06-14', '2023-06-17 17:02:00', '', 'Q0979', ''),
(12, '2023-06-15 20:51:00', 15, 1, 'en_cours', '2023-06-22', '2023-06-30 20:51:00', '', 'Q0979', ''),
(13, '2023-06-23 10:59:00', 7, 1, 'valider', '2023-06-23', '2023-06-30 11:00:00', 'bonnes vacaces', 'B45T9', '');

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

CREATE TABLE `contrat` (
  `idContrat` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `typeContrat` varchar(4) NOT NULL,
  `salaireDeBase` int(11) NOT NULL,
  `poste` varchar(25) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `idUser` varchar(25) NOT NULL,
  `idFiliale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contrat`
--

INSERT INTO `contrat` (`idContrat`, `duree`, `typeContrat`, `salaireDeBase`, `poste`, `dateEmbauche`, `idUser`, `idFiliale`) VALUES
(1, 15, 'CDI', 35000, 'RH', '2022-05-04', 'Q0979', 1),
(5, 1, 'CDD', 4000, 'stage', '2023-05-31', '9667A', 3),
(6, 10, 'CDI', 10000, 'developeur', '2020-05-04', 'A123', 3),
(7, 10, 'CDI', 30000, 'RP', '2020-05-04', 'A1234', 3),
(8, 10, 'CDI', 10000, 'developeur', '2020-05-04', 'A6782', 1),
(9, 10, 'CDI', 10000, 'developeur', '2020-05-04', 'B45T9', 2),
(10, 10, 'CDI', 10000, 'developeur', '2020-05-04', 'I5632', 2),
(16, 656, 'ctt', 5464, 'concierge', '2023-06-14', '2222222', 2),
(18, 12, 'cdd', 67782, 'ufioefuio', '2023-06-23', 'A785', 7);

-- --------------------------------------------------------

--
-- Table structure for table `filiale`
--

CREATE TABLE `filiale` (
  `idFiliale` int(11) NOT NULL,
  `nomFliale` varchar(25) NOT NULL,
  `adresseFiliale` varchar(30) NOT NULL,
  `emailFiliale` varchar(25) NOT NULL,
  `telFiliale` varchar(15) NOT NULL,
  `heureTravail` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiale`
--

INSERT INTO `filiale` (`idFiliale`, `nomFliale`, `adresseFiliale`, `emailFiliale`, `telFiliale`, `heureTravail`) VALUES
(1, 'Al Imran', 'casablanca,quartier belvedere', 'Al.Imran.pour.vous@gmail', '0745813421', 20),
(2, 'F11', 'casablanca,ain sbaa', 'F11.3456@gmail', '0789332997', 100),
(3, 'ONCF', 'casablanca,quartier Rhab', 'ONCF.3456@gmail', '0788453210', 0),
(6, 'test', 'blasa', 'walid@gmail.com', '0612092243', 45),
(7, 'IBM', 'HAY riyad,Rabat', 'ibm@support.ma', '0523167548', 60),
(8, 'fstt', 'Bd alwazani, Tanger', 'fstt@support.ma', '05647497540', 0),
(16, '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `heuresup`
--

CREATE TABLE `heuresup` (
  `idHeureSup` int(11) NOT NULL,
  `nombreHeures` int(11) NOT NULL,
  `dateJour` datetime NOT NULL,
  `valider` varchar(11) NOT NULL,
  `dateDemandeHS` date NOT NULL,
  `jourFerier` int(11) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `idUser` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heuresup`
--

INSERT INTO `heuresup` (`idHeureSup`, `nombreHeures`, `dateJour`, `valider`, `dateDemandeHS`, `jourFerier`, `commentaire`, `idUser`) VALUES
(1, 22, '2023-05-30 20:00:00', 'refuser', '2023-05-10', 1, 'il y a deja des perssones qui ont prit ce jour', '9667A'),
(3, 8, '2023-05-30 21:00:00', 'en cours', '2023-05-29', 1, '', '9667A'),
(8, 9, '2023-04-15 21:00:00', 'valide', '2023-04-12', 0, '', '9667A'),
(9, 2, '2023-06-07 16:22:00', 'valider', '2023-06-06', 0, 'tres bon travail', 'A123'),
(10, 1, '2023-06-05 20:18:00', 'refuser', '2023-06-06', 1, 'non siir tekhdem', 'B45T9'),
(11, 2, '2023-06-21 20:51:00', 'en_cours', '2023-06-22', 0, '', 'Q0979');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `envoyeur` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `recepteur` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idNotification`, `etat`, `envoyeur`, `type`, `recepteur`) VALUES
(1, 1, '2', 'Absence', '1'),
(2, 1, '2', 'reclamation', '1'),
(7, 4, '8', 'reclamation', '1'),
(9, 4, '12', 'demande de conge', '1'),
(10, 4, '5', 'demande de conge', '8'),
(11, 0, 'Q0979', 'demande de conge', '0'),
(12, 1, 'Q0979', 'demande de conge', 'Q0979'),
(13, 1, 'A1234', 'demande de conge', 'Q0979'),
(14, 1, 'A1234', 'demande de conge', 'Q0979'),
(15, 1, 'Q0979', 'demande de conge', 'Q0979'),
(16, 0, 'Q0979', 'valider reclamation', '9667A'),
(17, 0, 'Q0979', 'valider reclamation', '9667A'),
(18, 0, 'Q0979', 'valider conge', 'A123'),
(19, 0, 'Q0979', 'valider conge', 'A123'),
(20, 1, 'Q0979', 'refuser conge', 'Q0979'),
(21, 0, 'Q0979', 'valider heure', 'A123'),
(22, 0, 'Q0979', 'valider heure', 'A123'),
(23, 0, 'Q0979', 'refuer hs', 'B45T9'),
(24, 1, 'Q0979', 'demande de conge', 'Q0979'),
(25, 1, 'Q0979', 'heure sup', 'Q0979'),
(26, 1, 'Q0979', 'reclamation', 'Q0979'),
(27, 0, 'Q0979', 'reclamation', 'A1234'),
(28, 0, 'A1234', 'reclamation', 'A1234'),
(29, 1, 'B45T9', 'demande de conge', 'Q0979'),
(30, 0, 'Q0979', 'valider conge', 'B45T9');

-- --------------------------------------------------------

--
-- Table structure for table `prime`
--

CREATE TABLE `prime` (
  `idprime` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `montant` float NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `idUser` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prime`
--

INSERT INTO `prime` (`idprime`, `nom`, `montant`, `date`, `type`, `idUser`) VALUES
(13, 'gg', 123, '2023-06-22', 1, '2222222');

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `idReclamation` int(11) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `typeReclamation` varchar(15) NOT NULL,
  `valider` varchar(11) NOT NULL,
  `idUser` varchar(25) NOT NULL,
  `reclamation` varchar(100) NOT NULL,
  `dateReclamation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`idReclamation`, `commentaire`, `typeReclamation`, `valider`, `idUser`, `reclamation`, `dateReclamation`) VALUES
(1, '', 'Asence', 'encours rp', '9667A', 'Bonjour, j\'ai un problème pour une absence que vous avez m\'affecter mais j\'étais présent dans ce jou', '2021-06-09'),
(3, 'non tu es etait absent', 'Asence', 'valider', '9667A', 'Bonjour, j\'ai un problème pour une absence que vous avez m\'affecter mais j\'étais présent dans ce jou', '2021-06-09'),
(4, '', 'bulletin', 'en_cours', 'Q0979', 'teeeest', '2023-06-22'),
(5, 'bravoooooooooooooooooooo', 'prime', 'valider rp', 'Q0979', 'hello', '2023-06-22'),
(6, 'tous les bulletins sont disponibles', 'bulletin', 'refuser rp', 'A1234', 'j ai pas acces a les bulletins des mois precedents', '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `regle`
--

CREATE TABLE `regle` (
  `idRegle` int(11) NOT NULL,
  `regle` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regle`
--

INSERT INTO `regle` (`idRegle`, `regle`) VALUES
(37, 'ALLOCATION = 300 * nbEnfant '),
(38, 'HS = HS * SALAIREHORAIRE * ( 1 + 100 )'),
(39, 'SALAIREHORAIRE = SALAIREDEBASE / 26 / heureTravail'),
(40, 'SBG = SALAIREDEBASE + HS + Valeur'),
(41, 'PRIMEANC = ( SALAIREDEBASE + HS ) * Taux'),
(42, 'SBI = SALAIREDEBASE + HS + PRIMEANC'),
(43, 'CNSS = SALAIREDEBASE - 100'),
(44, 'AMO = SALAIREDEBASE - 1500'),
(45, 'CIMR = SALAIREDEBASE - 2000'),
(46, 'IGR = SALAIREDEBASE - 145.98'),
(47, 'SNI = SBI - CNSS - AMO - IGR - CIMR'),
(48, 'ABSENCE = SALAIREDEBASE / heureTravail * dureeABSENCE'),
(49, 'CONGE = SALAIREDEBASE / dureeCONGE'),
(50, 'SALAIRENET = SBG + CNSS + AMO + CIMR + IGR + ALLOCATION'),
(51, 'ALLOCATION CNSS ');

-- --------------------------------------------------------

--
-- Table structure for table `rubrique`
--

CREATE TABLE `rubrique` (
  `idRubrique` int(11) NOT NULL,
  `nomRubrique` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rubrique`
--

INSERT INTO `rubrique` (`idRubrique`, `nomRubrique`) VALUES
(1, 'Salaire de base'),
(2, 'CNSS'),
(3, 'AMO'),
(4, 'SNI'),
(5, 'SBI'),
(6, 'SB'),
(7, 'Salaire Net'),
(9, 'ALLOCATION'),
(10, 'SBG '),
(11, 'IRNET'),
(12, 'IRBRUT');

-- --------------------------------------------------------

--
-- Table structure for table `table_absence`
--

CREATE TABLE `table_absence` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `dateAjout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_absence`
--

INSERT INTO `table_absence` (`id`, `title`, `description`, `start_datetime`, `end_datetime`, `dateAjout`) VALUES
(3, '9667A', '', '2023-06-21 14:39:00', '2023-06-22 20:40:00', '2023-06-22 20:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `matricule` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `cin` varchar(25) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(35) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `age` int(11) NOT NULL,
  `rib` varchar(25) NOT NULL,
  `numeroTel` varchar(15) NOT NULL,
  `numeroCNSS` varchar(25) NOT NULL,
  `numeroAmo` varchar(25) NOT NULL,
  `numeroCimr` varchar(25) NOT NULL,
  `numeroIgr` varchar(25) NOT NULL,
  `situationFamiliale` varchar(8) NOT NULL,
  `nombreEnfants` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`matricule`, `nom`, `prenom`, `cin`, `dateNaissance`, `adresse`, `email`, `login`, `password`, `sexe`, `age`, `rib`, `numeroTel`, `numeroCNSS`, `numeroAmo`, `numeroCimr`, `numeroIgr`, `situationFamiliale`, `nombreEnfants`, `image`) VALUES
('2222222', 'sakkoir', 'ayat', 'ttyt', '2023-05-29', 'fghf', 'sak12@gmail.fr', '2222222_F11', '75de164d441c38c9a878d33c3', 'H', 0, 'hhf', '0645231469', '3435', 'ete54', '0', '66', 'marie', 12, ''),
('9667A', 'chaabi', 'amal', 'X24580', '2000-12-01', 'casablanca,welfa', 'amalch@gmail.com', 'amal', '789', 'f', 23, '123B567', '0678311100', 'W93400', ' UI16709', 'ZU12', '7891P1', 'celib', 0, ''),
('9999', 'test', 'tst', '1786', '1994-02-01', 'mohamedia', 'aya@hotmail.com', '9999_ONCF', 'c8e7fbb518f0828ab9d01df75', 'h', 29, '123455765364', '0567435729', '12345', '54321', '345', '123', 'divorce', 2, ''),
('A123', 'amir', 'souhaib', 'X56B0', '1991-05-01', 'Mohammedia,Riad salam', 'amirso@gmail.com', 'amir', '445', 'M', 32, 'Q234O', '0690436282', 'A97802', 'N21H55', '1BW901', 'W164B1', 'marie', 6, ''),
('A1234', 'abdouni', 'ibtissam', 'BA13226', '2003-02-06', 'Casablanca,quartier El Falah', 'ibtiabdo@gmail.com', 'ibtissam', '202cb962ac59075b964b07152d234b70', 'f', 20, '1234567', '0658946292', 'M9850Z9', ' UI12093', 'NA12', 'P209', 'celib', 0, ''),
('A6782', 'raji', 'nassima', 'Y2301', '2000-08-01', 'casablanca,sidi othman', 'nassima11@gmail.com', 'nassima', '110', 'f', 23, 'NOP45', '0678311171', 'W93432', '2B21175', '1A0992', 'P20452', 'marie', 1, ''),
('A785', 'aya', 'Aya', 'PO987', '2013-07-02', 'ehh', 'ayamoufid6@gmail.com', 'A785_IBM', 'b66f7504a80ddea33c063a0fc361dcc7', 'f', 9, '4656465676', '0679123701', '6477383', '66383', '45628', '9835', 'celib', 0, ''),
('AI800', 'Moufid', 'Aya', 'BW18586', '2001-12-18', 'casablanca', 'moufidaya518@gmail.com', 'AI800_Al Imran', 'aya', 'f', 21, '1234567890425364', '0679123701', '12345', '54321', '12567', '14987', 'celib', 0, ''),
('B45T9', 'najah', 'reda', 'P120O8', '1987-09-12', 'casablanca, sidi moumen', 'Aya.sakkour@gmail.com', 'reda', '698d51a19d8a121ce581499d7b701668', 'M', 39, 'Q234', '0658916282', '90890Z9', '2B21255', '1Q0990', 'P20923', 'marie', 4, ''),
('I5632', 'arsali', 'ahmed', 'Q45230', '1991-06-18', 'Rabat,Hay riad', 'ahmed23@gmail.com', 'ahmed', '6678', 'M', 32, '123VW', '1231A', '1Q692', 'Q14D1', '1Q0QV', '09NW1', 'marier', 2, ''),
('Q0979', 'sakkour', 'aya', 'R13569', '2002-05-03', 'casablanca,quartier El maarif', 'ayasakk@gmail.com', 'aya', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'F', 21, 'e2x2', '0699502343', 'W934B', '492B212', '11M45', '0W7891', 'celib', 4, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`idAbsence`);

--
-- Indexes for table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`idaffec`),
  ADD KEY `idRegle` (`idRegle`),
  ADD KEY `idRub` (`idRub`),
  ADD KEY `idFiliale` (`idFiliale`);

--
-- Indexes for table `bulltin`
--
ALTER TABLE `bulltin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_name` (`matricule`);

--
-- Indexes for table `condition_regle`
--
ALTER TABLE `condition_regle`
  ADD PRIMARY KEY (`idcond`),
  ADD KEY `idRegle` (`idRegle`);

--
-- Indexes for table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign Key3` (`idUser`);

--
-- Indexes for table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `fk2` (`idUser`),
  ADD KEY `ffk1` (`idFiliale`);

--
-- Indexes for table `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`idFiliale`);

--
-- Indexes for table `heuresup`
--
ALTER TABLE `heuresup`
  ADD PRIMARY KEY (`idHeureSup`),
  ADD KEY `fk1` (`idUser`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `FK` (`envoyeur`);

--
-- Indexes for table `prime`
--
ALTER TABLE `prime`
  ADD PRIMARY KEY (`idprime`),
  ADD KEY `Foreign Key` (`idUser`);

--
-- Indexes for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idReclamation`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`idRegle`);

--
-- Indexes for table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`idRubrique`);

--
-- Indexes for table `table_absence`
--
ALTER TABLE `table_absence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`matricule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence`
--
ALTER TABLE `absence`
  MODIFY `idAbsence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `idaffec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `bulltin`
--
ALTER TABLE `bulltin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `condition_regle`
--
ALTER TABLE `condition_regle`
  MODIFY `idcond` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `conge`
--
ALTER TABLE `conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `idFiliale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `heuresup`
--
ALTER TABLE `heuresup`
  MODIFY `idHeureSup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `prime`
--
ALTER TABLE `prime`
  MODIFY `idprime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idReclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regle`
--
ALTER TABLE `regle`
  MODIFY `idRegle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rubrique`
--
ALTER TABLE `rubrique`
  MODIFY `idRubrique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `table_absence`
--
ALTER TABLE `table_absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_ibfk_1` FOREIGN KEY (`idRegle`) REFERENCES `regle` (`idRegle`),
  ADD CONSTRAINT `affectation_ibfk_2` FOREIGN KEY (`idRub`) REFERENCES `rubrique` (`idRubrique`),
  ADD CONSTRAINT `affectation_ibfk_3` FOREIGN KEY (`idFiliale`) REFERENCES `filiale` (`idFiliale`);

--
-- Constraints for table `condition_regle`
--
ALTER TABLE `condition_regle`
  ADD CONSTRAINT `condition_regle_ibfk_1` FOREIGN KEY (`idRegle`) REFERENCES `regle` (`idRegle`);

--
-- Constraints for table `conge`
--
ALTER TABLE `conge`
  ADD CONSTRAINT `Foreign Key3` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`matricule`);

--
-- Constraints for table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `Foreign Key2` FOREIGN KEY (`idFiliale`) REFERENCES `filiale` (`idFiliale`),
  ADD CONSTRAINT `ffk1` FOREIGN KEY (`idFiliale`) REFERENCES `filiale` (`idFiliale`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `heuresup`
--
ALTER TABLE `heuresup`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`matricule`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK` FOREIGN KEY (`envoyeur`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prime`
--
ALTER TABLE `prime`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`matricule`);

--
-- Constraints for table `table_absence`
--
ALTER TABLE `table_absence`
  ADD CONSTRAINT `table_absence_ibfk_1` FOREIGN KEY (`title`) REFERENCES `utilisateur` (`matricule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
