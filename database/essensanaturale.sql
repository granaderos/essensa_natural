-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2016 at 09:42 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essensanaturale`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `type`) VALUES
(3, 'ImAdmin', '*B333953F2ABEFAE8D6CA542658732463659C7607', 'admin'),
(2, 'mj', '*B333953F2ABEFAE8D6CA542658732463659C7607', 'client'),
(4, 'earl', '*7602D6BB16A78E15B79CF7B342DAC8B3B119A9B9', 'client'),
(6, 'mel', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'client'),
(7, '', '', 'client'),
(8, '', '', 'client'),
(9, 'p', '*7B9EBEED26AA52ED10C0F549FA863F13C39E0209', 'client'),
(10, 'm', '*E8BEE713F0CBBB9F9B09623007E2826138710274', 'client'),
(11, 'n', '*6F69A23EFA1D6F97489C271EC01C94A9DA8885EB', 'client'),
(12, 'j', '*9A04E9549880BB91C935B6A3E90DA60E3E5C783F', 'client'),
(13, 'h', '*473E7CEA8DB4DA45D3D4091415E33C3DC360A736', 'client'),
(14, 'm', '*E8BEE713F0CBBB9F9B09623007E2826138710274', 'client'),
(15, 'm', '*E8BEE713F0CBBB9F9B09623007E2826138710274', 'client'),
(16, 'n', '*6F69A23EFA1D6F97489C271EC01C94A9DA8885EB', 'client'),
(17, 'k', '*69A7BAE3D37A83849ECEF8F3FF9260B35E01555D', 'client'),
(18, 'l', '*894549142A2819BC7952B608F00C489C989212E8', 'client'),
(19, 'm', '*E8BEE713F0CBBB9F9B09623007E2826138710274', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `captchacodes`
--

CREATE TABLE IF NOT EXISTS `captchacodes` (
  `codeId` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captchacodes`
--

INSERT INTO `captchacodes` (`codeId`, `code`) VALUES
(1, 'cX6hKi'),
(2, '3nMqeC'),
(3, 'MKL2wn'),
(4, 'JBvWul'),
(5, 'Z9br8c'),
(6, 'ZzbSE0'),
(7, 'rjhDyL'),
(8, '3CdCMj'),
(9, 'JLLE7m'),
(10, 'VAwspa');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `messageId` int(11) NOT NULL,
  `senderId` int(11) DEFAULT NULL,
  `receiverId` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `dateSent` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `senderId`, `receiverId`, `subject`, `message`, `dateSent`) VALUES
