-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2014 at 10:32 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, '0+'),
(2, '6+'),
(3, '10+'),
(4, '12+'),
(5, '16+'),
(6, '18+');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Название фильма',
  `duration` tinyint(2) NOT NULL COMMENT 'Продолжительность мин.',
  `category` tinyint(4) NOT NULL COMMENT 'Категория для просмотра',
  `genre` tinyint(4) NOT NULL COMMENT 'Жанр',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`,`genre`),
  KEY `genre` (`genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `name`, `duration`, `category`, `genre`, `is_del`) VALUES
(1, 'Гордость и Предубеждение', 127, 1, 1, 0),
(2, 'Иван Васильевич меняет профессию', 88, 1, 1, 0),
(3, 'Побег из Шоушенка', 127, 1, 1, 0),
(4, 'Война миров', 116, 1, 1, 0),
(5, 'Одноклассники', 102, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Фантастика'),
(2, 'Боевик'),
(3, 'Комедия'),
(4, 'Драма'),
(5, 'Детектив'),
(6, 'Триллер'),
(7, 'Ужасы'),
(8, 'Документальный'),
(9, 'Анимация');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE IF NOT EXISTS `halls` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cinema_id` smallint(6) NOT NULL,
  `number_hall` tinyint(2) NOT NULL,
  `count_places` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cinema_id` (`cinema_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `cinema_id`, `number_hall`, `count_places`) VALUES
(1, 1, 1, 200),
(2, 1, 2, 350),
(3, 2, 1, 120),
(4, 2, 2, 300),
(5, 2, 3, 160),
(6, 3, 1, 340),
(7, 4, 1, 230),
(8, 4, 2, 230),
(9, 5, 1, 140),
(10, 5, 2, 300),
(11, 5, 3, 250),
(12, 6, 1, 100),
(13, 6, 2, 100),
(14, 6, 3, 100),
(15, 7, 1, 80),
(16, 7, 2, 20),
(17, 7, 3, 240),
(18, 7, 4, 300),
(19, 8, 1, 200),
(20, 9, 1, 120),
(21, 9, 2, 180),
(22, 10, 1, 230);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` smallint(6) NOT NULL,
  `film_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hall_id` (`hall_id`),
  KEY `film_id` (`film_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `hall_id`, `film_id`, `time`) VALUES
(1, 14, 3, '2014-05-04 15:20:00'),
(2, 13, 4, '2014-05-04 19:20:00'),
(3, 6, 3, '2014-05-04 14:30:00'),
(4, 16, 3, '2014-05-04 21:00:00'),
(5, 18, 3, '2014-05-04 14:20:00'),
(6, 4, 4, '2014-05-04 22:00:00'),
(7, 1, 3, '2014-05-04 17:30:00'),
(8, 1, 4, '2014-05-04 20:30:00'),
(9, 2, 5, '2014-05-05 16:00:00'),
(10, 4, 5, '2014-05-04 21:00:00'),
(11, 3, 5, '2014-05-04 21:00:00'),
(12, 6, 1, '2014-05-04 19:40:00'),
(13, 8, 3, '2014-05-04 17:50:00'),
(14, 14, 2, '2014-05-04 18:10:00'),
(15, 12, 4, '2014-05-04 23:00:00'),
(16, 12, 4, '2014-05-04 19:00:00'),
(17, 16, 5, '2014-05-04 20:35:00'),
(18, 22, 1, '2014-05-04 18:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE IF NOT EXISTS `theaters` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Наименование кинотеатра',
  `code_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `code_name` (`code_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Кинотеатры' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `code_name`) VALUES
(1, 'Планета кино', 'planeta_kino'),
(2, 'Синема Парк', 'cinema_park'),
(3, 'Родина', 'rodina'),
(4, 'Мегаполис', 'megapolis'),
(5, 'Простор', 'prostor'),
(6, 'Победа', 'pobeda'),
(7, 'Мир кино', 'mir_kino'),
(8, 'Искра', 'iskra'),
(9, 'Правда', 'pravda'),
(10, 'Смена', 'smena');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL COMMENT 'Ссылка на киносеанс',
  `unique_code` int(11) NOT NULL COMMENT 'Уникальный код',
  `place` smallint(3) NOT NULL COMMENT 'Место в зале',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `films_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genre` (`id`);

--
-- Constraints for table `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `halls_ibfk_1` FOREIGN KEY (`cinema_id`) REFERENCES `theaters` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
