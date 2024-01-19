-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2024 at 07:47 PM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u944161398_agromate`
--

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` int(11) NOT NULL,
  `unique_id` text NOT NULL,
  `farmer_name` varchar(24) NOT NULL,
  `farmer_email` varchar(256) NOT NULL,
  `farmer_address` varchar(256) NOT NULL,
  `farmer_phone` varchar(13) NOT NULL,
  `farmer_password` varchar(256) NOT NULL,
  `profile_picture` varchar(256) NOT NULL DEFAULT 'work-1.png',
  `status` text NOT NULL DEFAULT 'Offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `unique_id`, `farmer_name`, `farmer_email`, `farmer_address`, `farmer_phone`, `farmer_password`, `profile_picture`, `status`) VALUES
(1, '183631521', 'Jb', 'jb@mail.com', 'Bambili', '680484468', '$2y$10$3tVuXaeRCelGjXlq4qiIgOjw7zG/i3HA0ClEI2AMMlncQIaPQ0p1i', 'work-1.png', 'Active'),
(2, '1069513536', 'Foryoung', 'juniorngu84@gmail.com', 'Baforkum', '677802114', '$2y$10$tLloc8Bz1dWWCvHKpy5BruSlbl9WWE5cu7GiwR9IF57E2rBjTZou6', 'work-1.png', 'Active'),
(3, '892007345', 'Codee', 'codee@gmail.com', 'Bambili Up quarter', '654321089', '$2y$10$yF9XDZoAngp.CT6W6vn9vOo6FElSBtt21gmtW.ga76qQN7jonz3LS', 'work-1.png', 'Active'),
(4, '339305886', 'Akere', 'akere@gmail.com', 'Bambui', '651526975', '$2y$10$2TGyhjKwKb92IuvZyxU04.NHt0GNnsy8YeDlhRuj0IhbFEHMw5qIq', 'work-1.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_ratings`
--

CREATE TABLE `farmer_ratings` (
  `id` int(11) UNSIGNED NOT NULL,
  `farmer_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_ratings`
--

INSERT INTO `farmer_ratings` (`id`, `farmer_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 2, 3, 4, 'Top notch something. Na better mboma', '2023-05-04 21:44:34'),
(2, 1, 3, 1, '', '2023-05-04 22:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES
(1, 1133815588, 1133815588, 'Yoo Bill', '2023-05-04 11:38:06'),
(2, 892007345, 1133815588, 'Yoooo', '2023-05-04 11:43:02'),
(3, 892007345, 1133815588, 'Bill hafa', '2023-05-04 14:34:04'),
(4, 1133815588, 892007345, 'I am cool ma\'am. thanks and you?', '2023-05-04 14:38:44'),
(5, 1133815588, 1133815588, 'Where do u live', '2023-05-04 15:14:59'),
(6, 892007345, 1133815588, 'Fine thank you dude', '2023-05-04 15:18:19'),
(7, 892007345, 1133815588, 'So tell me more about your skillset', '2023-05-04 15:18:34'),
(8, 1133815588, 892007345, 'Well I\'m an HND holder in Agro Technology and crop cultivation from RCA(Regional College Of Agriculture) Bambili', '2023-05-04 15:22:45'),
(9, 892007345, 1133815588, '', '2023-05-04 15:22:55'),
(10, 1133815588, 892007345, 'Why the empty space?', '2023-05-04 15:29:24'),
(11, 892007345, 1133815588, 'Oh Error. Sorry', '2023-05-04 15:29:47'),
(12, 1133815588, 892007345, 'Mboma', '2023-05-04 15:31:34'),
(13, 1133815588, 892007345, 'Mboma', '2023-05-04 15:33:16'),
(14, 892007345, 1133815588, 'Good evening Engineer', '2023-05-04 23:34:48'),
(15, 1133815588, 892007345, 'Thanks ma\'am. Lets rendervous at 3 corners Bambili by 4pm tomorrow. Cool?', '2023-05-04 23:35:49'),
(16, 892007345, 1133815588, 'Ok cool. See you then! Stay safe', '2023-05-04 23:36:11'),
(17, 465849650, 465849650, 'Heo King Junior. Saw your post , wish to know more about you', '2023-05-05 00:07:10'),
(18, 1069513536, 465849650, 'Yoooo', '2023-05-05 00:12:10'),
(19, 465849650, 1069513536, 'Thank you Mr Foryoung. How can i help you today', '2023-05-05 00:25:17'),
(20, 1069513536, 465849650, 'Let me call you via mobile please. Be available', '2023-05-05 00:25:47'),
(21, 465849650, 1069513536, 'Ok will be waiting. Thanks', '2023-05-05 00:26:47'),
(22, 183631521, 183631521, 'Good eveing Jb Sir. Heard you are reside in Bambili. What you say we meet up. I could make you my regular supplier', '2023-05-05 15:59:19'),
(23, 1133815588, 892007345, 'No qualms. Thanks for the concern', '2023-05-06 10:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `product_image` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `product_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(30) NOT NULL,
  `farmer_name` varchar(30) NOT NULL,
  `farmer_email` varchar(30) NOT NULL,
  `farmer_phone` varchar(13) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_description` varchar(256) DEFAULT NULL,
  `product_price` int(10) NOT NULL,
  `saved_by_user_id` int(11) DEFAULT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `farmer_name`, `farmer_email`, `farmer_phone`, `product_name`, `product_description`, `product_price`, `saved_by_user_id`, `image_name`) VALUES
(7, 'Jb', 'jb@mail.com', '680484468', 'Lemon/Oranges', 'Fresh lemons, oranges and limes just for you. Get to me now', 50, NULL, '1682084138-lemonorange.jpg'),
(8, 'Jb', 'jb@mail.com', '680484468', 'American tomatoes', 'Fresh hard tomatoes for sale. Just for you', 25, NULL, '1682085233-apples.jpg'),
(12, 'Foryoung', 'juniorngu84@gmail.com', '677802114', 'Maize', 'Get your fresh/dry maize for corn fufu ', 100, NULL, '1682169648-IMG-20230422-WA0004.jpg'),
(13, 'Foryoung', 'juniorngu84@gmail.com', '677802114', 'Vegetables', 'Fresh vegetables for you mehn. Just tap in and I\'ll ship your stuff ASAP...', 1500, NULL, '1682169722-IMG-20230422-WA0005.jpg'),
(18, 'Codee', 'codee@gmail.com', '654321089', 'Open for hiring', 'I\'m open for hiring as farm supervisor or field worker. Very experienced with working with monocots', 10000, NULL, '1682264574-using-our-product.jpg'),
(19, 'Codee', 'codee@gmail.com', '654321089', 'Irish potatoes', 'Get your fresh healthy potatoe tubers for consumption and even seeds for planting', 4500, NULL, '1682264634-farm-products-iii-478590.jpg'),
(20, 'Foryoung', 'juniorngu84@gmail.com', '677802114', 'Fowls', 'Locally called \"contry fowl\" available now at steady cheap prices. Very negotiable', 2000, NULL, '1682327534-istockphoto-1342480600-170667a.jpg'),
(21, 'Foryoung', 'juniorngu84@gmail.com', '677802114', ' Cattle/Beef', 'Beef meat available. Cattle for sale alongside locally manufactured cattle milk', 1200, NULL, '1682327606-istockphoto-1303666715-170667a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `saved_products`
--

CREATE TABLE `saved_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_products`
--

INSERT INTO `saved_products` (`id`, `user_id`, `product_id`, `saved_at`) VALUES
(3, 2, 8, '2023-05-05 14:31:55'),
(4, 2, 7, '2023-05-05 15:01:28'),
(5, 1, 13, '2023-05-05 18:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` text NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_address` varchar(30) NOT NULL,
  `user_phone` varchar(13) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `profile_picture` varchar(256) DEFAULT 'work-1.png',
  `status` varchar(10) DEFAULT 'Offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `user_name`, `user_email`, `user_address`, `user_phone`, `user_password`, `profile_picture`, `status`) VALUES
(1, '465849650', 'Junior', 'junior@gmail.com', 'Baforkum', '+237677802114', '$2y$10$OQEIMoL5c7LBRBAysOUeD.vPbNckGrMX6ln1NnHmSd/ijlW82rokK', 'work-1.png', 'Active'),
(2, '80871769', 'Deman', 'deman@gmail.com', 'Bambui', '+237677802114', '$2y$10$jn/6CEEFHqAc0Yvyzc4LU.kr./yihrGZvxdjW4m7QFTnGXUhTofLS', 'work-1.png', 'Active'),
(3, '1133815588', 'Bill', 'bill@mail.com', 'Ghana Street', '678904567', '$2y$10$0qSLNrh7/Myl9DeYleVOfudcZ6BofHyBhtjcojbfFEoEUPf1IW4Ny', 'work-1.png', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `farmer_ratings`
--
ALTER TABLE `farmer_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `saved_products`
--
ALTER TABLE `saved_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmer_ratings`
--
ALTER TABLE `farmer_ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `saved_products`
--
ALTER TABLE `saved_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
