-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 08:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airline_reservation`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`Harry`@`localhost` PROCEDURE `GetFlightStatistics` (IN `j_date` DATE)  BEGIN
 select flight_no,departure_date,IFNULL(no_of_passengers, 0) as no_of_passengers,total_capacity from (
select f.flight_no,f.departure_date,sum(t.no_of_passengers) as no_of_passengers,j.total_capacity 
from flight_det f left join Purchased_tickets t 
on t.booking_status='CONFIRMED' 
and t.flight_no=f.flight_no 
and f.departure_date=t.Journey_date 
inner join Aircraft_det j on j.Aircraft_id=f.Aircraft_id
group by flight_no,Journey_date) k where departure_date=j_date;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `pwd` varchar(30) DEFAULT NULL,
  `staff_id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `pwd`, `staff_id`, `name`, `email`) VALUES
('admin', 'password', '816963', 'Akhil Madishetty', 'AKhilmadishetty@gmail.com'),
('Gupta', 'password', '816963', 'Janakiram Gupta', 'Janakiramgupta@gmail.com'),
('Srija', 'password', '816963', 'Srija Reddy', 'Srijareddy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_name` varchar(20) NOT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_name`, `pwd`, `name`, `email`, `phone_no`, `address`) VALUES
('aadith', 'aadith007', 'aadith_name', 'aadith_email', '12345', 'aadith_address'),
('AKhil', 'password', 'Akhil Madishetty', 'akhil.madishetty7@gmail.com', '1222231', 'India'),
('charles', 'charles_pass', 'Charles', 'charles@gmail.com', '9090909090', 'Bangalore'),
('Srija', 'srija123', 'Srija_reddy', 'Srija_email', '12345', 'Srija_address');

-- --------------------------------------------------------

--
-- Table structure for table `flight_det`
--

CREATE TABLE `flight_det` (
  `flight_no` varchar(10) NOT NULL,
  `from_city` varchar(20) DEFAULT NULL,
  `to_city` varchar(20) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `seats_economy` int(5) DEFAULT NULL,
  `seats_business` int(5) DEFAULT NULL,
  `price_economy` int(10) DEFAULT NULL,
  `price_business` int(10) DEFAULT NULL,
  `Aircraft_id` varchar(10) DEFAULT NULL,
  `Journey_time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_det`
--

INSERT INTO `flight_det` (`flight_no`, `from_city`, `to_city`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `seats_economy`, `seats_business`, `price_economy`, `price_business`, `Aircraft_id`, `Journey_time`) VALUES
('E001', 'Hyderabad', 'Dubai', '2021-05-24', '2021-05-25', '15:00:00', '19:45:00', 150, 50, 50000, 95000, '10007', 0),
('E002', 'Dubai', 'Toronto', '2021-05-24', '2021-05-25', '12:00:00', '23:45:00', 150, 50, 65000, 125000, '10002', 0),
('E002', 'Delhi', 'Toronto', '2021-05-26', '2021-05-26', '05:00:00', '17:45:00', 148, 50, 48750, 125000, '10002', 13),
('E003', 'Dubai', 'London', '2021-05-24', '2021-05-25', '11:00:00', '19:45:00', 150, 50, 58000, 135000, '10004', 0),
('E004', 'Delhi', 'Toronto', '2021-05-25', '2021-05-26', '12:00:00', '23:45:00', 150, 50, 85000, 125000, '10001', 0),
('E005', 'Mumbai', 'Frankfurt', '2021-05-27', '2021-05-27', '01:00:00', '14:15:00', 150, 50, 55000, 105000, '10002', 13),
('E005', 'Mumbai', 'Frankfurt', '2021-05-28', '2021-05-28', '01:00:00', '14:15:00', 150, 50, 55000, 105000, '10002', 13),
('E006', 'Bangalore', 'Sydney', '2021-05-28', '2021-05-28', '16:00:00', '23:45:00', 150, 50, 50000, 95000, '10008', 8),
('E007', 'Hyderabad', 'Toronto', '2021-05-27', '2021-05-27', '06:00:00', '15:30:00', 299, 45, 64280, 129500, '10003', 9),
('E008', 'Dubai', 'Toronto', '2021-05-29', '2021-05-29', '11:00:00', '19:45:00', 150, 50, 58000, 135000, '10003', 8);

-- --------------------------------------------------------

--
-- Table structure for table `frequent_flier_details`
--

CREATE TABLE `frequent_flier_details` (
  `frequent_flier_no` varchar(20) NOT NULL,
  `customer_name` varchar(20) DEFAULT NULL,
  `mileage` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Aircraft_det`
--

CREATE TABLE `Aircraft_det` (
  `Aircraft_id` varchar(10) NOT NULL,
  `Aircraft_type` varchar(20) DEFAULT NULL,
  `total_capacity` int(5) DEFAULT NULL,
  `active` varchar(5) DEFAULT NULL,
  `Airlines_Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Aircraft_det`
--

INSERT INTO `Aircraft_det` (`Aircraft_id`, `Aircraft_type`, `total_capacity`, `active`, `Airlines_Name`) VALUES
('10001', 'Airbus A380', 500, 'Yes', 'Emirates'),
('10002', 'Concorde', 450, 'Yes', 'Emirates'),
('10003', 'Gulfstream ', 600, 'Yes', 'Emirates'),
('10004', 'Lockheed Vega 5b', 650, 'No', 'Emirates'),
('10005', 'The Wright Flyer', 550, 'Yes', 'Emirates'),
('10006', 'Airbus A380', 500, 'Yes', 'avianca'),
('10007', 'Concorde', 450, 'Yes', 'avianca'),
('10008', 'Gulfstream ', 600, 'Yes', 'avianca'),
('10009', 'Lockheed Vega 5b', 650, 'No', 'avianca'),
('10010', 'The Wright Flyer', 550, 'Yes', 'avianca');

-- --------------------------------------------------------

--
-- Table structure for table `passengers_det`
--

CREATE TABLE `passengers_det` (
  `passenger_id` int(10) NOT NULL,
  `PNR_NO` varchar(15) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `meal_choice` varchar(5) DEFAULT NULL,
  `frequent_flier_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passengers_det`
--

INSERT INTO `passengers_det` (`passenger_id`, `PNR_NO`, `name`, `age`, `gender`, `meal_choice`, `frequent_flier_no`) VALUES
(1, '7081866', 'Jhon', 33, 'male', 'yes', NULL),
(2, '7081866', 'Kane', 45, 'male', 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_det`
--

CREATE TABLE `payment_det` (
  `payment_id` varchar(20) NOT NULL,
  `PNR_NO` varchar(15) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` int(6) DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_det`
--

INSERT INTO `payment_det` (`payment_id`, `PNR_NO`, `payment_date`, `payment_amount`, `payment_mode`) VALUES
('135900320', '2864193', '2021-05-25', 65130, 'credit card'),
('412762614', '7081866', '2021-05-25', 99200, 'debit card');

--
-- Triggers `payment_det`
--
DELIMITER $$
CREATE TRIGGER `update_ticket_after_payment` AFTER INSERT ON `payment_det` FOR EACH ROW UPDATE Purchased_tickets
     SET booking_status='CONFIRMED', payment_id= NEW.payment_id
   WHERE PNR_NO = NEW.PNR_NO
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Purchased_tickets`
--

CREATE TABLE `Purchased_tickets` (
  `PNR_NO` varchar(15) NOT NULL,
  `date_of_reservation` date DEFAULT NULL,
  `flight_no` varchar(10) DEFAULT NULL,
  `Journey_date` date DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `no_of_passengers` int(5) DEFAULT NULL,
  `lounge_access` varchar(5) DEFAULT NULL,
  `priority_checkin` varchar(5) DEFAULT NULL,
  `insurance` varchar(5) DEFAULT NULL,
  `payment_id` varchar(20) DEFAULT NULL,
  `customer_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Purchased_tickets`
--

INSERT INTO `Purchased_tickets` (`PNR_NO`, `date_of_reservation`, `flight_no`, `Journey_date`, `class`, `booking_status`, `no_of_passengers`, `lounge_access`, `priority_checkin`, `insurance`, `payment_id`, `customer_name`) VALUES
('2864193', '2021-05-25', 'E007', '2021-05-27', 'economy', 'CONFIRMED', 1, 'yes', 'yes', 'yes', '135900320', 'akhil'),
('7081866', '2021-05-25', 'E002', '2021-05-26', 'economy', 'CONFIRMED', 2, 'yes', 'yes', 'yes', '412762614', 'charles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_name`);

--
-- Indexes for table `flight_det`
--
ALTER TABLE `flight_det`
  ADD PRIMARY KEY (`flight_no`,`departure_date`),
  ADD KEY `Aircraft_id` (`Aircraft_id`);

--
-- Indexes for table `frequent_flier_details`
--
ALTER TABLE `frequent_flier_details`
  ADD PRIMARY KEY (`frequent_flier_no`),
  ADD KEY `customer_name` (`customer_name`);

--
-- Indexes for table `Aircraft_det`
--
ALTER TABLE `Aircraft_det`
  ADD PRIMARY KEY (`Aircraft_id`);

--
-- Indexes for table `passengers_det`
--
ALTER TABLE `passengers_det`
  ADD PRIMARY KEY (`passenger_id`,`PNR_NO`),
  ADD KEY `PNR_NO` (`PNR_NO`),
  ADD KEY `frequent_flier_no` (`frequent_flier_no`);

--
-- Indexes for table `payment_det`
--
ALTER TABLE `payment_det`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `PNR_NO` (`PNR_NO`);

--
-- Indexes for table `Purchased_tickets`
--
ALTER TABLE `Purchased_tickets`
  ADD PRIMARY KEY (`PNR_NO`),
  ADD KEY `customer_name` (`customer_name`),
  ADD KEY `Journey_date` (`Journey_date`),
  ADD KEY `flight_no` (`flight_no`),
  ADD KEY `flight_no_2` (`flight_no`,`Journey_date`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight_det`
--
ALTER TABLE `flight_det`
  ADD CONSTRAINT `flight_details_ibfk_1` FOREIGN KEY (`Aircraft_id`) REFERENCES `Aircraft_det` (`Aircraft_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `frequent_flier_details`
--
ALTER TABLE `frequent_flier_details`
  ADD CONSTRAINT `frequent_flier_details_ibfk_1` FOREIGN KEY (`customer_name`) REFERENCES `customer` (`customer_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passengers_det`
--
ALTER TABLE `passengers_det`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`PNR_NO`) REFERENCES `Purchased_tickets` (`PNR_NO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passengers_ibfk_2` FOREIGN KEY (`frequent_flier_no`) REFERENCES `frequent_flier_details` (`frequent_flier_no`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_det`
--
ALTER TABLE `payment_det`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`PNR_NO`) REFERENCES `Purchased_tickets` (`PNR_NO`) ON UPDATE CASCADE;

--
-- Constraints for table `Purchased_tickets`
--
ALTER TABLE `Purchased_tickets`
  ADD CONSTRAINT `ticket_details_ibfk_2` FOREIGN KEY (`customer_name`) REFERENCES `customer` (`customer_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_details_ibfk_3` FOREIGN KEY (`flight_no`,`Journey_date`) REFERENCES `flight_det` (`flight_no`, `departure_date`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
