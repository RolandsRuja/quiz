-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 16, 2018 at 05:14 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `is_true` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `answer`, `is_true`) VALUES
(1, 1, 'Cleveland Cavaliers', 0),
(2, 1, 'Los Angeles Lakers', 1),
(3, 2, 'Goldenstate Warriors', 1),
(4, 2, 'Oklahama City Thunder', 0),
(5, 2, 'New York Knicks', 0),
(6, 3, 'Utah Jazz', 0),
(7, 3, 'Brooklyn Nets', 0),
(8, 3, 'San Antonio Spurs', 0),
(9, 3, 'New York Knicks', 1),
(10, 4, 'Atlanta Hawks', 0),
(11, 4, 'Dallas Mavericks', 1),
(12, 4, 'Boston Celtics', 0),
(13, 4, 'Los Angeles Clippers', 0),
(14, 4, 'Memphis Grizzlies', 0),
(15, 5, 'Sacremento Kings', 0),
(16, 5, 'Minnesota Timberwolves', 0),
(17, 5, 'Indiana Pacers', 0),
(18, 5, 'Chicago Bulls', 0),
(19, 5, 'Toronto Raptors', 0),
(20, 5, 'Houston Rockets', 1),
(21, 6, 'Boston Bruins', 0),
(22, 6, 'Buffalo Sabres', 1),
(23, 7, 'Washington Capitals', 1),
(24, 7, 'Chicago Blackhawks', 0),
(25, 7, 'Carolina Hurricanes', 0),
(26, 8, 'Tampa Bay Lightning', 0),
(27, 8, 'New York Islanders', 0),
(28, 8, 'Ottawa Senators', 0),
(29, 8, 'Pittsburgh Penguins', 1),
(30, 9, 'Vegas Golden Knights', 0),
(31, 9, 'Chicago Blackhawks', 1),
(32, 9, 'Vancouver Canucks', 0),
(33, 9, 'Arizona Coyotes', 0),
(34, 9, 'Winnipeg Jets', 0),
(35, 10, 'Philadelphia Flyers', 0),
(36, 10, 'Toronto Maple Leafs', 0),
(37, 10, 'Florida Panthers', 0),
(38, 10, 'Anaheim Ducks', 0),
(39, 10, 'St. Louis Blues', 0),
(40, 10, 'Colorado Avalanche', 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `test_id`, `question_id`, `answer_id`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 2, 5),
(3, 1, 1, 3, 6),
(4, 1, 1, 4, 13),
(5, 1, 1, 5, 19),
(6, 2, 2, 6, 21),
(7, 2, 2, 7, 24),
(8, 2, 2, 8, 28),
(9, 2, 2, 9, 31),
(10, 2, 2, 10, 37),
(11, 3, 1, 1, 2),
(12, 3, 1, 2, 3),
(13, 3, 1, 3, 7),
(14, 3, 1, 4, 12),
(15, 3, 1, 5, 16),
(16, 4, 1, 1, 1),
(17, 4, 1, 2, 3),
(18, 4, 1, 3, 6),
(19, 4, 1, 4, 11),
(20, 4, 1, 5, 17),
(21, 5, 2, 6, 22),
(22, 5, 2, 7, 23),
(23, 5, 2, 8, 29),
(24, 5, 2, 9, 31),
(25, 5, 2, 10, 40);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `test_id`, `question`) VALUES
(1, 1, 'Which team LeBron James plays for?'),
(2, 1, 'Which team Kevin Durant plays for?'),
(3, 1, 'Which team Kristaps Porzingis plays for?'),
(4, 1, 'Which team Luka Doncic plays for?'),
(5, 1, 'Which team James Harden plays for?'),
(6, 2, 'Which team Zemgus Girgensons plays for?'),
(7, 2, 'Which team Alex Ovechkin plays for?'),
(8, 2, 'Which team Sideny Crosby plays for?'),
(9, 2, 'Which team Patrick Kane plays for?'),
(10, 2, 'Which team Mikko Rantanen plays for?');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'NBA player test'),
(2, 'NHL player test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `test_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `correct` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `test_id`, `total`, `correct`) VALUES
(1, 'First', 1, 5, 0),
(2, 'second', 2, 5, 1),
(3, 'third', 1, 5, 2),
(4, 'rr16041', 1, 5, 2),
(5, 'Rolands', 2, 5, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
