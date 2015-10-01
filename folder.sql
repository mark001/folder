-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2015 at 06:00 PM
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
`branch_id` int(11) NOT NULL,
  `branch_name` varchar(20) NOT NULL DEFAULT 'master',
  `folder_id` varchar(42) NOT NULL,
  `user_id` varchar(42) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `folder_id`, `user_id`) VALUES
(1, 'master', 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(2, 'master', 'fceaeba5eca19017fd24328ae1fe9af3af1796b8', 'f1b5a91d4d6ad523f2610114591c007e75d15084');

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
('b6589fc6ab0dc82cf12099d1c2d40ab994e8410c', 'Sample', '1', 'Java', '0', '2015-10-01 22:26:08', '', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
('fceaeba5eca19017fd24328ae1fe9af3af1796b8', 'Second', '1', 'HTML', 'This is the second sample and hopefully with no errors!', '2015-10-01 22:51:24', '', 'f1b5a91d4d6ad523f2610114591c007e75d15084');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `report_intensity`, `report_details`, `report_date`, `screenshot`, `report_type`, `report_status`, `user_id`) VALUES
(1, '1', 'ads', '2015-10-01 21:16:19', 'C:/xampp/htdocs/folder/upload/screenshot/folder_list_icon_active.png', '1', '1', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(2, '1', 'This is a sample report feedback', '2015-10-01 21:42:58', 'C:/xampp/htdocs/folder/upload/screenshot/new_folder_icon.png', '1', '1', 'f1b5a91d4d6ad523f2610114591c007e75d15084'),
(3, '0', 'suggestion sample', '2015-10-01 21:53:43', 'C:/xampp/htdocs/folder/upload/screenshot/folder_list_icon.png', '2', '1', 'f1b5a91d4d6ad523f2610114591c007e75d15084');

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
('ade26a02c04c02163fab32c509c9b858205c30ea', 'Jane Doe', '2', 'e3cd9f6469fc3e1acfb9f2bdbfc5a3d2bbb8e2ad', 'Jane@folder.com', '0'),
('ae6e4d1209f17b460503904fad297b31e9cf6362', 'John Doe', '2', '7c222fb2927d828af22f592134e8932480637c0d', 'john@john', '1'),
('b037a88a9a1a684e9bf7c8cd0327f870250d076a', 'kim agustin', '2', 'd195107d36fc091f83e808eee5088f9196e88ada', 'kim@kim', '1'),
('c8320d048a4e4f4147e9b7ae00d612b46ebe68ca', 'tomas santella', '1', 'b35f188a0c5e6fefc42c99fc2e7bc8e916fcb070', 'tomas@tomas', '1'),
('d269bdab76cda698be2fae6214954373a19133e5', 'antonio sotto', '1', '7c222fb2927d828af22f592134e8932480637c0d', 'antonio@antonio', '1'),
('f1b5a91d4d6ad523f2610114591c007e75d15084', 'mark', '2', '61d6504733ca7757e259c644acd085c4dd471019', 'mark@folder.com', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
 ADD PRIMARY KEY (`branch_id`), ADD KEY `folder_id` (`folder_id`), ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`folder_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `branches_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
