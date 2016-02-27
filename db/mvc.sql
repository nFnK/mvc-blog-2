-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2016 at 08:38 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `brp_course`
--

CREATE TABLE IF NOT EXISTS `brp_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `brp_course`
--

INSERT INTO `brp_course` (`id`, `title`, `description`, `status`) VALUES
(25, 'Electronic Signatures', 'Electronic Signatures', 'Active'),
(26, 'Deploying Hybrid Backup Solutions', 'Deploying Hybrid Backup Solutions', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `brp_product`
--

CREATE TABLE IF NOT EXISTS `brp_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `brp_product`
--

INSERT INTO `brp_product` (`id`, `title`, `description`, `status`) VALUES
(4, 'Backup Server', 'Backup Server', 'Active'),
(5, 'Message Archiver unit', 'Message Archiver unit', 'Active'),
(6, 'SignNow Unit', 'SignNow Unit', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `brp_reward_program`
--

CREATE TABLE IF NOT EXISTS `brp_reward_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(25) NOT NULL,
  `validity` datetime NOT NULL,
  `added_on` datetime NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `brp_reward_program`
--

INSERT INTO `brp_reward_program` (`id`, `title`, `description`, `type`, `validity`, `added_on`, `status`) VALUES
(13, 'Training - Electronic Signatures', 'Earn $50 for completing our digital signature training.', 'Training', '2016-02-29 00:00:00', '2016-02-10 08:43:11', 'Active'),
(14, 'Training - Deploying Hybrid Backup Solutions', 'Earn $100 for completing the Hybrid Backup Solutions Course.', 'Training', '2016-02-23 00:00:00', '2016-02-10 08:43:40', 'Active'),
(15, 'Full Backup Promotion', 'Get paid $100 for every Backup Server or Message Archiver unit that you sell.', 'Sale', '2016-02-29 00:00:00', '2016-02-10 09:13:14', 'Active'),
(16, 'SignNow Bundle Reward', 'Add SignNow to your Barracuda sale and earn an extra $50.', 'Sale', '2016-02-29 00:00:00', '2016-02-10 09:13:42', 'Active'),
(17, 'SignNow Bundle Reward1', 'test', 'Training', '2016-02-23 00:00:00', '2016-02-10 22:53:14', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `brp_reward_program_item`
--

CREATE TABLE IF NOT EXISTS `brp_reward_program_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_program_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `brp_reward_program_item`
--

INSERT INTO `brp_reward_program_item` (`id`, `reward_program_id`, `item_id`, `amount`) VALUES
(3, 13, 25, 50),
(4, 14, 26, 100),
(5, 15, 4, 100),
(6, 16, 6, 50),
(7, 17, 25, 100);

--
-- Table structure for table `brp_user`
--

CREATE TABLE IF NOT EXISTS `brp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `pass` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `brp_user`
--

INSERT INTO `brp_user` (`id`, `email`, `pass`, `status`, `created`) VALUES
(17, 'admin@localhost.com', '21232f297a57a5a743894a0e4a801fc3', 'Active', '2016-02-08 02:50:08'),
(18, 'priyanka@localhost.com', '21232f297a57a5a743894a0e4a801fc3', 'Active', '2016-02-09 00:13:25'),
(19, 'bhicks@barracuda.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Active', '2016-02-09 01:39:20'),
(20, 'lsmith@barracuda.com', 'd3eb9a9233e52948740d7eb8c3062d14', 'Active', '2016-02-09 01:39:50'),
(21, 'johndoe@abc.com', 'ba273a93b9de3c0d241b93c40ba94cb8', 'Active', '2016-02-10 08:41:46'),
(22, 'marysmith@xyz.com', '25a91646f76e4bab8321ed8ee5b1825a', 'Active', '2016-02-10 08:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `brp_user_profile`
--

CREATE TABLE IF NOT EXISTS `brp_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `company` varchar(255) NOT NULL,
  `date_format` varchar(25) NOT NULL,
  `pending_requests` int(11) DEFAULT '0',
  `last_activity` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `brp_user_profile`
--

INSERT INTO `brp_user_profile` (`id`, `uid`, `firstname`, `lastname`, `role`, `company`, `date_format`, `pending_requests`, `last_activity`) VALUES
(8, 17, 'admin', 'admin', 'Employee', 'admin', 'm-d-Y', 0, '2016-02-10 22:50:08'),
(9, 18, 'Priyanka', 'Amonker', 'Partner', 'localhost', 'm-d-Y', 0, '2016-02-10 05:54:05'),
(10, 19, 'Bill', 'Hicks', 'Employee', 'Barracude', 'm-d-Y', 0, '2016-02-09 01:39:20'),
(11, 20, 'Laura', 'Smith', 'Employee', 'Barracude', 'm-d-Y', 0, '2016-02-09 01:39:50'),
(12, 21, 'John', 'Doe', 'Partner', 'ABC Enterprises', 'd-m-Y', 0, '2016-02-10 08:41:46'),
(13, 22, 'Mary', 'Smith', 'Partner', 'XYZ Corporation', 'm-d-Y', 0, '2016-02-10 08:42:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
