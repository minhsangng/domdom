-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 10:48 PM
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
-- Database: `domdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(5) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `blackList` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `phoneNumber`, `fullName`, `address`, `email`, `blackList`) VALUES
(1, '0901111222', 'Nguyễn Văn Khánh', 'Gò Vấp', 'vankhanh@gmail.com', 0),
(2, '0923654272', 'Lê Văn Minh', 'Gò Vấp', 'vanminh@gmail.com', 0),
(3, '0901165242', 'Châu Minh Kiệt', 'Gò Vấp', 'minhkiet@gmail.com', 0),
(4, '0901652544', 'Nguyễn Hoài Khang', 'Gò Vấp', 'hoaikhang@gmail.com', 0),
(5, '0935626694', 'Lê Minh Ân', 'Gò Vấp', 'minhan@gmail.com', 0),
(6, '0935126953', 'Nguyễn Vân An', 'Gò Vấp', 'vanan@gmail.com', 0),
(7, '0961162542', 'Phạm Hữu Phước', 'Gò Vấp', 'huuphuoc@gmail.com', 0),
(8, '0995642351', 'Nguyễn Lê Hoài', 'Gò Vấp', 'lehoai@gmail.com', 0),
(9, '0926548523', 'Trần Thị Mai', 'Gò Vấp', 'thimai@gmail.com', 0),
(10, '0945265284', 'Lê Thị Huỳnh Hoa', 'Gò Vấp', 'quynhhoa@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `dishID` int(5) NOT NULL,
  `dishName` varchar(100) NOT NULL,
  `dishCategory` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `businessStatus` int(1) NOT NULL DEFAULT 1,
  `availabilityStatus` int(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `preparationProcess` text DEFAULT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dishID`, `dishName`, `dishCategory`, `price`, `businessStatus`, `availabilityStatus`, `description`, `preparationProcess`, `image`) VALUES
