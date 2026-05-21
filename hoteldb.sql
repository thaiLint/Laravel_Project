-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 01:16 PM
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
-- Database: `hoteldb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBookingReport` (IN `p_FromDate` DATE, IN `p_ToDate` DATE, IN `p_RoomType` VARCHAR(100), IN `p_CustomerName` VARCHAR(100))   BEGIN
    SELECT
        b.BookingID,
        c.FullName,
        c.Phone,
        r.RoomNumber  AS Room,
        rt.TypeName   AS RoomType,
        b.CheckInDate,
        b.CheckOutDate,
        COALESCE(pay.TotalAmount, 0) AS TotalAmount,
        COALESCE(pay.AmountPaid,  0) AS AmountPaid,
        COALESCE(pay.TotalAmount - pay.AmountPaid, 0) AS BalanceDue,
        b.Status      AS STATUS
    FROM Bookings b
    INNER JOIN Customers c  ON b.CustomerID  = c.CustomerID
    INNER JOIN Rooms r      ON b.RoomID      = r.RoomID
    INNER JOIN RoomTypes rt ON r.RoomTypeID  = rt.RoomTypeID
    LEFT JOIN (
        SELECT ci.BookingID, co.TotalAmount, p.AmountPaid
        FROM CheckIns ci
        LEFT JOIN CheckOuts co ON ci.CheckInID  = co.CheckInID
        LEFT JOIN Payments  p  ON co.CheckOutID = p.CheckOutID
    ) pay ON pay.BookingID = b.BookingID
    WHERE DATE(b.CheckInDate) BETWEEN p_FromDate AND p_ToDate
      AND (p_RoomType     = '' OR rt.TypeName   LIKE CONCAT('%', p_RoomType,     '%'))
      AND (p_CustomerName = '' OR c.FullName     LIKE CONCAT('%', p_CustomerName, '%'))
    ORDER BY b.BookingID ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCheckInCheckOutReport` (IN `p_FromDate` DATE, IN `p_ToDate` DATE, IN `p_RoomType` VARCHAR(100), IN `p_CustomerName` VARCHAR(100))   BEGIN
    SELECT
        c.FullName       AS CustomerName,
        c.Phone          AS PhoneNumber,
        r.RoomNumber     AS Room,
        rt.TypeName      AS RoomType,
        r.RoomNumber,
        c.IDCardNumber   AS `ID/Passport`,
        ci.CheckInDate   AS `Check In`,
        co.CheckOutDate  AS `Check Out`,
        co.TotalAmount   AS SubTotal,
        0                AS Discount
    FROM CheckIns ci
    INNER JOIN Customers c  ON ci.CustomerID = c.CustomerID
    INNER JOIN Rooms r      ON ci.RoomID = r.RoomID
    INNER JOIN RoomTypes rt ON r.RoomTypeID = rt.RoomTypeID
    LEFT JOIN CheckOuts co ON ci.CheckInID = co.CheckInID
    WHERE
        (p_FromDate     IS NULL OR DATE(ci.CheckInDate)  >= p_FromDate)
        AND (p_ToDate   IS NULL OR DATE(co.CheckOutDate) <= p_ToDate)
        AND (p_RoomType IS NULL OR rt.TypeName = p_RoomType)
        AND (p_CustomerName IS NULL OR c.FullName LIKE CONCAT('%', p_CustomerName, '%'))
    ORDER BY ci.CheckInDate DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCustomerReport` (IN `p_FromDate` DATE, IN `p_ToDate` DATE, IN `p_RoomType` VARCHAR(100), IN `p_CustomerName` VARCHAR(100))   BEGIN
    SELECT DISTINCT
        c.CustomerID,
        c.FullName,
        c.Gender,
        c.Phone          AS PhoneNumber,
        c.Email,
        c.IDCardNumber,
        c.Address
    FROM Customers c
    INNER JOIN Bookings b  ON c.CustomerID = b.CustomerID
    INNER JOIN Rooms r     ON b.RoomID = r.RoomID
    INNER JOIN RoomTypes rt ON r.RoomTypeID = rt.RoomTypeID
    WHERE
        (p_FromDate     IS NULL OR DATE(b.CheckInDate)  >= p_FromDate)
        AND (p_ToDate   IS NULL OR DATE(b.CheckOutDate) <= p_ToDate)
        AND (p_RoomType IS NULL OR rt.TypeName = p_RoomType)
        AND (p_CustomerName IS NULL OR c.FullName LIKE CONCAT('%', p_CustomerName, '%'))
    ORDER BY c.CustomerID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPaymentReport` (IN `p_FromDate` DATE, IN `p_ToDate` DATE, IN `p_RoomType` VARCHAR(100), IN `p_CustomerName` VARCHAR(100))   BEGIN
    SELECT
        c.FullName       AS CustomerName,
        c.Phone          AS PhoneNumber,
        r.RoomNumber     AS Room,
        rt.TypeName      AS RoomType,
        ci.CheckInDate   AS `Check In`,
        co.CheckOutDate  AS `Check Out`,
        NULL             AS RoomService,
        NULL             AS ServiceCharge,
        co.TotalAmount,
        p.AmountPaid,
        p.PaymentMethod  AS Payment
    FROM Payments p
    INNER JOIN CheckOuts co ON p.CheckOutID = co.CheckOutID
    INNER JOIN CheckIns ci  ON co.CheckInID = ci.CheckInID
    INNER JOIN Customers c  ON ci.CustomerID = c.CustomerID
    INNER JOIN Rooms r      ON ci.RoomID = r.RoomID
    INNER JOIN RoomTypes rt ON r.RoomTypeID = rt.RoomTypeID
    WHERE
        (p_FromDate     IS NULL OR DATE(ci.CheckInDate)  >= p_FromDate)
        AND (p_ToDate   IS NULL OR DATE(co.CheckOutDate) <= p_ToDate)
        AND (p_RoomType IS NULL OR rt.TypeName = p_RoomType)
        AND (p_CustomerName IS NULL OR c.FullName LIKE CONCAT('%', p_CustomerName, '%'))
    ORDER BY ci.CheckInDate DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRoomReport` (IN `p_FromDate` DATE, IN `p_ToDate` DATE, IN `p_RoomType` VARCHAR(100), IN `p_RoomNumber` VARCHAR(50), IN `p_Floor` VARCHAR(50))   BEGIN
    SELECT
        r.RoomNumber,
        rt.TypeName,
        NULL             AS Floor,
        rt.PricePerNight,
        r.Status
    FROM Rooms r
    INNER JOIN RoomTypes rt ON r.RoomTypeID = rt.RoomTypeID
    WHERE
        (p_RoomType   IS NULL OR p_RoomType   = '' OR rt.TypeName   = p_RoomType)
        AND (p_RoomNumber IS NULL OR p_RoomNumber = '' OR r.RoomNumber LIKE CONCAT('%', p_RoomNumber, '%'))
    ORDER BY r.RoomNumber;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp(),
  `ImagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `Password`, `FullName`, `Role`, `CreatedAt`, `ImagePath`) VALUES
(1, 'Sonita.Sun', 'Hello@123', 'Sun Sonita', 'Admin', '2026-03-30 18:29:16', NULL),
(2, 'Lineth.Thai', 'Hello@123', 'Lineth Thai', 'Admin', '2026-03-30 18:29:44', NULL),
(3, 'Vicheka.Sokhem', 'Hello@123', 'Vicheka Sokhem', 'Admin', '2026-03-30 18:29:44', NULL),
(4, 'Chanthy.Tham', 'Hello@123', 'Tham Chanthy', 'Admin', '2026-03-30 18:35:12', NULL),
(5, 'Chenghorng.Tha', 'Hello@123', 'Tha Chenghorng', 'Admin', '2026-03-30 18:35:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `BookingDate` datetime DEFAULT current_timestamp(),
  `CheckInDate` datetime NOT NULL,
  `CheckOutDate` datetime NOT NULL,
  `STATUS` enum('Pending','Confirm','Cancelled','Completed') NOT NULL DEFAULT 'Pending',
  `CreatedByAdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `CustomerID`, `RoomID`, `BookingDate`, `CheckInDate`, `CheckOutDate`, `STATUS`, `CreatedByAdminID`) VALUES
