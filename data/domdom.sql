-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 01:17 PM
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
  `phoneNumber` varchar(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blackList` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `phoneNumber`, `fullName`, `address`, `email`, `blackList`) VALUES
(1, '0901234567', 'Nguyễn Văn An', '123 Đường Lê Lai, TP.HCM', 'nguyenvanan@gmail.com', 0),
(2, '0902345678', 'Trần Thị Bình', '456 Đường Nguyễn Thị Minh Khai, TP.HCM', 'tranthibinh@gmail.com', 0),
(3, '0903456789', 'Lê Minh Cường', '789 Đường Lý Tự Trọng, TP.HCM', 'leminhcuong@gmail.com', 0),
(4, '0904567890', 'Phạm Thị Dung', '101 Đường Phạm Ngọc Thạch, TP.HCM', 'phamthidung@gmail.com', 0),
(5, '0905678901', 'Hoàng Văn Hưng', '202 Đường Trần Hưng Đạo, TP.HCM', 'hoangvanhung@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `dishID` int(5) NOT NULL,
  `dishName` varchar(50) NOT NULL,
  `dishCategory` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `businessStatus` tinyint(1) NOT NULL DEFAULT 1,
  `availabilityStatus` tinyint(1) NOT NULL DEFAULT 1,
  `description` mediumtext DEFAULT NULL,
  `preparationProcess` mediumtext DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dishID`, `dishName`, `dishCategory`, `price`, `businessStatus`, `availabilityStatus`, `description`, `preparationProcess`, `image`) VALUES
