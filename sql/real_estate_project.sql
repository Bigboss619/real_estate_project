-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 05:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `email`, `photo`, `password`, `token`, `role`, `status`) VALUES
(1, 'Okpalaihedi Ugochukwu', 'admin@gmail.com', '', 'admin123', '', 'admin', '1'),
(2, 'Ugochukwu Emmanuel Okpalaihedi', 'eugochukwu91021@gmail.com', '1725424317.png', '$2y$10$e2Qrk.X2ll.sZlv.pTqkbujbdyMM/PJag.PDa4bHQoYPESYIVgPsW', '', 'admin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `biography` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `estate` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedln` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` int(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `fullname`, `email`, `photo`, `password`, `company`, `designation`, `biography`, `phone`, `country`, `address`, `estate`, `city`, `zip_code`, `website`, `facebook`, `twitter`, `linkedln`, `pinterest`, `instagram`, `youtube`, `token`, `role`, `status`) VALUES
(1, 'Okpalaihedi Uchechukwu Praise(Invisible)', 'uchepraise911@gmail.com', '1733914330.jpg', '$2y$10$VYhf.ivsXAcDJqEmzkc/heZgsXOoXiTTK2e/x7Opjt1FCa7wi7jIK', 'Bigboss619', '', '', '+234 7059407749', 'Nigeria', '', 'Lagos', 'Surulere', '', '', '', '', '', '', '', 0, '', '', '1'),
(3, 'Emmanuel Ugochukwu', 'emmanuel@gmail.com', '1733946136.jpg', '$2y$10$l4FFGHy87hYZltD9ZPe8aOI4ipLB1q.rhBMMG7.KspmggIRZwZrh2', '', '', '', '+234 705 6546 4466', 'Nigeria', 'No 1 boundary Avenue fegge onitsha Nigeria', 'Abia', 'Onitsha', '4050', '', '', '', '', '', '', 0, '', '', '1'),
(4, 'Ozamah Faith', 'ozamahfaith@gmail.com', '1734018481.jpg', '$2y$10$g2n8YqRnao0GNemZVJLM/OqtpIJ2I1.QkZtDj.7NAB.7BngRSn/rm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '1'),
(5, 'Benson Victor Chidindu', 'bensonvictor@gmail.com', '1734101003.jpg', '$2y$10$s6DuLAaf5gF3q29kfIWY1eZgfcxL/P05hpIY66Jdr.y6EUh96qmZi', 'AA Property', '', '', '+234 67477 3377', 'Germany', '', 'Condo', 'New Jersey', '', '', '', '', '', '', '', 0, '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`) VALUES
(1, 'Free Wifi'),
(2, 'Swimming Pool'),
(3, 'Parking Lot'),
(4, 'Gym'),
(5, 'Fitness Center'),
(6, 'Room Service'),
(7, 'Private Locker');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fullname`, `email`, `photo`, `password`, `token`, `role`, `status`) VALUES
(3, 'Okpalaihedi Ugochukwu Emmanuel (Bigboss619)', 'eugochukwu91021@gmail.com', '1729560921.jpg', '$2y$10$0MLZrGrz4QLf/7EOZ6tTzuNE6LIXFGe/vCW1zrxWCHUPzApRLZSVi', '', '', '1'),
(4, 'Ozamah Faith', 'ozamahfaith@gmail.com', '1729746950.jpg', '$2y$10$VogHtnVj1Zbu2xp7zxFoq.6b/4UHInmy5hmCsuTz0aWNyFeBMv/gK', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(1, 'How do I buy a property?', '<p>The process typically involves finding a property, making an offer, conducting inspections, obtaining financing, and closing the deal. no.</p>'),
(2, 'What is a real estate agent and what do they do?', '<p>A real estate agent is a licensed professional who helps buyers and sellers navigate the real estate process. They can assist with finding properties, negotiating deals, and handling paperwork.</p>'),
(3, 'What is a mortgage?', '<p>A mortgage is a loan used to purchase a property. The property acts as collateral for the loan, and the buyer makes monthly payments to repay the loan over time.</p>'),
(4, 'What is a home inspection?', '<p>A home inspection is a thorough examination of a property, performed by a licensed inspector, to assess its condition and identify any potential problems.</p>'),
(5, 'What is property tax?', '<p>Property tax is a tax imposed by local government on real estate property, based on the value of the property. The tax is typically used to fund local services and infrastructure.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `slag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `photo`, `slag`) VALUES
(1, 'Boston', '1725424969.jpg', 'boston123'),
(2, 'California', '1725425099.jpg', 'california123'),
(3, 'Chicago', '1725425126.jpg', 'chicago123'),
(4, 'Dallas', '1725425151.jpg', 'dallas123'),
(5, 'Denver', '1725425196.jpg', 'denver123'),
(6, 'New York', '1725425228.jpg', 'newyork123'),
(7, 'San Diago', '1725425268.jpg', 'sandiago123'),
(8, 'Washington', '1725425296.jpg', 'washington123');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `posted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `message`, `customer_id`, `agent_id`, `posted_on`) VALUES
(1, 'I want to discuss something with you.', '<p>I want to purchase a propety duplex house within the range of $40,000 USD. Please do you have any</p>', '3', '1', '2024-10-21 13:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `message_replies`
--

CREATE TABLE `message_replies` (
  `id` int(20) NOT NULL,
  `message_id` varchar(255) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `reply_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_replies`
--

INSERT INTO `message_replies` (`id`, `message_id`, `customer_id`, `agent_id`, `sender`, `reply`, `reply_on`) VALUES
(3, '1', '3', '1', 'Customer', 'Please I haven\'t gotten your feedback', '2024-10-22 05:32:17'),
(4, '1', '3', '1', 'Agent', 'Please I will do so very soon. Please be patient.', '2024-10-22 05:38:27'),
(5, '1', '3', '1', 'Customer', 'I will soon be traveling to London I really need your reply ASAP.', '2024-10-22 06:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `package_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `purchases_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `currently_active` tinyint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `agent_id`, `package_id`, `transaction_id`, `payment_method`, `paid_amount`, `status`, `purchases_date`, `expire_date`, `currently_active`) VALUES
(1, '1', '2', 'PAYID-M3EBNCI9H814152R0181771S', 'PayPal', '29', 'Completed', '2024-08-23', '2025-11-22', 1),
(4, '3', '2', 'PAYID-M5M6YDI1J685103G8534960U', 'PayPal', '29', 'Completed', '2024-12-11', '2025-01-10', 1),
(5, '4', '2', 'pi_3QVEmv2L3bhIDhDy0I6oxjk6', 'Stripe', '29', 'Completed', '2024-12-12', '2025-01-11', 1),
(6, '5', '3', 'pi_3QVaWe2L3bhIDhDy0OjxICIj', 'Stripe', '39', 'Completed', '2024-12-13', '2025-02-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `allowed_days` varchar(255) NOT NULL,
  `allowed_properties` varchar(255) NOT NULL,
  `allowed_feature_properties` varchar(255) NOT NULL,
  `allowed_photo` varchar(255) NOT NULL,
  `allowed_videos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `allowed_days`, `allowed_properties`, `allowed_feature_properties`, `allowed_photo`, `allowed_videos`) VALUES
(1, 'Basic ', '19', '15 ', '3', '0', '3', '3'),
(2, 'Standard ', '29', '30', '10', '5', '10', '10'),
(3, 'Gold ', '39', '60', '-1', '15', '20', '20');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(40) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `long_description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `posted_on` datetime NOT NULL,
  `total_view` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `short_description`, `long_description`, `photo`, `posted_on`, `total_view`) VALUES
(1, '5 Tips for Finding Your Dream Home', '158b9bfc-fb30-42e6-800a', 'Lorem ipsum dolor sit amet, nibh saperet te pri, at nam diceret disputationi. Quo an consul impedit, usu possim evertitur dissentiet ei.', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">With the new year underway, it\'s a great time to take stock of your finances and plan for the future. If you\'re looking to maximize your investments in 2023, here are some tips and strategies to help you get started.</p>\r\n<ol style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"box-sizing: border-box;\">Diversify your portfolio: Don\'t put all your eggs in one basket. Spread your investments across different assets, such as stocks, bonds, real estate, and commodities, to reduce your overall risk.</li>\r\n<li style=\"box-sizing: border-box;\">Consider index funds: Index funds are a great way to gain exposure to the stock market without having to pick individual stocks. They offer low fees and broad diversification, making them a good choice for long-term investing.</li>\r\n<li style=\"box-sizing: border-box;\">Stay invested for the long term: Don\'t get caught up in short-term market fluctuations. Stick to your investment plan and remain invested for the long term, even during periods of market volatility.</li>\r\n<li style=\"box-sizing: border-box;\">Monitor your investments regularly: Keep a close eye on your investments and re-balance your portfolio as needed to ensure that you are aligned with your investment goals.</li>\r\n<li style=\"box-sizing: border-box;\">Consider working with a financial advisor: If you\'re not comfortable managing your investments on your own, consider working with a financial advisor. They can provide you with personalized advice and help you make informed investment decisions.</li>\r\n<li style=\"box-sizing: border-box;\">Stay informed: Stay up to date with the latest news and trends in the financial world, so you can make informed investment decisions. Read financial news and attend investment seminars to gain a deeper understanding of the market.</li>\r\n<li style=\"box-sizing: border-box;\">Invest in yourself: Finally, remember to invest in yourself. Whether it\'s through education, training, or professional development, investing in your personal growth can pay off in the long run.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">By following these tips and strategies, you can maximize your investment returns in 2023 and beyond. Good luck!</p>', '1730446262.jpg', '2024-11-01 00:00:00', 1),
(2, 'Pros & Cons of Renting vs. Buying', '158b9bfc-fb30-42e6-800a-32dff', 'Nec in rebum primis causae. Affert iisque ex pri, vis utinam vivendo definitionem ad, nostrum omnes que per et. Omnium antiopam.', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">With the new year underway, it\'s a great time to take stock of your finances and plan for the future. If you\'re looking to maximize your investments in 2023, here are some tips and strategies to help you get started.</p>\r\n<ol style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"box-sizing: border-box;\">Diversify your portfolio: Don\'t put all your eggs in one basket. Spread your investments across different assets, such as stocks, bonds, real estate, and commodities, to reduce your overall risk.</li>\r\n<li style=\"box-sizing: border-box;\">Consider index funds: Index funds are a great way to gain exposure to the stock market without having to pick individual stocks. They offer low fees and broad diversification, making them a good choice for long-term investing.</li>\r\n<li style=\"box-sizing: border-box;\">Stay invested for the long term: Don\'t get caught up in short-term market fluctuations. Stick to your investment plan and remain invested for the long term, even during periods of market volatility.</li>\r\n<li style=\"box-sizing: border-box;\">Monitor your investments regularly: Keep a close eye on your investments and re-balance your portfolio as needed to ensure that you are aligned with your investment goals.</li>\r\n<li style=\"box-sizing: border-box;\">Consider working with a financial advisor: If you\'re not comfortable managing your investments on your own, consider working with a financial advisor. They can provide you with personalized advice and help you make informed investment decisions.</li>\r\n<li style=\"box-sizing: border-box;\">Stay informed: Stay up to date with the latest news and trends in the financial world, so you can make informed investment decisions. Read financial news and attend investment seminars to gain a deeper understanding of the market.</li>\r\n<li style=\"box-sizing: border-box;\">Invest in yourself: Finally, remember to invest in yourself. Whether it\'s through education, training, or professional development, investing in your personal growth can pay off in the long run.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">By following these tips and strategies, you can maximize your investment returns in 2023 and beyond. Good luck!</p>', '1730446436.jpg', '2024-11-01 00:00:00', 1),
(3, 'Maximizing Your Investment in 2023', '158b9bfc-fb30-42e6-800a-32dfffcd83dc', 'Id pri placerat voluptatum, vero dicunt dissentiunt eum et, adhuc iisque vis no. Eu suavitate conten tiones definitionem mel, ex vide.', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">With the new year underway, it\'s a great time to take stock of your finances and plan for the future. If you\'re looking to maximize your investments in 2023, here are some tips and strategies to help you get started.</p>\r\n<ol style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"box-sizing: border-box;\">Diversify your portfolio: Don\'t put all your eggs in one basket. Spread your investments across different assets, such as stocks, bonds, real estate, and commodities, to reduce your overall risk.</li>\r\n<li style=\"box-sizing: border-box;\">Consider index funds: Index funds are a great way to gain exposure to the stock market without having to pick individual stocks. They offer low fees and broad diversification, making them a good choice for long-term investing.</li>\r\n<li style=\"box-sizing: border-box;\">Stay invested for the long term: Don\'t get caught up in short-term market fluctuations. Stick to your investment plan and remain invested for the long term, even during periods of market volatility.</li>\r\n<li style=\"box-sizing: border-box;\">Monitor your investments regularly: Keep a close eye on your investments and re-balance your portfolio as needed to ensure that you are aligned with your investment goals.</li>\r\n<li style=\"box-sizing: border-box;\">Consider working with a financial advisor: If you\'re not comfortable managing your investments on your own, consider working with a financial advisor. They can provide you with personalized advice and help you make informed investment decisions.</li>\r\n<li style=\"box-sizing: border-box;\">Stay informed: Stay up to date with the latest news and trends in the financial world, so you can make informed investment decisions. Read financial news and attend investment seminars to gain a deeper understanding of the market.</li>\r\n<li style=\"box-sizing: border-box;\">Invest in yourself: Finally, remember to invest in yourself. Whether it\'s through education, training, or professional development, investing in your personal growth can pay off in the long run.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">By following these tips and strategies, you can maximize your investment returns in 2023 and beyond. Good luck!</p>', '1730446510.jpg', '2024-11-01 00:00:00', 1),
(4, 'The Top 10 Most Popular Real Estate Markets of the Year', 'b30-42e6-800a-32dfffcd83dc', 'This blog will provide you with a list of the hottest real estate markets in the country, as well as information on why they\'re so popular.', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">With the new year underway, it\'s a great time to take stock of your finances and plan for the future. If you\'re looking to maximize your investments in 2023, here are some tips and strategies to help you get started.</p>\r\n<ol style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"box-sizing: border-box;\">Diversify your portfolio: Don\'t put all your eggs in one basket. Spread your investments across different assets, such as stocks, bonds, real estate, and commodities, to reduce your overall risk.</li>\r\n<li style=\"box-sizing: border-box;\">Consider index funds: Index funds are a great way to gain exposure to the stock market without having to pick individual stocks. They offer low fees and broad diversification, making them a good choice for long-term investing.</li>\r\n<li style=\"box-sizing: border-box;\">Stay invested for the long term: Don\'t get caught up in short-term market fluctuations. Stick to your investment plan and remain invested for the long term, even during periods of market volatility.</li>\r\n<li style=\"box-sizing: border-box;\">Monitor your investments regularly: Keep a close eye on your investments and re-balance your portfolio as needed to ensure that you are aligned with your investment goals.</li>\r\n<li style=\"box-sizing: border-box;\">Consider working with a financial advisor: If you\'re not comfortable managing your investments on your own, consider working with a financial advisor. They can provide you with personalized advice and help you make informed investment decisions.</li>\r\n<li style=\"box-sizing: border-box;\">Stay informed: Stay up to date with the latest news and trends in the financial world, so you can make informed investment decisions. Read financial news and attend investment seminars to gain a deeper understanding of the market.</li>\r\n<li style=\"box-sizing: border-box;\">Invest in yourself: Finally, remember to invest in yourself. Whether it\'s through education, training, or professional development, investing in your personal growth can pay off in the long run.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">By following these tips and strategies, you can maximize your investment returns in 2023 and beyond. Good luck!</p>', '1730446603.jpg', '2024-11-01 00:00:00', 3),
(5, 'The Benefits of Working with a Good Real Estate Agent', 'b9bfc-fb30-42e6-800a-32dfffcd83dc', 'Find out why working with a real estate agent can be a game-changer when it comes to buying or selling a home. Learn about the services they provide.', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">With the new year underway, it\'s a great time to take stock of your finances and plan for</p>\r\n<ol style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; color: #212529; font-family: Roboto, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"box-sizing: border-box;\">Diversify your portfolio: Don\'t put all your eggs in one basket. Spread your investments across different assets, such as stocks, bonds, real estate, and commodities, to reduce your overall risk.</li>\r\n<li style=\"box-sizing: border-box;\">Consider index funds: Index funds are a great way to gain exposure to the stock market without having to pick individual stocks. They offer low fees and broad diversification, making them a good choice for long-term investing.</li>\r\n<li style=\"box-sizing: border-box;\">Stay invested for the long term: Don\'t get caught up in short-term market fluctuations. Stick to your investment plan and remain invested for the long term, even during periods of market volatility.</li>\r\n<li style=\"box-sizing: border-box;\">Monitor your investments regularly: Keep a close eye on your investments and re-balance your portfolio as needed to ensure that you are aligned with your investment goals.</li>\r\n<li style=\"box-sizing: border-box;\">Consider working with a financial advisor: If you\'re not comfortable managing your investments on your own, consider working with a financial advisor. They can provide you with personalized advice and help you make informed investment decisions.</li>\r\n<li style=\"box-sizing: border-box;\">Stay informed: Stay up to date with the latest news and trends in the financial world, so you can make informed investment decisions. Read financial news and attend investment seminars to gain a deeper understanding of the market.</li>\r\n<li style=\"box-sizing: border-box;\">Invest in yourself: Finally, remember to invest in yourself. Whether it\'s through education, training, or professional development, investing in your personal growth can pay off in the long run.</li>\r\n</ol>', '1730446907.jpg', '2024-11-01 08:41:47', 2);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(40) NOT NULL,
  `agent_id` int(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `feature_photo` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `bedroom` int(35) NOT NULL,
  `bathroom` int(35) NOT NULL,
  `size` varchar(200) NOT NULL,
  `floor` int(20) NOT NULL,
  `garage` int(20) NOT NULL,
  `balcony` int(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `built_year` varchar(20) NOT NULL,
  `map` varchar(255) NOT NULL,
  `is_featured` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `posted_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `agent_id`, `location_id`, `type_id`, `amenities`, `name`, `slug`, `description`, `feature_photo`, `price`, `purpose`, `bedroom`, `bathroom`, `size`, `floor`, `garage`, `balcony`, `Address`, `built_year`, `map`, `is_featured`, `status`, `posted_on`) VALUES
