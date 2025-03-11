-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2024 at 01:02 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kutak_dobre_hrane`
--

-- --------------------------------------------------------

--
-- Table structure for table `dostave`
--

DROP TABLE IF EXISTS `dostave`;
CREATE TABLE IF NOT EXISTS `dostave` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `status` enum('prihvacena','odbijena','neobradjena') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'neobradjena',
  `vreme_dostave` enum('20-30 minuta','30-40 minuta','50-60 minuta') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `datum_i_vreme` datetime NOT NULL,
  `racun` int NOT NULL,
  `kor_ime` varchar(50) NOT NULL,
  `jela` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dostave`
--

INSERT INTO `dostave` (`id`, `id_restorana`, `status`, `vreme_dostave`, `datum_i_vreme`, `racun`, `kor_ime`, `jela`) VALUES
(1, 1, 'prihvacena', '50-60 minuta', '2024-07-01 03:19:41', 2000, 'mara123', 'Naziv:palacinke, Kolicina:2'),
(29, 1, 'prihvacena', '30-40 minuta', '2024-07-07 02:46:24', 3000, 'mara123', 'Naziv: punjene paprike, Kolicina: 3  '),
(28, 14, 'prihvacena', '30-40 minuta', '2024-07-07 01:41:58', 400, 'kaca123', 'Naziv: pomfrit, Kolicina: 2  '),
(22, 3, 'neobradjena', NULL, '2024-07-05 18:00:52', 2060, 'mara123', 'Naziv: banana split, Kolicina: 2  '),
(23, 1, 'prihvacena', '50-60 minuta', '2024-07-05 18:01:34', 3000, 'mara123', 'Naziv: punjene paprike, Kolicina: 2  Naziv: palacinke, Kolicina: 1  '),
(12, 3, 'odbijena', NULL, '2024-07-04 18:22:20', 2060, 'mara123', 'Naziv: banana split, Kolicina: 2  '),
(24, 2, 'neobradjena', NULL, '2024-07-05 18:01:50', 1094, 'mara123', 'Naziv: baklave, Kolicina: 2  '),
(25, 1, 'neobradjena', NULL, '2024-07-05 19:34:14', 2000, 'mara123', 'Naziv: punjene paprike, Kolicina: 2  '),
(26, 14, 'neobradjena', NULL, '2024-07-07 01:40:35', 600, 'kaca123', 'Naziv: pomfrit, Kolicina: 3  '),
(16, 1, 'prihvacena', '30-40 minuta', '2024-07-04 22:09:53', 6000, 'mara123', 'Naziv: punjene paprike, Kolicina: 6  '),
(17, 1, 'prihvacena', '20-30 minuta', '2024-07-04 22:10:05', 1000, 'mara123', 'Naziv: palacinke, Kolicina: 1  '),
(19, 1, 'prihvacena', '30-40 minuta', '2024-07-04 22:10:33', 2000, 'mara123', 'Naziv: palacinke, Kolicina: 2  '),
(21, 1, 'neobradjena', NULL, '2024-07-04 22:11:05', 1000, 'mara123', 'Naziv: punjene paprike, Kolicina: 1  ');

-- --------------------------------------------------------

--
-- Table structure for table `gosti`
--