(1, 'Burger bò', 'Burger/Cơm', 39000.00, 1, 1, 'Burger với nhân bò nướng mềm, thêm rau và sốt.', 'Nướng bò, chuẩn bị bánh, kết hợp chúng.', 'burgerbo.png'),
(2, 'Burger heo', 'Burger/Cơm', 35000.00, 1, 1, 'Burger với nhân heo giòn, rau xà lách và sốt đặc biệt.', 'Nướng bánh Burger, chiên thị heo và cùng rau và sốt.', 'burgerheo.png'),
(3, 'Burger tôm', 'Burger/Cơm', 35000.00, 1, 1, 'Burger với nhân tôm giòn, rau xà lách và sốt đặc biệt.', 'Nướng bánh hamburger, chiên tôm và cùng rau và sốt.', 'burgertom.png'),
(4, 'Gà rán giòn', 'Gà rán', 25000.00, 1, 1, 'Gà rán giòn với lớp vỏ bột chiên xù.', 'Chiên gà với bột chiên giòn cho đến khi vàng đều.', 'garangion.png'),
(5, 'Gà rán cay', 'Gà rán', 32000.00, 1, 1, 'Gà rán với gia vị cay, thơm ngon.', 'Chiên gà với gia vị cay và bột chiên giòn.', 'garancay.png'),
(6, 'Gà rán phô mai', 'Gà rán', 35000.00, 1, 1, 'Gà rán với lớp phô mai tan chảy.', 'Chiên gà, phủ lớp phô mai lên trên và nướng thêm.', 'garanphomai.png'),
(7, 'Gà rán mật ong', 'Gà rán', 35000.00, 1, 1, 'Gà rán với lớp phô mai tan chảy.', 'Chiên gà, phủ lớp mật ong lên trên và nướng thêm.', 'garanmatong.png'),
(8, 'Gà rán BBQ', 'Gà rán', 35000.00, 1, 1, 'Gà rán theo phong cách BBQ.', 'Chiên gà, phủ lớp lớp BBQ lên trên và nướng thêm.', 'garanbbq.png'),
(9, 'Mì Ý sốt bò bằm', 'Mì Ý', 30000.00, 1, 1, 'Mì Ý với sốt thịt bò và cà chua.', 'Luộc mì, làm sốt bò bằm xào với cà chua và gia vị.', 'miysotbobam.png'),
(10, 'Mì Ý sốt kem', 'Mì Ý', 23000.00, 1, 1, 'Mì Ý với sốt kem béo ngậy.', 'Luộc mì, làm sốt kem và trộn cùng mì.', 'miysotkem.png'),
(11, 'Mì Ý sốt pesto', 'Mì Ý', 23000.00, 1, 1, 'Mì Ý với sốt kem béo ngậy.', 'Luộc mì, làm sốt pesto và trộn cùng mì.', 'miysotpesto.png'),
(12, 'Mì Ý sốt cà chua', 'Mì Ý', 23000.00, 1, 1, 'Mì Ý với sốt ca chua ngọt ngọt chua chua.', 'Luộc mì, làm sốt cà chua và trộn cùng mì.', 'miysotcachua.png'),
(13, 'Mì Ý sốt hải sản', 'Mì Ý', 28000.00, 1, 1, 'Mì Ý với nấu cùng các loại hải sản.', 'Luộc mì, làm sốt và bỏ cùng hải sản trộn mì.', 'miyhaisan.png'),
(14, 'CocaCola', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt CocaCola.', 'Dùng trực tiếp hoặc với đá.', 'cocacola.png'),
(15, 'Pepsi', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt Pepsi.', 'Dùng trực tiếp hoặc với đá.', 'pepsi.png'),
(16, 'Sprite', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt Sprite.', 'Dùng trực tiếp hoặc với đá.', 'sprite.png'),
(17, 'Fanta', 'Thức uống', 15000.00, 1, 1, 'Nước ngọt Fanta.', 'Dùng trực tiếp hoặc với đá.', 'fanta.png'),
(18, 'Trà đào cam xả', 'Thức uống', 18000.00, 1, 1, 'Nước trà đào cam xả.', 'Dùng trực tiếp hoặc với đá.', 'tradaocamxa.png'),
(19, 'Cơm gà mắm tỏi', 'Burger/Cơm', 32000.00, 1, 1, 'Cơm với gà chiên mắm tỏi đậm đà.', 'Chiên gà với mắm tỏi và ăn kèm cơm trắng.', 'comgamamtoi.png'),
(20, 'Cơm thịt bò', 'Burger/Cơm', 35000.00, 1, 1, 'Cơm thịt bò xào mềm thơm.', 'Xào thịt bò với gia vị và ăn kèm cơm.', 'comthitbo.png'),
(21, 'Cơm thịt heo', 'Burger/Cơm', 35000.00, 1, 1, 'Cơm thịt heo nướng thơm ngon.', 'Nướng thịt heo và ăn kèm cơm trắng.', 'comthitheo.png'),
(22, 'Khoai tây chiên', 'Ăn kèm', 20000.00, 1, 1, 'Khoai tây chiên giòn rụm, ăn kèm với sốt.', 'Chiên khoai tây và phục vụ nóng.', 'khoaitaychien.png'),
(23, 'Khoai tây lắc phô mai', 'Ăn kèm', 25000.00, 1, 1, 'Khoai tây lắc với phô mai thơm lừng.', 'Chiên khoai tây, lắc đều với bột phô mai.', 'khoaitaylacphomai.png'),
(24, 'Sandwich gà', 'Ăn kèm', 25000.00, 1, 1, 'Sandwich với nhân gà và sốt đặc biệt.', 'Hâm nóng sandwich, thêm nhân gà và rau xanh.', 'sandwichga.png'),
(25, 'Hotdog xúc xích', 'Ăn kèm', 20000.00, 1, 1, 'Hotdog với nhân xúc xích và sốt đặc biệt.', 'Hâm nóng hotdog, thêm nhân xúc xích và rau xanh.', 'hotdogxucxich.png'),
(26, 'Súp bí đỏ', 'Ăn kèm', 15000.00, 1, 1, 'Súp bí đỏ ngọt thanh.', 'Xay nhuyễn bí đỏ nấu lên.', 'supbido.png'),
(27, 'Bánh xoài đào', 'Tráng miệng', 30000.00, 1, 1, 'Bánh xoài đào ngọt thanh, mềm mại.', 'Làm bánh với xoài và đào tươi làm nhân, chiên giòn.', 'banhxoaidao.png'),
(28, 'Kem vani', 'Tráng miệng', 20000.00, 1, 1, 'Kem vani mềm mịn.', 'Kem vani.', 'kemvani.png'),
(29, 'Kem dừa', 'Tráng miệng', 25000.00, 1, 1, 'Kem dừa mát lạnh, thơm ngon.', 'Làm kem từ nước dừa và sữa, cho vào tủ đông để đông cứng.', 'kemdua.png'),
(30, 'Kem dâu', 'Tráng miệng', 22000.00, 1, 1, 'Kem dâu ngọt ngào.', 'Xay dâu với kem và sữa.', 'kemdau.png');

-- --------------------------------------------------------

--
-- Table structure for table `dish_ingredient`
--

CREATE TABLE `dish_ingredient` (
  `dishID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `quantity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `dish_ingredient`
--

INSERT INTO `dish_ingredient` (`dishID`, `ingredientID`, `quantity`) VALUES
(1, 1, 100),
(1, 2, 50),
(1, 3, 30),
(2, 4, 150),
(2, 5, 70),
(2, 6, 40),
(3, 7, 120),
(3, 8, 90),
(3, 9, 60),
(4, 10, 110),
(4, 11, 80),
(4, 12, 50),
(5, 13, 130),
(5, 14, 60),
(5, 15, 40),
(6, 1, 100),
(6, 5, 50),
(6, 7, 30),
(7, 2, 80),
(7, 6, 40),
(7, 10, 20),
(8, 3, 90),
(8, 4, 70),
(8, 8, 50),
(9, 5, 60),
(9, 9, 40),
(9, 12, 50),
(10, 1, 100),
(10, 7, 60),
(10, 10, 40),
(11, 2, 70),
(11, 6, 40),
(11, 14, 50),
(12, 3, 80),
(12, 8, 50),
(12, 11, 40),
(13, 4, 90),
(13, 5, 60),
(13, 15, 30),
(14, 6, 80),
(14, 9, 50),
(14, 12, 40),
(15, 7, 100),
(15, 10, 60),
(15, 13, 50),
(16, 1, 120),
(16, 8, 80),
(16, 14, 60),
(17, 2, 90),
(17, 9, 50),
(17, 12, 30),
(18, 3, 100),
(18, 6, 60),
(18, 11, 50),
(19, 4, 110),
(19, 5, 50),
(19, 13, 70),
(20, 5, 100),
(20, 8, 40),
(20, 10, 60),
(21, 1, 90),
(21, 2, 70),
(21, 4, 50),
(22, 6, 80),
(22, 9, 40),
(22, 12, 60),
(23, 7, 60),
(23, 10, 100),
(23, 13, 50),
(24, 2, 50),
(24, 5, 40),
(24, 6, 30),
(25, 3, 70),
(25, 8, 40),
(25, 10, 60),
(26, 4, 60),
(26, 12, 50),
(26, 13, 40),
(27, 7, 100),
(27, 8, 30),
(27, 11, 50),
(28, 5, 90),
(28, 6, 60),
(28, 12, 40),
(29, 2, 80),
(29, 7, 50),
(29, 10, 60),
(30, 1, 120),
(30, 5, 70),
(30, 9, 40);

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

CREATE TABLE `employee_shift` (
  `shiftID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importorder`
--

CREATE TABLE `importorder` (
  `importOrderID` int(5) NOT NULL,
  `importOrderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `userID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredientID` int(5) NOT NULL,
  `ingredientName` varchar(50) NOT NULL,
  `unitOfcalculaton` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `typeIngredient` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `ingredientName`, `unitOfcalculaton`, `price`, `typeIngredient`, `status`) VALUES
(1, 'Gạo', 'kg', 20000.00, 'Ngũ cốc', 1),
(2, 'Thịt gà', 'kg', 80000.00, 'Thịt', 1),
(3, 'Thịt bò', 'kg', 150000.00, 'Thịt', 1),
(4, 'Cà chua', 'kg', 15000.00, 'Rau củ', 1),
(5, 'Hành tây', 'kg', 10000.00, 'Rau củ', 1),
(6, 'Tỏi', 'kg', 30000.00, 'Gia vị', 1),
(7, 'Sữa tươi', 'lít', 25000.00, 'Sữa', 1),
(8, 'Phô mai', 'kg', 120000.00, 'Sữa', 1),
(9, 'Trứng', 'quả', 2000.00, 'Gia cầm', 1),
(10, 'Dưa leo', 'kg', 12000.00, 'Rau củ', 1),
(11, 'Nước mắm', 'lít', 40000.00, 'Gia vị', 1),
(12, 'Dầu ăn', 'lít', 30000.00, 'Gia vị', 1),
(13, 'Mì', 'gói', 5000.00, 'Ngũ cốc', 1),
(14, 'Bột chiên giòn', 'kg', 25000.00, 'Ngũ cốc', 1),
(15, 'Khoai tây', 'kg', 20000.00, 'Rau củ', 1),
(16, 'Cà rốt', 'kg', 15000.00, 'Rau củ', 1),
(17, 'Đường', 'kg', 20000.00, 'Gia vị', 1),
(18, 'Muối', 'kg', 5000.00, 'Gia vị', 1),
(19, 'Chanh', 'quả', 5000.00, 'Trái cây', 1),
(20, 'Mật ong', 'kg', 120000.00, 'Gia vị', 1);

-- --------------------------------------------------------

--
-- Table structure for table `needingredient`
--

CREATE TABLE `needingredient` (
  `importOrderID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(5) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `sumOfQuantity` int(5) NOT NULL,
  `paymentMethod` varchar(30) NOT NULL,
  `note` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `customerID` int(5) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `finalAmount` decimal(10,2) NOT NULL,
  `partyPackageID` int(5) DEFAULT NULL,
  `storeID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `orderDate`, `total`, `sumOfQuantity`, `paymentMethod`, `note`, `status`, `customerID`, `discountAmount`, `finalAmount`, `partyPackageID`, `storeID`) VALUES
(1, '2024-11-24', 132000.00, 4, 'Tiền mặt', NULL, 0, 1, 0.00, 132000.00, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_dish`
--

CREATE TABLE `order_dish` (
  `orderDetailID` int(5) NOT NULL,
  `orderID` int(5) NOT NULL,
  `dishID` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `lineTotal` decimal(10,2) NOT NULL,
  `promotionID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order_dish`
--

INSERT INTO `order_dish` (`orderDetailID`, `orderID`, `dishID`, `quantity`, `unitPrice`, `discountAmount`, `lineTotal`, `promotionID`) VALUES
(1, 1, 1, 3, 39000.00, 0.00, 39000.00, 0),
(2, 1, 16, 1, 15000.00, 0.00, 15000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `partypackage`
--

CREATE TABLE `partypackage` (
  `partyPackageID` int(11) NOT NULL,
  `partyPackageName` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `decoration` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `partypackage`
--

INSERT INTO `partypackage` (`partyPackageID`, `partyPackageName`, `price`, `image`, `decoration`) VALUES
(1, 'Gói Sinh Nhật', 2499000.00, 'goisinhnhat.png', 'Bóng bay, bánh sinh nhật nhỏ, bố trí bàn sinh nhật theo chủ đề'),
(2, 'Gói Gia Đình', 3199000.00, 'goigiadinh.png', 'Trang trí bàn gia đình ấm cúng, bóng bay và bảng tên từng thành viên'),
(3, 'Gói Liên Hoan Bạn Bè', 3499000.00, 'goilienhoanbanbe.png', 'Bóng bay, đèn LED, không gian mở cho nhóm bạn'),
(4, 'Gói Tiệc Công Ty', 5999000.00, 'goitieccongty.png', 'Trang trí phong cách công sở, bảng tên công ty, khu vực trình chiếu'),
(5, 'Gói Kỷ Niệm Ngày Cưới', 4299000.00, 'goikyniemngaycuoi.pn', 'Bàn ăn lãng mạn, đèn nến, hoa trang trí theo yêu cầu'),
(6, 'Gói Tiệc Trẻ Em', 2299000.00, 'goitiectreem.png', 'Trang trí hoạt hình, bàn ăn đầy màu sắc, kèm đồ chơi nhỏ cho bé'),
(7, 'Gói Tiệc Cặp Đôi', 3799000.00, 'goitieccapdoi.png', 'Bàn ăn riêng tư, ánh nến, hoa tươi, và menu đặc biệt cho hai người'),
(8, 'Gói Tiệc Tất Niên', 5499000.00, 'goitiectatnien.png', 'Trang trí phong cách lễ hội, đèn trang trí, menu đa dạng theo mùa'),
(9, 'Gói Độc Quyền', 6999000.00, 'goidocquyen.png', 'Trang trí theo yêu cầu riêng, ánh sáng chuyên nghiệp, phục vụ đặc biệt');

-- --------------------------------------------------------

--
-- Table structure for table `partypackage_dish`
--

CREATE TABLE `partypackage_dish` (
  `partyPackageID` int(5) NOT NULL,
  `dishID` int(5) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `partypackage_dish`
--

INSERT INTO `partypackage_dish` (`partyPackageID`, `dishID`, `quantity`) VALUES
(1, 1, 2),
(1, 6, 3),
(1, 11, 2),
(1, 16, 3),
(1, 21, 2),
(1, 26, 2),
(2, 2, 2),
(2, 7, 3),
(2, 12, 2),
(2, 17, 3),
(2, 22, 2),
(2, 27, 2),
(3, 3, 2),
(3, 8, 3),
(3, 13, 2),
(3, 18, 3),
(3, 23, 2),
(3, 28, 2),
(4, 4, 2),
(4, 9, 3),
(4, 14, 2),
(4, 19, 3),
(4, 24, 2),
(4, 29, 2),
(5, 5, 2),
(5, 10, 3),
(5, 15, 2),
(5, 20, 3),
(5, 25, 2),
(5, 30, 2),
(6, 1, 3),
(6, 7, 3),
(6, 13, 2),
(6, 18, 3),
(6, 22, 2),
(6, 26, 2),
(7, 2, 3),
(7, 8, 3),
(7, 14, 2),
(7, 19, 3),
(7, 23, 2),
(7, 27, 2),
(8, 3, 3),
(8, 9, 3),
(8, 15, 2),
(8, 20, 3),
(8, 24, 2),
(8, 28, 2),
(9, 4, 3),
(9, 10, 3),
(9, 11, 2),
(9, 16, 3),
(9, 25, 2),
(9, 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotionID` int(5) NOT NULL,
  `promotionName` varchar(50) DEFAULT NULL,
  `discountPercentage` int(5) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `quantity` int(5) NOT NULL,
  `maxDiscountAmount` decimal(10,2) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotionID`, `promotionName`, `discountPercentage`, `startDate`, `endDate`, `quantity`, `maxDiscountAmount`, `description`, `image`, `status`) VALUES
(1, 'Giảm Giá Mùa Hè', 10, '2024-06-01', '2024-06-30', 10, 100000.00, 'Ưu đãi 10% cho tất cả gói tiệc', 'muahe.png', 0),
(2, 'Ưu Đãi Cuối Tuần', 15, '2024-11-01', '2024-11-30', 8, 100000.00, 'Giảm giá 15% cho gói tiệc vào thứ Bảy và Chủ Nhật', 'cuoituan.png', 1),
(3, 'Kỷ Niệm Thành Lập', 40, '2024-08-01', '2024-08-07', 5, 100000.00, 'Ưu đãi mừng ngày thành lập cửa hàng', 'thanhlap.png', 0),
(4, 'Giảm Giá VIP', 25, '2024-11-01', '2024-11-30', 15, 100000.00, 'Chỉ áp dụng cho khách hàng VIP', 'vip.png', 1),
(5, 'Mùa Tựu Trường', 10, '2024-09-01', '2024-09-15', 12, 100000.00, 'Ưu đãi cho các gói tiệc cho học sinh, sinh viên', 'tuutruong.png', 0),
(6, 'Black Friday Sale', 30, '2024-11-22', '2024-11-30', 20, 100000.00, 'Giảm giá khủng nhân dịp Black Friday', 'blackfriday.png', 1),
(7, 'Mừng Giáng Sinh', 20, '2024-12-01', '2024-12-25', 16, 100000.00, 'Ưu đãi đặc biệt mùa Giáng sinh', 'giangsinh.png', 2),
(8, 'Tết Nguyên Đán', 15, '2025-01-01', '2025-01-31', 24, 100000.00, 'Khuyến mãi mừng năm mới', 'tet.png', 2),
(9, 'Happy Hour', 20, '2024-11-01', '2024-11-30', 25, 100000.00, 'Giảm giá trong khung giờ 14h-16h', 'happyhour.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotiondish`
--

CREATE TABLE `promotiondish` (
  `promotionDishID` int(5) NOT NULL,
  `promotionID` int(5) NOT NULL,
  `dishID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `promotiondish`
--

INSERT INTO `promotiondish` (`promotionDishID`, `promotionID`, `dishID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `proposalID` int(5) NOT NULL,
  `typeOfProposal` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `userID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`proposalID`, `typeOfProposal`, `content`, `status`, `userID`) VALUES
(1, 'Đề xuất món ăn', 'Món ăn: Bánh mì kẹp thịt nướng, Nguyên liệu: Thịt bò, bánh mì, rau sống, gia vị, Cách chế biến: Nướng thịt, kẹp vào bánh mì với rau sống', 0, 1),
(2, 'Đề xuất món ăn', 'Món ăn: Gà rán giòn, Nguyên liệu: Gà, bột chiên xù, gia vị, Dụng cụ: Chảo chiên', 1, 2),
(3, 'Đề xuất món ăn', 'Món ăn: Phở bò, Nguyên liệu: Thịt bò, bún phở, gia vị, hành, nước dùng', 0, 3),
(4, 'Đề xuất món ăn', 'Món ăn: Pizza hải sản, Nguyên liệu: Hải sản, phô mai, bột pizza, gia vị', 1, 4),
(5, 'Đề xuất món ăn', 'Món ăn: Mỳ Ý sốt bò, Nguyên liệu: Mỳ Ý, thịt bò, sốt cà chua, gia vị', 0, 5),
(6, 'Đề xuất nhân viên mới', 'Ứng viên: Nguyễn Văn A, Vị trí: Bếp trưởng, Kinh nghiệm: 5 năm, Địa chỉ: Quận 1, TP.HCM, SĐT: 0901234567', 0, 6),
(7, 'Đề xuất nhân viên mới', 'Ứng viên: Trần Thị B, Vị trí: Nhân viên phục vụ, Kinh nghiệm: 2 năm, Địa chỉ: Quận 3, TP.HCM, SĐT: 0902345678', 1, 7),
(8, 'Đề xuất nhân viên mới', 'Ứng viên: Lê Minh C, Vị trí: Quản lý cửa hàng, Kinh nghiệm: 7 năm, Địa chỉ: Quận 10, TP.HCM, SĐT: 0903456789', 0, 8),
(9, 'Đề xuất nhân viên mới', 'Ứng viên: Phạm Thị D, Vị trí: Nhân viên bếp, Kinh nghiệm: 3 năm, Địa chỉ: Quận 2, TP.HCM, SĐT: 0904567890', 1, 9),
(10, 'Đề xuất nhân viên mới', 'Ứng viên: Nguyễn Hoàng E, Vị trí: Nhân viên thu ngân, Kinh nghiệm: 1 năm, Địa chỉ: Quận 7, TP.HCM, SĐT: 0905678901', 0, 10),
(11, 'Đề xuất chuyển nguyên liệu thừa sang cửa hàng khác', 'Cửa hàng: Quận 1, Nguyên liệu: 20kg gạo, 15kg rau cải, Lý do: Nguyên liệu tồn kho quá nhiều, cần chuyển sang cửa hàng khác để tránh hư hỏng', 0, 11),
(12, 'Đề xuất chuyển nguyên liệu thừa sang cửa hàng khác', 'Cửa hàng: Quận 3, Nguyên liệu: 10kg thịt gà, 5kg cà chua, Lý do: Nguyên liệu không sử dụng hết trong ngày, cần chuyển sang cửa hàng Quận 5', 1, 12),
(13, 'Đề xuất chuyển nguyên liệu thừa sang cửa hàng khác', 'Cửa hàng: Quận 7, Nguyên liệu: 50kg bột mì, 20kg hành, Lý do: Bột mì và hành không tiêu thụ hết, cần chuyển sang cửa hàng Quận 9', 0, 13),
(14, 'Đề xuất chuyển nguyên liệu thừa sang cửa hàng khác', 'Cửa hàng: Quận 5, Nguyên liệu: 30kg thịt bò, 10kg rau, Lý do: Nguyên liệu vượt mức dự trữ, chuyển sang cửa hàng Quận 10', 1, 14),
(15, 'Đề xuất chuyển nguyên liệu thừa sang cửa hàng khác', 'Cửa hàng: Quận 9, Nguyên liệu: 40kg gà, 10kg bột chiên xù, Lý do: Nguyên liệu dư thừa, cần chuyển sang cửa hàng Quận 7', 0, 15);

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
  `shiftName` varchar(10) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shiftID`, `shiftName`, `startTime`, `endTime`) VALUES
(1, 'Sáng', '07:00:00', '12:00:00'),
(2, 'Chiều', '12:00:00', '17:00:00'),
(3, 'Tối', '17:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `storeID` int(5) NOT NULL,
  `storeName` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`storeID`, `storeName`, `address`, `status`, `contact`) VALUES
(1, 'Đom Đóm 1', '12 Đường Nguyễn Thị Minh Khai, Quận 1, TP.HCM', 1, '0912562542'),
(2, 'Đom Đóm 2', '6B Đường Cộng Hòa, Quận Tân Bình, TP.HCM', 1, '0935626654'),
(3, 'Đom Đóm 3', '45 Đường Trần Hưng Đạo, Quận 5, TP.HCM', 1, '0932546215'),
(4, 'Đom Đóm 4', '1 Đường Lê Lợi, Quận 3, TP.HCM', 1, '0922546253'),
(5, 'Đom Đóm 5', '31F Đường Lý Tự Trọng, Quận 10, TP.HCM', 1, '0932625421');

-- --------------------------------------------------------

--
-- Table structure for table `store_ingredient`
--

CREATE TABLE `store_ingredient` (
  `storeID` int(5) NOT NULL,
  `ingredientID` int(5) NOT NULL,
  `importOrderID` int(5) NOT NULL,
  `quantityInStock` int(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `roleID` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateBirth` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `phoneNumber` varchar(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `storeID` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `roleID`, `userName`, `email`, `password`, `dateBirth`, `sex`, `phoneNumber`, `image`, `storeID`, `status`) VALUES
(1, 1, 'Nguyễn Văn Toàn', 'admin@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1980-01-01', 1, '0901234567', 'admin_image.jpg', 1, 1),
(2, 2, 'Trần Thị Minh Anh', 'manager1@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1985-02-15', 2, '0902345678', 'manager1_image.jpg', 1, 1),
(3, 2, 'Phạm Minh Tuấn', 'manager2@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1986-03-20', 1, '0903456789', 'manager2_image.jpg', 2, 1),
(4, 2, 'Lê Ngọc Duy', 'manager3@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1987-04-25', 1, '0904567890', 'manager3_image.jpg', 3, 1),
(5, 2, 'Hoàng Thị Lan', 'manager4@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1988-05-30', 2, '0905678901', 'manager4_image.jpg', 4, 1),
(6, 2, 'Vũ Quang Hieu', 'manager5@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1989-06-10', 1, '0906789012', 'manager5_image.jpg', 5, 1),
(7, 3, 'Nguyễn Thị Thùy Dung', 'seller1@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-07-10', 2, '0907890123', 'seller1_image.jpg', 1, 1),
(8, 3, 'Trần Minh Khoa', 'seller2@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-08-12', 1, '0908901234', 'seller2_image.jpg', 1, 1),
(9, 3, 'Phạm Quang Hải', 'seller3@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-09-15', 1, '0909012345', 'seller3_image.jpg', 1, 1),
(10, 3, 'Lê Thanh Tâm', 'seller4@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-10-20', 2, '0909123456', 'seller4_image.jpg', 1, 1),
(11, 3, 'Hoàng Thị Bích Ngọc', 'seller5@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1999-11-25', 2, '0909234567', 'seller5_image.jpg', 1, 1),
(12, 3, 'Nguyễn Thiện Hải', 'seller6@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-02-11', 1, '0909045678', 'seller6_image.jpg', 2, 1),
(13, 3, 'Trần Minh Hoàng', 'seller7@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-03-16', 1, '0909456789', 'seller7_image.jpg', 2, 1),
(14, 3, 'Phạm Minh Trung', 'seller8@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-04-21', 1, '0909567890', 'seller8_image.jpg', 2, 1),
(15, 3, 'Lê Hoàng Anh', 'seller9@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-05-26', 1, '0909678901', 'seller9_image.jpg', 2, 1),
(16, 3, 'Hoàng Thi Lan', 'seller10@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-06-30', 2, '0909789012', 'seller10_image.jpg', 2, 1),
(17, 3, 'Nguyễn MinhThuận', 'seller11@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-07-14', 1, '0909890123', 'seller11_image.jpg', 3, 1),
(18, 3, 'Trần Thanh Tuấn', 'seller12@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-08-18', 1, '0909901234', 'seller12_image.jpg', 3, 1),
(19, 3, 'Phạm Quang Sáng', 'seller13@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-09-22', 1, '0909912345', 'seller13_image.jpg', 3, 1),
(20, 3, 'Lê Tấn Khoa', 'seller14@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-10-27', 1, '0909923456', 'seller14_image.jpg', 3, 1),
(21, 3, 'Hoàng Quang Tuân', 'seller15@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1999-11-30', 1, '0909934567', 'seller15_image.jpg', 3, 1),
(22, 3, 'Nguyễn Quang Hiếu', 'seller16@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-01-20', 1, '0909347678', 'seller16_image.jpg', 4, 1),
(23, 3, 'Trần Thi Ngọc', 'seller17@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-02-25', 2, '0949456789', 'seller17_image.jpg', 4, 1),
(24, 3, 'Phạm Thi Lan', 'seller18@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-03-10', 2, '0969567890', 'seller18_image.jpg', 4, 1),
(25, 3, 'Lê Hoài Khang', 'seller19@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-04-15', 1, '0989678901', 'seller19_image.jpg', 4, 1),
(26, 3, 'Hoàng Thị Lan Anh', 'seller20@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-05-19', 2, '0939789012', 'seller20_image.jpg', 4, 1),
(27, 3, 'Nguyễn Thị Thanh', 'seller21@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-06-01', 2, '0905890123', 'seller21_image.jpg', 5, 1),
(28, 3, 'Trần Minh Khuê', 'seller22@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-07-12', 2, '0904901234', 'seller22_image.jpg', 5, 1),
(29, 3, 'Phạm Thiên Khoa', 'seller23@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-08-14', 1, '0939912345', 'seller23_image.jpg', 5, 1),
(30, 3, 'Lê Tuan Duy', 'seller24@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-09-10', 2, '0902923456', 'seller24_image.jpg', 5, 1),
(31, 3, 'Hoàng Quang Hieu', 'seller25@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1999-10-12', 1, '0901934567', 'seller25_image.jpg', 5, 1),
(32, 4, 'Nguyễn Thị Minh Tâm', 'cook1@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1988-07-10', 1, '0909232567', 'cook1_image.jpg', 1, 1),
(33, 4, 'Trần Quang Hải', 'cook2@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1990-08-12', 2, '0959345678', 'cook2_image.jpg', 1, 1),
(34, 4, 'Phạm Thị Lệ', 'cook3@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1991-09-15', 1, '0909456749', 'cook3_image.jpg', 1, 1),
(35, 4, 'Lê Tấn Huy', 'cook4@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1992-10-20', 2, '0909567899', 'cook4_image.jpg', 1, 1),
(36, 4, 'Hoàng Quang Đạt', 'cook5@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1993-11-25', 1, '0909678979', 'cook5_image.jpg', 1, 1),
(38, 4, 'Nguyễn Minh Tuấn', 'cook6@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-02-11', 1, '0909789582', 'cook6_image.jpg', 2, 1),
(39, 4, 'Trần Thi Lan', 'cook7@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-03-16', 2, '0509890123', 'cook7_image.jpg', 2, 1),
(40, 4, 'Phạm Tấn Duy', 'cook8@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-04-21', 1, '0579901234', 'cook8_image.jpg', 2, 1),
(41, 4, 'Lê Thanh Anh', 'cook9@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-05-26', 2, '0429912345', 'cook9_image.jpg', 2, 1),
(42, 4, 'Hoàng Thị Thúy', 'cook10@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-06-30', 1, '0576923456', 'cook10_image.jpg', 2, 1),
(43, 4, 'Nguyễn Thị Thuận', 'cook11@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-01-10', 1, '0965936467', 'cook11_image.jpg', 3, 1),
(44, 4, 'Trần Thi Ngọc', 'cook12@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-02-12', 2, '0819345678', 'cook12_image.jpg', 3, 1),
(45, 4, 'Phạm Thiên Khoa', 'cook13@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-03-10', 1, '0909456929', 'cook13_image.jpg', 3, 1),
(46, 4, 'Lê Hoàng Anh', 'cook14@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-04-15', 1, '0909562890', 'cook14_image.jpg', 3, 1),
(47, 4, 'Nguyễn Thi Minh Anh', 'cook15@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-05-19', 2, '0909637975', 'cook15_image.jpg', 3, 1),
(48, 4, 'Nguyễn Thi Thanh', 'cook16@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-06-01', 2, '0909789712', 'cook16_image.jpg', 4, 1),
(49, 4, 'Trần Tấn Duy', 'cook17@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-07-12', 1, '0909890125', 'cook17_image.jpg', 4, 1),
(50, 4, 'Phạm Minh Khuê', 'cook18@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-08-14', 2, '0909901239', 'cook18_image.jpg', 4, 1),
(51, 4, 'Cao Bích Phượng', 'cook19@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-09-10', 2, '0909912348', 'cook19_image.jpg', 4, 1),
(52, 4, 'Hoàng Thanh Tuân', 'cook20@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-10-14', 1, '0909923246', 'cook20_image.jpg', 4, 1),
(53, 4, 'Nguyễn Hoàng Anh', 'cook21@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1994-11-01', 1, '0406984567', 'cook21_image.jpg', 5, 1),
(54, 4, 'Trần Thanh Tâm', 'cook22@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1995-12-05', 2, '0802645678', 'cook22_image.jpg', 5, 1),
(55, 4, 'Phạm Thi Quỳnh', 'cook23@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1996-01-14', 2, '0839456789', 'cook23_image.jpg', 5, 1),
(56, 4, 'Lê Huỳnh Phong', 'cook24@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1997-02-16', 1, '0439567890', 'cook24_image.jpg', 5, 1),
(57, 4, 'Hoàng Tấn Duy', 'cook25@domdom.com', '1a1dc91c907325c69271ddf0c944bc72', '1998-03-21', 1, '0239678901', 'cook25_image.jpg', 5, 1);

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
  ADD PRIMARY KEY (`dishID`,`ingredientID`),
  ADD KEY `ingredientID` (`ingredientID`);

--
-- Indexes for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD PRIMARY KEY (`shiftID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `importorder`
--
ALTER TABLE `importorder`
  ADD PRIMARY KEY (`importOrderID`),
  ADD KEY `fk_importorder_user` (`userID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`);

--
-- Indexes for table `needingredient`
--
ALTER TABLE `needingredient`
  ADD PRIMARY KEY (`importOrderID`,`ingredientID`),
  ADD KEY `ingredientID` (`ingredientID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `order_ibfk_3` (`partyPackageID`),
  ADD KEY `order_ibfk_4` (`storeID`);

--
-- Indexes for table `order_dish`
--
ALTER TABLE `order_dish`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `dishID` (`dishID`),
  ADD KEY `order_dish_ibfk_1` (`orderID`);

--
-- Indexes for table `partypackage`
--
ALTER TABLE `partypackage`
  ADD PRIMARY KEY (`partyPackageID`),
  ADD UNIQUE KEY `partyPackageName` (`partyPackageName`);

--
-- Indexes for table `partypackage_dish`
--
ALTER TABLE `partypackage_dish`
  ADD PRIMARY KEY (`partyPackageID`,`dishID`),
  ADD KEY `dishID` (`dishID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotionID`);

--
-- Indexes for table `promotiondish`
--
ALTER TABLE `promotiondish`
  ADD PRIMARY KEY (`promotionDishID`),
  ADD KEY `promotionID` (`promotionID`),
  ADD KEY `dishID` (`dishID`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`proposalID`),
  ADD KEY `fk_userID` (`userID`);

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
  ADD UNIQUE KEY `shiftName` (`shiftName`),
  ADD UNIQUE KEY `startTime` (`startTime`),
  ADD UNIQUE KEY `endTime` (`endTime`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeID`);

--
-- Indexes for table `store_ingredient`
--
ALTER TABLE `store_ingredient`
  ADD PRIMARY KEY (`storeID`,`ingredientID`),
  ADD KEY `ingredientID` (`ingredientID`),
  ADD KEY `store_ingredient_ibfk_3` (`importOrderID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD UNIQUE KEY `image` (`image`),
  ADD KEY `roleID` (`roleID`),
  ADD KEY `user_ibfk_3` (`storeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `dishID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `importorder`
--
ALTER TABLE `importorder`
  MODIFY `importOrderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_dish`
--
ALTER TABLE `order_dish`
  MODIFY `orderDetailID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partypackage`
--
ALTER TABLE `partypackage`
  MODIFY `partyPackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotiondish`
--
ALTER TABLE `promotiondish`
  MODIFY `promotionDishID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `proposalID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shiftID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD CONSTRAINT `dish_ingredient_ibfk_1` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`),
  ADD CONSTRAINT `dish_ingredient_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`);

--
-- Constraints for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD CONSTRAINT `employee_shift_ibfk_1` FOREIGN KEY (`shiftID`) REFERENCES `shift` (`shiftID`),
  ADD CONSTRAINT `employee_shift_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `importorder`
--
ALTER TABLE `importorder`
  ADD CONSTRAINT `fk_importorder_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `needingredient`
--
ALTER TABLE `needingredient`
  ADD CONSTRAINT `needingredient_ibfk_1` FOREIGN KEY (`importOrderID`) REFERENCES `importorder` (`importOrderID`),
  ADD CONSTRAINT `needingredient_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`partyPackageID`) REFERENCES `partypackage` (`partyPackageID`),
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeID`);

--
-- Constraints for table `order_dish`
--
ALTER TABLE `order_dish`
  ADD CONSTRAINT `order_dish_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `order_dish_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `partypackage_dish`
--
ALTER TABLE `partypackage_dish`
  ADD CONSTRAINT `partypackage_dish_ibfk_1` FOREIGN KEY (`partyPackageID`) REFERENCES `partypackage` (`partyPackageID`),
  ADD CONSTRAINT `partypackage_dish_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `promotiondish`
--
ALTER TABLE `promotiondish`
  ADD CONSTRAINT `promotiondish_ibfk_1` FOREIGN KEY (`promotionID`) REFERENCES `promotion` (`promotionID`),
  ADD CONSTRAINT `promotiondish_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `store_ingredient`
--
ALTER TABLE `store_ingredient`
  ADD CONSTRAINT `store_ingredient_ibfk_1` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeID`),
  ADD CONSTRAINT `store_ingredient_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`),
  ADD CONSTRAINT `store_ingredient_ibfk_3` FOREIGN KEY (`importOrderID`) REFERENCES `importorder` (`importOrderID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`storeID`) REFERENCES `store` (`storeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
