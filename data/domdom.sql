-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 11:33 AM
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
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceDate` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Gà rán'),
(2, 'Burger'),
(3, 'Mì ý'),
(4, 'Món phụ'),
(5, 'Tráng miệng'),
(6, 'Thức uống');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `blackList` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `email`, `phone`, `address`, `createdAt`, `blackList`) VALUES
(1, 'Nguyễn Vân An', 'vanan@gmail.com', '0987654321', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(2, 'Trần Thị Bình', 'thibinh@gmail.com', '0912345678', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(3, 'Lê Văn Cường', 'vancuong@gmail.com', '0925649245', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(4, 'Phan Minh Trí', 'minhtri@gmail.com', '0925649826', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(5, 'Nguyễn Hoài Ân', 'hoaian@gmail.com', '0982546957', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(6, 'Nguyễn Minh Khang', 'minhkhang@gmail.com', '0987265495', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(7, 'Lê Hoài Khang', 'hoaikhang@gmail.com', '0923264527', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(8, 'Châu Quý Khánh', 'quykhanh@gmail.com', '0995546526', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(9, 'Trần Văn Hên', 'vanhen@gmail.com', '0983254692', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0),
(10, 'Nguyễn Văn Trực', 'vantruc@gmail.com', '0935465962', 'Quận Gò Vấp, TP.HCM', '2024-10-11 13:13:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `dishID` int(11) NOT NULL,
  `dishName` varchar(255) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `businessStatus` varchar(30) NOT NULL,
  `preparationProcess` varchar(100) DEFAULT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'nodish.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`dishID`, `dishName`, `description`, `price`, `categoryID`, `businessStatus`, `preparationProcess`, `image`) VALUES
(1, 'Gà rán', 'Gà rán giòn,', 35000.00, 1, 'Đang kinh doanh', NULL, 'garan.png'),
(2, 'Gà rán sốt phô mai', 'Gà rán sốt phô mai,', 35000.00, 1, 'Đang kinh doanh', NULL, 'garanphomai.png'),
(3, 'Gà rán sốt cay', 'Gà rán sốt cay,', 35000.00, 1, 'Đang kinh doanh', NULL, 'garancay.png'),
(4, 'Gà viên', 'Gà viên nhỏ giòn tan', 25000.00, 1, 'Đang kinh doanh', NULL, 'gavien.png'),
(5, 'Burger gà', 'Burger với nhân gà rán giòn', 40000.00, 2, 'Đang kinh doanh', NULL, 'burgerga.png'),
(6, 'Burger bò', 'Burger nhân bò tươi', 45000.00, 2, 'Đang kinh doanh', NULL, 'burgerbo.png'),
(7, 'Cơm gà', 'Cơm với đùi gà rán', 50000.00, 4, 'Đang kinh doanh', NULL, 'comga.png'),
(8, 'Mì Ý bò bằm', 'Mì Ý với sốt bò bằm', 40000.00, 3, 'Đang kinh doanh', NULL, 'miyboham.png'),
(9, 'Mì Ý sốt cà', 'Mì Ý với sốt cà chua', 40000.00, 3, 'Đang kinh doanh', NULL, 'miysotca.png'),
(10, 'Khoai tây chiên', 'Khoai tây chiên giòn', 15000.00, 4, 'Đang kinh doanh', NULL, 'khoaitaychien.png'),
(11, 'Salad', 'Salad rau trộn', 30000.00, 4, 'Đang kinh doanh', NULL, 'salad.png'),
(12, 'Kem Vani', 'Kem vani mát lạnh', 10000.00, 5, 'Đang kinh doanh', NULL, 'kemvani.png'),
(13, 'Pepsi', 'Nước ngọt Pepsi', 15000.00, 6, 'Đang kinh doanh', NULL, 'pepsi.png'),
(14, 'Coca-cola', 'Nước ngọt Cocacola', 15000.00, 6, 'Đang kinh doanh', NULL, 'cocacola.png'),
(15, 'Sprite', 'Nước ngọt Pepsi', 15000.00, 6, 'Đang kinh doanh', NULL, 'sprite.png');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts`
--