DROP TABLE IF EXISTS `gosti`;
CREATE TABLE IF NOT EXISTS `gosti` (
  `kor_ime` varchar(50) NOT NULL,
  `broj_kreditne_kartice` varchar(16) NOT NULL,
  `aktivnost` enum('aktivan','blokiran') NOT NULL,
  `broj_kasnjenja` int NOT NULL,
  PRIMARY KEY (`kor_ime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gosti`
--

INSERT INTO `gosti` (`kor_ime`, `broj_kreditne_kartice`, `aktivnost`, `broj_kasnjenja`) VALUES
('mara123', '2222222222222222', 'aktivan', 0),
('kaca123', '8888888888888888', 'aktivan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jelovnik`
--

DROP TABLE IF EXISTS `jelovnik`;
CREATE TABLE IF NOT EXISTS `jelovnik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `slika` varchar(100) NOT NULL,
  `cena` int NOT NULL,
  `sastojci` varchar(1000) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jelovnik`
--

INSERT INTO `jelovnik` (`id`, `id_restorana`, `slika`, `cena`, `sastojci`, `naziv`) VALUES
(1, 1, 'uploads/punjene_paprike.jpg', 1000, 'paprika, mleveno svinjsko meso, luk, krompir, djumbir', 'punjene paprike'),
(2, 1, 'uploads/palacinke.jpg', 1000, 'mleko, brasno, krastavac, majonez, margarin, jaje, jedan pomfrit, coca cola', 'palacinke'),
(3, 2, 'uploads/baklave.jpg', 547, 'tekila, shots, limun, so', 'baklave'),
(4, 1, 'uploads/pomfrit.jpg', 300, 'krompir, ulje, so', 'pomfrit'),
(5, 3, 'uploads/banana_split.jpg', 1030, 'banana, split', 'banana split'),
(6, 14, 'uploads/pomfrit.jpg', 200, 'krompir, ulje, so', 'pomfrit');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `komentar` varchar(1000) NOT NULL,
  `kor_ime` varchar(50) NOT NULL,
  `id_rezervacije` int NOT NULL,
  `ocena` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `id_restorana`, `komentar`, `kor_ime`, `id_rezervacije`, `ocena`) VALUES
(1, 1, 'Hrana je bila fina, ali usluga ne bas najbolja. Nisu mi se svideli konobaricini nokti.', 'mara123', 1, '4'),
(2, 1, 'Sve super, divna usluga, sve pohvale!!!!', 'mara123', 9, '5'),
(3, 2, 'Nista mi se ne svidja, veoma neprijatan ambijent.', 'mara123', 2, '1'),
(4, 3, 'Sta je ovo rekla sam!', 'mara123', 4, '2'),
(26, 14, 'Bilo je odlocno bas sam odusevljena, moja mama kaze isto', 'kaca123', 32, '5'),
(25, 2, 'Mnogo dobra pljeskavica!', 'mara123', 14, '5'),
(22, 2, 'Imala sam dlaku u supi, i nije moja bila je ridja!', 'mara123', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `konobari`
--

DROP TABLE IF EXISTS `konobari`;
CREATE TABLE IF NOT EXISTS `konobari` (
  `kor_ime` varchar(50) NOT NULL,
  `id_restorana` int NOT NULL,
  `aktivnost` enum('aktivan','blokiran') NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konobari`
--

INSERT INTO `konobari` (`kor_ime`, `id_restorana`, `aktivnost`, `ime`, `prezime`, `id`) VALUES
('sara123', 1, 'aktivan', 'Sara', 'Brkic', 1),
('tanja123', 1, 'aktivan', 'Tatjana', 'Markovic', 2),
('tica123', 2, 'aktivan', 'Tijana', 'Smigic', 5),
('fica123$', 3, 'aktivan', 'Filip', 'Vasiljevic', 6),
('jeca123', 14, 'aktivan', 'Jelena', 'Pesic', 7);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `kor_ime` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `tip` enum('gost','konobar','administrator') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bezbedonosno_pitanje` enum('Kako se zove Vaša sestra','Kako Vam se zvala učiteljica/učitelj','Koja Vam je omiljena boja') NOT NULL,
  `bezbedonosni_odgovor` varchar(100) NOT NULL,
  `pol` enum('M','Ž') NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `kontakt_telefon` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profilna_slika` varchar(100) NOT NULL DEFAULT '''uploads/default_image.png''',
  PRIMARY KEY (`kor_ime`),
  UNIQUE KEY `kor_ime` (`kor_ime`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ime`, `prezime`, `kor_ime`, `lozinka`, `tip`, `bezbedonosno_pitanje`, `bezbedonosni_odgovor`, `pol`, `adresa`, `kontakt_telefon`, `email`, `profilna_slika`) VALUES
('Marija', 'Brkic', 'mara123', '036f859c323932d3da845d81745428d0', 'gost', 'Kako Vam se zvala učiteljica/učitelj', 'ljilja', 'M', 'Veljka Petrovica 157', '0606241101', 'marija.brkic9@gmail.com', 'uploads/formati_slika_04.png'),
('Sara', 'Brkic', 'sara123', '8a339d634eb0e8e314be76315dbe4866', 'konobar', 'Kako se zove Vaša sestra', 'ana', 'M', 'Ratka Mitrovica 101', '0112515449', 'bm200200d@student.etf.bg', 'uploads/default_image.png'),
('ana', 'peric', 'ana123', 'f925296ea575831baf8d8a23f81135d1', 'administrator', 'Koja Vam je omiljena boja', 'bela', 'M', 'veljka petrovica', '0606241101', 'damdamdam@gmail.com', 'uploads/default_image.png'),
('Tatjana', 'Markovic', 'tanja123', '5c7670e9d53bc37c303663498bb0f6b9', 'konobar', 'Kako Vam se zvala učiteljica/učitelj', 'ivana', 'Ž', 'Ilije Bircanina 5', '0621952912', 'tatjana.m@gmail.com', 'uploads/default_image.png'),
('Katarina', 'Petrovic', 'kaca123', 'dfc018a6a701ffba517ce72ba31dfbdd', 'gost', 'Koja Vam je omiljena boja', 'crvena', 'Ž', 'Ljubise Samardzica 234', '060555434', 'bm200200d@student.etf.bg.ac.rs', 'uploads/default_image.png'),
('Tijana', 'Smigic', 'tica123', '1f2b7bfca3a9c871ca34487cc6141ffe', 'konobar', 'Kako se zove Vaša sestra', 'plava', 'Ž', 'Topcidersko brdo 1111', '0651952912', 'tijana.tijana@gmail.com', 'uploads/formati_slika_04.png'),
('Filip', 'Vasiljevic', 'fica123$', '84dc62c77379f4137bdba4ed54a94c76', 'konobar', 'Kako se zove Vaša sestra', 'teodora', 'Ž', 'Petlovo brdo 11', '0622224425', 'filip_vasiljevic@gmail.com', 'uploads/default_image.png'),
('Jelena', 'Pesic', 'jeca123', '517252e7a6ea4e10abdb4c5c26a497d7', 'konobar', 'Kako se zove Vaša sestra', 'marija', 'Ž', 'Novi beograd 14', '0652255525', 'pesicka@gmail.com', 'uploads/default_image.png');

-- --------------------------------------------------------

--
-- Table structure for table `registracije`
--

DROP TABLE IF EXISTS `registracije`;
CREATE TABLE IF NOT EXISTS `registracije` (
  `id_registracije` int NOT NULL AUTO_INCREMENT,
  `kor_ime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lozinka` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bezbedonosno_pitanje` enum('Kako se zove Vaša sestra','Kako Vam se zvala učiteljica/učitelj','Koja Vam je omiljena boja') NOT NULL,
  `bezbedonosni_odgovor` varchar(100) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `pol` enum('M','Ž') NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `kontakt_telefon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profilna_slika` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'uploads/default_image.png',
  `broj_kreditne_kartice` varchar(16) NOT NULL,
  `status_registracije` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'neobradjena',
  PRIMARY KEY (`id_registracije`),
  UNIQUE KEY `kor_ime` (`kor_ime`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registracije`
--

INSERT INTO `registracije` (`id_registracije`, `kor_ime`, `lozinka`, `bezbedonosno_pitanje`, `bezbedonosni_odgovor`, `ime`, `prezime`, `pol`, `adresa`, `kontakt_telefon`, `email`, `profilna_slika`, `broj_kreditne_kartice`, `status_registracije`) VALUES
(12, 'kaca123', 'dfc018a6a701ffba517ce72ba31dfbdd', 'Koja Vam je omiljena boja', 'crvena', 'Katarina', 'Petrovic', 'Ž', 'Ljubise Samardzica 234', '060555434', 'kacakaca@gmail.com', 'uploads/default_image.png', '8888888888888888', 'prihvacena'),
(11, 'miso123', 'a570fa4e9f7cc105028805048f0a7b67', 'Kako se zove Vaša sestra', 'mladenka', 'Milorad', 'Milovanovic', 'M', 'Karanski put 22', '011381533', 'miso123@gmail.com', 'uploads/default_image.png', '5555555555555555', 'neobradjena'),
(10, 'mare123', '20e8d502b1c349417cba7090665ef110', 'Kako se zove Vaša sestra', 'nemam sestru', 'Marko', 'Savic', 'M', 'Radoja Domanovica 11a', '0113555235', 'marko.mare1@gmail.com', 'uploads/formati_slika_04.png', '4444444444444444', 'neobradjena');

-- --------------------------------------------------------

--
-- Table structure for table `restorani`
--

DROP TABLE IF EXISTS `restorani`;
CREATE TABLE IF NOT EXISTS `restorani` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `tip` enum('kineski','indijski','japanski','domaca kuhinja') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prosecna_ocena` float NOT NULL,
  `mapa` varchar(500) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `pocetak_radnog_vremena` time NOT NULL,
  `kraj_radnog_vremena` time NOT NULL,
  `opis` varchar(500) NOT NULL,
  `kontakt_osoba` varchar(50) NOT NULL,
  `broj_stolova` int NOT NULL,
  `broj_ocena` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restorani`
--

INSERT INTO `restorani` (`id`, `naziv`, `adresa`, `tip`, `prosecna_ocena`, `mapa`, `telefon`, `pocetak_radnog_vremena`, `kraj_radnog_vremena`, `opis`, `kontakt_osoba`, `broj_stolova`, `broj_ocena`) VALUES
(1, 'Green Pizza', 'Ratka Mitrovica 181', 'domaca kuhinja', 4.5, 'Ratka Mitrovica 181', '0112310945', '08:00:00', '22:00:00', 'Sedenje u basti, ponuda veganskih jela, ima slobodan Wi-Fi', 'Marinko Rokvic', 2, 20),
(2, 'Stepin Vajat', 'Kneza Viseslava 31b', 'domaca kuhinja', 2.7843, 'nema_jos_mape.png', '0668822828', '00:00:00', '24:00:00', 'Restoran domace i brze hrane u kome su ogromne pljeskavice, necete moci da ih pojedete cele, ako ste zensko, a ako ste musko, sta god.', 'Sonja Pavlovic', 4, 51),
(3, 'Pink Restoran', 'Solunskih Boraca 16', 'kineski', 4.5, 'nema_jos.jpg', '0112502091', '08:00:00', '22:00:00', 'Kineska kuhinja i nudle', 'Marija Brkic', 2, 35),
(14, 'Zavicaj', 'Gavrila Principa 77', 'indijski', 5, '', '0634493536', '09:00:00', '23:00:00', 'Restoran dobre hrane, pica i muzike', 'Ljiljana Markovic', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

DROP TABLE IF EXISTS `rezervacije`;
CREATE TABLE IF NOT EXISTS `rezervacije` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `datum_i_vreme` datetime NOT NULL,
  `broj_osoba` int NOT NULL,
  `specijalni_zahtevi` varchar(500) NOT NULL,
  `status` enum('neobradjena','prihvacena','odbijena','dosao','nije dosao','otkazana') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kor_ime` varchar(50) NOT NULL,
  `komentar_konobara` varchar(500) NOT NULL,
  `id_konobara` int NOT NULL,
  `id_stola` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id`, `id_restorana`, `datum_i_vreme`, `broj_osoba`, `specijalni_zahtevi`, `status`, `kor_ime`, `komentar_konobara`, `id_konobara`, `id_stola`) VALUES
(1, 1, '2024-07-01 03:14:14', 5, '', 'dosao', 'mara123', '', 1, 1),
(9, 1, '2024-07-03 18:17:00', 5, '', 'dosao', 'mara123', '', 1, 1),
(10, 1, '2024-07-05 18:20:00', 3, 'postim', 'dosao', 'mara123', '', 2, 1),
(11, 1, '2024-07-05 12:32:00', 1, '', 'dosao', 'mara123', '', 2, 1),
(12, 1, '2024-07-05 12:32:00', 1, '', 'dosao', 'mara123', '', 1, 2),
(13, 1, '2024-07-04 14:33:00', 2, '', 'dosao', 'mara123', '', 1, 1),
(15, 1, '2024-07-12 12:35:00', 3, '', 'prihvacena', 'mara123', '', 2, 1),
(18, 1, '2024-07-27 17:39:00', 2, '', 'prihvacena', 'mara123', '', 1, 2),
(19, 1, '2024-07-26 16:39:00', 2, '', 'odbijena', 'mara123', 'Ne mogu ovo da obradim, ova musterija mi je bivsa tasta, i uhodi me da me tuce, zasluzio sam....', 1, 1),
(20, 1, '2024-07-13 14:39:00', 2, '', 'neobradjena', 'mara123', '', 0, 1),
(21, 1, '2024-07-05 18:36:00', 2, '', 'prihvacena', 'mara123', '', 1, 2),
(22, 1, '2024-07-04 12:37:00', 2, '', 'dosao', 'mara123', '', 1, 2),
(30, 1, '2024-07-05 18:53:00', 5, '', 'prihvacena', 'mara123', '', 1, 1),
(31, 14, '2024-07-12 17:39:00', 2, 'samo skupo', 'neobradjena', 'kaca123', '', 0, 9),
(32, 14, '2024-07-06 13:03:00', 2, '', 'dosao', 'kaca123', '', 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stolovi`
--

DROP TABLE IF EXISTS `stolovi`;
CREATE TABLE IF NOT EXISTS `stolovi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_restorana` int NOT NULL,
  `max_ljudi` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stolovi`
--

INSERT INTO `stolovi` (`id`, `id_restorana`, `max_ljudi`) VALUES
(1, 1, 5),
(2, 1, 3),
(3, 2, 4),
(4, 2, 2),
(5, 2, 5),
(6, 2, 6),
(7, 3, 6),
(8, 3, 7),
(9, 14, 2),
(10, 14, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
