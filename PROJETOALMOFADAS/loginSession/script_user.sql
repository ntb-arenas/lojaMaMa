-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 07:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `projetoalmo`
--

-- --------------------------------------------------------

--
-- Table structure for table `back_product`
--

CREATE TABLE `back_product` (
  `CODE` varchar(30) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `back_product`
--

INSERT INTO `back_product` (`CODE`, `DESCRIPTION`) VALUES
('AZ', 'Azul'),
('CA', 'Castanho'),
('LA', 'Laranja');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CODE` varchar(10) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `SEQUENCE` int(10) NOT NULL,
  `VISIBLE` int(2) NOT NULL,
  `LINK` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CODE`, `TITLE`, `SEQUENCE`, `VISIBLE`, `LINK`) VALUES
('AAC', 'ALMOFADAS ANTI-CÓLICAS', 7, 1, '#'),
('AAM', 'ALMOFADAS DE AMAMENTAÇÃO', 2, 2, '#'),
('CS', 'CUNHAS', 3, 1, 'cunhas.php'),
('KM', 'KIT MATERNIDADE', 5, 1, '#'),
('MF', 'MUDA FRALDAS', 6, 1, '#'),
('PROM', 'PROMOÇÕES', 1, 0, '#'),
('SL', 'SLINGS', 4, 1, '#');

-- --------------------------------------------------------

--
-- Table structure for table `front_product`
--

CREATE TABLE `front_product` (
  `CODE` varchar(30) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `front_product`
--

INSERT INTO `front_product` (`CODE`, `DESCRIPTION`) VALUES
('BS', 'Balões'),
('FLVE', 'Flores Verde'),
('RLS', 'Riscas Largas');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORDER_ID` int(5) NOT NULL,
  `CUSTOMER_ID` int(5) NOT NULL,
  `PRODUCT_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ORDER_ID`, `CUSTOMER_ID`, `PRODUCT_ID`) VALUES
(123, 101, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `SKU` varchar(30) NOT NULL,
  `PRODUCT_TYPE` varchar(50) NOT NULL,
  `PRODUCT_NAME` varchar(50) NOT NULL,
  `FRONT_PRODUCT` varchar(50) NOT NULL,
  `BACK_PRODUCT` varchar(50) NOT NULL,
  `SIZE` varchar(20) NOT NULL,
  `PRICE` int(5) NOT NULL,
  `IVA_CODE` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`SKU`, `PRODUCT_TYPE`, `PRODUCT_NAME`, `FRONT_PRODUCT`, `BACK_PRODUCT`, `SIZE`, `PRICE`, `IVA_CODE`) VALUES
('AMA/Al-AzGr', 'AMA', 'Almofada de Amamentação', 'FLVE', 'AZ', 'Grande', 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `fNAME` varchar(200) NOT NULL,
  `lNAME` varchar(200) NOT NULL,
  `MORADA` varchar(200) DEFAULT NULL,
  `COD_POSTAL` varchar(8) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `PAIS` varchar(100) DEFAULT NULL,
  `TELEMOVEL` varchar(9) DEFAULT NULL,
  `USER_LEVEL` int(11) NOT NULL DEFAULT 0,
  `USER_STATUS` int(11) NOT NULL DEFAULT 0,
  `TOKEN_CODE` varchar(200) DEFAULT NULL,
  `MSGS_MARKETING` int(11) NOT NULL DEFAULT 0,
  `DATE_HOUR` varchar(100) NOT NULL DEFAULT '2022-05-20 01:10:38'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `fNAME`, `lNAME`, `MORADA`, `COD_POSTAL`, `CIDADE`, `PAIS`, `TELEMOVEL`, `USER_LEVEL`, `USER_STATUS`, `TOKEN_CODE`, `MSGS_MARKETING`, `DATE_HOUR`) VALUES
(100, 'vinoeeee', 'vinoarenas78@gmail.com', '$2y$10$ucnsrAPqVxD5aVcnZsXsi.iPBTgFsg3qnDnjOqJnDGDG5v07eGXZ6', 'Vino', 'Vino', NULL, NULL, NULL, NULL, NULL, 1, 0, 'ad1b85ba42318f6ac9d74c7971dfbfe7', 1, '2022-05-20 01:14:53'),
(101, 'saddd', 'vinoarenas78@gmail.com', '$2y$10$l0KTWBgQc/L7EpStWig3iOIw.QIhN0yhnGbsh5zIihdzcko9tjnJ.', 'Vino', 'Vino', NULL, NULL, NULL, NULL, NULL, 1, 0, 'b53cc1c82c173b7c6e01b4312fba3728', 1, '2022-05-20 01:15:21'),
(102, 'vino', 'vinoarenas78@gmail.com', '$2y$10$vViEA.PHByyQ1vH.5tlrYO5VglLdfkSYuhVD6GCC3/dy2mnfGNo/6', 'Vino', 'Arenas', 'Rua Particular N1 1RP CV/Dta', '1070-273', 'Lisboa', 'Portugal', '934266673', 1, 1, 'e814c35b8c340c182536dacdc60a3cc3', 1, '2022-05-20 09:58:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `back_product`
--
ALTER TABLE `back_product`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `front_product`
--
ALTER TABLE `front_product`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `Customer_ID_FK` (`CUSTOMER_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`SKU`),
  ADD KEY `CODE_FRONT_PROD` (`FRONT_PRODUCT`),
  ADD KEY `CODE_BACK_PROD` (`BACK_PRODUCT`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Customer_ID_FK` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `CODE_BACK_PROD` FOREIGN KEY (`BACK_PRODUCT`) REFERENCES `back_product` (`CODE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CODE_FRONT_PROD` FOREIGN KEY (`FRONT_PRODUCT`) REFERENCES `front_product` (`CODE`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