(9, 1, '6', '9', '1,3,6', 'Sea Side Pool', 'seaside123', 'This is a beautiful and spacious property located in a prime location. \r\nThe property boasts 3 bedrooms, 2 bathrooms, and a large living room with a fireplace. \r\nThe kitchen is fully equipped with modern appliances and plenty of storage space', '1725427194.jpg', 60000, 'Rent', 2, 2, '1200', 2, 1, 2, '	937 Jamajo Blvd, Orlando FL 32803', '2008', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-03'),
(10, 2, '1', '1', '5,4,6', 'admintest1', 'testwsswww122', 'I love this&nbsp;', '1725502796.jpg', 3000, 'Sale', 1, 2, '5000', 2, 2, 2, 'admintesting avenue lago state', '2009', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-03'),
(11, 2, '1', '1', '5,4,6,2', 'agentTest1', 'agent101', '', '1725672945.png', 3000, 'Sale', 2, 2, '300', 1, 2, 3, 'The Savator road off drive', '2006', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14469029.813646808!2d-8.988671417315121!3d27.702524706648372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7e8a6a28037bd1%3A0x7140bee3abd7f8a2!2sAlgeria!5e0!3m2!1sen!2sng!4v17247274', 'No', 'Active', '2024-10-03'),
(12, 1, '1', '1', '4,3,2', 'testing 1012', 'test233', 'The testing 1012 is in progress now', '1725755168.png', 100000, 'Sale', 2, 2, '400', 2, 1, 3, 'The Sayeyjti Lekkeie Lagos', '2008', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-03'),
(13, 1, '1', '1', '5,1,4,6', 'Uche Praise', 'priase222', '', '1725755272.png', 5000, 'Sale', 3, 2, '2', 3, 3, 1, 'Surulere Lagos', '2004', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-03'),
(15, 1, '3', '3', '5,3,6,2', 'Bachelor', 'bachelor2240', '', '1727438105.jpg', 3000, 'Sale', 2, 2, '2000', 2, 3, 1, 'GRA Fegge Housing Estate', '2006', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-03'),
(17, 1, '5', '9', '5,4,3', 'Ugo Mansion', 'mansion112', 'Ugo Mansion at victoria with merry', '1728168021.jpg', 150000, 'Rent', 1, 3, '3400', 2, 2, 2, 'Victoria Island Lagos ikeji', '2004', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-10-06'),
(18, 3, '7', '8', '1,4,2', 'Village House', 'villa3456', 'This is typical Village House with a touch of modern features and it is really good for dry season', '1733947584.jpg', 2000, 'Rent', 2, 2, '5400', 1, 1, 1, 'The estate off ogunlade drive lagos', '2002', 'Algeria = <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14469029.813646808!2d-8.988671417315121!3d27.702524706648372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7e8a6a28037bd1%3A0x7140bee3abd7f8a2!2sAlgeria!5e0!3m2!1sen!2sng!', 'Yes', 'Active', '2024-12-11'),
(19, 3, '8', '6', '4,3,7,6', 'Washington House', 'washingtom123', 'This house belongs to the former president of Nigeria. It has been newly refurnished and good to be used', '1733948154.jpg', 6000, 'Sale', 3, 3, '6000', 4, 1, 2, 'Banana island Ikeja', '2007', 'Spain = <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13330643.074773183!2d-17.597531993440512!3d35.34195650581622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc42e3783261bc8b%3A0xa6ec2c940768a3ec!2sSpain!5e0!3m2!1sen!2sng!4v17', 'Yes', 'Active', '2024-12-11'),
(20, 4, '2', '5', '5,4,3,2', 'Nice Condo in Orlando', 'condo123', 'This is not your typical kind of house. It has many features which wil be good.', '1734100507.jpg', 25000, 'Sale', 4, 2, '5900', 2, 2, 2, 'Ikeja Island, rockview hotel Lagos', '2004', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.46310642836!2d3.1191414046784316!3d6.548369373436928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1724726977', 'Yes', 'Active', '2024-12-13'),
(21, 5, '4', '7', '5,1,3,7', 'Apartment In Dallas', 'dallas123', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem odit cupiditate perferendis cum vel. Dolorem exercitationem atque et nam sint, perspiciatis pariatur reprehenderit libero ut laborum saepe veritatis dolore ea!', '1734103209.jpg', 40000, 'Sale', 2, 2, '26000', 2, 1, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing', '2007', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127083.59928298678!2d6.99114920450034!3d5.513096112792103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104259980202a4a1%3A0x2b97fd8924660eb1!2sOwerri%2C%20Imo!5e0!3m2!1sen!2sng!4v17', 'Yes', 'Active', '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `property_photo`
--

CREATE TABLE `property_photo` (
  `id` int(20) NOT NULL,
  `property_id` int(30) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_photo`
--

INSERT INTO `property_photo` (`id`, `property_id`, `photo`) VALUES
(11, 9, '1727982324.jpg'),
(12, 9, '1727982345.jpg'),
(13, 18, '1733947963.jpg'),
(14, 18, '1733947979.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_video`
--

CREATE TABLE `property_video` (
  `id` int(20) NOT NULL,
  `property_id` int(30) NOT NULL,
  `video_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_video`
--

INSERT INTO `property_video` (`id`, `property_id`, `video_id`) VALUES
(10, 9, '1X7OHIeRZPg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` text NOT NULL,
  `hero_heading` text NOT NULL,
  `hero_subheading` text NOT NULL,
  `hero_photo` text NOT NULL,
  `favicon` text NOT NULL,
  `banner` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `copyright` text NOT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `linkedln` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `map` text NOT NULL,
  `featured_property_heading` text NOT NULL,
  `featured_property_subheading` text NOT NULL,
  `featured_property_status` text NOT NULL,
  `why_choose_heading` text NOT NULL,
  `why_choose_subheading` text NOT NULL,
  `why_choose_photo` text NOT NULL,
  `why_choose_status` text NOT NULL,
  `agent_heading` text NOT NULL,
  `agent_subheading` text NOT NULL,
  `agent_status` text NOT NULL,
  `location_heading` text NOT NULL,
  `location_subheading` text NOT NULL,
  `location_status` text NOT NULL,
  `news_heading` text NOT NULL,
  `news_subheading` text NOT NULL,
  `news_status` text NOT NULL,
  `testimonial_heading` text NOT NULL,
  `testimonial_photo` text NOT NULL,
  `testimonial_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `hero_heading`, `hero_subheading`, `hero_photo`, `favicon`, `banner`, `address`, `email`, `phone`, `copyright`, `facebook`, `twitter`, `youtube`, `linkedln`, `instagram`, `map`, `featured_property_heading`, `featured_property_subheading`, `featured_property_status`, `why_choose_heading`, `why_choose_subheading`, `why_choose_photo`, `why_choose_status`, `agent_heading`, `agent_subheading`, `agent_status`, `location_heading`, `location_subheading`, `location_status`, `news_heading`, `news_subheading`, `news_status`, `testimonial_heading`, `testimonial_photo`, `testimonial_status`) VALUES
(1, 'logo.png', 'Discover Your New Home ', 'You can get your desired awesome properties, homes, condos etc. here by name, category or location. ', 'hero_photo.jpg', 'favicon.png', 'banner_photo.jpg', '34 Antiger Lane, USA, 12937', 'contact@arefindev.com', '122-222-1212', 'Copyright 2023, ArefinDev. All Rights Reserved.', '', '', 'www.youtube.com', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31707.9610043545!2d3.3443373416107782!3d6.585207030236199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b928a57aaee0b%3A0x9aee0609fd186a84!2sOjota%2C%20Lagos!5e0!3m2!1sen!2sng!4v1733280137399!5m2!1sen!2sng\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Featured Properties ', 'Find out the awesome properties that you must love ', 'Show', 'Why Choose Us ', 'Describing why we are best in the property business ', 'why_choose.jpg', 'Show', 'Agents', 'Meet our expert property agents from the following list ', 'Show', 'Locations ', 'Check out all the properties of important locations ', 'Show', 'Latest News ', 'Check our latest news from the following section ', 'Show', 'Our Happy Clients ', 'testimonial_photo.jpg', 'Show');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `token` text NOT NULL,
  `status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`, `status`) VALUES
(3, 'bensonvictor@gmail.com', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_privacy_items`
--

CREATE TABLE `terms_privacy_items` (
  `id` int(11) NOT NULL,
  `terms` text NOT NULL,
  `privacy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_privacy_items`
--

INSERT INTO `terms_privacy_items` (`id`, `terms`, `privacy`) VALUES
(1, '<h4>Introduction&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Welcome to ArefinDev (the \"Company\"). The following terms and conditions (the \"Terms\") govern your use of our website, products, and services (collectively referred to as the \"Services\"). By accessing or using our Services, you agree to be bound by these Terms and our Privacy Policy, which is incorporated into these Terms. If you do not agree to these Terms, you may not use our Services.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<h4>Use of Service</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp;You may use our Services only for lawful purposes and in accordance with these Terms. You agree not to use our Services:</p>\r\n<ul>\r\n<li>In any way that violates any applicable federal, state, local, or international law or regulation.</li>\r\n</ul>\r\n<ul>\r\n<li>For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way by exposing them to inappropriate content, asking for personally identifiable information, or otherwise.</li>\r\n</ul>\r\n<ul>\r\n<li>To transmit, or procure the sending of, any advertising or promotional material, including any \"junk mail,\" \"chain letter,\" \"spam,\" or any other similar solicitation.</li>\r\n</ul>\r\n<ul>\r\n<li>To impersonate or attempt to impersonate the Company, a Company employee, another user, or any other person or entity.</li>\r\n</ul>\r\n<ul>\r\n<li>To use, display, mirror, or frame the Services, or any individual element within the Services, the Company\'s name, trademark, logo, or other proprietary information, or the layout and design of any page or form contained on a page, without the Company\'s express written consent.</li>\r\n</ul>\r\n<h4>Intellectual Property</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;The Services and its entire contents, features, and functionality (including but not limited to all information, software, text, displays, images, video, and audio, and the design, selection, and arrangement thereof), are owned by the Company, its licensors, or other providers of such material and are protected by United States and international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws. These Terms permit you to use the Services for your personal, non-commercial use only. You hereby acknowledge that any unauthorized use may violate such laws and the Terms.&nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<h4>Disclaimer of Warranties</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; THE SERVICES ARE PROVIDED \"AS IS\" WITHOUT WARRANTY OF ANY KIND. THE COMPANY DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. THE COMPANY DOES NOT WARRANT THAT THE FUNCTIONS CONTAINED IN THE SERVICES WILL BE UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED, OR THAT THE SERVICES OR THE SERVER THAT MAKES THE SERVICES AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.</p>\r\n<h4>Limitation of Liability</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; IN NO EVENT WILL THE COMPANY BE LIABLE FOR ANY INDIRECT, INCIDENTAL, PUNITIVE, EXEMPLARY, OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, LOSS OF USE, LOSS OF DATA, OR COSTS OF PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES, HOWEVER CAUSED AND UNDER ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THE SERVICES, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<h4>Indemnification</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; You agree to indemnify, defend, and hold harmless</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '<h4>Introduction</h4>\r\n<p>&nbsp; &nbsp; &nbsp; At ArefinDev, we are committed to protecting your privacy and personal information. This Privacy Policy (the \"Policy\") explains how we collect, use, and disclose your personal information when you use our website and related services (collectively, the \"Services\"). By using our Services, you agree to the collection, use, and disclosure of your personal information as described in this Policy.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<h4>Information Collection&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h4>\r\n<p>We collect information about you in various ways when you use our Services. This may include: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<ul>\r\n<li>Information you provide directly: We collect information that you provide to us directly, such as your name, email address, and other contact information.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Information we collect automatically: We collect information about your use of our Services automatically, such as your IP address, browser type, and device information.&nbsp;</li>\r\n</ul>\r\n<h4>Use of Information</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; We use the information we collect about you for the following purposes:&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<ul>\r\n<li>To provide the Services: We use your information to provide the Services to you.</li>\r\n</ul>\r\n<ul>\r\n<li>To improve the Services: We use your information to understand how you use our Services and to improve them.</li>\r\n</ul>\r\n<ul>\r\n<li>To communicate with you: We use your information to communicate with you, such as to respond to your inquiries and send you updates about the Services.</li>\r\n</ul>\r\n<h4>Disclosure of Information</h4>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp;We do not sell, rent, or otherwise disclose your personal information to third parties, except as described in this Policy. We may share your information with:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<ul>\r\n<li>Service providers: We may share your information with service providers who perform services on our behalf, such as hosting, data analysis, and customer support.</li>\r\n</ul>\r\n<ul>\r\n<li>Legal reasons: We may disclose your information if we believe it is necessary to comply with a law, regulation, legal process, or government request.</li>\r\n</ul>\r\n<h4>Security</h4>\r\n<p>We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. However, no security measures are perfect or impenetrable and we cannot guarantee the security of your personal information.&nbsp; &nbsp; &nbsp;</p>\r\n<h4>Changes to this Policy</h4>\r\n<p>We may update this Policy from time to time. If we make any material changes, we will notify you by email or by posting a notice on our website. Your continued use of our Services after we have notified you of any changes to this Policy indicates your acceptance of the changes.</p>\r\n<h4>Contact Us</h4>\r\n<p>If you have any questions or concerns about this Policy, please contact us at arefindev@gmail.com</p>');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `comment`, `photo`) VALUES
(1, 'Sal Harvey', 'Director, DEF Company', ' I had the pleasure of working with Smith Brent during my recent home search and I can\'t speak highly enough of their services. Smith Brent listened to my needs and helped me find the perfect home tha', '1730388532.jpg'),
(2, 'Robert Krol 2', 'CEO, ABC Company', 'I recently worked with Patrick Johnson on purchasing my dream home and I couldn\'t have asked for a better experience. Patrick Johnson was knowledgeable, professional, and truly cared about finding me ', '1730390457.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Apartment'),
(3, 'Bungalow'),
(4, 'Cabin'),
(5, 'Codon'),
(6, 'Cottage'),
(7, 'Duplex'),
(8, 'Town House'),
(9, 'Villa');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_items`
--

CREATE TABLE `why_choose_items` (
  `id` int(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `why_choose_items`
--

INSERT INTO `why_choose_items` (`id`, `heading`, `text`, `icon`) VALUES
(1, 'Years of Experience', 'With decades of combined experience in the industry, our agents have the expertise and knowledge to provide you with a seamless home-buying experience.', 'fas fa-briefcase'),
(2, 'Competitive Prices', 'We understand that buying a home is a significant investment, which is why we strive to offer competitive prices to our clients.', 'fas fa-search'),
(3, 'Responsive Communication', 'Our responsive agents are here to answer your questions and address your concerns, ensuring a smooth and stress-free home-buying experience.', 'fas fa-share-alt');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(20) NOT NULL,
  `customer_id` varchar(256) NOT NULL,
  `property_id` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `customer_id`, `property_id`) VALUES
(1, '3', '9'),
(2, '3', '12'),
(3, '3', '17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_replies`
--
ALTER TABLE `message_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_photo`
--
ALTER TABLE `property_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_video`
--
ALTER TABLE `property_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_privacy_items`
--
ALTER TABLE `terms_privacy_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_items`
--
ALTER TABLE `why_choose_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message_replies`
--
ALTER TABLE `message_replies`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `property_photo`
--
ALTER TABLE `property_photo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `property_video`
--
ALTER TABLE `property_video`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `terms_privacy_items`
--
ALTER TABLE `terms_privacy_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `why_choose_items`
--
ALTER TABLE `why_choose_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
