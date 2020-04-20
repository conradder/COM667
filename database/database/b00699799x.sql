-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2020 at 11:37 AM
-- Server version: 5.6.11-log
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b00699799x`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventdets`
--

CREATE TABLE `eventdets` (
  `eventID` int(11) NOT NULL,
  `evDate` date DEFAULT NULL,
  `evTime` time DEFAULT NULL,
  `evLoc` varchar(30) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `createdBy` int(6) DEFAULT NULL,
  `cancelled` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventdets`
--

INSERT INTO `eventdets` (`eventID`, `evDate`, `evTime`, `evLoc`, `notes`, `createdBy`, `cancelled`) VALUES
(1, '2020-02-01', '19:30:00', '50ca5592e4b0cc5bad7c6449', 'This is a test', 1, NULL),
(2, '2020-05-31', '22:00:00', '4c9d89017ada199cf0a493bc', 'another wee test, hopefully this time it works', 2, 0),
(9, '2020-05-01', '18:30:00', '4f85d1a6e4b08d4038372c98', 'Howdy, this is some text that will go into the event as an exmaple of some notes a user may put in!', 1, NULL),
(10, '2020-05-04', '20:00:00', '4b4506d3f964a5209b0126e3', 'Ba maith liom beoir agus comhrá', 2, NULL),
(11, '2020-05-28', '19:30:00', '52988e8511d22448bd236206', 'waka waka', 5, 0),
(12, '2020-03-30', '21:00:00', '50ca5592e4b0cc5bad7c6449', 'hello a simple test áé', 1, NULL),
(13, '2020-04-15', '23:00:00', '4e91caed7ee60278a65886ad', '', 1, NULL),
(14, '2020-07-12', '18:30:00', '5dd96ecbd5c4a50007a8de21', 'fáilte roimh chách', 1, NULL),
(15, '2020-04-28', '22:30:00', '545b434b498e9a85bdb35967', 'wee test', 1, 0),
(16, '2020-04-10', '19:30:00', '55a9519d498ee90cd8e10fb1', 'Test on mobile', 1, NULL),
(17, '2020-05-13', '19:30:00', '4c029f8a187ec928c074b47b', 'test again', 1, NULL),
(18, '2020-06-30', '21:00:00', '4bb3c394715eef3b6bce86bb', 'testing email.', 1, NULL),
(19, '2020-04-08', '23:00:00', '4b9f32acf964a520861737e3', 'email test', 1, NULL),
(20, '2020-04-09', '23:00:00', '4b9f32acf964a520861737e3', 'email test', 1, NULL),
(21, '2020-04-24', '20:30:00', '5235d8e211d2ec2133665cc2', '', 13, NULL),
(22, '2020-05-12', '21:00:00', '5ad5a1be3af9883089e065fa', '', 13, NULL),
(23, '2020-05-08', '11:00:00', '4eae77d6b8f765aba1bce4c0', 'testing something', 14, 0),
(24, '2020-04-25', '15:20:00', '4c84d9c9d92ea0931f646072', 'Dress code enforced', 15, NULL),
(25, '2028-03-31', '00:00:00', '4e05ece4b61c60b0453b092e', 'Threat level midnight', 15, NULL),
(26, '2020-05-23', '19:30:00', '4d6a577eb6f46dcb244e2fb2', 'Test2', 15, 0),
(27, '2020-04-20', '19:16:00', '4bf05b2f8bf5c9282c0b97fe', 'Testing for report', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fsq_venuedets`
--

CREATE TABLE `fsq_venuedets` (
  `fsq_id` varchar(30) NOT NULL,
  `venueName` varchar(255) DEFAULT NULL,
  `venueAdd` varchar(255) DEFAULT NULL,
  `venueCity` varchar(25) DEFAULT NULL,
  `venueLat` double DEFAULT NULL,
  `venueLng` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fsq_venuedets`
--

INSERT INTO `fsq_venuedets` (`fsq_id`, `venueName`, `venueAdd`, `venueCity`, `venueLat`, `venueLng`) VALUES
('4b06f46df964a5201af422e3', 'The Black Box', '18-22 Hill St', 'Belfast', 54.601719716187, -5.9269524496303),
('4b4506d3f964a5209b0126e3', 'Ryans Bar and Grill', '116-118 Lisburn Rd', 'Belfast', 54.583763241144, -5.943758044204),
('4b47cc65f964a520313f26e3', 'The Duke of York', '7-11 Commercial Court', 'Belfast', 54.60185281695, -5.9274315875331),
('4b6ed73ff964a520e0cc2ce3', 'Belfast Castle', 'Cavehill Estate', 'Belfast', 54.642679460327, -5.9423250183998),
('4b71e344f964a5204c622de3', 'Laverys', '12-18 Bradbury Pl', 'Belfast', 54.588987725399, -5.9343160312769),
('4b814716f964a5204c9d30e3', 'Ulster Hall', '34 Bedford St', 'Belfast', 54.594615426303, -5.9313521101804),
('4b9f32acf964a520861737e3', 'Canal Court Hotel and Spa', 'Merchants Quay', 'Newry', 54.176129060782, -6.3401632632255),
('4bb3c394715eef3b6bce86bb', 'The Garrick', '29 Chichester St', 'Belfast', 54.597361047461, -5.9265934472156),
('4bf05b2f8bf5c9282c0b97fe', 'The Bellevue Arms', '129 Antrim Road', 'Glengormley', 54.664314103453, -5.9479815962101),
('4bf930e18d30d13af4ca0118', 'Hilden Brewing', 'Grand Street', 'Lisburn', 54.520350084434, -6.0258678881676),
('4c029f8a187ec928c074b47b', 'Sandinos', 'Water St.', 'Derry', 54.996138121498, -7.3175688789748),
('4c06ca359e1ab7134be25243', 'The Errigle Inn', '312-320 Ormeau Rd', 'Belfast', 54.575976333609, -5.9172632360136),
('4c5313e6fd2ea5936562de27', 'The Dirty Duck Alehouse', '3 Kinnegar Rd', 'Holywood', 54.641138274368, -5.8411359511),
('4c6fcdd4d274b60cca8cd70d', 'Berts Jazz Bar', '16 Skipper St', 'Belfast', 54.600558416775, -5.9255008309245),
('4c84d9c9d92ea0931f646072', 'Assisi Animal Sanctuary', '1 Old Bangor Road', 'Conlig', 54.619675359651, -5.6791519357505),
('4c9d89017ada199cf0a493bc', 'The Continental', '1 Wall Street Ct', 'New York', 40.7053828724268, -74.00825666246006),
('4d65135a801854814d855168', 'Ulster University - Students Union', 'Belfast Campus', 'Belfast', 54.603764, -5.929627),
('4d6a577eb6f46dcb244e2fb2', 'Dominos Pizza - Larne', 'Unit 3 Port Of Larne Retail ', 'Larne', 54.846685428415, -5.810709516107),
('4e05ece4b61c60b0453b092e', 'Alley Cats', '', 'Coleraine', 55.119856813531, -6.6749121614418),
('4e91caed7ee60278a65886ad', 'Cassidys', '', 'Belfast', 54.618695101277, -5.9378751885947),
('4eae77d6b8f765aba1bce4c0', 'Ulster University - School of Computing and Mathematics', '', 'Newtownabbey', 54.688221492321, -5.8809640097281),
('4eb6a74f5c5c5a532086cb7d', 'Fortwilliam Golf Club', '', 'Belfast', 54.641388611896, -5.9331827008586),
('4f85d1a6e4b08d4038372c98', 'The Brew Dock', '1 Amiens St', 'Dublin', 53.350059436373215, -6.251013682214186),
('509918cde4b08a05092ee1ce', 'Ulster University Jordanstown Library', 'Shore Rd', 'Newtownabbey', 54.686239739442, -5.879224535602),
('50ca5592e4b0cc5bad7c6449', 'The Sunflower', '65 Union Street', 'Belfast', 54.603050231933594, -5.932623863220215),
('5235d8e211d2ec2133665cc2', 'Lough and Quay', '', 'Warrenpoint', 54.099709026466, -6.2552054204217),
('52988e8511d22448bd236206', 'The Dirty Onion', '3 Hill St', 'Belfast', 54.60159683227539, -5.926235675811768),
('545b434b498e9a85bdb35967', 'The Woodworkers', '20 Bradbury Pl', 'Belfast', 54.588932251151, -5.9346122721104),
('55a9519d498ee90cd8e10fb1', 'Bootleggers', '46 Church Lane', 'Belfast', 54.599482725759, -5.9249526781239),
('599f7ef035d3fc615fac23a1', 'Larne and Ballymena Locksmiths', '76 Main St', 'Larne', 54.8517, -5.8175),
('5ad5a1be3af9883089e065fa', 'The Mountain House', '37 Newry Road', 'Belleeks', 54.179681, -6.458755),
('5dd96ecbd5c4a50007a8de21', 'Ben Madigans Bar and Kitchen', '169-175 Cavehill Rd', 'Belfast', 54.626642, -5.943448);

-- --------------------------------------------------------

--
-- Table structure for table `pwreset`
--

CREATE TABLE `pwreset` (
  `resetID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `resetHash` varchar(255) DEFAULT NULL,
  `resetdate` date DEFAULT NULL,
  `resettime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pwreset`
--

INSERT INTO `pwreset` (`resetID`, `userID`, `resetHash`, `resetdate`, `resettime`) VALUES
(9, 14, '9b9fc76879b8474e7f48a9180952eb2e14502022', '2020-04-18', '19:39:00'),
(11, 1, '196ff4bff03c6fc042c483066b68a02612252cc1', '2020-04-19', '16:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `userdets`
--

CREATE TABLE `userdets` (
  `userID` int(6) NOT NULL,
  `forname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pw` varchar(50) DEFAULT NULL,
  `userTypeID` int(1) DEFAULT NULL,
  `loginHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdets`
--

INSERT INTO `userdets` (`userID`, `forname`, `surname`, `email`, `pw`, `userTypeID`, `loginHash`) VALUES
(1, 'Conchúr', 'Ó Fearáin', 'conorfearon@hotmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '27b1a0cde800f915399a293f0fd4f269a61f19c1'),
(2, 'John', 'Wick', 'johnwick@hitmen.com', 'gooddog', 2, 'sha1(conorfearon@hotmail.com123)'),
(3, 'Pól Test', 'MacTést test', 'test2@test.test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '9e87d973aa67d294638eab4da2b92d89e7de110a'),
(4, 'Pól', 'MacTést', 'user@user.use', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 'sha1(conorfearon@hotmail.com123)'),
(5, 'maise', 'the cat', 'meow@meow.prrr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 'sha1(conorfearon@hotmail.com123)'),
(6, 'maise', 'the cat', 'meow@meow.prrr1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 'sha1(conorfearon@hotmail.com123)'),
(7, 'blah', 'blah', 'blah@blah.blah', '5bf1fd927dfb8679496a2e6cf00cbe50c1c87145', 2, 'sha1(conorfearon@hotmail.com123)'),
(8, 'blah', 'blah', 'blah@blah.blah1', '5bf1fd927dfb8679496a2e6cf00cbe50c1c87145', 2, 'sha1(conorfearon@hotmail.com123)'),
(9, 'rere', 'eee', '123@123.123', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 'sha1(conorfearon@hotmail.com123)'),
(10, 'rere', 'eee', '123@123.1234', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 'sha1(conorfearon@hotmail.com123)'),
(11, 'Lizzo', 'Singer', '321@321.321', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 2, 'sha1(conorfearon@hotmail.com123)'),
(12, 'conor', 'fearon', 'fearon-c8@ulster.ac.ukxxx', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 2, 'a35d456579e17c1d6dd411792bbfbf38099d8ae1'),
(13, 'conor ', 'fearon', 'xxxfearon-c8@ulster.ac.uk12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 'xx'),
(14, 'conor', 'fearon', 'fearon-c8@ulster.ac.uk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, '253186212956b2583115772e1e565bcacb6b8345'),
(15, 'Leona ', 'Fearon née Taylor', 'Leonaconor@hotmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '55b3b8f99824ae92918ba7a722f4556936a199d7'),
(16, 'joejoe', 'bloggsbloggs', 'joebloggs@joebloggs.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, '41b4126265eb7881c0f26581a38dd885100ddce1'),
(17, 'Testy', 'Testy', 'Test@test.test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, '365b3aa76a7af89cc7e419387a0c30bf24365b27');

-- --------------------------------------------------------

--
-- Table structure for table `userreminder`
--

CREATE TABLE `userreminder` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `eventID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userreminder`
--

INSERT INTO `userreminder` (`userID`, `eventID`) VALUES
(15, 2),
(1, 9),
(15, 9),
(1, 11),
(15, 11),
(1, 14),
(14, 14),
(15, 14),
(1, 15),
(15, 17),
(14, 18),
(13, 22),
(15, 22),
(14, 23),
(15, 26);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeID` int(11) NOT NULL,
  `userTypeDets` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeID`, `userTypeDets`) VALUES
(1, 'Admin User'),
(2, 'Standard User');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vupcoming`
-- (See below for the actual view)
--
CREATE TABLE `vupcoming` (
`eventID` int(11)
,`evDate` date
,`evTime` time
,`venueName` varchar(255)
,`venueCity` varchar(25)
,`latRad` double
,`lngRad` double
);

-- --------------------------------------------------------

--
-- Structure for view `vupcoming`
--
DROP TABLE IF EXISTS `vupcoming`;

CREATE ALGORITHM=UNDEFINED DEFINER=`B00699799`@`%` SQL SECURITY DEFINER VIEW `vupcoming`  AS  select `eventdets`.`eventID` AS `eventID`,`eventdets`.`evDate` AS `evDate`,`eventdets`.`evTime` AS `evTime`,`fsq_venuedets`.`venueName` AS `venueName`,`fsq_venuedets`.`venueCity` AS `venueCity`,radians(`fsq_venuedets`.`venueLat`) AS `latRad`,radians(`fsq_venuedets`.`venueLng`) AS `lngRad` from ((`eventdets` join `userdets` on((`eventdets`.`createdBy` = `userdets`.`userID`))) join `fsq_venuedets` on((`eventdets`.`evLoc` = `fsq_venuedets`.`fsq_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventdets`
--
ALTER TABLE `eventdets`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `evLoc` (`evLoc`),
  ADD KEY `c1` (`createdBy`);

--
-- Indexes for table `fsq_venuedets`
--
ALTER TABLE `fsq_venuedets`
  ADD PRIMARY KEY (`fsq_id`);

--
-- Indexes for table `pwreset`
--
ALTER TABLE `pwreset`
  ADD PRIMARY KEY (`resetID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `userdets`
--
ALTER TABLE `userdets`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userTypeID` (`userTypeID`);

--
-- Indexes for table `userreminder`
--
ALTER TABLE `userreminder`
  ADD PRIMARY KEY (`userID`,`eventID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventdets`
--
ALTER TABLE `eventdets`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pwreset`
--
ALTER TABLE `pwreset`
  MODIFY `resetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userdets`
--
ALTER TABLE `userdets`
  MODIFY `userID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventdets`
--
ALTER TABLE `eventdets`
  ADD CONSTRAINT `c1` FOREIGN KEY (`createdBy`) REFERENCES `userdets` (`userID`),
  ADD CONSTRAINT `eventdets_ibfk_1` FOREIGN KEY (`evLoc`) REFERENCES `fsq_venuedets` (`fsq_id`);

--
-- Constraints for table `pwreset`
--
ALTER TABLE `pwreset`
  ADD CONSTRAINT `pwreset_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userdets` (`userID`);

--
-- Constraints for table `userdets`
--
ALTER TABLE `userdets`
  ADD CONSTRAINT `userdets_ibfk_1` FOREIGN KEY (`userTypeID`) REFERENCES `usertype` (`userTypeID`);

--
-- Constraints for table `userreminder`
--
ALTER TABLE `userreminder`
  ADD CONSTRAINT `userreminder_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userdets` (`userID`),
  ADD CONSTRAINT `userreminder_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `eventdets` (`eventID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