(1, 'Gà rán', 'Gà rán', 30000.00, 1, 1, 'Món gà rán giòn thơm ngon', 'Chiên gà bằng nồi chiên 180 độ C trong 15 phút đến khi lớp da giòn', 'garan.png'),
(2, 'Gà rán sốt cay', 'Gà rán', 30000.00, 1, 1, 'Món gà rán giòn thơm ngon, cay nồng', '', 'garansotcay.png'),
(3, 'Gà rán sốt phô mai', 'Gà rán', 30000.00, 1, 1, 'Món gà rán giòn thơm ngon, phô mai béo ngậy', NULL, 'garansotphomai.png'),
(4, 'Burger gà', 'Burger/cơm', 28000.00, 1, 1, 'Burger gà đặc biệt với nước sốt đặc trưng', NULL, 'burgerga.png'),
(5, 'Burger bò', 'Burger/cơm', 28000.00, 1, 1, 'Burger bò đặc biệt với nước sốt đặc trưng', NULL, 'burgerbo.png'),
(6, 'Mỳ Ý sốt bò bằm', 'Mỳ Ý', 35000.00, 1, 1, 'Món mỳ Ý với sốt bò bằm và phô mai', NULL, 'miysotbobam.png'),
(7, 'Mỳ Ý sốt cà chua', 'Mỳ Ý', 32000.00, 1, 1, 'Món mỳ Ý với sốt cà chua', NULL, 'miysotcachua.png'),
(8, 'Khoai tây chiên', 'Ăn kèm', 15000.00, 1, 1, 'Khoai tây chiên giòn, thơm ngon', NULL, 'khoaitaychien'),
(9, 'Khoai tây chiên BBQ', 'Ăn kèm', 18000.00, 1, 1, 'Khoai tây chiên giòn, thơm ngon vị BBQ', NULL, 'khoaitaychienbbq'),
(10, 'Gà viên chiên', 'Ăn kèm', 30000.00, 1, 1, 'Gà viên chiên giòn ngon miệng', NULL, 'gavienchien.png'),
(11, 'Cơm gà giòn cay', 'Burger/cơm', 35000.00, 1, 1, 'Cơm gà giòn cay kèm sốt đặc biệt', NULL, 'comgagioncay.png'),
(12, 'Cơm thịt heo chiên', 'Burger/cơm', 35000.00, 1, 1, 'Cơm thịt heo chiên kèm sốt đặc biệt', 'Thịt heo chiên vừa chín tới, rưới nước sốt đặc biệt, ăn cùng với cơm', 'comthitheochien.png'),
(13, 'Kem sữa tươi', 'Tráng miệng', 7000.00, 1, 1, 'Kem sữa tươi thơm béo vị sữa', NULL, 'kemsuatuoi.png'),
(14, 'Kem sữa dâu', 'Tráng miệng', 10000.00, 1, 1, 'Kem dâu mát lạnh thơm vị sữa', NULL, 'kemsuadau.png'),
(15, 'Coca-cocla', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt', NULL, 'cocacola.png'),
(16, 'Pepsi', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt', NULL, 'pepsi.png'),
(17, 'Milo', 'Thức uống', 15000.00, 1, 1, 'Sữa milo lúa mạch', NULL, 'milo.png');

-- --------------------------------------------------------

--
-- Table structure for table `dish_ingredient`
--

CREATE TABLE `dish_ingredient` (
  `dishID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

CREATE TABLE `employee_shift` (
  `employeeshiftID` int(5) NOT NULL,
  `shiftID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_shift`
--

INSERT INTO `employee_shift` (`employeeshiftID`, `shiftID`, `userID`, `date`, `status`) VALUES
(1, 1, 6, '2024-10-15', 0),
(2, 2, 11, '2024-10-15', 0),
(3, 1, 7, '2024-10-16', 0),
(4, 2, 12, '2024-10-16', 0),
(5, 1, 8, '2024-10-17', 0),
(6, 2, 13, '2024-10-17', 0),
(7, 1, 9, '2024-10-18', 0),
(8, 2, 14, '2024-10-18', 0),
(9, 1, 10, '2024-10-19', 0),
(10, 2, 15, '2024-10-19', 0),
(11, 1, 6, '2024-10-20', 0),
(12, 2, 11, '2024-10-20', 0),
(13, 1, 7, '2024-10-21', 0),
(14, 2, 12, '2024-10-21', 0),
(15, 1, 8, '2024-10-22', 1),
(16, 2, 13, '2024-10-22', 0),
(17, 1, 9, '2024-10-23', 0),
(18, 2, 14, '2024-10-23', 0),
(19, 1, 10, '2024-10-24', 0),
(20, 2, 15, '2024-10-24', 0),
(24, 1, 11, '2024-10-23', 0),
(25, 2, 16, '2024-10-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `importorder`
--

CREATE TABLE `importorder` (
  `importOrderID` int(5) NOT NULL,
  `importOrderDate` date NOT NULL DEFAULT current_timestamp(),
  `importDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredientID` int(5) NOT NULL,
  `ingredientName` varchar(100) NOT NULL,
  `unitOfcalculaton` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `typeIngredient` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `ingredientName`, `unitOfcalculaton`, `price`, `typeIngredient`, `status`) VALUES
(6, 'Thịt gà', 'kg', 80000.00, 'Thịt', 1),
(7, 'Bột chiên', 'gram', 15000.00, 'Gia vị', 1),
(8, 'Dầu ăn', 'chai', 40000.00, 'Gia vị', 1),
(9, 'Sốt cay', 'ml', 15000.00, 'Gia vị', 1),
(10, 'Phô mai', 'gram', 30000.00, 'Gia vị', 1),
(11, 'Bánh burger', 'cái', 5000.00, 'Bánh mì', 1),
(12, 'Rau xà lách', 'gram', 2000.00, 'Rau củ', 1),
(13, 'Sốt mayonnaise', 'chai', 20000.00, 'Gia vị', 1),
(14, 'Thịt bò', 'kg', 12000.00, 'Thịt', 1),
(15, 'Khoai tây', 'gram', 10000.00, 'Rau củ', 1),
(16, 'Muối', 'gram', 20000.00, 'Gia vị', 1);

-- --------------------------------------------------------

--
-- Table structure for table `needingingredient`
--

CREATE TABLE `needingingredient` (
  `importOrderID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(5) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `subTotal` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `sumOfQuantity` int(10) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `customerID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `orderDate`, `subTotal`, `total`, `sumOfQuantity`, `paymentMethod`, `note`, `status`, `customerID`) VALUES
(1, '2024-10-22', 0.00, 150000.00, 6, 'Tiền mặt', NULL, 1, 1),
(2, '2024-10-22', 0.00, 120000.00, 4, 'Thẻ', NULL, 0, 2),
(3, '2024-10-23', 0.00, 30000.00, 2, 'Thẻ', NULL, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_dish`
--

CREATE TABLE `order_dish` (
  `orderID` int(5) NOT NULL,
  `dishID` int(5) NOT NULL,
  `quantity` int(10) NOT NULL,
  `totalPrice` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order_dish`
--

INSERT INTO `order_dish` (`orderID`, `dishID`, `quantity`, `totalPrice`) VALUES
(1, 1, 4, 120000.00),
(1, 16, 2, 30000.00),
(2, 2, 4, 120000.00),
(3, 8, 2, 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `partypackage`
--

CREATE TABLE `partypackage` (
  `partyPackageID` int(5) NOT NULL,
  `partyPackageName` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `decoration` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partypackage`
--

INSERT INTO `partypackage` (`partyPackageID`, `partyPackageName`, `price`, `image`, `decoration`) VALUES
(1, 'Gói tiệc sinh nhật', 500000.00, 'sinhnat.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `partypackage_dish`
--

CREATE TABLE `partypackage_dish` (
  `partyPackageID` int(5) NOT NULL,
  `dishID` int(5) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotionID` int(5) NOT NULL,
  `promotionName` varchar(100) NOT NULL,
  `discountPercentage` decimal(5,2) NOT NULL,
  `startDate` date NOT NULL DEFAULT current_timestamp(),
  `endDate` date NOT NULL DEFAULT current_timestamp(),
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotionID`, `promotionName`, `discountPercentage`, `startDate`, `endDate`, `description`, `image`, `status`) VALUES
(1, 'Giảm 20%  thức uống', 20.00, '2024-10-21', '2024-10-27', 'Giảm 20% các loại thức uống cho tất cả cửa hàng', 'giamthucuong.png', 0),
(2, 'Ưu đãi khai trương', 45.00, '2024-10-21', '2024-10-27', 'Mừng khai trương cửa hàng thứ 5, giảm 45% tất cả mặt hàng', 'uudaikhaitruong.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `proposalID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `typeOfProposal` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`proposalID`, `userID`, `typeOfProposal`, `content`, `status`) VALUES
(1, 2, 'Đề xuất khác', 'Đổi quản lý', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(5) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleName`) VALUES
(1, 'Quản lý chuỗi cửa hàng'),
(2, 'Quản lý cửa hàng'),
(3, 'Nhân viên nhận đơn'),
(4, 'Nhân viên bếp');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shiftID` int(5) NOT NULL,
  `shiftName` varchar(50) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shiftID`, `shiftName`, `startTime`, `endTime`) VALUES
(1, 'Ca Sáng', '08:00:00', '14:00:00'),
(2, 'Ca Chiều', '14:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `storeID` int(5) NOT NULL,
  `storeName` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`storeID`, `storeName`, `address`, `contact`, `status`) VALUES
(1, 'Cửa hàng Đom Đóm 1', 'Gò Vấp - Đường 1', '0935624892', 1),
(2, 'Cửa hàng Đom Đóm 2', 'Gò Vấp - Đường 2', '0935625462', 1),
(3, 'Cửa hàng Đom Đóm 3', 'Gò Vấp - Đường 3', '0965232245', 1),
(4, 'Cửa hàng Đom Đóm 4', 'Gò Vấp - Đường 4', '0965254656', 1),
(5, 'Cửa hàng Đom Đóm 5', 'Gò Vấp - Đường 5', '0955848886', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_ingredient`
--

CREATE TABLE `store_ingredient` (
  `storeID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `quantityInStock` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `roleID` int(5) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateBirth` date NOT NULL DEFAULT current_timestamp(),
  `sex` int(1) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `roleID`, `userName`, `email`, `password`, `dateBirth`, `sex`, `phoneNumber`, `image`, `status`) VALUES
(1, 1, 'Nguyễn Văn An', 'admin@domdom.com', 'pass', '1985-01-01', 1, '0901234567', 'admin.jpg', 1),
(2, 2, 'Trần Thị Bình', 'manager1@domdom.com', 'pass', '1990-05-10', 0, '0902234567', 'manager1.jpg', 1),
(3, 2, 'Lê Văn Cường', 'manager2@domdom.com', 'pass', '1991-08-12', 1, '0903234567', 'manager2.jpg', 1),
(4, 2, 'Phạm Thị Duyên', 'manager3@domdom.com', 'pass', '1992-09-22', 0, '0904234567', 'manager3.jpg', 1),
(5, 2, 'Hoàng Văn En', 'manager4@domdom.com', 'pass', '1993-07-15', 1, '0905234567', 'manager4.jpg', 1),
(6, 2, 'Nguyễn Tấn Phát', 'manager5@domdom.com', 'pass', '1993-07-15', 1, '0936594213', 'manager5.jpg', 1),
(7, 3, 'Trần Thị Giang', 'seller2@domdom.com', 'pass', '1996-11-11', 0, '0907234567', 'seller2.jpg', 1),
(8, 3, 'Lê Minh Hùng', 'seller3@domdom.com', 'pass', '1995-12-05', 1, '0902654927', 'seller3.jpg', 1),
(9, 3, 'Trần Cao Cương', 'seller4@domdom.com', 'pass', '1997-07-01', 1, '0952564925', 'seller4.jpg', 1),
(10, 3, 'Trần Thanh Thy', 'seller5@domdom.com', 'pass', '1999-10-23', 0, '0902645641', 'seller5.jpg', 1),
(11, 3, 'Nguyễn Văn Phát', 'seller1@domdom.com', 'pass', '1995-04-05', 1, '0906234567', 'seller1.jpg', 1),
(12, 4, 'Nguyễn Mạnh Hưng', 'cook2@domdom.com', 'pass', '1994-02-20', 1, '0926548527', 'cook2.jpg', 1),
(13, 4, 'Lê Minh Ân', 'cook3@domdom.com', 'pass', '1994-11-08', 1, '0902654232', 'cook3.jpg', 1),
(14, 4, 'Châu Khả Ái', 'cook4@domdom.com', 'pass', '1995-02-26', 0, '0926549527', 'cook4.jpg', 1),
(15, 4, 'Phạm Thị Yến', 'cook5@domdom.com', 'pass', '1998-04-29', 0, '0995642367', 'cook5.jpg', 0),
(16, 4, 'Lê Văn Hưng', 'cook1@domdom.com', 'pass', '1994-01-31', 1, '0908234567', 'cook1.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`dishID`),
  ADD UNIQUE KEY `dishName` (`dishName`);

--
-- Indexes for table `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD PRIMARY KEY (`dishID`,`ingredientID`);

--
-- Indexes for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD PRIMARY KEY (`employeeshiftID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `importorder`
--
ALTER TABLE `importorder`
  ADD PRIMARY KEY (`importOrderID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`);

--
-- Indexes for table `needingingredient`
--
ALTER TABLE `needingingredient`
  ADD PRIMARY KEY (`ingredientID`,`importOrderID`),
  ADD KEY `importOrderID` (`importOrderID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `order_dish`
--
ALTER TABLE `order_dish`
  ADD KEY `dishID` (`dishID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `orderID_2` (`orderID`) USING BTREE;

--
-- Indexes for table `partypackage`
--
ALTER TABLE `partypackage`
  ADD PRIMARY KEY (`partyPackageID`),
  ADD UNIQUE KEY `price` (`price`);

--
-- Indexes for table `partypackage_dish`
--
ALTER TABLE `partypackage_dish`
  ADD KEY `dishID` (`dishID`),
  ADD KEY `partyPackageID` (`partyPackageID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotionID`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`proposalID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shiftID`),
  ADD UNIQUE KEY `shiftName` (`shiftName`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeID`);

--
-- Indexes for table `store_ingredient`
--
ALTER TABLE `store_ingredient`
  ADD PRIMARY KEY (`storeID`,`ingredientID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `dishID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `employee_shift`
--
ALTER TABLE `employee_shift`
  MODIFY `employeeshiftID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `importorder`
--
ALTER TABLE `importorder`
  MODIFY `importOrderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `partypackage`
--
ALTER TABLE `partypackage`
  MODIFY `partyPackageID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `proposalID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shiftID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD CONSTRAINT `dish_ingredient_ibfk_1` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `needingingredient`
--
ALTER TABLE `needingingredient`
  ADD CONSTRAINT `needingingredient_ibfk_1` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`),
  ADD CONSTRAINT `needingingredient_ibfk_2` FOREIGN KEY (`importOrderID`) REFERENCES `importorder` (`importOrderID`);

--
-- Constraints for table `order_dish`
--
ALTER TABLE `order_dish`
  ADD CONSTRAINT `order_dish_ibfk_1` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`),
  ADD CONSTRAINT `order_dish_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`);

--
-- Constraints for table `partypackage_dish`
--
ALTER TABLE `partypackage_dish`
  ADD CONSTRAINT `partypackage_dish_ibfk_1` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`),
  ADD CONSTRAINT `partypackage_dish_ibfk_2` FOREIGN KEY (`partyPackageID`) REFERENCES `partypackage` (`partyPackageID`);

--
-- Constraints for table `store_ingredient`
--
ALTER TABLE `store_ingredient`
  ADD CONSTRAINT `store_ingredient_ibfk_1` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
