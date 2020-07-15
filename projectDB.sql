-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 15, 2020 at 11:08 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `movieProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actorsId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actorsId`, `name`, `gender`) VALUES
(1, 'Morgan Freeman  ', 'male'),
(2, 'Leonardo DiCaprio ', 'male'),
(3, 'Robert De Niro', 'male'),
(4, 'Brad Pitt ', 'male'),
(5, 'Matt Damon ', 'male'),
(6, 'Tom Hanks', 'male'),
(7, 'Christian Bale', 'male'),
(8, 'Al Pacino ', 'male'),
(9, 'Gary Oldman ', 'male'),
(10, 'Edward Norton', 'male'),
(11, 'Scarlett Johansson', 'female'),
(12, 'Margot Robbie', 'female'),
(13, 'Emma Watson', 'female'),
(14, 'Jennifer Lawrence', 'female'),
(15, 'Jennifer Aniston', 'female'),
(16, 'Anne Hathaway', 'female'),
(17, 'Natalie Portman', 'female'),
(18, 'Angelina Jolie', 'female'),
(19, 'Emma Stone', 'female'),
(20, 'Gal Gadot', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categId`, `title`) VALUES
(2, 'action'),
(3, 'comedy'),
(4, 'drama'),
(5, 'fiction');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `actorId` int(11) NOT NULL,
  `categId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieId`, `title`, `poster`, `synopsis`, `year`, `actorId`, `categId`) VALUES
(1, 'Morning here', 'https://i.pinimg.com/originals/7f/55/57/7f5557da276976a501028ba48b24c7f8.jpg', '', 2007, 7, 2),
(2, 'New Film', 'https://www.times-standard.com/wp-content/uploads/2020/02/CallWildPoster.jpg', '', 2019, 10, 5),
(3, 'Jurassic Park', 'https://upload.wikimedia.org/wikipedia/en/e/e7/Jurassic_Park_poster.jpg', '', 1993, 12, 3),
(4, 'The Godfather', 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkE yXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', '', 1972, 20, 4),
(5, 'Snatch', 'https://m.media-amazon.com/images/M/MV5BMTA2NDYxOGYtYjU1Mi00Y2QzLTgxMTQtMWI1MGI0ZGQ5MmU4Xk EyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_UY1200_CR95,0,630,1200_AL_.jpg', '', 2000, 18, 5),
(6, 'GO NEW', 'https://fr.web.img4.acsta.net/medias/nmedia/18/65/13/28/18970771.jpg', '', 2020, 15, 4),
(7, 'Green Book', 'https://blob.cede.ch/catalog/16821000/16821699_1_92.jpg', '', 2018, 6, 2),
(8, 'Batman Begins', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcT-Uvfu- g0DtNDADFmyFOWDKtvl9rpAWVeFH0g_E9jXzMCRRez7', '', 2005, 7, 5),
(9, 'Deadpool', 'https://upload.wikimedia.org/wikipedia/en/2/23/Deadpool_%282016_poster%29.png', '', 2016, 11, 3),
(10, 'Jaws', 'https://encrypted- tbn2.gstatic.com/images?q=tbn:ANd9GcSNafDFWxZ3Mp_EEeYV3XXvqcCwArfq4QI8-s5NZbfD6i_bDLCn', '', 1975, 15, 4),
(11, 'Guard', 'https://www.denofgeek.com/wp-content/uploads/2020/05/the-old-guard.jpg?resize=696%2C432', '', 2020, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlistId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `playlistContent`
--

CREATE TABLE `playlistContent` (
  `playlistId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actorsId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categId`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `actorId` (`actorId`),
  ADD KEY `movies_ibfk_1` (`categId`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlistId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `playlistContent`
--
ALTER TABLE `playlistContent`
  ADD KEY `movieId` (`movieId`),
  ADD KEY `playlistcontent_ibfk_1` (`playlistId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actorsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlistId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`categId`) REFERENCES `category` (`categId`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `playlistContent`
--
ALTER TABLE `playlistContent`
  ADD CONSTRAINT `playlistcontent_ibfk_1` FOREIGN KEY (`playlistId`) REFERENCES `playlist` (`playlistId`);
