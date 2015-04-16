-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2013 at 07:29 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iportal`
--
CREATE DATABASE IF NOT EXISTS `iportal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iportal`;

-- --------------------------------------------------------

--
-- Table structure for table `coursedetails`
--

CREATE TABLE IF NOT EXISTS `coursedetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` varchar(3) DEFAULT NULL,
  `materialid` int(1) NOT NULL,
  `materialno` int(3) NOT NULL,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courselist`
--

CREATE TABLE IF NOT EXISTS `courselist` (
  `courseid` int(5) NOT NULL AUTO_INCREMENT,
  `coursetype` varchar(3) DEFAULT NULL,
  `coursenumber` int(3) NOT NULL,
  `coursename` varchar(60) NOT NULL,
  `courseintro` varchar(500) NOT NULL,
  `facultyid` int(4) NOT NULL,
  PRIMARY KEY (`courseid`),
  KEY `facultyid` (`facultyid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `courselist`
--

INSERT INTO `courselist` (`courseid`, `coursetype`, `coursenumber`, `coursename`, `courseintro`, `facultyid`) VALUES
(1, 'CSL', 740, 'Software Engineering', 'Concepts and techniques relevant to production of large software\r\nsystems: Structured programming.Separate compilation, configuration management, program libraries. Design\r\npatterns; UML. Documentation. Validation. Quality assurance, safety.Testing and test case generation. Organization and management of large software design projects.', 10),
(2, 'CSL', 356, 'Analysis and Design of Algorithms', 'RAM model and complexity: O(log n) bit model, Integer sorting and\r\nstring sorting, Review of fundamental data structures: Red-black trees,mergeable heaps, interval trees Fundamental design methodologies and their implementations: Search Techniques, Dynamic Programming,Greedy algorithms, Divide and Conquer, Randomized Techniques.', 5),
(3, 'CSL', 374, 'Computer Networks', 'Fundamentals of Digital Communications, including channel capacity,\r\nerror rates, multiplexing, framing and synchronization. Broadcast network and multi-access protocols, including CSMA/CD. Data link protocols, Network protocols including routing and congestion control,IP protocol. ', 11),
(4, 'CSD', 310, 'Mini Project', 'Design/fabrication/implementation work under the guidance of a faculty member. Prior to registration, a detailed plan of work should be submitted by the student to the Head of the Department for approval.', 12),
(5, 'EEL', 101, 'Introduction to Electrical Engineering', 'DC circuits, KCL, KVL, Network theorems, Mesh and nodal analysis,Step response and transients. RC, RL and RLC circuits, Phasor diagram solution of AC circuits. Power in 1- and 3-phase AC circuits. Two port networks.', 6),
(6, 'EEL', 201, 'Digital Electronics', 'Review of Boolean Algebra, Karnaugh Map and Logic Gates;Designing combinational Circuits using gates and/or Multiplexers; Introduction to logic families: TTL, ECL, CMOS; PLAs and FPGAs.', 6),
(7, 'EEL', 205, 'Signals and Systems', 'Review of Boolean Algebra, Karnaugh Map and Logic Gates;Designing combinational Circuits using gates and/or Multiplexers; Introduction\r\nto logic families: TTL, ECL, CMOS; PLAs and FPGAs;', 6),
(8, 'MEL', 110, 'Engineering Drawing', 'Orthographic, Axonometric, Isometric, Oblique, Perspective projections.\r\nLettering, instruments and line work, free hand sketching, plane\r\ngeometric constructions, auxiliary planes. Intersection and development of surfaces, planes and solids with their spatial relationships.', 7),
(9, 'MEL', 120, 'Manufacturing Practice', 'The objective of the course is to expose students to basics of manufacturing as it plays a direct role in improvement of quality of human life and creating wealth for the nation. The second objective of\r\nthe course is to expose students to hands-on practice with common manufacturing processes', 7),
(10, 'MEL', 140, 'Engineering Thermodynamics', 'Introduction to applications. Basic concepts and definitions – system, boundary, equilibrium, steady state and others. Thermodynamic properties of a pure substance – saturated and other states. Work and heat – definition and applications.', 7),
(11, 'CSS', 310, 'Independent Study', 'Research oriented activities or study of subjects outside regular course offerings under the guidance of a faculty member. Prior to registration, a detailed plan of work should be submitted by the student to the Head of the Department for approval.', 11);

-- --------------------------------------------------------

--
-- Table structure for table `dep`
--

CREATE TABLE IF NOT EXISTS `dep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dep`
--

INSERT INTO `dep` (`id`, `department`) VALUES
(1, 'Computer Science and Engineering'),
(2, 'Electrical Engineering'),
(3, 'Mechanical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subject` varchar(40) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `seen` int(1) DEFAULT NULL,
  `timestamp1` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `rid`, `sid`, `subject`, `content`, `seen`, `timestamp1`) VALUES
(1, 8, 13, '', 'Hi', 0, '2013-11-29 08:39:00'),
(4, 10, 13, 'Class Today ?', 'Sir,\r\nDo we have a class today ?\r\n\r\nYours Sincerely\r\nRam Agrawal\r\n\r\n', 0, '2013-11-30 05:02:15'),
(6, 4, 10, 'Class Today', 'Yes we have a class today from 6:15:7:30', 0, '2013-11-30 05:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `courseid` int(5) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `courseid`, `notification`, `timestamp`) VALUES
(1, 1, 'Minor 1 marks uploaded', '2013-11-19 13:24:49'),
(2, 1, 'Lectures 11 and 12 uploaded', '2013-11-19 13:24:49'),
(3, 1, 'Demo of Assignment 2 on 12/11/2013', '2013-11-19 13:24:49'),
(7, 3, 'Assignment 4 uploaded', '2013-11-19 13:24:49'),
(8, 3, 'No class today', '2013-11-19 13:24:49'),
(9, 3, 'Re minors on 28/11/13', '2013-11-19 13:24:49'),
(10, 4, 'Research paper on Speech Recognition uploaded', '2013-11-19 13:24:49'),
(11, 5, 'Class on Saturday', '2013-11-19 13:24:49'),
(12, 6, 'Extra Tutorials on Sunday', '2013-11-19 13:24:49'),
(13, 7, 'Minor 1 marks uploaded', '2013-11-19 13:24:49'),
(14, 8, 'Lab sheet number 8 uploaded', '2013-11-19 13:24:49'),
(15, 9, 'No labs this week', '2013-11-19 13:24:49'),
(16, 10, 'Minor 1 solutions uploaded', '2013-11-19 13:24:49'),
(48, 2, 'Assignment 3 uploaded', '2013-11-19 18:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `usercourse`
--

CREATE TABLE IF NOT EXISTS `usercourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `courseid` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courseid` (`courseid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `usercourse`
--

INSERT INTO `usercourse` (`id`, `userid`, `courseid`) VALUES
(1, 3, 9),
(2, 3, 10),
(3, 2, 1),
(4, 2, 6),
(5, 2, 10),
(6, 3, 2),
(7, 3, 5),
(8, 3, 8),
(9, 4, 6),
(10, 4, 10),
(11, 4, 8),
(12, 4, 7),
(13, 4, 3),
(14, 4, 4),
(15, 4, 1),
(16, 4, 2),
(17, 8, 5),
(18, 8, 6),
(19, 8, 7),
(20, 8, 3),
(21, 8, 8),
(22, 9, 8),
(23, 9, 9),
(24, 9, 10),
(25, 9, 3),
(26, 9, 5),
(27, 11, 11),
(28, 11, 3),
(29, 12, 4),
(30, 10, 1),
(31, 5, 2),
(32, 6, 5),
(33, 6, 6),
(34, 6, 7),
(35, 7, 8),
(36, 7, 9),
(37, 7, 10),
(96, 13, 2),
(98, 13, 3),
(99, 5, 3),
(100, 13, 9),
(101, 13, 4),
(102, 13, 10),
(103, 13, 6),
(106, 13, 1),
(107, 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE IF NOT EXISTS `userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(1) NOT NULL,
  `name` varchar(60) NOT NULL,
  `departmentid` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departmentid` (`departmentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `username`, `password`, `type`, `name`, `departmentid`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Administrator', 1),
(2, 'cs1110251', '146d9fce875b75ab3da1fc325c7a18c4', 3, 'Sahil Agrawal', 1),
(3, 'cs1110201', 'a70a464a3f58e45d52e167f1a5534712', 3, 'Abdul Khalid', 1),
(4, 'cs1110246', 'ef6c4c5a057a2981fba79fa95e352f73', 3, 'Ram Agrawal', 1),
(5, 'ssen', '256e08816e850722d983eeffbc8166de', 2, 'Sandeep Sen', 1),
(6, 'adhawan', '30c9bea93d2cdcda9a4350304b5f1294', 2, 'Anuj Dhawan', 2),
(7, 'harish', '698c9634246010398e8c427bdd12d374', 2, 'Harish Hirani', 3),
(8, 'ee1110447', 'ce88d5dd414d5de81c56ab7db6ef1601', 3, 'Ayush Gupta', 2),
(9, 'me1110258', '9d44205d05a4d377f328f89bf4013b5c', 3, 'Shiva Dhawan', 3),
(10, 'scgupta', '50a56dc2db84301a763fe74cd2fa4754', 2, 'S.C. Gupta', 1),
(11, 'saran', '2208639860dda3f5c6bf627bbe3657c7', 2, 'Huzur Saran', 1),
(12, 'kkb', 'b7ce7616ad0078889c45d6771679bb28', 2, 'K.K. Biswas', 1),
(13, 'ram', 'e2fc714c4727ee9395f324cd2e7f331f', 3, 'Ram Agrawal', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courselist`
--
ALTER TABLE `courselist`
  ADD CONSTRAINT `courselist_ibfk_1` FOREIGN KEY (`facultyid`) REFERENCES `userlist` (`id`);

--
-- Constraints for table `usercourse`
--
ALTER TABLE `usercourse`
  ADD CONSTRAINT `usercourse_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courselist` (`courseid`),
  ADD CONSTRAINT `usercourse_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `userlist` (`id`);

--
-- Constraints for table `userlist`
--
ALTER TABLE `userlist`
  ADD CONSTRAINT `userlist_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `dep` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