(1, 1, 11, '2026-05-14 12:14:05', '2026-05-15 13:08:39', '2026-05-16 13:08:39', 'Completed', 1),
(2, 2, 14, '2026-05-15 00:00:56', '2026-05-15 13:08:39', '2026-05-16 13:08:39', '', 1),
(3, 4, 16, '2026-05-15 00:17:11', '2026-05-15 13:08:39', '2026-05-16 13:08:39', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE `checkins` (
  `CheckInID` int(11) NOT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `CustomerID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `CheckInDate` datetime NOT NULL,
  `CreatedByAdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`CheckInID`, `BookingID`, `CustomerID`, `RoomID`, `CheckInDate`, `CreatedByAdminID`) VALUES
(1, 1, 1, 11, '2026-05-15 13:08:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `CheckOutID` int(11) NOT NULL,
  `CheckInID` int(11) NOT NULL,
  `CheckOutDate` datetime NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `CreatedByAdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`CheckOutID`, `CheckInID`, `CheckOutDate`, `TotalAmount`, `CreatedByAdminID`) VALUES
(1, 1, '2026-05-16 13:08:39', 120.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `IDCardNumber` varchar(50) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `FullName`, `Gender`, `Phone`, `Email`, `Address`, `IDCardNumber`, `CreatedAt`) VALUES
(1, 'Lineth', 'Female', '', '', '', '', '2026-05-14 12:11:21'),
(2, 'Vicheka', 'Female', '', '', '', '', '2026-05-14 12:11:35'),
(3, 'Nita', 'Female', '', '', '', '', '2026-05-14 12:11:45'),
(4, 'Thy Thy', 'Female', '', '', '', '', '2026-05-14 12:12:10'),
(5, 'Chorng Chorng', 'Female', '', '', '', '', '2026-05-14 12:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `CheckOutID` int(11) NOT NULL,
  `PaymentDate` datetime DEFAULT current_timestamp(),
  `AmountPaid` decimal(10,2) NOT NULL,
  `PaymentMethod` enum('Cash','Card','Bank','Other') DEFAULT NULL,
  `PaymentStatus` enum('Paid','Pending','Refunded') NOT NULL DEFAULT 'Paid',
  `BookingID` int(11) NOT NULL,
  `InvoiceNo` varchar(20) DEFAULT NULL,
  `IsPrinted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `CheckOutID`, `PaymentDate`, `AmountPaid`, `PaymentMethod`, `PaymentStatus`, `BookingID`, `InvoiceNo`, `IsPrinted`) VALUES
(1, 1, '2026-05-14 12:33:31', 25.00, 'Bank', 'Paid', 1, 'INV-20260514-0001', 0);

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `trg_payments_invoiceno` BEFORE INSERT ON `payments` FOR EACH ROW BEGIN
  DECLARE seq INT;

  -- Count today's payments to build a daily sequence
  SELECT COUNT(*) + 1 INTO seq
  FROM `payments`
  WHERE DATE(`PaymentDate`) = CURDATE();

  -- Format: INV-YYYYMMDD-0001
  SET NEW.InvoiceNo = CONCAT(
    'INV-',
    DATE_FORMAT(NOW(), '%Y%m%d'),
    '-',
    LPAD(seq, 4, '0')
  );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `RoomTypeID` int(11) NOT NULL,
  `Status` enum('Available','Occupied','Reserved') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomNumber`, `RoomTypeID`, `Status`) VALUES
(11, '101', 1, 'Occupied'),
(12, '102', 1, 'Occupied'),
(13, '103', 2, 'Available'),
(14, '201', 3, 'Occupied'),
(15, '202', 3, 'Occupied'),
(16, '203', 4, 'Occupied'),
(17, '204', 4, 'Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeID` int(11) NOT NULL,
  `TypeName` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `PricePerNight` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeID`, `TypeName`, `Description`, `PricePerNight`) VALUES
(1, 'Single Room', NULL, 25.00),
(2, 'Double Room', NULL, 40.00),
(3, 'Deluxe Room', NULL, 60.00),
(4, 'Suite Room', NULL, 100.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `FK_Bookings_Customers` (`CustomerID`),
  ADD KEY `FK_Bookings_Rooms` (`RoomID`),
  ADD KEY `FK_Bookings_Admins` (`CreatedByAdminID`);

--
-- Indexes for table `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`CheckInID`),
  ADD KEY `FK_CheckIns_Bookings` (`BookingID`),
  ADD KEY `FK_CheckIns_Customers` (`CustomerID`),
  ADD KEY `FK_CheckIns_Rooms` (`RoomID`),
  ADD KEY `FK_CheckIns_Admins` (`CreatedByAdminID`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`CheckOutID`),
  ADD UNIQUE KEY `CheckInID` (`CheckInID`),
  ADD KEY `FK_CheckOuts_Admins` (`CreatedByAdminID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD UNIQUE KEY `InvoiceNo` (`InvoiceNo`),
  ADD KEY `FK_Payments_CheckOuts` (`CheckOutID`),
  ADD KEY `FK_Payment_Booking` (`BookingID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD UNIQUE KEY `RoomNumber` (`RoomNumber`),
  ADD KEY `FK_Rooms_RoomTypes` (`RoomTypeID`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`RoomTypeID`),
  ADD UNIQUE KEY `TypeName` (`TypeName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkins`
--
ALTER TABLE `checkins`
  MODIFY `CheckInID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `CheckOutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_Bookings_Admins` FOREIGN KEY (`CreatedByAdminID`) REFERENCES `admins` (`AdminID`),
  ADD CONSTRAINT `FK_Bookings_Customers` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `FK_Bookings_Rooms` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Constraints for table `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `FK_CheckIns_Admins` FOREIGN KEY (`CreatedByAdminID`) REFERENCES `admins` (`AdminID`),
  ADD CONSTRAINT `FK_CheckIns_Bookings` FOREIGN KEY (`BookingID`) REFERENCES `bookings` (`BookingID`),
  ADD CONSTRAINT `FK_CheckIns_Customers` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `FK_CheckIns_Rooms` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `FK_CheckOuts_Admins` FOREIGN KEY (`CreatedByAdminID`) REFERENCES `admins` (`AdminID`),
  ADD CONSTRAINT `FK_CheckOuts_CheckIns` FOREIGN KEY (`CheckInID`) REFERENCES `checkins` (`CheckInID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_Payment_Booking` FOREIGN KEY (`BookingID`) REFERENCES `bookings` (`BookingID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Payments_CheckOuts` FOREIGN KEY (`CheckOutID`) REFERENCES `checkouts` (`CheckOutID`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `FK_Rooms_RoomTypes` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
