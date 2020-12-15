-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2020 at 07:04 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to-do`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `todo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `todo_name` varchar(255) NOT NULL,
  `todo_desc` longtext,
  `due_date` date DEFAULT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`todo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `user_id`, `todo_name`, `todo_desc`, `due_date`, `added_date`, `updated_date`, `status`) VALUES
(1, 5, 'Some', '', NULL, '2020-12-13 12:28:27', '2020-12-13 12:28:27', 1),
(2, 5, 'Some', '', '2020-12-12', '2020-12-13 21:47:11', '2020-12-13 21:47:11', 1),
(3, 5, 'Some', 'Some', '2020-12-20', '2020-12-13 21:48:24', '2020-12-13 21:48:24', 1),
(4, 5, 'Some', '', '2020-12-12', '2020-12-13 21:57:04', '2020-12-13 21:57:04', 2),
(5, 5, 'Test', '', '2020-12-01', '2020-12-14 12:21:19', '2020-12-14 12:21:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `todo_status`
--

DROP TABLE IF EXISTS `todo_status`;
CREATE TABLE IF NOT EXISTS `todo_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_text` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo_status`
--

INSERT INTO `todo_status` (`status_id`, `status_text`) VALUES
(1, 'Pending'),
(2, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `mail_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '1',
  `joined_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `mail_id`, `password`, `token`, `user_status`, `joined_date`) VALUES
(5, 'Aravind', 'aravindanarayanan.m@gmail.com', 'dc35f09e38b6bfb217411527a00818e4', '0bcacecd576a36913a78eca43af33dd76b4f736418fc494e3a8384fdd0cec84b', 1, '2020-12-12 22:07:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