CREATE TABLE `employee_shifts` (
  `userID` int(11) NOT NULL,
  `shiftID` int(11) NOT NULL,
  `shiftDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `employee_shifts`
--

INSERT INTO `employee_shifts` (`userID`, `shiftID`, `shiftDate`) VALUES
(7, 1, '2024-10-07'),
(8, 2, '2024-10-07'),
(9, 1, '2024-10-08'),
(10, 2, '2024-10-08'),
(11, 1, '2024-10-09'),
(12, 2, '2024-10-09'),
(13, 1, '2024-10-10'),
(14, 2, '2024-10-10'),
(15, 1, '2024-10-11'),
(16, 2, '2024-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `import_orders`
--

CREATE TABLE `import_orders` (
  `importOderID` int(11) NOT NULL,
  `importOrderDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredientID` int(11) NOT NULL,
  `ingredientName` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `manufactureDate` date DEFAULT NULL,
  `expirationDate` date DEFAULT NULL,
  `quantityInStock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredientID`, `ingredientName`, `info`, `manufactureDate`, `expirationDate`, `quantityInStock`) VALUES
(1, 'Thịt gà', 'Thịt gà tươi', '2024-09-01', '2024-12-01', 100),
(2, 'Mì Ý', 'Mì Ý chất lượng cao', '2024-09-01', '2025-03-01', 200),
(3, 'Sốt cà chua', 'Sốt cà chua nhập khẩu', '2024-09-15', '2025-01-01', 150),
(4, 'Kem vani', 'Kem vani tươi ngon', '2024-09-01', '2025-01-01', 50),
(5, 'Pepsi', 'Nước ngọt có gas vị Pepsi', '2024-09-10', '2025-09-10', 500),
(6, 'Coca', 'Nước ngọt có gas vị Coca', '2024-09-10', '2025-09-10', 500),
(7, 'Sprite', 'Nước ngọt có gas vị Sprite', '2024-09-10', '2025-09-10', 500),
(8, 'Thịt bò', 'Thịt bò nhập khẩu', '2024-09-01', '2024-12-01', 80),
(9, 'Bánh burger', 'Bánh burger mềm', '2024-09-01', '2024-11-01', 100);

-- --------------------------------------------------------

--
-- Table structure for table `needingingredients`
--

CREATE TABLE `needingingredients` (
  `dishID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Đang chế biến',
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customerID`, `orderDate`, `totalAmount`, `status`, `note`) VALUES
(1, 1, '2024-09-30 13:10:00', 60000.00, 'Hoàn thành', ''),
(2, 2, '2024-09-25 02:43:00', 45000.00, 'Hoàn thành', ''),
(3, 3, '2024-09-22 03:30:00', 100000.00, 'Hoàn thành', ''),
(4, 3, '2024-10-01 04:53:00', 75000.00, 'Hoàn thành', ''),
(5, 3, '2024-10-01 01:41:00', 135000.00, 'Hoàn thành', ''),
(6, 3, '2024-10-03 10:32:00', NULL, 'Hoàn thành', ''),
(7, 3, '2024-10-04 09:36:00', NULL, 'Hoàn thành', ''),
(8, 3, '2024-10-05 07:30:00', NULL, 'Hoàn thành', ''),
(9, 3, '2024-10-06 10:56:00', NULL, 'Hoàn thành', ''),
(10, 3, '2024-10-07 11:16:00', NULL, 'Hoàn thành', ''),
(11, 3, '2024-10-08 14:20:00', NULL, 'Hoàn thành', ''),
(12, 3, '2024-10-09 04:40:00', NULL, 'Hoàn thành', ''),
(13, 3, '2024-10-10 02:34:00', NULL, 'Hoàn thành', ''),
(14, 3, '2024-10-11 05:57:00', NULL, 'Hoàn thành', ''),
(15, 1, '2024-10-12 06:41:00', NULL, 'Hoàn thành', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_dishes`
--

CREATE TABLE `order_dishes` (
  `orderID` int(11) NOT NULL,
  `dishID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order_dishes`
--

INSERT INTO `order_dishes` (`orderID`, `dishID`, `quantity`) VALUES
(1, 2, 3),
(2, 1, 6),
(3, 6, 5),
(4, 5, 4),
(5, 4, 3),
(6, 4, 3),
(7, 9, 1),
(8, 3, 5),
(9, 2, 3),
(10, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partypackages`
--

CREATE TABLE `partypackages` (
  `partyPackageID` int(11) NOT NULL,
  `partyPackageName` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `partypackages`
--

INSERT INTO `partypackages` (`partyPackageID`, `partyPackageName`, `description`, `price`, `image`) VALUES
(1, 'Gói tiệc sinh nhật', '', 500000.00, 'sinhnhat.png'),
(2, 'Gói tiệc gia đình', '', 300000.00, 'giadinh.png'),
(3, 'Gói tiệc công ty', '', 1000000.00, 'congty.png'),
(4, 'Gói tiệc bạn bè', '', 700000.00, 'banbe.png'),
(5, 'Gói tiệc trẻ em', '', 400000.00, 'treem.png');

-- --------------------------------------------------------

--
-- Table structure for table `partypackage_dishes`
--

CREATE TABLE `partypackage_dishes` (
  `partyPackageID` int(11) NOT NULL,
  `dishID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `partypackage_dishes`
--

INSERT INTO `partypackage_dishes` (`partyPackageID`, `dishID`, `quantity`) VALUES
(1, 1, 10),
(1, 2, 5),
(2, 3, 2),
(2, 4, 20),
(3, 2, 10),
(3, 4, 15),
(4, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotionID` int(11) NOT NULL,
  `promotionName` varchar(100) NOT NULL,
  `discountPercentage` decimal(5,2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotionID`, `promotionName`, `discountPercentage`, `startDate`, `endDate`, `description`, `image`, `status`) VALUES
(1, 'Combo 2 gà rán 1 pepsi', 15.00, '2024-10-20', '2024-10-26', 'Giảm giá 15% cho combo 2 món', 'combo2ga1pep.png', ''),
(2, 'Tuần lễ sales', 40.00, '2024-10-07', '2024-10-13', 'Giảm giá 40% tất cả sản phẩm', 'salesweek.png', ''),
(3, 'Giảm giá khai trương', 35.00, '2024-10-01', '2024-10-07', 'Giảm giá 35% nhân dịp khai trương', 'openning.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `proposalID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `typeOfProposal` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Chưa duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`) VALUES
(1, 'Quản lý chuỗi cửa hàng'),
(2, 'Quản lý cửa hàng'),
(3, 'Nhân viên nhận đơn'),
(4, 'Nhân viên bếp'),
(5, 'Nhân viên bếp');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `shiftID` int(11) NOT NULL,
  `shiftName` varchar(255) DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shiftID`, `shiftName`, `startTime`, `endTime`) VALUES
(1, 'Ca sáng', '08:00:00', '12:00:00'),
(2, 'Ca chiều', '13:00:00', '17:00:00'),
(3, 'Ca tối', '18:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `storeID` int(11) NOT NULL,
  `storeName` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeID`, `storeName`, `address`, `status`, `contact`) VALUES
(1, 'Cửa hàng Đom Đóm 111', '12 Đường ABC, Quận Gò Vấp, TP.HCM', 'Đang hoạt động', '0982564321'),
(2, 'Cửa hàng Đom Đóm 112', '5 Đường EFD, Quận Gò Vấp, TP.HCM', 'Đang hoạt động', '0965245921'),
(3, 'Cửa hàng Đom Đóm 113', '18B Đường JKL, Quận Gò Vấp, TP.HCM', 'Đang hoạt động', '0962549823'),
(4, 'Cửa hàng Đom Đóm 114', '90/5 Đường AHD, Quận Gò Vấp, TP.HCM', 'Đang hoạt động', '0935624892'),
(5, 'Cửa hàng Đom Đóm 115', '6 Đường DEF, Quận Gò Vấp, TP.HCM', 'Đang hoạt động', '0913645678');

-- --------------------------------------------------------

--
-- Table structure for table `store_ingredients`
--

CREATE TABLE `store_ingredients` (
  `storeID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `quantityInStock` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `store_ingredients`
--

INSERT INTO `store_ingredients` (`storeID`, `ingredientID`, `quantityInStock`, `date`) VALUES
(1, 1, 50, '2024-10-01'),
(1, 5, 100, '2024-10-03'),
(2, 2, 60, '2024-10-03'),
(4, 4, 30, '2024-10-04'),
(5, 9, 60, '2024-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierID`, `supplierName`) VALUES
(1, 'Trang trại gà FChicken'),
(2, 'Công ty TNHH đồ uống BB'),
(3, 'Dịch vụ sỉ và lẻ thức ăn nhanh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `roleID` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Đang làm',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `password`, `phone`, `email`, `address`, `roleID`, `status`, `createdAt`) VALUES
(1, 'qlcch', 'pass', '', '', '', 1, '', '2024-10-11 13:35:12'),
(2, 'qlch1', 'pass', '', '', '', 2, '', '2024-10-11 13:35:12'),
(3, 'qlch2', 'pass', '', '', '', 2, '', '2024-10-11 13:35:12'),
(4, 'qlch3', 'pass', '', '', '', 2, '', '2024-10-11 13:35:12'),
(5, 'qlch4', 'pass', '', '', '', 2, '', '2024-10-11 13:35:12'),
(6, 'qlch5', 'pass', '', '', '', 2, '', '2024-10-11 13:35:12'),
(7, 'nvnd1', 'pass', '', '', '', 3, '', '2024-10-11 13:35:12'),
(8, 'nvnd2', 'pass', '', '', '', 3, '', '2024-10-11 13:35:12'),
(9, 'nvnd3', 'pass', '', '', '', 3, '', '2024-10-11 13:35:12'),
(10, 'nvnd4', 'pass', '', '', '', 3, '', '2024-10-11 13:35:12'),
(11, 'nvnd5', 'pass', '', '', '', 3, '', '2024-10-11 13:35:12'),
(12, 'nvb1', 'pass', '', '', '', 4, '', '2024-10-11 13:35:12'),
(13, 'nvb2', 'pass', '', '', '', 4, '', '2024-10-11 13:35:12'),
(14, 'nvb3', 'pass', '', '', '', 4, '', '2024-10-11 13:35:12'),
(15, 'nvb4', 'pass', '', '', '', 4, '', '2024-10-11 13:35:12'),
(16, 'nvb5', 'pass', '', '', '', 4, '', '2024-10-11 13:35:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`dishID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
  ADD PRIMARY KEY (`userID`,`shiftID`),
  ADD KEY `employee_shift_ibfk_2` (`shiftID`);

--
-- Indexes for table `import_orders`
--
ALTER TABLE `import_orders`
  ADD PRIMARY KEY (`importOderID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredientID`);

--
-- Indexes for table `needingingredients`
--
ALTER TABLE `needingingredients`
  ADD PRIMARY KEY (`dishID`,`ingredientID`),
  ADD KEY `needingingredient_ibfk_2` (`ingredientID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `orders_ibfk_1` (`customerID`);

--
-- Indexes for table `order_dishes`
--
ALTER TABLE `order_dishes`
  ADD PRIMARY KEY (`orderID`,`dishID`),
  ADD KEY `order_dish_ibfk_2` (`dishID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderID`) USING BTREE;

--
-- Indexes for table `partypackages`
--
ALTER TABLE `partypackages`
  ADD PRIMARY KEY (`partyPackageID`);

--
-- Indexes for table `partypackage_dishes`
--
ALTER TABLE `partypackage_dishes`
  ADD PRIMARY KEY (`partyPackageID`,`dishID`),
  ADD KEY `partypackage_dish_ibfk_2` (`dishID`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotionID`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`proposalID`),
  ADD KEY `proposal_ibfk_1` (`userID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shiftID`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`storeID`);

--
-- Indexes for table `store_ingredients`
--
ALTER TABLE `store_ingredients`
  ADD PRIMARY KEY (`storeID`,`ingredientID`),
  ADD KEY `store_ingredient_ibfk_2` (`ingredientID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `role_ibfk_1` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `dishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `import_orders`
--
ALTER TABLE `import_orders`
  MODIFY `importOderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `partypackages`
--
ALTER TABLE `partypackages`
  MODIFY `partyPackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `proposalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shiftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
  ADD CONSTRAINT `employee_shift_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `employee_shift_ibfk_2` FOREIGN KEY (`shiftID`) REFERENCES `shifts` (`shiftID`);

--
-- Constraints for table `needingingredients`
--
ALTER TABLE `needingingredients`
  ADD CONSTRAINT `needingingredient_ibfk_1` FOREIGN KEY (`dishID`) REFERENCES `dishes` (`dishID`),
  ADD CONSTRAINT `needingingredient_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredients` (`ingredientID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`);

--
-- Constraints for table `order_dishes`
--
ALTER TABLE `order_dishes`
  ADD CONSTRAINT `order_dish_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `order_dish_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dishes` (`dishID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `partypackage_dishes`
--
ALTER TABLE `partypackage_dishes`
  ADD CONSTRAINT `partypackage_dish_ibfk_1` FOREIGN KEY (`partyPackageID`) REFERENCES `partypackages` (`partyPackageID`),
  ADD CONSTRAINT `partypackage_dish_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dishes` (`dishID`);

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposal_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `store_ingredients`
--
ALTER TABLE `store_ingredients`
  ADD CONSTRAINT `store_ingredient_ibfk_1` FOREIGN KEY (`storeID`) REFERENCES `stores` (`storeID`),
  ADD CONSTRAINT `store_ingredient_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredients` (`ingredientID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
