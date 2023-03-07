-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 mrt 2023 om 11:05
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `street` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `company`
--

INSERT INTO `company` (`companyID`, `name`, `phonenumber`, `email`, `street`, `city`, `zipcode`, `country`) VALUES
(1, 'The better company', '0612345678', 'janbaksteen719@gmail.com', 'straat 1', 'arnhem', '1111 AB', 'Nederland');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menuitems`
--

CREATE TABLE `menuitems` (
  `menuitemID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `weight` int(10) NOT NULL,
  `icon` text NOT NULL,
  `path` varchar(20) NOT NULL,
  `homepage` varchar(20) NOT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `menuitems`
--

INSERT INTO `menuitems` (`menuitemID`, `name`, `weight`, `icon`, `path`, `homepage`, `statusID`) VALUES
(1, 'Gebruikers', 1, '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" class=\"bi bi-people-fill\" viewBox=\"0 0 16 16\">\r\n    <path d=\"M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z\"/>\r\n    </svg>', 'users', 'userlist', 1),
(2, 'Credits', 100, '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" class=\"bi bi-book-half\" viewBox=\"0 0 16 16\">\r\n  <path d=\"M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z\"/>\r\n</svg>', 'credits', 'credits', 1),
(3, 'Facturen', 5, '<svg xmlns=\"http://www.w3.org/2000/svg\"  fill=\"currentColor\" class=\"bi bi-journal-text\" viewBox=\"0 0 16 16\">\r\n  <path d=\"M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z\"/>\r\n  <path d=\"M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z\"/>\r\n  <path d=\"M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z\"/>\r\n</svg>', 'invoice', 'invoicelist', 1),
(4, 'Bedrijven', 2, '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" class=\"bi bi-buildings-fill\" viewBox=\"0 0 16 16\">\r\n  <path d=\"M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z\"/>\r\n</svg>', 'company', 'companylist', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rapport`
--

CREATE TABLE `rapport` (
  `rapportID` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `statusID` int(11) NOT NULL,
  `menuitemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rapportid_comments`
--

CREATE TABLE `rapportid_comments` (
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rapportID` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `roles`
--

INSERT INTO `roles` (`roleID`, `name`) VALUES
(1, 'admin'),
(2, 'visitor');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `site`
--

CREATE TABLE `site` (
  `siteID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `site`
--

INSERT INTO `site` (`siteID`, `name`, `statusID`) VALUES
(1, 'The-better.great-site.net', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`statusID`, `name`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userid_menuitemid`
--

CREATE TABLE `userid_menuitemid` (
  `userID_menuitemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `menuitemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `userid_menuitemid`
--

INSERT INTO `userid_menuitemid` (`userID_menuitemID`, `userID`, `menuitemID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 12, 1),
(4, 12, 2),
(5, 12, 3),
(6, 1, 3),
(10, 13, 3),
(11, 13, 2),
(12, 11, 1),
(13, 11, 3),
(14, 11, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL,
  `enddate` date NOT NULL,
  `statusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `roleID`, `enddate`, `statusID`) VALUES
(1, 'danilo719', '$2y$10$SRXupeAT.XqgV6tvIcO9COvvE1uAVGNvi8M5GZzGPBJbOIf5TBHkO', 1, '9999-01-01', 1),
(11, 'danilo718', '$2y$10$/sSKzaxXJgKK9rgCjE91Eud6aoGqAPJGGwAgGtyW5IA9JJeev.hB6', 2, '2023-01-02', 1),
(12, 'n.zorgvol', '$2y$10$/QqNtWzMfUVMA1zX1cSVVu6Na78pU2rPyl8GJ45haCxngtRNOugd.', 1, '9999-01-01', 1),
(13, 'selina', '$2y$10$Kog.n2.hgkd0t.J01By4DOqhXmqjaxbP0V2JgM1z7sv9rXz/Uj7ca', 2, '2022-12-23', 1),
(16, 'hilliante', '$2y$10$KGl9M4XRSpIDxDAPw/Miq.9od/sXOci.C2RdrShP5ZWJGCnFPcdne', 2, '2022-12-20', 1),
(17, 'raymond', '$2y$10$COlBZLb0ar9qYTxofkbmU.U.6bSGu..zvGc/Jk.Ybfy8SteeaFNwi', 2, '2022-12-20', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`menuitemID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexen voor tabel `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`rapportID`),
  ADD KEY `statusID` (`statusID`),
  ADD KEY `menuitemID` (`menuitemID`);

--
-- Indexen voor tabel `rapportid_comments`
--
ALTER TABLE `rapportid_comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `rapportID` (`rapportID`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexen voor tabel `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`siteID`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexen voor tabel `userid_menuitemid`
--
ALTER TABLE `userid_menuitemid`
  ADD PRIMARY KEY (`userID_menuitemID`),
  ADD KEY `menuitemID` (`menuitemID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `statusID` (`statusID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `menuitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `rapport`
--
ALTER TABLE `rapport`
  MODIFY `rapportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rapportid_comments`
--
ALTER TABLE `rapportid_comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `site`
--
ALTER TABLE `site`
  MODIFY `siteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `userid_menuitemid`
--
ALTER TABLE `userid_menuitemid`
  MODIFY `userID_menuitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `rapport_ibfk_1` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rapport_ibfk_2` FOREIGN KEY (`menuitemID`) REFERENCES `menuitems` (`menuitemID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `rapportid_comments`
--
ALTER TABLE `rapportid_comments`
  ADD CONSTRAINT `rapportid_comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rapportid_comments_ibfk_2` FOREIGN KEY (`rapportID`) REFERENCES `rapport` (`rapportID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `userid_menuitemid`
--
ALTER TABLE `userid_menuitemid`
  ADD CONSTRAINT `userid_menuitemid_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userid_menuitemid_ibfk_2` FOREIGN KEY (`menuitemID`) REFERENCES `menuitems` (`menuitemID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
