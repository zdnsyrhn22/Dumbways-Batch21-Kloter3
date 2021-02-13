-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 02:12 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_berita`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `created_at`, `id_user`, `id_category`) VALUES
(1, 'Lelang mobil sport', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum aliquid excepturi dolores saepe natus, perferendis esse, velit officia molestiae ea accusantium rerum, harum commodi aliquam porro quo temporibus magnam minima.', 'ferari.jpg', '2021-02-04 11:30:02', 1, 1),
(3, 'Al-Khawarizmi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum aliquid excepturi dolores saepe natus, perferendis esse, velit officia molestiae ea accusantium rerum, harum commodi aliquam porro quo temporibus magnam minima.', 'alkha.jpg', '2021-02-04 11:30:02', 3, 3),
(7, 'AC Milan mendatangkan Mandzukic', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea error voluptates vitae debitis commodi repellendus, quasi quidem esse cum perspiciatis ullam, soluta ut. Nulla, iure delectus eveniet praesentium facilis officiis.', 'milan.jpg', '2021-02-13 10:58:20', 1, 1),
(9, 'Nasa Kembali mengadakan ekspedisi mars', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores sit eius quidem amet soluta optio, saepe culpa placeat magni natus hic magnam sequi voluptas est nemo sapiente atque molestias debitis?', 'Vector 4.png', '2021-02-13 11:48:43', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `autho`
--

CREATE TABLE `autho` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `autho`
--

INSERT INTO `autho` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'zaidan', 'zdnsyrhn@gmail.com', 'admin123', 'default.png'),
(2, 'admin', 'admin@gmail.com', 'admin123', 'default.png'),
(3, 'user', 'user123@gmail.com', 'user123', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'sport'),
(2, 'tech'),
(3, 'sejarah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`id_user`),
  ADD KEY `fk_category` (`id_category`);

--
-- Indexes for table `autho`
--
ALTER TABLE `autho`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `autho`
--
ALTER TABLE `autho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `autho` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