(6, 2, 3, 'this', 'sample', '2016-10-03'),
(7, 2, 3, 'this', 'sample', '2016-10-03'),
(8, 3, 2, 'Confirmation', 'Hello; I would like to inform you that we lack supplies;', '2016-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `ordereditems`
--

CREATE TABLE IF NOT EXISTS `ordereditems` (
  `orderId` int(11) NOT NULL,
  `transId` int(11) DEFAULT NULL,
  `category` varchar(10) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordereditems`
--

INSERT INTO `ordereditems` (`orderId`, `transId`, `category`, `itemId`, `quantity`) VALUES
(8, 18, 'product', 7, 50),
(9, 18, 'product', 8, 4),
(10, 18, 'product', 7, 4),
(11, 21, 'product', 8, 5),
(12, 21, 'product', 7, 90),
(13, 22, 'product', 8, 20),
(14, 22, 'product', 9, 10),
(15, 22, 'product', 7, 3),
(16, 24, 'product', 7, 3),
(17, 26, 'product', 4, 1000),
(18, 27, 'product', 4, 11),
(19, 27, 'product', 8, 5),
(20, 28, 'product', 6, 6),
(21, 28, 'product', 5, 10),
(22, 30, 'product', 4, 5),
(23, 30, 'product', 8, 3),
(24, 32, 'product', 4, 6),
(25, 32, 'product', 8, 4),
(26, 33, 'product', 7, 3),
(27, 33, 'product', 5, 7),
(28, 34, 'product', 5, 4),
(29, 35, 'product', 5, 4),
(30, 36, 'product', 5, 6),
(31, 36, 'product', 7, 3),
(32, 37, 'product', 5, 5),
(33, 37, 'product', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orderinformation`
--

CREATE TABLE IF NOT EXISTS `orderinformation` (
  `orderInfo` int(11) NOT NULL,
  `transId` int(11) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `receiver` varchar(50) DEFAULT NULL,
  `careOf` varchar(50) DEFAULT NULL,
  `contactInfo` varchar(50) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `dateGiven` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderinformation`
--

INSERT INTO `orderinformation` (`orderInfo`, `transId`, `address`, `receiver`, `careOf`, `contactInfo`, `paymentMethod`, `dateGiven`) VALUES
(1, 18, 'Quezon City/#58 New York Cubao', 'Maria Clear Clara ', 'Hazel Query', NULL, NULL, NULL),
(2, 19, 'Quezon City/#58 New York Cubao', 'Maria Clear Clara ', 'Hazel Query', NULL, NULL, NULL),
(3, 20, 'Quezon City/#58 New York Cubao', 'Maria Clear Clara ', 'Hazel Query', NULL, NULL, NULL),
(4, 21, 'Taguig City/#232 ThisStreet Boulevard ', 'Melvin Santos Sanje', 'Matthew Ryan Lalim Corderos', '092698731278', 'sendCash', NULL),
(5, 22, '#23 This Village Brgy. That/Rizal/Luzon', 'Faust Azurin Ronald', 'Antonni Kimmy Sal', NULL, NULL, NULL),
(6, 23, '#23 This Village Brgy. That/Rizal/Luzon', 'Faust Azurin Ronald', 'Antonni Kimmy Sal', NULL, NULL, NULL),
(7, 24, '#34 The Street There Brgy. Adjacent /Quezon Province/Luzon', 'Ryan Cordero Lalim', 'Patrick Azurin Ronaldy', '09268731278', 'Cash Remittance', NULL),
(8, 25, '#34 The Street There Brgy. Adjacent /Quezon Province/Luzon', 'Ryan Cordero Lalim', 'Patrick Azurin Ronaldy', '09268731278', 'Cash Remittance', NULL),
(9, 26, NULL, 'Picker Peter Piper', NULL, '09268731278', 'Cash On Pick-Up', NULL),
(10, 27, NULL, 'Picker Peter Piper', NULL, '09268731278', 'Cash On Pick-Up', NULL),
(11, 27, '#2432 taytay rizal / Rizal / Luzon', 'earl reyes', 'derwin de castro', '09213914131', 'Cash Remittance', NULL),
(12, 28, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(13, 29, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(14, 30, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(15, 31, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(16, 32, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(17, 33, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(18, 34, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(19, 35, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(20, 36, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL),
(21, 37, '#58 New York Cubao / Taytay Rizal  / Luzon', 'Earl Reyes', 'Earl Reyes', '09268731278', 'Cash Remittance', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `packageId` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packageId`, `name`, `description`, `price`, `photo`, `status`) VALUES
(1, 'Pack01', 'prod00 - 40 pcs.&lt;br&gt;<br />\nprod05 - 20 pcs.&lt;br&gt;<br />\nprod09 - 92 boxes<br />\nprod10 - 10 pieces', 8989, '1.JPG', 1),
(2, 'Pack02', 'prod01 - 23 boxes', 2000, '2.JPG', 1),
(5, 'this', 'this', 90, '5.JPG', 1),
(7, 'the', 'the', 900, '7.jpeg', 1),
(8, 'op', 'op', 90, '8.png', 1),
(9, 'here', 'here', 8989, '9.jpg', 1),
(10, 'lo', 'lo', 898, '10.jpeg', 1),
(11, 'wert', 'wert', 90000, '11.JPG', 1),
(13, 'NewPackage', 'This is it.', 7000, '13.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `paymentId` int(11) NOT NULL,
  `transId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentId`, `transId`, `userId`, `photo`, `description`, `dateAdded`, `status`) VALUES
(3, 18, 2, '18.JPG', 'Hello Mr. Allan; this is the proof that I already deposited on your bank account the exact amount as', '2016-10-02', 1),
(4, 18, 2, '18.JPG', 'Hello Mr. Allan; this is the proof that I already deposited on your bank account the exact amount as', '2016-10-02', 1),
(5, 27, 6, '27.JPG', 'This is my proof of payment:\r\ninsert amount so on', '2016-10-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prodId` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50000) DEFAULT NULL,
  `unitPrice` double DEFAULT NULL,
  `sellingPrice` double DEFAULT NULL,
  `stocks` int(11) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodId`, `name`, `description`, `unitPrice`, `sellingPrice`, `stocks`, `photo`, `category`) VALUES
(4, 'p', 'p', 0, 0, 0, '4.JPG', 'Health'),
(5, 'Red Mint Cream Pain Reliever', 'Desc is Essensa Naturale Red Mint Cream Pain Relie', 90, 90, 150, '5.jpg', 'Health'),
(6, 'Essensa Naturale Ona Coffee', 'Essensa Naturale Ona Coffee', 80, 80, 0, '6.jpg', 'Health'),
(7, 'Herbs Central 8 in 1 Coffee', 'Herbs Central 8 in 1 Coffee', 80, 80, 0, '7.jpg', 'Health'),
(8, 'Phytostem Foam Wash', 'Phytostem Foam Wash', 90, 90, 0, '8.jpg', 'Beauty & Personal Care'),
(9, 'GenWhite', 'GenWhite', 90, 90, 0, '9.jpg', 'Beauty & Personal Care'),
(10, 'updates', 'updates', 10, 10, 335, '10.jpg', NULL),
(12, 'p', 'p', 9, 9, 4, '12.jpg', 'Household');

-- --------------------------------------------------------

--
-- Table structure for table `shippinginformation`
--

CREATE TABLE IF NOT EXISTS `shippinginformation` (
  `shippingId` int(11) NOT NULL,
  `transId` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contactNumber` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shippinginformation`
--

INSERT INTO `shippinginformation` (`shippingId`, `transId`, `name`, `contactNumber`, `address`) VALUES
(1, 17, 'M', '09268731278', '#58 Maryland Cubao Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `temporders`
--

CREATE TABLE IF NOT EXISTS `temporders` (
  `tempId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `prodId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `category` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temporders`
--

INSERT INTO `temporders` (`tempId`, `userId`, `prodId`, `quantity`, `dateAdded`, `category`) VALUES
(1, 3, 8, 5, '2016-09-25', 'product'),
(38, 4, 5, 5, '2016-10-15', 'product'),
(39, 10, 5, 5, '2016-10-15', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `testimonialId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `nameAge` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonialId`, `userId`, `title`, `description`, `nameAge`, `photo`, `status`) VALUES
(3, 3, 'SA BUAH MERAH MIX,NAILABAS KO SA PAG-IHI ANG KIDNEY STONE KO', 'Ako po ay may kidney stone at naka schedule nang mag pa opera Buti nalang at sinubukan ko ang Buah Merah Mix, wala pang 2 months of drinking, eto hawak ko ang lumabas na kidney stone ko. Salamat sa Buah Merah Mix nakatipid ako nang mahigit P100,000.', 'Rudy Morales, 51 yrs old', '3.jpg', 1),
(4, 3, 'SA BUAH MERAH MIX,NAILABAS KO SA PAG-IHI ANG KIDNEY STONE KO', 'Noong pumunta ako nang doktor, nakita sa ultrasound ko na meron akong mahigit 1cm na gallstone (Bato sa Apdo)Laking gulat ko at&quot; nang Doktor ko dahil pagkatapos nang isang buwang inom ang Buah Merah Mix, natunaw ang Gall Stone ko. Ang galing talaga nang Buah Merah Mix!&quot;', 'Patricia Vermas, 54 yrs old', '4.jpg', 1),
(5, 3, 'DALAWANG BUKOL SA PAA KO, NAWALA NA', 'Ako po ay may dalawang bukol na kasing laki nang piso sa kanang paa at laging masakit ang aking balakang. Dahil sa Buah Merah Mix, ngayon sakit sa balakang ko at yung dalawang bukol sa paa ko ay nawala na. Bilib ako sa Buah Merah Mix,ang Bilis mag pagaling&quot; ', 'Josephina Ricaport, 70 yrs old', '5.jpg', 1),
(6, 3, '8 YEARS KONG MAYONA, GUMALING NA.', '8 years na akong may mayoma, malaki ang tiyan ko at matigas dahil sa (6)anim ang bukol.Naka tatlong bote lang ako nang Buah Merah Mix sa loob nang tatlong araw, nagulat ako dahil lumabas ang buo buong dugo at ngayon wala na akong mayoma Lumiit ba ang tiyan ko. Salamat sa Buah Merah Mix. Sana makatulong din sa inyo', 'Cristy Haong, 42 yrs old', '6.jpg', 1),
(7, 3, '20 DAYS LANG NATUNAW ANG BUKOL KO SA BREAST.', 'Nag pa ultra sound po ako at nakitang meron akong bukol sa breast. Nagworry po kami nang pamilya ko, bali sinubukan ko po Buah Merah Mix, kasi maraming nagsasabing mahusay daw, ngayon po hawak ko yung bago kong ultra sound, after 20 days lang nang pag inom, natunaw po at nawala na ang bukol sa breast ko. Mahusay talaga ang Buah Merah Mix', 'Chona Banal, 47 yrs old', '7.jpg', 1),
(8, 3, 'NORMAL NA BLOOD SUGAR KO, AT NAKAKALAKAD NA AKO.', 'Ako po ay may Diabetes at Bone cancer, hindi po ako makatayo, nanlalabo ang aking mga mata,at lagi akong nanghihina. Malaki na din ang nagagastos ko, pero sa tulong nang Buah Merah Mix, NORMAL na Blood Sugar Level ko, nakakalakad na ako at malakas pa ako. Malaki pa tinipid ko, Salamat sa ating Dakilang Dios AMA, at sa Buah Merah Mix', 'Col. Augusto Sagun, 68 yrs old', '8.jpg', 1),
(9, 3, 'MAGALING NA AKO SA PROSTATE PROBLEM KO.', 'Matagal na po akong naghihirap sa aking prostate problem, laking gulat ko nang hibdi ko pa naubos ang isang bote nang Buah Merah Mix, gumaling na din. Naniniwala ako ba ang Buah Merah ang binigay sa aking nang ating DIOS para gumaling ako.', 'Rodolfo Rosales, 72 yrs old', '9.jpg', 1),
(12, 2, 'This is a sample Title', 'Sample Content', 'Sample name and Age', '12.png', 0),
(13, 2, 'Cured Whilst Making This Web Site', 'Hey; this is Marejean. I would like to share a testimony. Everything related to essensa naturale is effective.<br />\n<br />\nContact me @JavaScriptWithMarejean (Facebook)', 'this is just a sample testimonial ^_^', '13.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `dateOfTransaction` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `method` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transId`, `userId`, `dateOfTransaction`, `status`, `method`) VALUES
(18, 2, '2016-09-02', 1, 'delivery'),
(21, 2, '2016-10-02', 0, 'delivery'),
(22, 2, '2016-10-02', 0, 'ship'),
(24, 2, '2016-10-02', 0, 'ship'),
(26, 2, '2016-10-02', 0, 'pick-up'),
(28, 4, '2016-10-15', 0, 'ship'),
(29, 4, '2016-10-15', 0, 'ship'),
(30, 4, '2016-10-15', 0, 'ship'),
(31, 4, '2016-10-15', 0, 'ship'),
(32, 4, '2016-10-15', 0, 'ship'),
(33, 4, '2016-10-15', 0, 'ship'),
(34, 4, '2016-10-15', 0, 'ship'),
(35, 4, '2016-10-15', 0, 'ship'),
(36, 4, '2016-10-15', 0, 'ship'),
(37, 2, '2016-08-02', 1, 'ship');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `telNo` varchar(7) DEFAULT NULL,
  `cellNo` varchar(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lastname`, `firstname`, `middlename`, `birthday`, `gender`, `address`, `telNo`, `cellNo`) VALUES
(1, 'Perpinosa', 'Marejean', NULL, '0000-00-00', 'female', 'Quezon City', '4342-32', '09268731278'),
(2, 'Perpinosa', 'Marejean', 'Gra', '0000-00-00', 'female', 'Quezon City', '943-134', '09268731278'),
(3, 'De Castro', 'Derwin', 'G', '1989-12-12', 'male', 'Antipolo', '928-129', '09338731278'),
(4, 'Reyes', 'Earl', 'Christian', '0000-00-00', 'female', 'Cubao', '9789678', '09268731267'),
(5, 'Reyes', 'Earl', 'Christian', '0000-00-00', 'female', 'Cubao', '9789678', '09268731267'),
(6, 'Juanillo', 'Melissa', 'Picones', '0000-00-00', 'female', 'cubao', '6566565', '09234567891'),
(7, '', '', '', '0000-00-00', 'female', '', '', ''),
(8, '', '', '', '0000-00-00', 'female', '', '', ''),
(9, 'p', 'p', 'p', '0000-00-00', 'female', 'p', 'p', 'p'),
(10, 'm', 'm', 'm', '0000-00-00', 'female', 'm', 'm', 'm'),
(11, 'n', 'n', 'n', '0000-00-00', 'female', 'n', 'n', 'n'),
(12, 'j', 'j', 'j', '0000-00-00', 'female', 'j', 'j', 'j'),
(13, 'this', 'This', 'this', '0000-00-00', 'female', 'hj', 'kh', 'jhjk'),
(14, 'm', 'm', 'm', '0000-00-00', 'female', 'm', 'm', 'm'),
(15, 'm', 'm', 'm', '0000-00-00', 'female', 'm', 'm', 'm'),
(16, 'n', 'n', 'n', '0000-00-00', 'female', 'n', 'n', 'n'),
(17, 'k', 'k', 'k', '0000-00-00', 'female', 'k', 'k', 'k'),
(18, 'b', 'b', 'b', '0000-00-00', 'female', 'fl', 'l', 'l'),
(19, 'z', 'z', 'z', '0000-00-00', 'female', 'm', 'm', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captchacodes`
--
ALTER TABLE `captchacodes`
  ADD PRIMARY KEY (`codeId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `ordereditems`
--
ALTER TABLE `ordereditems`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `orderinformation`
--
ALTER TABLE `orderinformation`
  ADD PRIMARY KEY (`orderInfo`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packageId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodId`);

--
-- Indexes for table `shippinginformation`
--
ALTER TABLE `shippinginformation`
  ADD PRIMARY KEY (`shippingId`);

--
-- Indexes for table `temporders`
--
ALTER TABLE `temporders`
  ADD PRIMARY KEY (`tempId`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonialId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captchacodes`
--
ALTER TABLE `captchacodes`
  MODIFY `codeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ordereditems`
--
ALTER TABLE `ordereditems`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `orderinformation`
--
ALTER TABLE `orderinformation`
  MODIFY `orderInfo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `packageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `shippinginformation`
--
ALTER TABLE `shippinginformation`
  MODIFY `shippingId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `temporders`
--
ALTER TABLE `temporders`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonialId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
