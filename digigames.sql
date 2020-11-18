-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 07:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digigames`
--

-- --------------------------------------------------------

--
-- Table structure for table `creditcards`
--

CREATE TABLE `creditcards` (
  `cardID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `cardNumber` varchar(12) NOT NULL,
  `expirationMonth` int(11) NOT NULL,
  `expirationYear` int(11) NOT NULL,
  `securityCode` varchar(3) NOT NULL,
  `nameOnCard` varchar(32) NOT NULL,
  `billingAddress` varchar(128) NOT NULL,
  `billingCity` varchar(128) NOT NULL,
  `billingState` varchar(64) NOT NULL,
  `billingZipCode` varchar(16) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `gamekeys`
--

CREATE TABLE `gamekeys` (
  `accountID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gamelibrary`
--

CREATE TABLE `gamelibrary` (
  `gameID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `genre` varchar(64) NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `releaseDate` date NOT NULL,
  `console` varchar(64) NOT NULL,
  `averageRating` float NOT NULL DEFAULT 5,
  `ratingCount` int(11) NOT NULL DEFAULT 0,
  `normalPrice` float NOT NULL DEFAULT 0,
  `proPrice` float NOT NULL DEFAULT 0,
  `purchaseCount` int(11) NOT NULL DEFAULT 0,
  `imageLink` varchar(256) DEFAULT NULL,
  `screenshotLink` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gamelibrary`
--

INSERT INTO `gamelibrary` (`gameID`, `title`, `genre`, `description`, `releaseDate`, `console`, `averageRating`, `ratingCount`, `normalPrice`, `proPrice`, `purchaseCount`, `imageLink`, `screenshotLink`) VALUES
(2, 'Jet Set Radio', 'Sports', 'Tag, grind, and trick to the beat in SEGA’s hit game Jet Set Radio!', '2000-06-29', 'PC', 5, 0, 7.99, 4.99, 0, 'https://static.wikia.nocookie.net/jetsetradio/images/b/b7/Images.jpg/revision/latest/scale-to-width-down/340?cb=20100730095249', 'https://ip.trueachievements.com/remote/download.xbox.com/content/images/66acd000-77fe-1000-9115-d80258411247/1033/screenlg1.jpg?width=900'),
(3, 'Tekken 7', 'Fighting', 'Discover the epic conclusion of the long-time clan warfare between members of the Mishima family. Powered by Unreal Engine 4, the legendary fighting game franchise fights back with stunning story-driven cinematic battles and intense duels that can be enjoyed with friends and rivals.', '2017-06-01', 'PC', 5, 0, 39.99, 19.99, 0, 'https://www.mobygames.com/images/covers/l/434975-tekken-7-playstation-4-front-cover.jpg', 'https://cdn3.dualshockers.com/wp-content/uploads/2015/04/Tekken7-5.jpg'),
(4, 'DRAGON BALL FighterZ', 'Fighting', 'DRAGON BALL FighterZ is born from what makes the DRAGON BALL series so loved and famous: endless spectacular fights with its all-powerful fighters.', '2018-01-26', 'PC', 5, 0, 59.99, 29.99, 0, 'https://upload.wikimedia.org/wikipedia/en/a/ad/DBFZ_cover_art.jpg', 'https://www.newgamenetwork.com/images/uploads/gallery/DragonBallFighterZ/fighterz_11.jpg'),
(5, 'Them\'s Fightin\' Herds', 'Fighting', 'Them’s Fightin’ Herds is an indie fighting game featuring a cast of adorable animals designed by acclaimed cartoon producer Lauren Faust. Beneath the cute and cuddly surface, a serious fighter awaits!', '2020-04-30', 'PC', 5, 0, 14.99, 9.99, 0, 'https://upload.wikimedia.org/wikipedia/en/f/f9/TFH_box_art_vertical.jpg', 'https://steamuserimages-a.akamaihd.net/ugc/932687096466519151/9DC7A031AF1F32E39159EF9ECF388AD42FED95D8/'),
(6, 'UNDER NIGHT IN-BIRTH Exe:Late[cl-r]', 'Fighting', 'Pick one of 20 unique characters and fight your way through the dangers of the “Hollow Night”, and claim your victory over those who would get in your way. Experience intuitive and tight 2D fighter controls, with a splash of devastating combos and unique fighting styles to keep your appetite for battle sated!', '2018-08-20', 'PC', 5, 0, 24.99, 14.99, 0, 'https://s3.gaming-cdn.com/images/products/4985/orig/under-night-in-birth-exelatest-cover.jpg', 'https://codingcurious.com/wp-content/uploads/2020/03/1583703731_728_Under-Night-In-Birth-ExeLatecl-r-Review-Switch.jpg'),
(7, 'Fall Guys: Ultimate Knockout', 'Battle Royale', 'Fall Guys is a massively multiplayer party game with up to 60 players online in a free-for-all struggle through round after round of escalating chaos until one victor remains!', '2020-08-04', 'PC', 5, 0, 19.99, 14.99, 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP0SekyX4CkyTxl4AqnVI4IC_4xPXxgKc5sA&usqp=CAU', 'https://cdn.gamer-network.net/2020/articles/2020-08-24-13-53/fall-guys-is-getting-a-mobile-version-in-china-1598273582218.jpg/EG11/thumbnail/1920x1074/format/jpg/quality/80'),
(8, 'Street Fighter V', 'Fighting', 'Experience the intensity of head-to-head battles with Street Fighter® V! Choose from 16 iconic characters, then battle against friends online or offline with a robust variety of match options.', '2016-02-15', 'PC', 5, 0, 19.99, 9.99, 0, 'https://upload.wikimedia.org/wikipedia/en/8/80/Street_Fighter_V_box_artwork.png', 'https://www.mobygames.com/images/shots/l/855921-street-fighter-v-playstation-4-screenshot-ryu-s-all-new-3.jpg'),
(9, 'Soulcalibur VI', 'Fighting', 'Bring more than your fists to the fight! Featuring all-new battle mechanics and characters, SOULCALIBUR VI marks a new era of the historic franchise. Welcome back to the stage of history!', '2018-10-18', 'PC', 5, 0, 59.99, 39.99, 0, 'https://upload.wikimedia.org/wikipedia/en/8/84/Soulcalibur_VI_cover_art.jpg', 'https://lh3.googleusercontent.com/proxy/ImRCMyJ9kpdaRn6goUVpb_VIXYc_hDjNho3bcc8KUQl6ftAS6HWASoBjPPIX-7t5yc7Y85IZdr0icCYCIIt5sMyWEas7x8c_PwKInpM6jvYMzRhrXuFE2skemZhpXxbP'),
(10, 'Mortal Kombat 11', 'Fighting', 'Mortal Kombat is back and better than ever in the next evolution of the iconic franchise.', '2019-04-23', 'PC', 5, 0, 49.99, 29.99, 0, 'https://upload.wikimedia.org/wikipedia/en/7/7e/Mortal_Kombat_11_cover_art.png', 'https://i.ytimg.com/vi/yrv9DI95Z3w/maxresdefault.jpg'),
(11, 'Dead by Daylight', 'Survival Horror', 'Dead by Daylight is a multiplayer (4vs1) horror game where one player takes on the role of the savage Killer, and the other four players play as Survivors, trying to escape the Killer and avoid being caught and killed.', '2016-06-14', 'PC', 5, 0, 19.99, 7.99, 0, 'https://i.pinimg.com/originals/50/40/5f/50405f32d1d605420dd16c322e4838d0.jpg', 'https://www.xboxone-hq.com/images/games/screenshots/1384-dead-by-daylight-screenshot-1496373184.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `accountID` int(11) NOT NULL,
  `genre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `accountID` int(11) NOT NULL,
  `notificationMessage` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `accountID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT 5,
  `ratingDescription` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`accountID`, `gameID`, `rating`, `ratingDescription`) VALUES
(1, 2, 5, 'This game is pretty good.'),
(2, 2, 3, 'The game has audio issues every now and then, and the developers haven\'t done enough to fix it. It could be the perfect port if thee small issues are fixed.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `paymentType` int(11) DEFAULT NULL,
  `paypalAddress` varchar(128) DEFAULT NULL,
  `creditCardID` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `accountID` int(11) NOT NULL,
  `userName` varchar(32) NOT NULL,
  `hashedPassword` varchar(64) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `emailAddress` varchar(64) NOT NULL,
  `securityQuestionA` int(11) NOT NULL DEFAULT 0,
  `securityResponseA` varchar(128) NOT NULL,
  `securityQuestionB` int(11) NOT NULL DEFAULT 0,
  `securityResponseB` varchar(128) NOT NULL,
  `paypalAddress` varchar(128) DEFAULT NULL,
  `membershipStatus` int(11) NOT NULL DEFAULT 0,
  `avatarType` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`accountID`, `userName`, `hashedPassword`, `dateOfBirth`, `emailAddress`, `securityQuestionA`, `securityResponseA`, `securityQuestionB`, `securityResponseB`, `paypalAddress`, `membershipStatus`, `avatarType`) VALUES
(1, 'testuser', 'password123', '1998-03-10', 'testuser@gmail.com', 0, 'Lucky', 0, 'Charles Darwin Middle School', 'testuser@gmail.com', 0, 0),
(2, 'testProUser', 'password123', '1998-03-10', 'testuser2@gmail.com', 0, 'Lucky', 0, 'Charles Darwin Middle School', 'testuser2@gmail.com', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD PRIMARY KEY (`cardID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `gamekeys`
--
ALTER TABLE `gamekeys`
  ADD KEY `accountID` (`accountID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `gamelibrary`
--
ALTER TABLE `gamelibrary`
  ADD PRIMARY KEY (`gameID`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD KEY `accountID` (`accountID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `creditCardID` (`creditCardID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`accountID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditcards`
--
ALTER TABLE `creditcards`
  MODIFY `cardID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamelibrary`
--
ALTER TABLE `gamelibrary`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD CONSTRAINT `creditcards_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`);

--
-- Constraints for table `gamekeys`
--
ALTER TABLE `gamekeys`
  ADD CONSTRAINT `gamekeys_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`),
  ADD CONSTRAINT `gamekeys_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `gamelibrary` (`gameID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `gamelibrary` (`gameID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `useraccounts` (`accountID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`creditCardID`) REFERENCES `creditcards` (`cardID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
