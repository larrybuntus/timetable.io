-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2017 at 05:42 PM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.4-7ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `deleted_messages`
--

CREATE TABLE `deleted_messages` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text,
  `user_id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `year` int(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `theme-color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metadata`
--

INSERT INTO `metadata` (`id`, `author`, `title`, `url`, `keywords`, `description`, `email`, `number`, `theme-color`) VALUES
(1, 'Lawrence Kweku Adu', 'timetable.io', 'http://localhost/timetable', 'timetable', 'a simple time table', 'lawrence.adu@hackprogh.com', '0501384208', '#222');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `name`) VALUES
(1, 'Akan'),
(2, 'Communication Design	'),
(3, 'Culture and Tourism'),
(4, 'Economics'),
(5, 'English'),
(6, 'French'),
(7, 'Geography and Rural Development'),
(8, 'History '),
(9, 'Industrial Art'),
(10, 'Integrated Rural Art and Industry'),
(11, 'Painting and Sculpture'),
(12, 'Political Studies'),
(13, 'Publishing Studies'),
(14, 'Religious Studies'),
(15, 'Sociology'),
(16, 'Social Work '),
(17, 'Actuarial Science'),
(18, 'Actuarial Science'),
(19, 'Agribusiness Management'),
(20, 'Agricultural Engineering'),
(21, 'Agricultural Biotechnology'),
(22, 'Agriculture'),
(23, 'Aquaculture and Water Resources Management'),
(24, 'Architecture'),
(25, 'Dental Surgery'),
(26, 'Biochemistry'),
(27, 'Biological Science'),
(28, 'Biomedical Engineering'),
(29, 'Business Administration'),
(30, 'Veterinary Medicine'),
(31, 'Chemical Engineering'),
(32, 'Chemistry'),
(33, 'Civil Engineering'),
(34, 'Computer Engineering'),
(35, 'Computer Science'),
(36, 'Construction Technology and Management'),
(37, 'Dairy and Meat Science and Technology'),
(38, 'Development Planning'),
(39, 'Disability and Rehabilitation Studies '),
(40, 'Electrical/Electronic Engineering'),
(41, 'Environmental Sciences'),
(42, 'Food Science and Technology'),
(43, 'Forest Resources Technology'),
(44, 'Geological Engineering'),
(45, 'Geomatic Engineering'),
(46, 'Herbal Medicine'),
(47, 'Human Biology'),
(48, 'Human Settlement Planning'),
(49, 'Land Economy'),
(50, 'Landscape Design and Management '),
(51, 'Materials Engineering'),
(52, 'Mathematics'),
(53, 'Mechanical Engineering'),
(54, 'Medical Laboratory Technology'),
(55, 'Metallurgical Engineering'),
(56, 'Meteorology and Climate Science'),
(57, 'Midwifery'),
(58, 'Natural Resources Management'),
(59, 'Nursing'),
(60, 'Petrochemical Engineering'),
(61, 'Petroleum Engineering'),
(62, 'Physics'),
(63, 'Post Harvest Technology'),
(64, 'Quantity Surveying and Construction Economics'),
(65, 'Real Estate'),
(66, 'Sonography'),
(67, 'Sports and Exercise Science'),
(68, 'Statistics'),
(69, 'Telecommunication Engineering'),
(70, 'Doctor of Optometry'),
(71, 'LLB'),
(72, 'Pharm D');

-- --------------------------------------------------------

--
-- Table structure for table `repositories`
--

CREATE TABLE `repositories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `year` int(1) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `programme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `venue` varchar(255) NOT NULL,
  `lecturer` varchar(255) DEFAULT 'myself',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `day`, `course`, `start_time`, `end_time`, `venue`, `lecturer`, `user_id`) VALUES
(1, 'mon', 'Computer Networks', '08:00:00', '11:00:00', 'FF24', 'Castro', 1),
(2, 'mon', 'Information Systems', '11:30:00', '13:30:00', 'FF24', 'Pabbi', 1),
(3, 'tue', 'Computer Security', '08:00:00', '10:00:00', 'FF24', 'Asante', 1),
(4, 'tue', 'Information Systems', '10:30:00', '11:30:00', 'FF24', 'Pabbi', 1),
(5, 'wed', 'Principles of Management', '08:00:00', '10:00:00', 'SF19', 'Poku', 1),
(6, 'wed', 'Introduction to Compilers', '10:30:00', '12:30:00', 'FF24', 'Panford', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT 'icon.jpg',
  `password` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `img`, `password`, `year`) VALUES
(1, 'Larry Buntus One', 'larrybuntus@gmail.com', 'icon.jpg', '$2y$09$jY0GXSyH9UhcWYKQCAHbLejfxRD/y3TjR4w.7KFLsqNXR4lXKjvT2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_programmes`
--

CREATE TABLE `users_programmes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_programmes`
--

INSERT INTO `users_programmes` (`id`, `user_id`, `programme_id`, `dateCreated`) VALUES
(1, 1, 35, '2017-02-11 12:44:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `programme_id` (`programme_id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repositories`
--
ALTER TABLE `repositories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programme_id` (`programme_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_programmes`
--
ALTER TABLE `users_programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `programme_id` (`programme_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `repositories`
--
ALTER TABLE `repositories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_programmes`
--
ALTER TABLE `users_programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deleted_messages`
--
ALTER TABLE `deleted_messages`
  ADD CONSTRAINT `deleted_messages_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deleted_messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repositories`
--
ALTER TABLE `repositories`
  ADD CONSTRAINT `repositories_ibfk_1` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_programmes`
--
ALTER TABLE `users_programmes`
  ADD CONSTRAINT `users_programmes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_programmes_ibfk_2` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
