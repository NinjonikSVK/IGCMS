-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: innodb.endora.cz:3306
-- Čas generovania: Pi 10.Júl 2020, 15:03
-- Verzia serveru: 5.6.45-86.1
-- Verzia PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `megapa1590763489`
--

-- ---------------------------------------------------------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `chat`
--

CREATE TABLE `chat` (
  `chatID` int(11) NOT NULL,
  `chatCont` text,
  `chatAuthor` text,
  `chatTime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `files`
--

CREATE TABLE `files` (
  `fileID` int(11) NOT NULL,
  `fileTitle` varchar(255) DEFAULT NULL,
  `fileCont` text,
  `fileName` text,
  `fileDL` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `descr` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Sťahujem dáta pre tabuľku `footer`
--

INSERT INTO `footer` (`id`, `title`, `descr`) VALUES
(1, '1f', '1d'),
(2, '2f', '2d'),
(3, '3f', '3d');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sortn` int(11) DEFAULT NULL,
  `descr` text,
  `icon` text,
  `parent` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `color` text,
  `canviewdashboard` int(11) DEFAULT '0',
  `canmanagetickets` int(11) DEFAULT '0',
  `canmanagepages` int(11) DEFAULT '0',
  `canmanagenews` int(11) DEFAULT '0',
  `canmanagefiles` int(11) DEFAULT '0',
  `canmanageusers` int(11) DEFAULT '0',
  `canmanagesite` int(11) DEFAULT '0',
  `canmanagegroups` int(11) DEFAULT '0',
  `canmoderatechat` int(11) DEFAULT '0',
  `canmanageforum` int(11) DEFAULT NULL,
  `canmoderateforum` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `likes`
--

CREATE TABLE `likes` (
  `likeID` int(11) NOT NULL,
  `newID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `likeAuthor` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `resetToken` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `resetComplete` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'No',
  `Level` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `location` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `skills` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `notes` text CHARACTER SET utf8 COLLATE utf8_czech_ci,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `IGN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `time` int(11) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL,
  `bg` text CHARACTER SET utf8 COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE `news` (
  `newID` int(11) NOT NULL,
  `newTItle` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `isRoot` int(11) NOT NULL DEFAULT '1',
  `newCont` text COLLATE utf8_czech_ci,
  `newAuthor` text COLLATE utf8_czech_ci,
  `newDate` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT '0',
  `dislikes` int(11) DEFAULT '0',
  `filename` text COLLATE utf8_czech_ci,
  `rubrika` text COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news_r`
--

CREATE TABLE `news_r` (
  `rID` int(11) NOT NULL,
  `newID` int(11) DEFAULT NULL,
  `rCont` text,
  `rAuthor` text,
  `rTime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `notifications`
--

CREATE TABLE `notifications` (
  `notID` int(11) NOT NULL,
  `notUser` varchar(255) DEFAULT NULL,
  `notType` int(11) DEFAULT NULL,
  `notDate` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pages`
--

CREATE TABLE `pages` (
  `pageID` int(11) NOT NULL,
  `pageTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `isRoot` int(11) NOT NULL DEFAULT '1',
  `pageCont` text CHARACTER SET utf8 COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `settings`
--

CREATE TABLE `settings` (
  `siteID` int(11) NOT NULL,
  `siteTitle` varchar(255) DEFAULT NULL,
  `isRoot` int(11) NOT NULL DEFAULT '1',
  `siteOwner` text,
  `slogan` text,
  `ip` text,
  `port` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `settings`
--

INSERT INTO `settings` (`siteID`, `siteTitle`, `isRoot`, `siteOwner`, `slogan`, `ip`, `port`) VALUES
(1, 'IGPortals.eu', 1, 'NinjonikSVK', 'Innovation Gaming Portals', 'play.igportals.eu', 25565);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `s_chat`
--

CREATE TABLE `s_chat` (
  `chID` int(11) NOT NULL,
  `Username` varchar(24) NOT NULL DEFAULT '',
  `Text` text NOT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ticketr`
--

CREATE TABLE `ticketr` (
  `respID` int(11) NOT NULL,
  `ticketID` int(11) DEFAULT NULL,
  `respAuthor` text,
  `respTime` int(11) DEFAULT NULL,
  `respCont` text,
  `respMail` text,
  `type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(11) NOT NULL,
  `ticketTitle` varchar(255) DEFAULT NULL,
  `ticketCont` text,
  `ticketTime` int(11) DEFAULT NULL,
  `ticketAuthor` text,
  `ticketAdmin` text,
  `ticketStatus` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `authorID` int(11) DEFAULT NULL,
  `forumID` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `locked` int(11) DEFAULT NULL,
  `pinned` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `topics_r`
--

CREATE TABLE `topics_r` (
  `id` int(11) NOT NULL,
  `topicID` int(11) DEFAULT NULL,
  `authorID` int(11) DEFAULT NULL,
  `descr` text,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatID`);

--
-- Indexy pre tabuľku `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileID`);

--
-- Indexy pre tabuľku `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexy pre tabuľku `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexy pre tabuľku `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newID`);

--
-- Indexy pre tabuľku `news_r`
--
ALTER TABLE `news_r`
  ADD PRIMARY KEY (`rID`);

--
-- Indexy pre tabuľku `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notID`);

--
-- Indexy pre tabuľku `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexy pre tabuľku `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`siteID`);

--
-- Indexy pre tabuľku `s_chat`
--
ALTER TABLE `s_chat`
  ADD PRIMARY KEY (`chID`);

--
-- Indexy pre tabuľku `ticketr`
--
ALTER TABLE `ticketr`
  ADD PRIMARY KEY (`respID`);

--
-- Indexy pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`);

--
-- Indexy pre tabuľku `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `topics_r`
--
ALTER TABLE `topics_r`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

-- AUTO_INCREMENT pre tabuľku `chat`
--
ALTER TABLE `chat`
  MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `files`
--
ALTER TABLE `files`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `news`
--
ALTER TABLE `news`
  MODIFY `newID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `news_r`
--
ALTER TABLE `news_r`
  MODIFY `rID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `pages`
--
ALTER TABLE `pages`
  MODIFY `pageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `settings`
--
ALTER TABLE `settings`
  MODIFY `siteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `s_chat`
--
ALTER TABLE `s_chat`
  MODIFY `chID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `ticketr`
--
ALTER TABLE `ticketr`
  MODIFY `respID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `topics_r`
--
ALTER TABLE `topics_r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
