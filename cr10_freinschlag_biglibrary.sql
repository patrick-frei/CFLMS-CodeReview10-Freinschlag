-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 18. Jul 2020 um 15:20
-- Server-Version: 8.0.20-0ubuntu0.20.04.1
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr10_freinschlag_biglibrary`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `authors`
--

CREATE TABLE `authors` (
  `author_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `authors`
--

INSERT INTO `authors` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'David', 'Walliams'),
(2, 'Reni', 'Eddo-Lodge'),
(3, 'Bernardine', 'Evaristo');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `media_id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish_date` date NOT NULL,
  `fk_publisher_id` int NOT NULL,
  `type` enum('book','CD','DVD') NOT NULL,
  `status` enum('available','reserved') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`media_id`, `title`, `image`, `ISBN`, `description`, `publish_date`, `fk_publisher_id`, `type`, `status`) VALUES
(3, 'The World\'s Worst Parents', '3.jpg', '9780008305796', 'Are you ready to meet the worst parents ever?\r\n\r\nSure, some parents are embarrassing – but they’re NOTHING on this lot. These ten tales of the world’s most spectacularly silly mums and deliriously daft dads will leave you rocking with laughter.\r\n\r\nPinch your nose for Peter Pong, the man with the stinkiest feet in the world… jump out of the way of Harriet Hurry, the fastest mum on two wheels… watch out for Monty Monopolize, the dad who takes all his kids toys … and oh no, it’s Supermum! Brandishing a toilet brush, a mop and a very bad homemade outfit…', '2020-07-02', 1, 'book', 'available'),
(4, 'Why I\'m No Longer Talking to White People About Race', '4.jpg', '9781408870587', 'I\'m no longer engaging with white people on the topic of race. Not all white people, just the vast majority who refuse to accept the legitimacy of structural racism and its symptoms... You can see their eyes shut down and harden. It\'s like treacle is poured into their ears, blocking up their ear canals. It\'s like they can no longer hear us.\r\n\r\nIn 2014, award-winning journalist Reni Eddo-Lodge wrote about her frustration with the way that discussions of race and racism in Britain were being led by those who weren\'t affected by it. She posted a piece on her blog, entitled: \'Why I\'m No Longer Talking to White People About Race\'.\r\n\r\nHer words hit a nerve. The post went viral and comments flooded in from others desperate to speak up about their own experiences. Galvanised by this clear hunger for open discussion, she decided to dig into the source of these feelings.', '2017-06-01', 2, 'book', 'available'),
(5, 'Girl, Woman, Other', '5.jpg', '9780241984994', 'Teeming with life and crackling with energy - a love song to modern Britain and black womanhood.\r\n\r\nGirl, Woman, Other follows the lives and struggles of twelve very different characters. Mostly women, black and British, they tell the stories of their families, friends and lovers, across the country and through the years.\r\n\r\nJoyfully polyphonic and vibrantly contemporary, this is a gloriously new kind of history, a novel of our times: celebratory, ever-dynamic and utterly irresistible.', '2019-05-02', 3, 'book', 'available');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media_has_authors`
--

CREATE TABLE `media_has_authors` (
  `mha_id` int NOT NULL,
  `fk_media_id` int DEFAULT NULL,
  `fk_author_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media_has_authors`
--

INSERT INTO `media_has_authors` (`mha_id`, `fk_media_id`, `fk_author_id`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 5, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `ZIP_code` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `size` enum('small','medium','big') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `name`, `street`, `ZIP_code`, `city`, `size`) VALUES
(1, 'HarperCollins Publishers', '195 Broadway', '10007', 'New York', 'medium'),
(2, 'Bloomsbury Publishing PLC', '1385 Broadway', '10018', 'New York', 'small'),
(3, 'Penguin Books Ltd', '20 Vauxhall Bridge Road', 'SW1V 2SA', 'London', 'small');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `fk_publisher_id` (`fk_publisher_id`);

--
-- Indizes für die Tabelle `media_has_authors`
--
ALTER TABLE `media_has_authors`
  ADD PRIMARY KEY (`mha_id`),
  ADD KEY `fk_media_id` (`fk_media_id`),
  ADD KEY `fk_author_id` (`fk_author_id`);

--
-- Indizes für die Tabelle `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `media_has_authors`
--
ALTER TABLE `media_has_authors`
  MODIFY `mha_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publishers` (`publisher_id`);

--
-- Constraints der Tabelle `media_has_authors`
--
ALTER TABLE `media_has_authors`
  ADD CONSTRAINT `media_has_authors_ibfk_1` FOREIGN KEY (`fk_media_id`) REFERENCES `media` (`media_id`),
  ADD CONSTRAINT `media_has_authors_ibfk_2` FOREIGN KEY (`fk_author_id`) REFERENCES `authors` (`author_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
