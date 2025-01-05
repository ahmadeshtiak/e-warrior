-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 09:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-gaming`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `username`, `password`) VALUES
(1, 'My name is Admin', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `title`, `description`, `genre`, `price`, `rating`) VALUES
(1, 'T it In', 'sdf', 'aksjfjjjkjkjafkjafjlkjalfkkj', 2300.00, 10.0),
(2, 'Mystic Adventure', 'An epic adventure in a mystical world.', 'Adventure', 29.99, 8.5),
(3, 'Space Defender', 'Defend your base against alien invaders.', 'Action', 19.99, 9.0),
(4, 'Puzzle Master', 'Solve challenging puzzles to progress.', 'Puzzle', 14.99, 8.2),
(5, 'Racing Thrill', 'High-speed racing with realistic graphics.', 'Racing', 39.99, 8.8),
(6, 'Fantasy Quest', 'Embark on a quest to save the fantasy kingdom.', 'RPG', 49.99, 9.1),
(7, 'Zombie Survival', 'Survive waves of zombies in a post-apocalyptic world.', 'Horror', 24.99, 7.5),
(8, 'Galaxy Explorer', 'Explore the galaxies and colonize new planets.', 'Strategy', 34.99, 8.7),
(9, 'Sports Mania', 'Compete in various sports tournaments.', 'Sports', 19.99, 7.9),
(10, 'Cyber Heist', 'A futuristic cyberpunk heist game.', 'Action', 44.99, 9.3),
(11, 'Magic Duel', 'Compete against wizards in intense magic battles.', 'Fantasy', 27.99, 8.6),
(12, 'Shadow Warrior', 'Become a skilled ninja and fight evil forces.', 'Action', 34.99, 8.4),
(13, 'Ocean Explorer', 'Dive deep into the ocean and uncover secrets.', 'Adventure', 22.99, 8.1),
(14, 'Castle Siege', 'Defend your castle or conquer new territories.', 'Strategy', 29.99, 8.9),
(15, 'Pixel Paradise', 'A retro-style sandbox game with limitless creativity.', 'Simulation', 14.99, 7.8),
(16, 'Alien Invasion', 'Battle aliens to save Earth from destruction.', 'Shooter', 24.99, 8.6),
(17, 'Dragon Slayer', 'Hunt down dragons in a medieval fantasy world.', 'RPG', 39.99, 9.2),
(18, 'Cooking Frenzy', 'Master the art of cooking in this fun simulation.', 'Casual', 12.99, 7.7),
(19, 'City Builder', 'Design and manage your dream city.', 'Simulation', 19.99, 8.5),
(20, 'Horror Nights', 'Survive the horrors lurking in the shadows.', 'Horror', 26.99, 8.0),
(21, 'Future Racer', 'Race through futuristic cities at lightning speed.', 'Racing', 44.99, 9.0),
(22, 'Battle Arena', 'Compete in epic battles in an online arena.', 'Multiplayer', 34.99, 8.8),
(23, 'Jungle Escape', 'Navigate through the jungle and evade traps.', 'Adventure', 17.99, 8.2),
(24, 'Space Traders', 'Trade goods across the galaxy and build an empire.', 'Strategy', 31.99, 8.7),
(25, 'Monster Arena', 'Train and battle monsters to become the champion.', 'Fantasy', 29.99, 8.3),
(26, 'Virtual Tycoon', 'Build your business empire in a virtual world.', 'Simulation', 24.99, 8.4),
(27, 'Ghost Hunter', 'Track down and capture ghosts in haunted locations.', 'Horror', 18.99, 7.9),
(28, 'Epic Chess', 'Play an advanced version of chess with power-ups.', 'Puzzle', 12.99, 7.6),
(29, 'Stealth Ops', 'Complete high-stakes missions using stealth tactics.', 'Action', 38.99, 9.1),
(30, 'Wild West Saga', 'Explore the Wild West as a gunslinger or rancher.', 'Adventure', 21.99, 8.3),
(31, 'Underwater Kingdom', 'Build and explore your own underwater city.', 'Simulation', 33.99, 8.9),
(33, 'asdfasf', 'safsfasf', 'aksjfjjjkjkjafkjafjlkjalfkkj', 1223.00, 10.0);

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(100) NOT NULL,
  `player_name` varchar(100) NOT NULL,
  `score` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `player_name`, `score`) VALUES
(1, 'Test1', 100),
(2, 'Test2', 200);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rating_id` int(100) NOT NULL,
  `game_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `comment` text DEFAULT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `review_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rating_id`, `game_id`, `user_id`, `comment`, `rating`, `review_date`) VALUES
(1, 'G001', 'U123', 'Great game! Had a lot of fun.', 5, '2024-01-01'),
(2, 'G002', 'U456', 'Graphics were amazing, but gameplay was slow.', 3, '2024-01-02'),
(3, 'G001', 'U789', 'An excellent sequel to the original.', 4, '2024-01-03'),
(4, 'G001', 'U101', 'The storyline is captivating and well-executed.', 5, '2024-01-04'),
(5, 'G001', 'U102', 'Multiplayer mode is laggy but still enjoyable.', 4, '2024-01-05'),
(6, 'G001', 'U103', 'Not as good as the previous version.', 3, '2024-01-06'),
(7, 'G002', 'U201', 'The graphics are stunning, but the gameplay is repetitive.', 3, '2024-01-07'),
(8, 'G002', 'U202', 'A solid game, but it could use more levels.', 4, '2024-01-08'),
(9, 'G002', 'U203', 'Excellent soundtrack and visuals.', 5, '2024-01-09'),
(10, 'G003', 'U301', 'A unique concept but poorly executed.', 2, '2024-01-10'),
(11, 'G003', 'U302', 'Very creative and fun to play with friends.', 4, '2024-01-11'),
(12, 'G003', 'U303', 'Too many bugs ruin the experience.', 1, '2024-01-12'),
(13, 'G004', 'U401', 'An underrated gem with great replay value.', 5, '2024-01-13'),
(14, 'G004', 'U402', 'The controls are clunky, but the story is worth it.', 3, '2024-01-14'),
(15, 'G004', 'U403', 'A mediocre game with a forgettable storyline.', 2, '2024-01-15'),
(16, 'G001', 'U101', 'The storyline is captivating and well-executed.', 5, '2024-01-04'),
(17, 'G001', 'U102', 'Multiplayer mode is laggy but still enjoyable.', 4, '2024-01-05'),
(18, 'G001', 'U103', 'Not as good as the previous version.', 3, '2024-01-06'),
(19, 'G002', 'U201', 'The graphics are stunning, but the gameplay is repetitive.', 3, '2024-01-07'),
(20, 'G002', 'U202', 'A solid game, but it could use more levels.', 4, '2024-01-08'),
(21, 'G002', 'U203', 'Excellent soundtrack and visuals.', 5, '2024-01-09'),
(22, 'G003', 'U301', 'A unique concept but poorly executed.', 2, '2024-01-10'),
(23, 'G003', 'U302', 'Very creative and fun to play with friends.', 4, '2024-01-11'),
(24, 'G003', 'U303', 'Too many bugs ruin the experience.', 1, '2024-01-12'),
(25, 'G004', 'U401', 'An underrated gem with great replay value.', 5, '2024-01-13'),
(26, 'G004', 'U402', 'The controls are clunky, but the story is worth it.', 3, '2024-01-14'),
(27, 'G111', 'U000', 'jaslfjlaksjflksJ', 5, '2026-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `balance` int(100) NOT NULL,
  `points` int(100) NOT NULL,
  `xp` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `balance`, `points`, `xp`) VALUES
(5, 'fsdfs', 'dfg@gsd.com', 'sdfas', 0, 0, 0),
(10, 'eab', 'dfg@gsd.com', '123', 0, 0, 0),
(11, 'abc', 'dfg@gsd.com', '123', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_library`
--

CREATE TABLE `user_library` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_library`
--

INSERT INTO `user_library` (`game_id`, `user_id`) VALUES
(4, 10),
(5, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_library`
--
ALTER TABLE `user_library`
  ADD PRIMARY KEY (`game_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rating_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_library`
--
ALTER TABLE `user_library`
  ADD CONSTRAINT `user_library_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`),
  ADD CONSTRAINT `user_library_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
