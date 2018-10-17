-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u4
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Lip 24, 2016 u 02:56 AM
-- Verzija poslužitelja: 5.5.49
-- PHP verzija: 5.4.45-0+deb7u3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `WebDiP2015x019`
--

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `idakcija` int(11) NOT NULL AUTO_INCREMENT,
  `postotak` int(11) DEFAULT NULL,
  `od_datum` date DEFAULT NULL,
  `do_datum` date DEFAULT NULL,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`idakcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Izbacivanje podataka za tablicu `akcija`
--

INSERT INTO `akcija` (`idakcija`, `postotak`, `od_datum`, `do_datum`, `naziv`) VALUES
(1, 10, '2015-12-28', '2016-01-14', 'Novogodišnja'),
(2, 5, '2016-03-21', '2016-04-21', 'Proljetna'),
(3, 7, '2016-06-12', '2016-08-12', 'Ljetna'),
(4, 4, '2016-06-01', '2016-06-30', 'Lipanj akcija'),
(7, 12, '2016-07-01', '2016-07-31', 'Srpanj akcija');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `dnevnik`
--

CREATE TABLE IF NOT EXISTS `dnevnik` (
  `iddnevnik` int(11) NOT NULL AUTO_INCREMENT,
  `tip_zapisa` int(11) DEFAULT NULL,
  `zapis` text,
  `vrijeme` timestamp NULL DEFAULT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  `korisnik` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddnevnik`),
  KEY `fk_dnevnik_korisnik1_idx` (`idkorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Izbacivanje podataka za tablicu `dnevnik`
--

INSERT INTO `dnevnik` (`iddnevnik`, `tip_zapisa`, `zapis`, `vrijeme`, `idkorisnik`, `korisnik`) VALUES
(1, 1, 'Prijavio se korisnik WebDiP2015x019', '2016-06-22 11:24:24', NULL, 'WebDiP2015x019'),
(2, 2, 'Odjavio se korisnik WebDiP2015x019', '2016-06-22 11:27:07', NULL, 'WebDiP2015x019'),
(3, 1, 'Prijavio se korisnik WebDiP2015x019', '2016-06-22 11:33:35', NULL, 'WebDiP2015x019'),
(4, 2, 'Odjavio se korisnik WebDiP2015x019', '2016-06-22 12:07:48', NULL, 'WebDiP2015x019'),
(5, 1, 'Prijavio se korisnik WebDiP2015x019', '2016-06-22 12:19:27', NULL, 'WebDiP2015x019');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `dzkodovi`
--

CREATE TABLE IF NOT EXISTS `dzkodovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kod` varchar(200) NOT NULL,
  `vrijeme` datetime NOT NULL,
  `iskoristenost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Izbacivanje podataka za tablicu `dzkodovi`
--

INSERT INTO `dzkodovi` (`id`, `kod`, `vrijeme`, `iskoristenost`) VALUES
(1, '4718733b0ab3b8b6d9b352b185674809', '2016-05-02 11:56:04', 0),
(2, 'f7d2c26d1a4e489c45670669ba43ab06', '2016-05-02 12:33:35', 0),
(3, '5bd44b3863ea138a7ad939b5810de84b', '2016-05-02 12:36:23', 0),
(4, 'probnikod', '2016-05-02 00:00:00', 0),
(5, 'probnikod2', '2016-05-02 11:00:00', 0),
(8, 'probnikod3', '2016-05-02 16:00:00', 1),
(10, 'probnikod4', '2016-05-03 18:00:00', 1),
(11, 'a79dfdda7da6bf1b57841fe64277c444', '2016-05-02 16:40:21', 1),
(12, 'aa4452548d56c17d6cb32724369a53ab', '2016-05-02 22:06:35', 1),
(13, '4eb0daa361ffa9b4b998ddcbec4bf432', '2016-05-02 22:44:26', 1),
(14, 'bc46b6d5c206ad47896d03f8a2b47f16', '2016-05-04 20:23:06', 1),
(15, '40eedffd0571731ccd44f19b38614b11', '2016-06-16 23:50:39', 0),
(16, 'f5a2e7228fa0e705d81c12582d457eab', '2016-06-16 23:54:33', 0);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `dzkorisnici`
--

CREATE TABLE IF NOT EXISTS `dzkorisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `korime` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `datumrod` varchar(50) NOT NULL,
  `spol` varchar(50) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lokacija` varchar(50) NOT NULL,
  `obavijesti` varchar(50) DEFAULT NULL,
  `aktiviran` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Izbacivanje podataka za tablicu `dzkorisnici`
--

INSERT INTO `dzkorisnici` (`id`, `ime`, `prezime`, `korime`, `lozinka`, `datumrod`, `spol`, `telefon`, `email`, `lokacija`, `obavijesti`, `aktiviran`) VALUES
(1, 'p', 'p', 'proba', 'p', 'p', 'p', 'p', 'proba@proba.com', 'p', NULL, 0),
(2, 't', 't', 'test', 't', 't', 't', 't', 'test@test.com', 't', NULL, 0),
(4, 'Damir', 'Drempetić', 'dDrempe!!10', 'Lozinka123!', '1994', 'M', '0981785527', 'ddrempe@live.com', '28;94', NULL, 1),
(5, 'Camir', 'Crempetić', 'cDrempe!!10', 'novaLOZINKA!0', '1994', 'M', '0981785527', 'cdrempe@live.com', '28;94', NULL, 0),
(6, 'Samir', 'Srempetić', 'sSrempe!!10', 'sifricaA1234!', '1994', 'M', '0981785527', 'samir.srempetic@mail', '28;94', NULL, 0),
(7, 'Neki', 'Novi', 'kDrempe!!10', 'jakaLOZINKA123!', '1980', 'M', '464684', 'neki.novi@gmail', '17;18', NULL, 0),
(8, 'Maja', 'Majaic', 'mMajaic??22', 'lozmMajaic??22', '1997', 'Ž', '6161168', 'm.majaic@mail', '180;90', NULL, 0),
(9, 'Ivan', 'Ivanic', 'iiVanic!!789', 'iiVanic!!789loz', '1989', 'M', '25423453', 'iivanic@leeching.net', '8;7', NULL, 0),
(10, 'Mato', 'Matic', 'matoMatic??12', 'matoMatic??12loz', '1982', 'M', '543245', 'mmatic@leeching.net', '16;17', NULL, 0),
(11, 'Sato', 'Matic', 'satoMatic??12', 'satoMatic??12loz', '1982', 'M', '543245', 'smatic@leeching.net', '16;17', NULL, 0),
(12, 'Pajo', 'Pajic', 'pPajic!!4444', 'pPajic!!4444loz', '1944', 'M', '5283', 'ppajic@leeching.net', '4;4', NULL, 1),
(13, 'Stjepan', 'Stjepanovic', 'sStjepko!!16', 'stjepkoLOZ123!', '1960', 'M', '227257', 'stjepstjep@leeching.net', '14;12', NULL, 1),
(14, 'Nenad', 'Nenadic', 'izNenada!!88', 'izNenada!!88loz', '1978', 'M', '58752', 'nenadnenadic@leeching.net', '92;44', NULL, 1),
(15, 'Drago', 'Dragic', 'dragDragic!!18', 'dragDragic!!18loz', '1969', 'M', '54646916916', 'dragodragic@mail.com', '44;55', NULL, 0),
(16, 'Joza', 'Lovac', 'jLovac!!223', 'puska123!AAA', '1986', 'M', '68464561', 'jozalovac@leeching.net', '90;14', NULL, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kategorija`
--

CREATE TABLE IF NOT EXISTS `kategorija` (
  `idkategorija` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idkategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Izbacivanje podataka za tablicu `kategorija`
--

INSERT INTO `kategorija` (`idkategorija`, `naziv`, `opis`) VALUES
(1, 'krema', NULL),
(2, 'tablete', NULL),
(3, 'sirup', NULL),
(4, 'pastile', NULL),
(5, 'sprej', NULL),
(6, 'prašak', NULL),
(7, 'ulje', NULL),
(8, 'mast', NULL),
(9, 'kapsule', NULL),
(10, 'gel', NULL),
(11, 'pomagalo', NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kliknuo`
--

CREATE TABLE IF NOT EXISTS `kliknuo` (
  `idkliknuo` int(11) NOT NULL AUTO_INCREMENT,
  `idkorisnik` int(11) NOT NULL,
  `idlijek` int(11) DEFAULT NULL,
  `idkategorija` int(11) DEFAULT NULL,
  `vrijeme` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idkliknuo`),
  KEY `fk_kliknuo_korisnik1_idx` (`idkorisnik`),
  KEY `fk_kliknuo_lijek1_idx` (`idlijek`),
  KEY `fk_kliknuo_kategorija1_idx` (`idkategorija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kod`
--

CREATE TABLE IF NOT EXISTS `kod` (
  `idkod` int(11) NOT NULL AUTO_INCREMENT,
  `vrijednost` varchar(200) DEFAULT NULL,
  `vrijeme` timestamp NULL DEFAULT NULL,
  `iskoristenost` int(11) DEFAULT '0',
  `idkorisnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`idkod`),
  KEY `fk_kod_korisnik_idx` (`idkorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Izbacivanje podataka za tablicu `kod`
--

INSERT INTO `kod` (`idkod`, `vrijednost`, `vrijeme`, `iskoristenost`, `idkorisnik`) VALUES
(1, '38e7675c4ac5c4cad076232fc0de392a', '2016-06-16 22:00:08', 1, NULL),
(2, '81ba9cae30c57740ebc7fdf769a0ceaf', '2016-06-21 22:06:55', 1, NULL),
(3, 'bb58efcc520d3f42a175784eda8a0372', '2016-06-18 18:15:00', 1, NULL),
(4, '73c92bdc0945abc9bb1a9226b013c301', '2016-06-22 07:56:49', 1, NULL),
(5, '00382ee299d7a8fd8904987df114f778', '2016-06-23 10:14:29', 1, NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `idkorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `uloga` int(11) DEFAULT '0',
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `korime` varchar(45) DEFAULT NULL,
  `lozinka` varchar(45) DEFAULT NULL,
  `aktiviran` int(11) DEFAULT '0',
  `zakljucan` int(11) DEFAULT '0',
  `neuspjesne_prijave` int(11) DEFAULT '0',
  PRIMARY KEY (`idkorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Izbacivanje podataka za tablicu `korisnik`
--

INSERT INTO `korisnik` (`idkorisnik`, `uloga`, `ime`, `prezime`, `godina`, `email`, `korime`, `lozinka`, `aktiviran`, `zakljucan`, `neuspjesne_prijave`) VALUES
(1, 3, 'Admin', 'Admin', 1930, 'damdrempe@foi.hr', 'WebDiP2015x019', 'admin_cTYx', 1, 0, 0),
(3, 2, 'Pero', 'Peric', 1987, 'peroperic@leeching.net', 'pperic123', '9d7f95e5', 1, 0, 0),
(5, 2, 'Ivan', 'Ivic', 1990, 'ivanivic@leeching.net', 'ivan12345', 'cijalijelivada123!A', 1, 0, 0),
(6, 0, 'Jelena', 'Pranjic', 1997, 'jelena@leeching.net', 'jelena', 'jelenaP123!', 0, 0, 0),
(8, 1, 'Franjo', 'Franjic', 1976, 'franjofranic@leeching.net', 'ffranc', 'ffranc1976A!', 1, 0, 0);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `lijek`
--

CREATE TABLE IF NOT EXISTS `lijek` (
  `idlijek` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `cijena` double DEFAULT NULL,
  `proizvodac` varchar(45) DEFAULT NULL,
  `tezina` double DEFAULT NULL,
  `bez_recepta` int(11) DEFAULT NULL,
  `idkategorija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlijek`),
  KEY `fk_lijek_kategorija1_idx` (`idkategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Izbacivanje podataka za tablicu `lijek`
--

INSERT INTO `lijek` (`idlijek`, `naziv`, `cijena`, `proizvodac`, `tezina`, `bez_recepta`, `idkategorija`) VALUES
(1, 'Floceta', 39.1, 'Belupo', NULL, NULL, 10),
(2, 'Octenisept', 55.1, 'Schulke', NULL, NULL, 10),
(3, 'Dormirin Forte', 53.2, 'PharmaS', NULL, NULL, 9),
(4, 'PROBalans Imuno', 109.4, 'PharmaS', NULL, NULL, 9),
(5, 'Trputac', 53, 'Aktival', NULL, NULL, 3),
(6, 'Aqua Maris sprej za nos', 34.5, 'Aqua Maris ', NULL, NULL, 5),
(7, 'LINEX Forte', 58.4, 'Sandoz', NULL, NULL, 9),
(8, 'Reumasan', 47.2, 'Dietpharm', NULL, NULL, 10),
(9, 'Epid', 65.4, 'Specchiasol', NULL, NULL, 5),
(10, 'Isla Mint', 46.2, 'Isla', NULL, NULL, 4),
(19, 'Sinusan', 28.99, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `moderira`
--

CREATE TABLE IF NOT EXISTS `moderira` (
  `idkorisnik` int(11) NOT NULL,
  `idkategorija` int(11) NOT NULL,
  PRIMARY KEY (`idkorisnik`,`idkategorija`),
  KEY `fk_korisnik_has_kategorija_kategorija1_idx` (`idkategorija`),
  KEY `fk_korisnik_has_kategorija_korisnik1_idx` (`idkorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Izbacivanje podataka za tablicu `moderira`
--

INSERT INTO `moderira` (`idkorisnik`, `idkategorija`) VALUES
(3, 1),
(5, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `na_akciji`
--

CREATE TABLE IF NOT EXISTS `na_akciji` (
  `lijek_idlijek` int(11) NOT NULL,
  `akcija_idakcija` int(11) NOT NULL,
  PRIMARY KEY (`lijek_idlijek`,`akcija_idakcija`),
  KEY `fk_lijek_has_akcija_akcija1_idx` (`akcija_idakcija`),
  KEY `fk_lijek_has_akcija_lijek1_idx` (`lijek_idlijek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Izbacivanje podataka za tablicu `na_akciji`
--

INSERT INTO `na_akciji` (`lijek_idlijek`, `akcija_idakcija`) VALUES
(5, 1),
(8, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `oznacio`
--

CREATE TABLE IF NOT EXISTS `oznacio` (
  `idoznacio` int(11) NOT NULL AUTO_INCREMENT,
  `oznaka` varchar(45) DEFAULT NULL,
  `idslika` int(11) NOT NULL,
  PRIMARY KEY (`idoznacio`),
  KEY `fk_oznacio_slika1_idx` (`idslika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `poslovnica`
--

CREATE TABLE IF NOT EXISTS `poslovnica` (
  `idposlovnica` int(11) NOT NULL AUTO_INCREMENT,
  `duzina` varchar(45) DEFAULT NULL,
  `sirina` varchar(45) DEFAULT NULL,
  `drzava` varchar(45) DEFAULT NULL,
  `grad` varchar(45) DEFAULT NULL,
  `ulica` varchar(45) DEFAULT NULL,
  `broj` varchar(45) DEFAULT NULL,
  `radno_vrijeme` text,
  `lokacija` varchar(45) DEFAULT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`idposlovnica`),
  KEY `fk_poslovnica_korisnik1_idx` (`idkorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Izbacivanje podataka za tablicu `poslovnica`
--

INSERT INTO `poslovnica` (`idposlovnica`, `duzina`, `sirina`, `drzava`, `grad`, `ulica`, `broj`, `radno_vrijeme`, `lokacija`, `idkorisnik`) VALUES
(1, '16.33828249999999', '46.3094427', NULL, NULL, 'Uska ulica 6', NULL, NULL, NULL, NULL),
(2, '16.331770600000027', '46.305259', NULL, NULL, 'Kratka ulica 18', NULL, NULL, NULL, NULL),
(3, '16.3319482', '46.309822', NULL, NULL, 'Stari grad', NULL, NULL, NULL, NULL),
(4, '16.2238577', '46.1133314', NULL, NULL, 'Gornjaki 44', NULL, NULL, NULL, NULL),
(5, '46', '16', NULL, NULL, 'Nova ulica ', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `racun`
--

CREATE TABLE IF NOT EXISTS `racun` (
  `idracun` int(11) NOT NULL AUTO_INCREMENT,
  `vrijeme` timestamp NULL DEFAULT NULL,
  `lijek` varchar(45) DEFAULT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `cijena` double DEFAULT NULL,
  `djelatnik` varchar(45) DEFAULT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`idracun`),
  KEY `fk_racun_korisnik1_idx` (`idkorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `racun`
--

INSERT INTO `racun` (`idracun`, `vrijeme`, `lijek`, `kolicina`, `cijena`, `djelatnik`, `idkorisnik`) VALUES
(1, '2016-06-23 19:41:39', 'Floceta', 3, 117.3, NULL, 8),
(2, '2016-06-23 19:41:39', 'LINEX Forte', 2, 116.8, NULL, 8);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `rezervira`
--

CREATE TABLE IF NOT EXISTS `rezervira` (
  `idrezervira` int(11) NOT NULL AUTO_INCREMENT,
  `idkorisnik` int(11) NOT NULL,
  `idlijek` int(11) NOT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `potvrdeno` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrezervira`),
  KEY `fk_rezervira_korisnik1_idx` (`idkorisnik`),
  KEY `fk_rezervira_lijek1_idx` (`idlijek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `slika`
--

CREATE TABLE IF NOT EXISTS `slika` (
  `idslika` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `idkorisnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`idslika`),
  KEY `fk_slika_korisnik1_idx` (`idkorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `vvrijeme`
--

CREATE TABLE IF NOT EXISTS `vvrijeme` (
  `idvvrijeme` int(11) NOT NULL AUTO_INCREMENT,
  `pomak` int(11) DEFAULT NULL,
  `trenutno` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idvvrijeme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Izbacivanje podataka za tablicu `vvrijeme`
--

INSERT INTO `vvrijeme` (`idvvrijeme`, `pomak`, `trenutno`) VALUES
(1, -36, '2016-06-23 22:59:37');

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `kliknuo`
--
ALTER TABLE `kliknuo`
  ADD CONSTRAINT `fk_kliknuo_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kliknuo_lijek1` FOREIGN KEY (`idlijek`) REFERENCES `lijek` (`idlijek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kliknuo_kategorija1` FOREIGN KEY (`idkategorija`) REFERENCES `kategorija` (`idkategorija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `kod`
--
ALTER TABLE `kod`
  ADD CONSTRAINT `fk_kod_korisnik` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `lijek`
--
ALTER TABLE `lijek`
  ADD CONSTRAINT `fk_lijek_kategorija1` FOREIGN KEY (`idkategorija`) REFERENCES `kategorija` (`idkategorija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `moderira`
--
ALTER TABLE `moderira`
  ADD CONSTRAINT `fk_korisnik_has_kategorija_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_kategorija_kategorija1` FOREIGN KEY (`idkategorija`) REFERENCES `kategorija` (`idkategorija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `na_akciji`
--
ALTER TABLE `na_akciji`
  ADD CONSTRAINT `fk_lijek_has_akcija_lijek1` FOREIGN KEY (`lijek_idlijek`) REFERENCES `lijek` (`idlijek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lijek_has_akcija_akcija1` FOREIGN KEY (`akcija_idakcija`) REFERENCES `akcija` (`idakcija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `oznacio`
--
ALTER TABLE `oznacio`
  ADD CONSTRAINT `fk_oznacio_slika1` FOREIGN KEY (`idslika`) REFERENCES `slika` (`idslika`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `poslovnica`
--
ALTER TABLE `poslovnica`
  ADD CONSTRAINT `fk_poslovnica_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_racun_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `rezervira`
--
ALTER TABLE `rezervira`
  ADD CONSTRAINT `fk_rezervira_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervira_lijek1` FOREIGN KEY (`idlijek`) REFERENCES `lijek` (`idlijek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograničenja za tablicu `slika`
--
ALTER TABLE `slika`
  ADD CONSTRAINT `fk_slika_korisnik1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
