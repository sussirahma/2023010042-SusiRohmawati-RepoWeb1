-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 07:49 PM
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
-- Database: `craftcircle_br`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `images`) VALUES
(1, 'Bracelet A', 15000.00, 25, 'BC6.png'),
(2, 'Bracelet B', 15000.00, 20, 'BC7.png'),
(3, 'Bracelet C', 15000.00, 20, 'BC9.png'),
(4, 'Bracelet D', 15000.00, 20, 'BC11.png'),
(5, 'Bracelet E', 13000.00, 12, 'BC24.png'),
(6, 'Bracelet F', 13000.00, 15, 'BC31.png'),
(7, 'Bracelet G', 13000.00, 20, 'BC25.png'),
(8, 'Bracelet H', 13000.00, 20, 'BC22.png'),
(9, 'Bracelet I', 13000.00, 20, 'BC19.png'),
(10, 'Bracelet J', 13000.00, 20, 'BC21.png'),
(11, 'Bracelet K', 13000.00, 20, 'BC23.png'),
(12, 'Bracelet L', 13000.00, 20, 'BC20.png'),
(13, 'Bracelet M', 13000.00, 20, 'BC27.png'),
(14, 'Bracelet N', 13000.00, 20, 'BC28.png'),
(15, 'Bracelet O', 13000.00, 20, 'BC30.png'),
(16, 'Bracelet P', 13000.00, 20, 'BC32.png'),
(17, 'Bracelet Q', 13000.00, 20, 'BC3.png'),
(18, 'Bracelet R', 13000.00, 20, 'BC2.png'),
(19, 'Bracelet S', 12000.00, 15, 'BC4.png'),
(20, 'Couple', 15000.00, 15, 'BC33.png'),
(21, 'Layers A', 15000.00, 15, 'BC18.png'),
(22, 'Layers B', 15000.00, 15, 'BC1.png'),
(23, 'Hanger A', 13000.00, 10, 'ST1.png'),
(24, 'Hanger B', 13000.00, 10, 'ST2.png');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `before_insert_products` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
  DECLARE last_id INT;
  SET last_id = (SELECT COALESCE(MAX(id), 0) FROM products);
  IF last_id >= 0 THEN
    SET NEW.id = last_id + 1;
  ELSE
    
    SET NEW.id = 1; 
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin1', 'arplb123@gmail.com', 'admin123', '2025-01-22 06:08:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
