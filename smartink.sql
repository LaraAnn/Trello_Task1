-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2014 at 11:03 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartink`
--
CREATE DATABASE IF NOT EXISTS `smartink` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smartink`;

-- --------------------------------------------------------

--
-- Table structure for table `about_info`
--

CREATE TABLE IF NOT EXISTS `about_info` (
  `id_about` int(100) NOT NULL AUTO_INCREMENT,
  `about_title` text NOT NULL,
  `about_desc` text NOT NULL,
  PRIMARY KEY (`id_about`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `about_info`
--

INSERT INTO `about_info` (`id_about`, `about_title`, `about_desc`) VALUES
(1, 'About', 'This is the about. Length - average of 5-20 lines.'),
(2, 'History', 'This is the History. Length - average of 40-60 lines.'),
(3, 'Mission', 'Length - average of 5-10 lines.'),
(4, 'Vision', 'Length - average of 5-10 lines.');

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE IF NOT EXISTS `admin_info` (
  `admin_user` varchar(30) NOT NULL,
  `admin_pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_user`, `admin_pass`) VALUES
('admin', 'ilovesmartink');

-- --------------------------------------------------------

--
-- Table structure for table `basic_setting`
--

CREATE TABLE IF NOT EXISTS `basic_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header_fc` text NOT NULL,
  `header_bgc` text NOT NULL,
  `header_fch` text NOT NULL,
  `header_bgch` text NOT NULL,
  `footer_fc` text NOT NULL,
  `footer_bgc` text NOT NULL,
  `footer_fch` text NOT NULL,
  `footer_bgch` text NOT NULL,
  `body_fontcolor` text NOT NULL,
  `body_bgcolor` text NOT NULL,
  `box_headercolor` text NOT NULL,
  `box_fontcolor` text NOT NULL,
  `box_bgcolor` text NOT NULL,
  `box_borderradius` text NOT NULL,
  `box_shadow` text NOT NULL,
  `box_shadowopacity` text NOT NULL,
  `box_padding` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `basic_setting`
--

INSERT INTO `basic_setting` (`id`, `header_fc`, `header_bgc`, `header_fch`, `header_bgch`, `footer_fc`, `footer_bgc`, `footer_fch`, `footer_bgch`, `body_fontcolor`, `body_bgcolor`, `box_headercolor`, `box_fontcolor`, `box_bgcolor`, `box_borderradius`, `box_shadow`, `box_shadowopacity`, `box_padding`) VALUES
(1, 'white', 'black', 'black', 'magenta', 'darkgray', 'black', 'white', 'black', 'black', 'lightgray', 'black', 'black', 'white', '5', '10', '80', '10');

-- --------------------------------------------------------

--
-- Table structure for table `branches_info`
--

CREATE TABLE IF NOT EXISTS `branches_info` (
  `id_branch` int(11) NOT NULL AUTO_INCREMENT,
  `branch_loc` text NOT NULL,
  `branch_add` text NOT NULL,
  PRIMARY KEY (`id_branch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE IF NOT EXISTS `cart_temp` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` text NOT NULL,
  `file_name` text NOT NULL,
  `size` text NOT NULL,
  `price` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_ignored` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE IF NOT EXISTS `contact_info` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `contact_title` text NOT NULL,
  `contact_desc` text NOT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id_contact`, `contact_title`, `contact_desc`) VALUES
(3, 'Numbers', 'Telephone Number/s: 702-4162 / 784-5725 / 784-3843<br>\r\nCellphone Number/s: 0918 509 6943'),
(4, 'E-mail address', 'smartinktarp@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id_event` int(100) NOT NULL AUTO_INCREMENT,
  `event_title` text NOT NULL,
  `event_desc` text NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `event_title`, `event_desc`) VALUES
(1, 'Happy treat! Happy me!', 'Want a tarpaulin on your birthday that you can afford?\r\n<br>\r\nThis is your day!<br>\r\nCome on and celebrate it with  affordable discounts of Smart Ink.'),
(2, 'Love is in the air', 'Want to give a romantic couple item for your love ones?\r\n<br>\r\nThis day lets make love!<br>\r\nTreat your love ones with availing affordable discounts of Smart Ink.'),
(3, 'Be honored!', 'Want to be acknowledge, for being an honored student?\r\n<br>\r\nCongratulations! This is your day!<br>\r\nGive yourself an honor in availing affordable discounts of Smart Ink.');

-- --------------------------------------------------------

--
-- Table structure for table `faq_info`
--

CREATE TABLE IF NOT EXISTS `faq_info` (
  `id_faq` int(100) NOT NULL AUTO_INCREMENT,
  `faq_q` text NOT NULL,
  `faq_a` text NOT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `faq_info`
--

INSERT INTO `faq_info` (`id_faq`, `faq_q`, `faq_a`) VALUES
(1, 'Why do we need to log in in order to make transactions?', 'That is because of the user profiling the system has. And so we cant mess other request with your request.'),
(2, 'How can I guarantee that my transaction is safe?', 'Our system uses a certain algorithm to keep the system safe. Just wanna see you this, there is a way out but there is no way in.'),
(3, 'How can I assure that my given information was safe?', 'Our system use encryption methods plus basic securities to prevent data loss.');

-- --------------------------------------------------------

--
-- Table structure for table `slider_info`
--

CREATE TABLE IF NOT EXISTS `slider_info` (
  `slider_id` int(100) NOT NULL AUTO_INCREMENT,
  `slider_pic_source` text NOT NULL,
  `slider_header` text NOT NULL,
  `slider_desc` text NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slider_info`
--

INSERT INTO `slider_info` (`slider_id`, `slider_pic_source`, `slider_header`, `slider_desc`) VALUES
(1, 'images/indexImage1.jpg', 'Smart ink ', 'Avail this item for 20% discount from march 1, 2014 untill march 15, 2014. asdad easdx awdxaewsdx dsfjhkfj dfguid joiuioty ada sdas dsad asdas ds dsa dasd asd as'),
(2, 'images/indexImage2.jpg', 'Smart ink', 'experience to have this tarpaulin promo with 20% discount if you avail to print 40pcs. of tarpaulin. dfhghihkrro jrdfiyern djoryuoe dghith irtui ui9ur 9r9 '),
(3, 'images/indexImage3.jpg', 'Smart ink', 'Great service. smart ink billboard size tarpaulin is now available. hgksg sjdigt jor jigh gjiosrt rotuoer jirueye              gkjyio3ty dfrg9ery9rtyjelg hhuihye9y ');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `service_type` text NOT NULL,
  `file_name` text NOT NULL,
  `size` text NOT NULL,
  `price` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `receipt` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `service_type`, `file_name`, `size`, `price`, `remarks`, `receipt`, `status`) VALUES
(22, 7, 'Tarpaulin Printing', 'lenheart65_52445678-15798034.jpg', '5-13', 1300, 'adasdas asd asd as das d', 81048583, 'pending'),
(23, 7, 'Tarpaulin Printing', 'lenheart65_77925720-18591308.jpg', '5-13', 1300, 'adasdas asd asd as das d', 76327209, 'pending'),
(24, 7, 'Tarpaulin Printing', 'lenheart65_57760314-67749633.jpg', '6-15', 1800, 'as das das dsad asdqw eetgtrnjgjdf fas das dasd sdgfkuhdff', 55291137, 'pending'),
(25, 17, 'Tarpaulin Printing', 'paulPogi_80581665-61995544.jpg', '7-16', 2240, 'Hey men, Im batman!', 65041503, 'accepted'),
(26, 17, 'Shirt Printing', 'paulPogi_73135681-58977050.jpg', 'Polo Shirt-xxl-3', 1080, 'asdas das dasd', 92180480, 'pending'),
(27, 17, 'Shirt Printing', 'paulPogi_82160949-89293823.jpg', 'Polo Shirt-xl-20', 7200, 'ase asdasd asd as dasd ', 15995788, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email_address` text NOT NULL,
  `gender` text NOT NULL,
  `birthdate` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email_address`, `gender`, `birthdate`) VALUES
(1, 'paul65', 'pogi', 'Paul Michael', 'Manalili', 'Cacatian', 'lenheart65@gmail.com', 'male', 'August-23-1994'),
(7, 'lenheart65', '56352645', 'Paul Michael', 'Manalili', 'Cacatian', 'lenheart65@gmail.com', 'male', 'August-23-1994'),
(13, 'paul111', '56352645', 'Paul Michael', 'Manalili', 'Cacatian', 'lenheart65@gmail.com', 'male', 'August-23-1994'),
(14, 'rovie_almeda', 'secretito', 'Rovie', 'Labutap', 'Almeda', 'rovie16.labutap@gmail.com', 'female', 'October-8-1995'),
(15, 'toybitsPogi', 'rjmendoza', 'Ramon Jeric', 'Bitoy', 'Mendoza', 'toybits@yahoo.com', 'male', 'June-8-1994'),
(16, 'rovielabutap', '12345678', 'Rocelle Vie', 'Torres', 'Labutap', 'rovie16.labutap@gmail.com', 'female', 'October-8-1995'),
(17, 'paulPogi', '56352645', 'Paul Michael', 'Manalili', 'Cacatian', 'lenheart65@gmail.com', 'male', 'August-23-1994'),
(18, 'allenChubiboy', '56352645', 'sasafdsfds', 'assdfsdf', 'sadfsdf', 'asd@pogi.com', 'female', 'May-14-1973');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
