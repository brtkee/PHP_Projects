SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO `users` (`User_ID`, `User_Name`) VALUES
(1, 'John'),
(2, 'Alice'),
(3, 'Bob'),
(4, 'Emma'),
(5, 'Michael'),
(6, 'Sophia'),
(7, 'William'),
(8, 'Olivia'),
(9, 'James'),
(10, 'Emily'),
(11, 'Daniel'),
(12, 'Charlotte'),
(13, 'Alexander'),
(14, 'Ava'),
(15, 'Ethan'),
(16, 'Isabella'),
(17, 'David'),
(18, 'Mia'),
(19, 'Matthew'),
(20, 'Grace'),
(21, 'Anna'),
(22, 'Peter'),
(23, 'Sophie'),
(24, 'Robert'),
(25, 'Julia'),
(26, 'Thomas'),
(27, 'Natalie'),
(28, 'Kevin'),
(29, 'Hannah'),
(30, 'Richard'),
(31, 'Emma'),
(32, 'Jacob'),
(33, 'Laura'),
(34, 'Christopher'),
(35, 'Maria'),
(36, 'Joshua'),
(37, 'Sarah'),
(38, 'Andrew'),
(39, 'Jessica'),
(40, 'Daniel');

ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `idx_User_Name` (`User_Name`);

ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;COMMIT;

