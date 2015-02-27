
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Feb 2015 um 09:56
-- Server Version: 5.1.66
-- PHP-Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `u102846768_wv`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Artikel`
--

CREATE TABLE IF NOT EXISTS `Artikel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ArtikelGruppenID` int(11) NOT NULL,
  `NettoPreis` double NOT NULL,
  `MwStSatz` double NOT NULL,
  `Beschreibung` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Bild` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `Artikel`
--

INSERT INTO `Artikel` (`ID`, `Titel`, `ArtikelGruppenID`, `NettoPreis`, `MwStSatz`, `Beschreibung`, `Bild`) VALUES
(1, 'Droideka', 3, 21000, 19, 'Die Droidekas waren eine Kampfdroidenreihe, die auch als Zerstörerdroide bekannt wurde', 'Droideka1.jpg'),
(2, 'Todesstern', 2, 10000000000000, 7, 'Der Todesstern, das einzig bekannte Exemplar der DS-1 Mobilen Tiefraumkampfstation, war eine mondgroße Superwaffe des Galaktischen Imperiums in Form einer mobilen Raumstation', 'Todesstern1.jpg'),
(3, 'S-5 Multifunktionsblaster', 1, 1000, 19, 'Der S-5 Multifunktionsblaster gehörte zum Waffenarsenal der Sicherheitskräfte und war die Standardbewaffnung', 'S-5 Multifunktionsblaster1.jpg'),
(4, 'Vibro-Schwert', 1, 500, 19, 'Vibro-Waffen sind kybernetisch verbesserte Hieb- und Stichwaffen, die als Nahkampfwaffen und Werkzeuge in der gesamten Galaxis verbreitet sind', 'Vibro-Schwert1.jpg'),
(5, 'Eta-2 Actis-Klasse Abfangjäger', 2, 320000, 19, 'War ein Sternjäger der Galaktischen Republik, der zur Zeit der Klonkriege oftmals von den Jedi des Alten Jedi-Ordens eingesetzt wurde.', 'Eta-2 Actis-Klasse Abfangjäger1.jpg'),
(6, 'Sternzerstörer der Imperium-Klasse', 2, 150000000, 19, 'Sind die stärksten Raumschiffe in den von Moffs kommandierten Sektor-Flotten des Imperiums', 'Sternzerstörer der Imperium-Klasse1.jpg'),
(9, 'All Terrain Recon Transport', 7, 40000, 19, 'Ist ein zweibeiniger Kampfläufer, der von der Galaktischen Republik in den Klonkriegen eingesetzt wurde', 'All Terrain Recon Transport.png'),
(7, 'B1-Kampfdroide', 3, 1800, 19, 'Sind eine Serie von ferngesteuerten Kampfdroiden, die von Baktoid Combat Automata im Auftrag der Handelsföderation produziert wurden', 'B1-Kampfdroide.jpg'),
(8, 'B2-Superkampfdroide', 3, 3300, 19, 'Sind Kampfdroiden der Handelsföderation, die während der Klonkriege von der Konföderation unabhängiger Systeme verwendet wurden', 'Superkampfdroide1.jpg'),
(10, 'Heavy Assault Vehicle/wheeled A6 Juggernaut', 6, 350000, 19, 'Ist ein zehnrädriges Bodenfahrzeug, das aufgrund seiner Panzerung und Bewaffnung sowohl für den Nah- und den Fernbereich als Angriffsfahrzeug wie auch als Transportfahrzeug verwendet wurden', 'Juggernaut1.jpg'),
(11, 'Gepanzerter Angriffspanzer-1', 6, 35000, 7, 'Das unverwechselbare Aussehen des AAT ist geprägt durch den nach hinten aufsteigenden Rumpf, der auf einem halbkreisförmigen Sockel befestigt ist', 'AAT1.jpg,AAT2.jpg,AAT3.jpg'),
(12, 'R2-Astromechdroide', 4, 4525, 19, 'Als Weiterentwicklung des R1-Astromechdroiden war er mit seinen 96 Zentimetern deutlich kompakter und besser für die Arbeit auf Raumschiffen geeignet als sein Vorgänger', 'R2-Astromechdroide.jpg'),
(13, 'R4-Astromechdroide', 4, 2500, 19, 'Die Droiden waren für den privaten Gebrauch, vor allem in den Außenregionen der Galaxis entworfen, weshalb die Anforderungen an die Droiden wesentlich geringer ausfielen', 'R4-Astromechdroide.jpg'),
(14, 'MSE-6 Maus-Droide', 4, 350, 19, 'Ist ein sehr beliebter Wartungsdroide.', 'MSE-6.jpg'),
(15, 'All Terrain Armored Transport', 7, 260000, 19, 'Der AT-AT ist eine echte Terrorwaffe. Selbst wenn er nicht im Einsatz ist, sondern in einem Hangar steht, flösst er durch seine gewaltige Größe und die massiven Waffensysteme Angst ein.', 'at-at1.png,at-at2.jpg'),
(16, 'TC-14', 5, 1200, 19, 'TC-14 istein silberner Protokolldroide mit weiblicher Programmierung', ''),
(17, 'C-3PO', 5, 1200, 19, 'C-3PO ist ein Protokolldroide mit meanlicher Programmierung', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ArtikelGruppen`
--

CREATE TABLE IF NOT EXISTS `ArtikelGruppen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `ArtikelGruppen`
--

INSERT INTO `ArtikelGruppen` (`ID`, `Title`) VALUES
(1, 'Waffen'),
(2, 'Raumschiffe'),
(3, 'Kampfdroiden'),
(4, 'Astromechdroiden'),
(5, 'Protokolldroiden'),
(6, 'Fahrzeuge'),
(7, 'Kampfläufer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Bestellung`
--

CREATE TABLE IF NOT EXISTS `Bestellung` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NutzerID` int(255) NOT NULL,
  `Datum` date NOT NULL,
  `ZahlArt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `R_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `R_Vornamen` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `R_Strasse_Nr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `R_PLZ_Ort` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Bezahlt` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `Bestellung`
--

INSERT INTO `Bestellung` (`ID`, `NutzerID`, `Datum`, `ZahlArt`, `R_Name`, `R_Vornamen`, `R_Strasse_Nr`, `R_PLZ_Ort`, `Bezahlt`) VALUES
(1, 1, '2015-02-03', 'Paypal', 'Skywalker', 'Luke', 'Milchstrasse 15', '10543 DeathstarOne', 0),
(2, 2, '2015-12-12', 'Sofortueberweisung', 'Warrick', 'Wicket W.', 'Waldstrasse 96', '10687 Endor', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `BestellungsDetails`
--

CREATE TABLE IF NOT EXISTS `BestellungsDetails` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BestellungenID` int(11) NOT NULL,
  `ArtikelName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NettoPreis` double NOT NULL,
  `MwSt` double NOT NULL,
  `Anzahl` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `BestellungsDetails`
--

INSERT INTO `BestellungsDetails` (`ID`, `BestellungenID`, `ArtikelName`, `NettoPreis`, `MwSt`, `Anzahl`) VALUES
(1, 1, 'Todesstern', 20000000000000, 7, 2),
(2, 2, 'Droideka', 21000, 19, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Nutzer`
--

CREATE TABLE IF NOT EXISTS `Nutzer` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Vorname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Strasse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StrasseNr` int(255) NOT NULL,
  `PLZ` int(255) NOT NULL,
  `Ort` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EMail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Passwort` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ISAdmin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `Nutzer`
--

INSERT INTO `Nutzer` (`ID`, `Name`, `Vorname`, `Strasse`, `StrasseNr`, `PLZ`, `Ort`, `EMail`, `Passwort`, `ISAdmin`) VALUES
(1, 'Skywalker', 'Anakin', 'Milchstrasse', 7, 10543, 'DeathstarOne', 'anakin@darkside.frc', '$2y$10$V9OxV5RaRJ8f73iOfkTcn.KiuUz44.8.hkOyTM.0B3MmNW7Hy4L4i', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Steuersaetze`
--

CREATE TABLE IF NOT EXISTS `Steuersaetze` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Steuersatz` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
