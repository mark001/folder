-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2015 at 02:09 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `folder`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` varchar(42) NOT NULL,
  `branch_name` varchar(20) NOT NULL DEFAULT 'master',
  `folder_id` varchar(42) NOT NULL,
  `user_id` varchar(42) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `folder_id`, `user_id`) VALUES
('cbcccd33ca3d8786c897433806d642e2dd420227', 'master', '04f79d2b8f73cbfcb1d69869ef0227ef0709ccfd', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`file_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `file_lastModified` datetime NOT NULL,
  `commit_message` text NOT NULL,
  `branch_id` varchar(42) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_size`, `file_type`, `file_path`, `file_lastModified`, `commit_message`, `branch_id`) VALUES
(95, 'JAVA 2 Platform, Enterprise Edition.pptx', 910856, 'pptx', 'C:\\xampp\\htdocs\\folder\\upload\\f1b5a91d4d6ad523f2610114591c007e75d15084\\Sample\\master\\J2EE report\\JAVA 2 Platform, Enterprise Edition.pptx', '0000-00-00 00:00:00', '', 'cbcccd33ca3d8786c897433806d642e2dd420227'),
(103, 'java ee.gif', 40702, 'gif', 'C:\\xampp\\htdocs\\folder\\upload\\f1b5a91d4d6ad523f2610114591c007e75d15084\\Sample\\master\\J2EE report\\java ee.gif', '0000-00-00 00:00:00', '', 'cbcccd33ca3d8786c897433806d642e2dd420227'),
(104, 'mainframe.png', 85055, 'png', 'C:\\xampp\\htdocs\\folder\\upload\\f1b5a91d4d6ad523f2610114591c007e75d15084\\Sample\\master\\J2EE report\\mainframe.png', '0000-00-00 00:00:00', '', 'cbcccd33ca3d8786c897433806d642e2dd420227'),
(105, 'thinking.jpg', 4050, 'jpg', 'C:\\xampp\\htdocs\\folder\\upload\\f1b5a91d4d6ad523f2610114591c007e75d15084\\Sample\\master\\J2EE report\\thinking.jpg', '0000-00-00 00:00:00', '', 'cbcccd33ca3d8786c897433806d642e2dd420227'),
(106, 'thinking.png', 44522, 'png', 'C:\\xampp\\htdocs\\folder\\upload\\f1b5a91d4d6ad523f2610114591c007e75d15084\\Sample\\master\\J2EE report\\thinking.png', '0000-00-00 00:00:00', '', 'cbcccd33ca3d8786c897433806d642e2dd420227');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `folder_id` varchar(42) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `folder_access` char(1) NOT NULL,
  `folder_type` varchar(10) NOT NULL,
  `folder_details` text NOT NULL,
  `folder_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `folder_author` varchar(30) NOT NULL,
  `user_id` varchar(42) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`folder_id`, `folder_name`, `folder_access`, `folder_type`, `folder_details`, `folder_update`, `folder_author`, `user_id`) VALUES
('04f79d2b8f73cbfcb1d69869ef0227ef0709ccfd', 'Sample', '0', 'Java', 'This is a sample project', '2015-10-06 10:56:37', '', 'f1b5a91d4d6ad523f2610114591c007e75d15084');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
`report_id` int(11) NOT NULL,
  `report_intensity` char(1) NOT NULL DEFAULT '0',
  `report_details` text NOT NULL,
  `report_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `screenshot` varchar(200) NOT NULL,
  `report_type` char(1) NOT NULL DEFAULT '0',
  `report_status` char(1) NOT NULL DEFAULT '1',
  `user_id` varchar(42) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `report_intensity`, `report_details`, `report_date`, `screenshot`, `report_type`, `report_status`, `user_id`) VALUES
(1, '1', 'ads', '2015-10-01 21:16:19', 'C:/xampp/htdocs/folder/upload/screenshot/folder_list_icon_active.png', '1', '0', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(2, '1', 'This is a sample report feedback', '2015-10-01 21:42:58', 'C:/xampp/htdocs/folder/upload/screenshot/new_folder_icon.png', '1', '0', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(3, '0', 'suggestion sample', '2015-10-01 21:53:43', 'C:/xampp/htdocs/folder/upload/screenshot/folder_list_icon.png', '2', '0', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(4, '1', 'i hate choose files', '2015-10-03 09:37:03', 'C:/xampp/htdocs/folder/upload/screenshot/java_ee.gif', '1', '0', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(5, '1', 'i hate choose files', '2015-10-03 09:37:03', 'C:/xampp/htdocs/folder/upload/screenshot/java_ee1.gif', '1', '0', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(6, '1', 'double feed back', '2015-10-03 09:38:54', 'C:/xampp/htdocs/folder/upload/screenshot/mainframe.png', '1', '1', 'f1b5a91d4d6ad523f2610114591c007e75d15084');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(42) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_type` char(1) NOT NULL DEFAULT '2',
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_type`, `password`, `email`, `user_status`) VALUES
('a20d909766b2388bde4ff027c87602a8d7cc8b7d', 'mark fernandez', '1', 'dd5d67fb3428a2d9981e98680f92be2bc91ca0b6', 'mark@mark', '1'),
('b037a88a9a1a684e9bf7c8cd0327f870250d076a', 'kim agustin', '2', 'd195107d36fc091f83e808eee5088f9196e88ada', 'kim@kim', '1'),
('c8320d048a4e4f4147e9b7ae00d612b46ebe68ca', 'tomas santella', '1', 'b35f188a0c5e6fefc42c99fc2e7bc8e916fcb070', 'tomas@tomas', '1'),
('d269bdab76cda698be2fae6214954373a19133e5', 'antonio sotto', '1', '7c222fb2927d828af22f592134e8932480637c0d', 'antonio@antonio', '1'),
('f1b5a91d4d6ad523f2610114591c007e75d15084', 'mark', '2', 'dd5d67fb3428a2d9981e98680f92be2bc91ca0b6', 'mark@folder', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
 ADD PRIMARY KEY (`branch_id`), ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`file_id`), ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
 ADD PRIMARY KEY (`folder_id`), ADD UNIQUE KEY `folder_name` (`folder_name`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
 ADD PRIMARY KEY (`report_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`folder_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
