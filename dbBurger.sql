

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `burger`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(20) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `phone`) VALUES
(1, 'Vladimir', 'vlakuva@mail.ru', ''),
(2, 'кевин', 'gike@spindl-e.com', '+7 (921) 121 51 78'),
(7, 'Валерий', 'val126@mail.ru', '+7 (952) 921 35 16'),
(8, 'Николай', 'new@mail.com', '+7 (231) 689 84 45'),
(9, 'Инокентий', 'ino@mail.ru', '+7 (259) 486 87 46'),
(10, 'Инокентий', 'vladimir_kuvanov@mail.ru', '+7 (259) 486 87 46'),
(12, 'Инокентий', 'vovan986021@gmail.com', '+7 (259) 486 87 46'),
(13, 'кевин', 'andrykoznov@gmail.com', '+7 (326) 597 45 46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `details`) VALUES
(1, NULL, 'Садовая, д 27 кв 24', 'Не звонить в домофон'),
(2, NULL, 'Ул.Садовая,Дом 27,Корпус , Квартира 24,Этаж 2', ''),
(3, NULL, 'Ул.Уханова,Дом 5,Корпус , Квартира 5,Этаж 2', 'не звонить в домофон'),
(4, NULL, 'Ул.Уханова,Дом 5,Корпус , Квартира 5,Этаж 2', 'не звонить в домофон'),
(5, 1, 'Ул.Уханова,Дом 5,Корпус , Квартира 5,Этаж 2', 'не звонить в домофон'),
(6, NULL, 'Ул.Уханова,Дом 5,Корпус , Квартира 5,Этаж 2', 'не звонить в домофон'),
(7, 12, 'Ул.Уханова,Дом 5,Корпус , Квартира 5,Этаж 2', 'не звонить в домофон');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
