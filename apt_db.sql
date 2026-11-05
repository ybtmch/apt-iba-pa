-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 01:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apt_application_requests`
--

CREATE TABLE `apt_application_requests` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_application_requests`
--

INSERT INTO `apt_application_requests` (`application_id`, `user_id`, `property_id`, `application_date`, `status`) VALUES
(1, 3, 3, '2023-11-28 05:38:54', 1),
(2, 3, 4, '2023-11-28 05:38:58', 1),
(3, 4, 5, '2023-11-28 05:39:01', 1),
(4, 5, 6, '2023-11-28 05:39:04', 1),
(5, 6, 7, '2023-11-28 05:39:10', 1),
(6, 7, 8, '2023-11-28 05:39:14', 1),
(7, 8, 9, '2023-11-28 05:39:18', 1),
(8, 9, 16, '2023-11-28 05:39:22', 1),
(9, 10, 17, '2023-11-28 05:39:26', 1),
(10, 11, 18, '2023-11-28 05:39:32', 1),
(11, 12, 19, '2023-11-28 05:39:36', 1),
(12, 13, 20, '2023-11-28 05:39:40', 1),
(13, 12, 21, '2023-11-28 05:39:44', 1),
(14, 14, 22, '2023-11-28 05:39:47', 1),
(15, 15, 23, '2023-11-28 05:41:30', 1),
(16, 16, 24, '2023-11-28 07:38:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_appointments`
--

CREATE TABLE `apt_appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_number` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_appointments`
--

INSERT INTO `apt_appointments` (`appointment_id`, `appointment_number`, `property_id`, `user_id`, `date`, `time`, `status`) VALUES
(1, 'APT-TRIJ91EZ', 5, 16, '2023-11-30', '11:30 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_bookmarks`
--

CREATE TABLE `apt_bookmarks` (
  `bookmark_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_bookmarks`
--

INSERT INTO `apt_bookmarks` (`bookmark_id`, `property_id`, `user_id`, `status`) VALUES
(1, 22, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_chats`
--

CREATE TABLE `apt_chats` (
  `chat_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_chats`
--

INSERT INTO `apt_chats` (`chat_id`, `property_id`, `landlord_id`, `user_id`, `status`) VALUES
(1, 5, 4, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_faqs`
--

CREATE TABLE `apt_faqs` (
  `faq_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_faqs`
--

INSERT INTO `apt_faqs` (`faq_id`, `admin_id`, `question`, `answer`, `status`) VALUES
(1, 0, 'How do I find accommodations on this website?', 'You can browse for properties by going to the accommodations page. For more specific results, you can search for property names or locations. There are also available filters to provide more narrow results. ', 1),
(2, 0, 'Is it free to use this website to find accommodations?', 'Yes, using our website to find accommodations is free. You only pay when you apply for a room reservation.', 1),
(3, 0, 'What information do I need to provide to request a visit or apply for a reservation?', 'To make certain requests, you will need to create an account, providing your name, email, contact number, and picture.', 1),
(4, 0, 'Is my personal information safe on this website?', 'Yes, we take your privacy seriously. We use secure technology to protect your information.', 1),
(5, 0, 'Can I leave a review of the accommodation I have stayed in?', 'Yes, we encourage you to leave a review to help others make informed decisions.', 1),
(6, 0, 'What should I do if I forget my password?', 'If you forget your password, you can usually reset it by clicking on the \"Forgot password\" link on the login page.', 1),
(7, 0, 'How can I see photos and read more about the accommodations?', 'Click on the accommodation listing to see more photos, details, and reviews.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apt_feedbacks`
--

CREATE TABLE `apt_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_type` varchar(255) NOT NULL,
  `feedback_part` varchar(255) NOT NULL,
  `feedback_page` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_logs`
--

CREATE TABLE `apt_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_logs`
--

INSERT INTO `apt_logs` (`log_id`, `user_id`, `action`, `description`, `date_time`) VALUES
(1, 2, 'register', 'Micoh Yabut created an account using micohyabut01@gmail.com', '2023-11-28 02:21:39'),
(2, 3, 'register', 'Jonathan Buitizon created an account using aufcooperative@gmail.com', '2023-11-28 03:15:13'),
(3, 3, 'application', 'Jonathan Buitizon filed an application for AUF COOP Dormitory 3', '2023-11-28 03:30:40'),
(4, 3, 'application', 'Jonathan Buitizon filed an application for AUF COOP Dormitory 4', '2023-11-28 03:34:03'),
(5, 4, 'register', 'Jason Joven created an account using tridia@gmail.com', '2023-11-28 03:35:37'),
(6, 4, 'application', 'Jason Joven filed an application for Tridia Dormitory', '2023-11-28 03:39:54'),
(7, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 03:41:27'),
(8, 5, 'register', 'Raquel Diaz created an account using raqueldiaz@gmail.com', '2023-11-28 03:46:38'),
(9, 5, 'application', 'Raquel Diaz filed an application for Sarmiento Dormitory', '2023-11-28 03:48:56'),
(10, 6, 'register', 'Arsenia Pineda created an account using dejesusdorm@gmail.com', '2023-11-28 03:50:23'),
(11, 6, 'application', 'Arsenia Pineda filed an application for Crisel De Jesus Dormitory', '2023-11-28 03:53:36'),
(12, 7, 'register', 'Janice Aguas created an account using janiceaguas@gmail.com', '2023-11-28 03:55:03'),
(13, 8, 'register', 'Adelfo Layug created an account using warren@gmail.com', '2023-11-28 03:55:39'),
(14, 7, 'login', 'Janice Aguas has logged in using janiceaguas@gmail.com', '2023-11-28 03:55:54'),
(15, 7, 'application', 'Janice Aguas filed an application for St. Mary\'s Dormitory', '2023-11-28 03:58:06'),
(16, 8, 'login', 'Adelfo Layug has logged in using warren@gmail.com', '2023-11-28 03:58:35'),
(17, 8, 'application', 'Adelfo Layug filed an application for Waren III Dormitory', '2023-11-28 04:00:25'),
(18, 9, 'register', 'Maribel Galang created an account using valenzuela@gmail.com', '2023-11-28 04:01:31'),
(19, 9, 'application', 'Maribel Galang filed an application for AA Valenzuela Dormitory', '2023-11-28 04:04:03'),
(20, 10, 'register', 'Remedios Surla created an account using emlaz@gmail.com', '2023-11-28 04:04:43'),
(21, 10, 'application', 'Remedios Surla filed an application for Emlaz Dormitory', '2023-11-28 04:07:38'),
(22, 11, 'register', 'Jeanne Valencia created an account using batac@gmail.com', '2023-11-28 04:51:24'),
(23, 11, 'application', 'Jeanne Valencia filed an application for Batac Dormitory', '2023-11-28 04:57:00'),
(24, 12, 'register', 'RM Mamac created an account using rmmamac@gmail.com', '2023-11-28 04:57:45'),
(25, 12, 'application', 'RM Mamac filed an application for Triple J Dormitory', '2023-11-28 05:00:34'),
(26, 13, 'register', 'Nelia Roquel created an account using neliaroquel@gmail.com', '2023-11-28 05:03:02'),
(27, 13, 'application', 'Nelia Roquel filed an application for Quecami House Dormitory', '2023-11-28 05:05:27'),
(28, 12, 'login', 'RM Mamac has logged in using rmmamac@gmail.com', '2023-11-28 05:06:01'),
(29, 12, 'application', 'RM Mamac filed an application for RMM Dormitory', '2023-11-28 05:10:30'),
(30, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 05:10:43'),
(31, 14, 'register', 'Maximo Talao created an account using burjs@gmail.com', '2023-11-28 05:14:54'),
(32, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 05:23:57'),
(33, 14, 'application', 'Maximo Talao filed an application for Burj\'s Dormitory', '2023-11-28 05:24:15'),
(34, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 05:27:09'),
(35, 14, 'login', 'Maximo Talao has logged in using burjs@gmail.com', '2023-11-28 05:27:40'),
(36, 15, 'register', 'Amelia Pangan created an account using svzdorm@gmail.com', '2023-11-28 05:32:49'),
(37, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 05:38:42'),
(38, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 05:39:31'),
(39, 15, 'application', 'Amelia Pangan filed an application for SVZ Apartment', '2023-11-28 05:40:33'),
(40, 3, 'login', 'Jonathan Buitizon has logged in using aufcooperative@gmail.com', '2023-11-28 05:53:21'),
(41, 4, 'login', 'Jason Joven has logged in using tridia@gmail.com', '2023-11-28 05:53:55'),
(42, 16, 'register', 'Aaron David created an account using aaron@gmail.com', '2023-11-28 07:19:49'),
(43, 16, 'appointment', 'Aaron David requested an appointment at Tridia Dormitoryfor November 30, 2023 at 11:30 AM', '2023-11-28 07:21:14'),
(44, 16, 'application', 'Aaron David filed an application for AUF COOP', '2023-11-28 07:36:20'),
(45, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-11-28 07:36:47'),
(46, 16, 'login', 'Aaronnnn David has logged in using aaron@gmail.com', '2023-11-28 07:41:16'),
(47, 2, 'login', 'Micoh Yabut has logged in using micohyabut01@gmail.com', '2023-11-28 07:43:06'),
(48, 2, 'reservation', 'Micoh Yabut has made a reservation for Double-Bed Room at AUF COOP', '2023-11-28 07:44:04'),
(49, 2, 'reservation', 'Micoh Yabut has made a reservation for Double-Bed Room at AUF COOP', '2023-11-28 07:45:03'),
(50, 2, 'reservation', 'Micoh Yabut has made a reservation for Double-Bed Room at AUF COOP', '2023-11-28 07:47:08'),
(51, 2, 'login', 'Micoh Yabut has logged in using micohyabut01@gmail.com', '2023-12-06 14:31:53'),
(52, 3, 'login', 'Jonathan Buitizon has logged in using aufcooperative@gmail.com', '2023-12-06 14:33:42'),
(53, 2, 'login', 'Micoh Yabut has logged in using micohyabut01@gmail.com', '2023-12-06 21:27:06'),
(54, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-12-06 21:37:03'),
(55, 14, 'login', 'Maximo Talao has logged in using burjs@gmail.com', '2023-12-06 21:53:51'),
(56, 2, 'login', 'Micoh Yabut has logged in using micohyabut01@gmail.com', '2023-12-06 22:02:35'),
(57, 1, 'login', 'Apt Admin has logged in using admin@apt.com', '2023-12-06 22:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `apt_messages`
--

CREATE TABLE `apt_messages` (
  `message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isRead` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_notifications`
--

CREATE TABLE `apt_notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notification_type` varchar(255) NOT NULL,
  `isRead` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_notifications`
--

INSERT INTO `apt_notifications` (`notification_id`, `user_id`, `notification_text`, `timestamp`, `notification_type`, `isRead`, `status`) VALUES
(2, 3, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:30:40', 'application', 0, 1),
(4, 3, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:34:03', 'application', 0, 1),
(6, 4, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:39:54', 'application', 0, 1),
(7, 1, 'An application has been made for the property Sarmiento Dormitory by the user Raquel Diaz', '2023-11-28 03:48:56', 'application', 0, 1),
(8, 5, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:48:56', 'application', 0, 1),
(9, 1, 'An application has been made for the property Crisel De Jesus Dormitory by the user Arsenia Pineda', '2023-11-28 03:53:36', 'application', 0, 1),
(10, 6, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:53:36', 'application', 0, 1),
(11, 1, 'An application has been made for the property St. Mary\'s Dormitory by the user Janice Aguas', '2023-11-28 03:58:06', 'application', 0, 1),
(12, 7, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 03:58:06', 'application', 0, 1),
(13, 1, 'An application has been made for the property Waren III Dormitory by the user Adelfo Layug', '2023-11-28 04:00:25', 'application', 0, 1),
(14, 8, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 04:00:25', 'application', 0, 1),
(15, 1, 'An application has been made for the property AA Valenzuela Dormitory by the user Maribel Galang', '2023-11-28 04:04:03', 'application', 0, 1),
(16, 9, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 04:04:03', 'application', 0, 1),
(17, 1, 'An application has been made for the property Emlaz Dormitory by the user Remedios Surla', '2023-11-28 04:07:38', 'application', 0, 1),
(18, 10, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 04:07:38', 'application', 0, 1),
(19, 1, 'An application has been made for the property Batac Dormitory by the user Jeanne Valencia', '2023-11-28 04:57:00', 'application', 0, 1),
(20, 11, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 04:57:00', 'application', 0, 1),
(21, 1, 'An application has been made for the property Triple J Dormitory by the user RM Mamac', '2023-11-28 05:00:34', 'application', 0, 1),
(22, 12, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 05:00:34', 'application', 0, 1),
(23, 1, 'An application has been made for the property Quecami House Dormitory by the user Nelia Roquel', '2023-11-28 05:05:27', 'application', 0, 1),
(24, 13, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 05:05:27', 'application', 0, 1),
(25, 1, 'An application has been made for the property RMM Dormitory by the user RM Mamac', '2023-11-28 05:10:30', 'application', 0, 1),
(26, 12, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 05:10:30', 'application', 0, 1),
(27, 1, 'An application has been made for the property Burj\'s Dormitory by the user Maximo Talao', '2023-11-28 05:24:15', 'application', 0, 1),
(28, 14, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 05:27:59', 'application', 1, 1),
(29, 1, 'An application has been made for the property SVZ Apartment by the user Amelia Pangan', '2023-11-28 05:40:33', 'application', 0, 1),
(30, 15, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 05:40:33', 'application', 0, 1),
(31, 4, 'An appointment has been scheduled for your property, Tridia Dormitory, on November 30, 2023 at 11:30 AM by Aaron David. Appointment number: APT-TRIJ91EZ', '2023-11-28 07:21:14', 'appointment', 0, 1),
(32, 1, 'An application has been made for the property AUF COOP by the user Aaron David', '2023-11-28 07:36:20', 'application', 0, 1),
(33, 16, 'We have received the application for your property. Please wait for Apt. Iba Pa to contact you. Thank you', '2023-11-28 07:45:36', 'application', 1, 1),
(34, 16, 'A reservation has been made for a Double-Bed Room on your property, AUF COOP by Micoh Yabut', '2023-11-28 07:45:36', 'reservation', 1, 1),
(35, 16, 'A reservation has been made for a Double-Bed Room on your property, AUF COOP by Micoh Yabut', '2023-11-28 07:45:36', 'reservation', 1, 1),
(36, 16, 'A reservation has been made for a Double-Bed Room on your property, AUF COOP by Micoh Yabut', '2023-11-28 07:47:08', 'reservation', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_password_reset_tokens`
--

CREATE TABLE `apt_password_reset_tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_payments`
--

CREATE TABLE `apt_payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `transaction_number` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_payments`
--

INSERT INTO `apt_payments` (`payment_id`, `user_id`, `payment_type`, `transaction_number`, `date`) VALUES
(1, 2, 'credit card', 'ch_3OHLxhHBdKJS22070WHLGBCV', '2023-11-28 07:44:05'),
(2, 2, 'credit card', 'ch_3OHLycHBdKJS22071Sw250NF', '2023-11-28 07:45:03'),
(3, 2, 'credit card', 'ch_3OHM0dHBdKJS22071XiGqUiB', '2023-11-28 07:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `apt_properties`
--

CREATE TABLE `apt_properties` (
  `property_id` int(11) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_properties`
--

INSERT INTO `apt_properties` (`property_id`, `property_type`, `property_name`, `landlord_id`, `status`) VALUES
(3, 'Dormitory', 'AUF COOP Dormitory 3', 3, 1),
(4, 'Dormitory', 'AUF COOP Dormitory 4', 3, 1),
(5, 'Dormitory', 'Tridia Dormitory', 4, 1),
(6, 'Dormitory', 'Sarmiento Dormitory', 5, 1),
(7, 'Dormitory', 'Crisel De Jesus Dormitory', 6, 1),
(8, 'Dormitory', 'St. Mary\'s Dormitory', 7, 1),
(9, 'Dormitory', 'Waren III Dormitory', 8, 1),
(16, 'Dormitory', 'AA Valenzuela Dormitory', 9, 1),
(17, 'Dormitory', 'Emlaz Dormitory', 10, 1),
(18, 'Dormitory', 'Batac Dormitory', 11, 1),
(19, 'Dormitory', 'Triple J Dormitory', 12, 1),
(20, 'Dormitory', 'Quecami House Dormitory', 13, 1),
(21, 'Dormitory', 'RMM Dormitory', 12, 1),
(22, 'Dormitory', 'Burj\'s Dormitory', 14, 1),
(23, 'Apartment', 'SVZ Apartment', 15, 1),
(24, 'Dormitory', 'AUF COOP', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_amenities`
--

CREATE TABLE `apt_property_amenities` (
  `amenity_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `aircon` tinyint(1) NOT NULL,
  `bathroom` tinyint(1) NOT NULL,
  `cabinet` tinyint(1) NOT NULL,
  `cctv` tinyint(1) NOT NULL,
  `drinking_water` tinyint(1) NOT NULL,
  `elevator` tinyint(1) NOT NULL,
  `emergency_exit` tinyint(1) NOT NULL,
  `food_hall` tinyint(1) NOT NULL,
  `laundry` tinyint(1) NOT NULL,
  `lounge` tinyint(1) NOT NULL,
  `microwave` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `refrigerator` tinyint(1) NOT NULL,
  `security` tinyint(1) NOT NULL,
  `sink` tinyint(1) NOT NULL,
  `study_area` tinyint(1) NOT NULL,
  `tv` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_amenities`
--

INSERT INTO `apt_property_amenities` (`amenity_id`, `property_id`, `aircon`, `bathroom`, `cabinet`, `cctv`, `drinking_water`, `elevator`, `emergency_exit`, `food_hall`, `laundry`, `lounge`, `microwave`, `parking`, `refrigerator`, `security`, `sink`, `study_area`, `tv`, `wifi`, `status`) VALUES
(1, 3, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 0, 1, 1),
(2, 4, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 1),
(3, 5, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1, 1),
(4, 6, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(5, 7, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1),
(6, 8, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 1, 1),
(7, 9, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1),
(8, 16, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1),
(9, 17, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1),
(10, 18, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 0, 1, 1),
(11, 19, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 0, 1, 1),
(12, 20, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(13, 21, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1),
(14, 22, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1),
(15, 23, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1),
(16, 24, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_availability`
--

CREATE TABLE `apt_property_availability` (
  `availability_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `time_slots` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_availability`
--

INSERT INTO `apt_property_availability` (`availability_id`, `property_id`, `time_slots`, `status`) VALUES
(1, 3, '8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 4:00 PM, 4:30 PM', 1),
(2, 4, '8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM', 1),
(3, 5, '10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM', 1),
(4, 6, '12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM', 1),
(5, 7, '10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 4:00 PM, 4:30 PM, 5:00 PM', 1),
(6, 8, '9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 5:00 PM', 1),
(7, 9, '12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM, 6:00 PM', 1),
(8, 16, '8:00 AM, 8:30 AM, 9:00 AM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 6:30 PM, 7:00 PM, 7:30 PM', 1),
(9, 17, '9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM', 1),
(10, 18, '6:00 AM, 6:30 AM, 7:00 AM, 7:30 AM, 8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM, 6:00 PM, 6:30 PM, 7:00 PM, 7:30 PM, 8:00 PM', 1),
(11, 19, '10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM', 1),
(12, 20, '12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM', 1),
(13, 21, '9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM', 1),
(14, 22, '7:00 AM, 7:30 AM, 8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM', 1),
(15, 23, '8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM', 1),
(16, 24, '8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_details`
--

CREATE TABLE `apt_property_details` (
  `property_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `total_floors` int(20) NOT NULL,
  `total_units` int(3) NOT NULL,
  `occupied_units` int(11) NOT NULL,
  `lowest_rate` float NOT NULL,
  `electric_bill` varchar(255) DEFAULT NULL,
  `water_bill` varchar(255) DEFAULT NULL,
  `reservation_fee` float NOT NULL,
  `advance_deposit` float NOT NULL,
  `gcash` varchar(255) DEFAULT NULL,
  `maya` varchar(255) DEFAULT NULL,
  `credit_card` varchar(255) DEFAULT NULL,
  `cash` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_details`
--

INSERT INTO `apt_property_details` (`property_id`, `description`, `total_floors`, `total_units`, `occupied_units`, `lowest_rate`, `electric_bill`, `water_bill`, `reservation_fee`, `advance_deposit`, `gcash`, `maya`, `credit_card`, `cash`, `status`) VALUES
(3, 'AUF COOP Dormitory offers a secured and comfortable living spaces for AUF students.', 4, 15, 0, 9000, '1000', '240', 6000, 0, 'Yes', NULL, NULL, 1, 1),
(4, 'AUF COOP Dormitory offers a secured and comfortable living spaces for AUF students.', 4, 23, 0, 6000, '1000', '240', 6000, 0, 'Yes', NULL, NULL, 1, 1),
(5, 'Tridia Dormitory is a well-appointed accommodation option situated in close proximity to Angeles University Foundation. This dormitory offers a prime location for students and individuals looking for a comfortable living space near the university.', 2, 26, 0, 4000, '800', '300', 4000, 0, 'Yes', NULL, NULL, 1, 1),
(6, 'Sarmiento Dormitory is the perfect place for students. It\'s super close to popular universities like AUF and HAU, so you won\'t have to travel far for your classes. Plus, you\'ll find all the essential stuff you need nearby. It\'s like a comfortable and friendly home that makes studying a breeze.', 4, 12, 0, 6000, '500', '100', 6000, 0, NULL, NULL, NULL, 1, 1),
(7, 'Make your academic journey a breeze at Sel\'s Dormitory, strategically located near Angeles University Foundation, Holy Angel University, and more. Effortlessly access schools like Angeles City Science High School and Claro M. Recto Information and Communication Technology High School, along with essential amenities, thanks to the nearby transportation terminals.', 4, 9, 0, 6500, '1000', '200', 6500, 0, NULL, NULL, NULL, 1, 1),
(8, 'St. Mary Dormitory offers the ideal location, making it a snap to reach schools like Angeles University Foundation, Holy Angel University, and Angeles City Science High School. In addition, transportation terminals nearby ensure stress-free commutes to your classes and daily necessities.', 2, 8, 0, 7000, '1000', '250', 7000, 0, 'Yes', NULL, NULL, 1, 1),
(9, 'Warren III Dormitory is your gateway to hassle-free education, with its proximity to universities like Angeles University Foundation and Holy Angel University. You\'ll also have easy access to schools like Angeles City Science High School and Claro M. Recto Information and Communication Technology High School, along with various transportation options for smooth travel.', 4, 14, 0, 5000, '800', '150', 5000, 0, 'Yes', NULL, NULL, 1, 1),
(16, 'AA Valenzuela Dormitory, a 3 Storey Dormitory, puts you at the center of convenience, with easy travel to Angeles University Foundation, Holy Angel University, and other nearby schools. Count on accessible transportation terminals for a smooth commute to your classes and essential facilities. ', 3, 8, 0, 6000, '800', '200', 6000, 0, 'Yes', NULL, NULL, 1, 1),
(17, 'We are near AUF Angeles University Foundation and a 5 to 8-minute walk to HAU Holy Angel University.  An 8 to 15-minute one-ride to Clark Freeport Zone.  If you are familiar with the Chinabank and Security Bank at MacArthur Highway, take San Pablo Street between those banks.  Straight down San Pablo Street in a short walk you will hit the intersection and your very right corner is the Claro M. Recto Barangay Hall.  ', 3, 13, 0, 6000, '800', '200', 6000, 2000, NULL, NULL, NULL, 1, 1),
(18, 'Batac Domritory offers a hassle-free academic experience, situated conveniently near universities like Angeles University Foundation and Holy Angel University. With nearby transportation terminals, getting to your classes and essential amenities is a breeze.', 3, 4, 0, 6500, '1500', NULL, 3500, 0, 'Yes', NULL, NULL, 1, 1),
(19, 'To all ladies out there who are looking for a \"HOME AWAY FROM HOME\" in Angeles City, this might just be the place for you! TRIPLE J DORMITORY — Move into this cozy and spacious LADIES DORM Looking for convenient and affordable living in the city? Well, look no further! We have available Two (2) Bedroom, Duplex Apartment Units just waiting for you to make them your home!', 2, 12, 0, 5000, '800', '250', 5000, 0, 'Yes', NULL, NULL, 1, 1),
(20, 'Quecami House is a newly-built girl\'s dormitory located close to the university and the city centre. This stylish property offers its residents convenience, comfort, and a high level of security. The premises are equipped with different amenities. ', 2, 8, 0, 6500, '1000', '350', 6500, 0, 'Yes', NULL, NULL, 1, 1),
(21, 'To all ladies out there who are looking for a \"HOME AWAY FROM HOME\" in Angeles City, this might just be the place for you! TRIPLE J DORMITORY — Move into this cozy and spacious LADIES DORM Looking for convenient and affordable living in the city? Well, look no further! We have available Two (2) Bedroom, Duplex Apartment Units just waiting for you to make them your home!', 2, 12, 0, 8000, '2000', '350', 5000, 16000, 'Yes', NULL, NULL, 1, 1),
(22, 'Burj\'s Dormitory is a conveniently located accommodation situated in front of Angeles University Foundation. It offers a practical and accessible living space for students and individuals looking to reside near the university. With its prime location, residents have easy access to the campus facilities and activities.', 4, 20, 0, 8000, '800', '200', 4500, 4500, NULL, NULL, NULL, 1, 1),
(23, 'Discover the perfect location at SVZ Apartment, allowing you to access universities like Angeles University Foundation and Holy Angel University with ease. As it is next to AUF Sports Cultural Center and infront of Lourdes Parish Church. Additionally, nearby transportation terminals make it simple to reach schools like Angeles City Science High School and Claro M. Recto Information and Communication Technology High School, as well as essential services. ', 4, 2, 0, 2000, '5000', '800', 1000, 20000, NULL, NULL, NULL, 1, 1),
(24, 'short description', 4, 20, 20, 5000, '1000', '240', 5000, 0, 'Yes', 'Yes', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_faqs`
--

CREATE TABLE `apt_property_faqs` (
  `faq_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_images`
--

CREATE TABLE `apt_property_images` (
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `thumbnail` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_images`
--

INSERT INTO `apt_property_images` (`image_id`, `property_id`, `image_path`, `title`, `thumbnail`, `status`) VALUES
(1, 3, '3coop1.jpg', 'CR', 0, 1),
(2, 3, '3coop2.jpg', 'Hallway', 0, 1),
(3, 3, '3coop3.jpg', 'Roofdeck', 0, 1),
(4, 3, '3coop4.jpg', 'Room', 1, 1),
(5, 4, 'IMG_4319.jpg', 'Sink', 0, 1),
(6, 4, 'IMG_4322.jpg', 'Room', 0, 1),
(7, 4, 'IMG_4326.jpg', 'Desk', 0, 1),
(8, 4, 'IMG_4327.jpg', 'Cabinet', 0, 1),
(9, 4, 'IMG_4331.jpg', 'Outside', 1, 1),
(10, 5, 'Tridia1.webp', 'Outside', 1, 1),
(11, 5, 'Tridia2.webp', 'CR', 0, 1),
(12, 5, 'Tridia3.webp', 'Room 1', 0, 1),
(13, 5, 'Tridia4.webp', 'Hallway', 0, 1),
(14, 5, 'Tridia5.webp', 'Dining Area', 0, 1),
(15, 5, 'Tridia6.webp', 'Room 2', 0, 1),
(16, 6, 'sarmiento1.webp', 'Room 1', 1, 1),
(17, 6, 'sarmiento2.webp', 'Room 2', 0, 1),
(18, 6, 'sarmiento3.webp', 'Dining', 0, 1),
(19, 6, 'sarmiento4.webp', 'Cabinet', 0, 1),
(20, 7, 'sel1.webp', 'Dining Area', 0, 1),
(21, 7, 'sel2.webp', 'Lounge', 0, 1),
(22, 7, 'sel3.webp', 'Front', 0, 1),
(23, 7, 'sel4.webp', 'Outside', 1, 1),
(24, 7, 'sel5.webp', 'Hallway', 0, 1),
(25, 7, 'sel8.webp', 'Dining Area 2', 0, 1),
(26, 8, 'stmary1.webp', 'Room 1', 0, 1),
(27, 8, 'stmary2.webp', 'Lounge', 1, 1),
(28, 8, 'stmary3.webp', 'CR', 0, 1),
(29, 8, 'stmary4.webp', 'Hallway', 0, 1),
(30, 8, 'stmary5.webp', 'Room 2', 0, 1),
(31, 8, 'stmary6.webp', 'Lounge 2', 0, 1),
(32, 9, '241360300_4392143000850798_3281780844818049475_n.webp', 'Hallway', 0, 1),
(33, 9, '332476739_2458997520930732_2985384276627900555_n.webp', 'Room 1', 1, 1),
(34, 9, '332555359_689631806177816_6047484500576784131_n.webp', 'Room 2', 0, 1),
(39, 16, '398112003_807197314749200_6011218152423486073_n.webp', 'Kitchen', 0, 1),
(40, 16, 'aavalenzuela2.webp', 'CR', 0, 1),
(41, 16, 'aavalenzuela3.webp', 'Room', 0, 1),
(42, 16, 'aavalenzuela5.webp', 'Living Area', 0, 1),
(43, 16, 'aavalenzuela7.webp', 'Outside', 1, 1),
(44, 17, '393791959_10230571691057452_8630800388156209836_n.webp', 'Living Area', 0, 1),
(45, 17, '394144163_10230571690097428_5851356451650709080_n.webp', 'CR', 0, 1),
(46, 17, '394150385_10230571692657492_363781128953140962_n.webp', 'Living Area 2', 0, 1),
(47, 17, 'emlaz1.webp', 'Room', 0, 1),
(48, 17, 'emlaz2.webp', 'Room', 0, 1),
(49, 17, 'emlaz5.webp', 'Outside', 1, 1),
(50, 18, 'IMG_4374.webp', 'CR', 0, 1),
(51, 18, 'IMG_4377.webp', 'Room', 0, 1),
(52, 18, 'IMG_4378.webp', 'Hall', 1, 1),
(53, 18, 'IMG_4379.webp', 'Lounge', 0, 1),
(54, 18, 'IMG_4381.webp', 'Room 2', 0, 1),
(55, 19, '180742785_103757878637485_5755467829537509918_n.webp', 'Outside', 1, 1),
(56, 19, '185310289_103757675304172_7121829603078518079_n.webp', 'Room', 0, 1),
(57, 19, '205230266_104510485228891_5649896889255797457_n.webp', 'CR', 0, 1),
(58, 19, '205263161_104510625228877_5746707922379157848_n.webp', 'Kitchen', 0, 1),
(59, 20, '11538961_108715082804132_6334708508166194659_o.webp', 'Room', 0, 1),
(60, 20, '11710044_108715112804129_5640245827510591670_o.webp', 'Admin', 0, 1),
(61, 20, '11707827_108715246137449_7335000751880547326_o.webp', 'Outside', 0, 1),
(62, 20, '300365137_381702307464976_179491343091493287_n.webp', 'Study Area', 1, 1),
(63, 21, '271764495_292455422910572_4501687427801296592_n.webp', 'Room', 0, 1),
(64, 21, '271795938_292455439577237_2944984135297921209_n.webp', 'Poster', 0, 1),
(65, 21, '271845289_292455409577240_1727305419430476509_n.webp', 'Living Area', 1, 1),
(66, 22, '5.webp', 'Bathroom ', 0, 1),
(67, 22, '4.webp', 'Room', 1, 1),
(68, 22, '2.webp', 'Room 1', 0, 1),
(69, 22, '1.webp', 'Room 2', 0, 1),
(70, 23, 'IMG_4803.webp', 'Kitchen', 0, 1),
(71, 23, 'IMG_4802.webp', 'Room', 0, 1),
(72, 23, 'IMG_4806.webp', 'Building', 1, 1),
(73, 24, 'menu-bg.webp', 'Room', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_locations`
--

CREATE TABLE `apt_property_locations` (
  `property_id` int(11) NOT NULL,
  `property_number` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_locations`
--

INSERT INTO `apt_property_locations` (`property_id`, `property_number`, `street`, `barangay`, `city`, `province`, `region`, `latitude`, `longitude`, `status`) VALUES
(3, '1395', 'M. Ponce', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.146052142850388', '120.59423003312548', 1),
(4, '1378', 'M. Ponce', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.145415238803118', '120.59304434616075', 1),
(5, '382', 'T Claudio ', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.143632043852607', '120.59544539234274', 1),
(6, '44', 'P. Nuque', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.145767348594573', '120.59265868287339', 1),
(7, '1387', 'M. Ponce', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.146000362105104', '120.59412443266771', 1),
(8, '674', 'Manuel Roxas ', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.145912334809058', '120.59332451235927', 1),
(9, '625', 'Biak-na-Bato', 'Salapungan', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.144949210237376', '120.59633092425679', 1),
(16, '554', 'Pineda', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.146880633052161', '120.59309366287424', 1),
(17, '1671', 'T. Alonzo ', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.147196494087726', '120.59230602019493', 1),
(18, '678', 'Manuel Roxas', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.145772526675376', '120.59340137855888', 1),
(19, '739', 'Sta. Lucia', 'Lourdes Sur East', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.141292144908038', '120.59316337108613', 1),
(20, '1100', 'T. Claudio', 'Lourdes Sur East', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.142556914116241', '120.59364885091784', 1),
(21, '610', 'Manuel Roxas', 'Lourdes Sur East', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.143353054625328', '120.5948156118393', 1),
(22, '452', 'Cuatro de Hulyo', 'Salapungan', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.146101981805757', '120.59567735571977', 1),
(23, 'Lot 3, Blk 37', 'Fajardo St.', 'Lourdes Sur East', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.144747264206938', '120.59669447353602', 1),
(24, '231', 'M. Ponce', 'Claro M. Recto', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.146127742727597', '120.59439517760285', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_rules`
--

CREATE TABLE `apt_property_rules` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `short_term` tinyint(1) NOT NULL,
  `min_weeks` int(2) NOT NULL,
  `mix_gender` tinyint(1) NOT NULL,
  `curfew` tinyint(1) NOT NULL,
  `from_curfew` varchar(255) DEFAULT NULL,
  `to_curfew` varchar(255) DEFAULT NULL,
  `cooking` tinyint(1) NOT NULL,
  `pets` tinyint(1) NOT NULL,
  `visitors` tinyint(1) NOT NULL,
  `from_visit` varchar(255) DEFAULT NULL,
  `to_visit` varchar(255) DEFAULT NULL,
  `alcohol` tinyint(1) NOT NULL,
  `smoking` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_rules`
--

INSERT INTO `apt_property_rules` (`id`, `property_id`, `short_term`, `min_weeks`, `mix_gender`, `curfew`, `from_curfew`, `to_curfew`, `cooking`, `pets`, `visitors`, `from_visit`, `to_visit`, `alcohol`, `smoking`, `status`) VALUES
(1, 3, 1, 1, 0, 1, '12MN', '4AM', 0, 0, 1, '3:00 AM', '4:00 PM', 0, 0, 1),
(2, 4, 0, 1, 1, 1, '12MN', '4AM', 0, 0, 1, '3:00 AM', '2:00 AM', 0, 0, 1),
(3, 5, 0, 1, 0, 1, '11PM', '5AM', 0, 0, 1, '3:00 AM', '2:00 AM', 0, 0, 1),
(4, 6, 1, 1, 1, 0, NULL, NULL, 1, 0, 1, '3:00 AM', '2:00 AM', 0, 0, 1),
(5, 7, 0, 8, 1, 0, NULL, NULL, 0, 0, 1, '3:00 AM', '2:00 AM', 0, 0, 1),
(6, 8, 0, 1, 0, 0, NULL, NULL, 0, 0, 1, '3:00 AM', '2:00 AM', 0, 0, 1),
(7, 9, 0, 1, 0, 1, '11PM', '4AM', 0, 0, 0, NULL, NULL, 0, 0, 1),
(8, 16, 1, 1, 1, 1, '11PM', '5AM', 1, 0, 0, NULL, NULL, 0, 0, 1),
(9, 17, 1, 1, 1, 1, '11PM', '5AM', 0, 0, 1, '8:00 AM', '5:00 PM', 0, 0, 1),
(10, 18, 0, 1, 0, 0, NULL, NULL, 0, 1, 1, '6:00 AM', '12:00 MN', 0, 0, 1),
(11, 19, 0, 1, 1, 0, NULL, NULL, 1, 0, 0, NULL, NULL, 0, 0, 1),
(12, 20, 0, 1, 1, 0, NULL, NULL, 0, 0, 1, '8:00 AM', '11:00 PM', 0, 0, 1),
(13, 21, 0, 1, 0, 1, '8PM', '5AM', 1, 0, 1, '8:00 AM', '6:00 PM', 0, 0, 1),
(14, 22, 0, 6, 1, 0, NULL, NULL, 1, 1, 1, '7:00 AM', '4:00 PM', 0, 1, 1),
(15, 23, 0, 6, 1, 0, NULL, NULL, 1, 1, 1, '6:00 AM', '12:00 MN', 0, 0, 1),
(16, 24, 0, 1, 0, 1, '6PM', '3AM', 0, 0, 1, '3:00 AM', '4:00 PM', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_reservations`
--

CREATE TABLE `apt_reservations` (
  `reservation_id` int(11) NOT NULL,
  `reservation_number` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `no_of_units` int(2) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_reservations`
--

INSERT INTO `apt_reservations` (`reservation_id`, `reservation_number`, `user_id`, `property_id`, `unit_id`, `no_of_units`, `payment_status`, `reservation_date`, `status`) VALUES
(1, 'APT-AUFO5TVT', 2, 24, 27, 1, 1, '2023-11-28 07:44:04', 1),
(2, 'APT-AUF431N6', 2, 24, 27, 1, 1, '2023-11-28 07:45:03', 1),
(3, 'APT-AUF2W3HN', 2, 24, 27, 1, 1, '2023-11-28 07:47:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_reviews`
--

CREATE TABLE `apt_reviews` (
  `review_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `description` text NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_unavailable_slots`
--

CREATE TABLE `apt_unavailable_slots` (
  `slot_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_unavailable_slots`
--

INSERT INTO `apt_unavailable_slots` (`slot_id`, `property_id`, `date`, `time`) VALUES
(1, 5, '2023-11-30', '11:30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `apt_units`
--

CREATE TABLE `apt_units` (
  `unit_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `total_units` int(11) NOT NULL,
  `occupied_units` int(11) NOT NULL,
  `furnished_type` varchar(255) NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `monthly_rent` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_units`
--

INSERT INTO `apt_units` (`unit_id`, `property_id`, `unit_type`, `total_units`, `occupied_units`, `furnished_type`, `dimension`, `monthly_rent`, `status`) VALUES
(1, 3, 'Double-Bed Room', 9, 0, 'Furnished', '', '6000', 1),
(2, 3, 'Quad-Bed Room', 6, 0, 'Furnished', '', '9000', 1),
(3, 4, 'Single-Bed Room', 2, 0, 'Furnished', '', '6000', 1),
(4, 4, 'Double-Bed Room', 21, 0, 'Furnished', '', '6000', 1),
(5, 5, 'Double-Bed Room', 26, 0, 'Semi-furnished', '', '4000', 1),
(6, 6, 'Double-Bed Room', 12, 0, 'Semi-furnished', '', '6000', 1),
(7, 7, 'Double-Bed Room', 9, 0, 'Furnished', '', '6500', 1),
(8, 8, 'Double-Bed Room', 8, 0, 'Semi-furnished', '', '7000', 1),
(9, 9, 'Double-Bed Room', 14, 0, 'Furnished', '', '5000', 1),
(16, 16, 'Double-Bed Room', 8, 0, 'Furnished', '', '6000', 1),
(17, 17, 'Double-Bed Room', 10, 0, 'Furnished', '', '4000', 1),
(18, 17, 'Triple-Bed Room', 3, 0, 'Furnished', '', '6000', 1),
(19, 18, 'Double-Bed Room', 3, 0, 'Furnished', '', '6500', 1),
(20, 18, 'Quad-Bed Room', 1, 0, 'Furnished', '', '4000', 1),
(21, 19, 'Double-Bed Room', 12, 0, 'Furnished', '', '5000', 1),
(22, 20, 'Single-Bed Room', 8, 0, 'Furnished', '', '6500', 1),
(23, 21, 'Double-Bed Room', 12, 0, 'Furnished', '', '8000', 1),
(24, 22, 'Double-Bed Room', 10, 0, 'Furnished', '3m x 3m', '5500', 1),
(25, 22, 'Triple-Bed Room', 10, 0, 'Furnished', '4m x 3m', '8000', 1),
(26, 23, '2-Bedroom Apartment', 2, 0, 'Furnished', '', '2000', 1),
(27, 24, 'Double-Bed Room', 15, 15, 'Furnished', '', '5000', 1),
(28, 24, 'Single-Bed Room', 5, 5, 'Furnished', '', '4500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_users`
--

CREATE TABLE `apt_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_users`
--

INSERT INTO `apt_users` (`user_id`, `email`, `password`, `salt`, `status`) VALUES
(1, 'admin@apt.com', '5b6184fe1a394b9d7ff5d22ca01be7e890f895d3c47363842d191bc1722ce99e', '469b05fdb55e3e3a6757142938b862a3', 1),
(2, 'micohyabut01@gmail.com', 'da88fb4f4bb1341f7c45b9e75377fa40902560dc0ff336b970931e503fbc8bf0', '89d35135c1400f87fe06cc73ed53081c', 1),
(3, 'aufcooperative@gmail.com', '8ee6a6c068503bf4503c00b13209260660ad54d43830cdca2ea1eb156137ee1f', '1d7c7849cf86fb547ec50c3d01afd283', 1),
(4, 'tridia@gmail.com', 'e6e951dba1bc59b90cb244e400c0d5c4e60fa0da0f50b7ca60b67b5f34375205', '4e600e297aa6328ebfdf59450648c75c', 1),
(5, 'raqueldiaz@gmail.com', 'b129c636f5bec2940af8191aac28f32eb966ee5063c579dd058fa21f11a05139', '5d6d815e668a39a60f5fa156663e0380', 1),
(6, 'dejesusdorm@gmail.com', '77764eb0f9ad579673c835681ba0cde40f96cdaddd674ddb8ad56c1efb0a2299', '8d14dfa6b9438fd044851718adfef479', 1),
(7, 'janiceaguas@gmail.com', '28f090d17b4c640ff2394b613cba0993753e1acc9879e4ff5a51c374f9865da4', '70b172bf07b515bb92fed1f312e70072', 1),
(8, 'warren@gmail.com', '31fee78fc1441f3fa265a535652ba9b4a7352104eb43993c3e00d429cec93c7f', 'fe51c660af71914ed18a89945a4bad35', 1),
(9, 'valenzuela@gmail.com', '316ec036f01fc9e3554450d76728b68e2d895904ca67313cdae485043bcdbf58', '92e058db3fbefb04a8a6ac1a01a80766', 1),
(10, 'emlaz@gmail.com', '0acc14a34c11720e2909603f43f57a71d8716183652235ed8b083572304e2751', 'a7ae073942998f729d812b0b6cb91bdb', 1),
(11, 'batac@gmail.com', '26e61b27d8bab78c023a04ca29a5df71cb8b168a955a899573231d65674eda4a', 'ab2d7035d8207f9b5b9d0e383beb1a1c', 1),
(12, 'rmmamac@gmail.com', 'c1b0a9d4ee04eacbb30dce38c9e504d94aa2f724d6f11a0f9ea56a60bf3fafa2', 'cceed9426cd76b5d4bb2895edeb088bb', 1),
(13, 'neliaroquel@gmail.com', 'ec5cfda6b083790e3138f49bd29b2bb9ca19da76412bdea14c4a20a461b274c1', '859213bd130b1790136f1c2c7eb35fcd', 1),
(14, 'burjs@gmail.com', '4b1412354319f3b4633ae424aea7c60add903ba8d9b93aec313b00b15539a71e', '022890636ade1809cb39d7eaa8ee35bf', 1),
(15, 'svzdorm@gmail.com', '3454c9259e1e4cd04972087c2a08c166823899d55d7b9cea4f87de3d6d135995', 'd39b3dcf80bd27e67459674b19daef74', 1),
(16, 'aaron@gmail.com', '3de6ebb0db20371b42b6673eb870b830e6feb99cb736e8231de3d8c0bd8dbac3', 'd815beea5f3d366327c127c67f91472a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_user_images`
--

CREATE TABLE `apt_user_images` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_user_images`
--

INSERT INTO `apt_user_images` (`image_id`, `user_id`, `image_name`, `status`) VALUES
(1, 2, 'id.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_user_information`
--

CREATE TABLE `apt_user_information` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `user_type` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_user_information`
--

INSERT INTO `apt_user_information` (`user_id`, `first_name`, `last_name`, `contact_number`, `user_type`, `status`) VALUES
(1, 'Apt', 'Admin', '09355526262', 3, 1),
(2, 'Micoh', 'Yabut', '09355511626', 2, 1),
(3, 'Jonathan', 'Buitizon', '09565442123', 1, 1),
(4, 'Jason', 'Joven', '09177057476', 1, 1),
(5, 'Raquel', 'Diaz', '09952671924', 1, 1),
(6, 'Arsenia', 'Pineda', '09175093747', 1, 1),
(7, 'Janice', 'Aguas', '09985524921', 1, 1),
(8, 'Adelfo', 'Layug', '09223009506', 1, 1),
(9, 'Maribel', 'Galang', '09256178686', 1, 1),
(10, 'Remedios', 'Surla', '09209292859', 1, 1),
(11, 'Jeanne', 'Valencia', '09544465526', 1, 1),
(12, 'RM', 'Mamac', '09750688223', 1, 1),
(13, 'Nelia', 'Roquel', '09209774393', 1, 1),
(14, 'Maximo', 'Talao', '09350790701', 1, 1),
(15, 'Amelia', 'Pangan', '09138823413', 1, 1),
(16, 'Aaronnnn', 'David', '09283283827', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_application_requests_ibfk_1` (`user_id`);

--
-- Indexes for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_appointments_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_bookmarks`
--
ALTER TABLE `apt_bookmarks`
  ADD PRIMARY KEY (`bookmark_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_bookmarks_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_chats`
--
ALTER TABLE `apt_chats`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_chats_ibfk_2` (`landlord_id`),
  ADD KEY `apt_chats_ibfk_3` (`user_id`);

--
-- Indexes for table `apt_faqs`
--
ALTER TABLE `apt_faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `apt_feedbacks`
--
ALTER TABLE `apt_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `apt_logs`
--
ALTER TABLE `apt_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `apt_logs_ibfk_1` (`user_id`);

--
-- Indexes for table `apt_messages`
--
ALTER TABLE `apt_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `apt_messages_ibfk_2` (`sender_id`);

--
-- Indexes for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `apt_password_reset_tokens`
--
ALTER TABLE `apt_password_reset_tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `apt_payments`
--
ALTER TABLE `apt_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `apt_properties`
--
ALTER TABLE `apt_properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `apt_properties_ibfk_1` (`landlord_id`);

--
-- Indexes for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  ADD PRIMARY KEY (`amenity_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_property_availability`
--
ALTER TABLE `apt_property_availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_property_details`
--
ALTER TABLE `apt_property_details`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `apt_property_faqs`
--
ALTER TABLE `apt_property_faqs`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `property_id` (`landlord_id`);

--
-- Indexes for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_property_locations`
--
ALTER TABLE `apt_property_locations`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `room_id` (`unit_id`),
  ADD KEY `apt_reservations_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_reviews_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_units`
--
ALTER TABLE `apt_units`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_users`
--
ALTER TABLE `apt_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `apt_user_information`
--
ALTER TABLE `apt_user_information`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_bookmarks`
--
ALTER TABLE `apt_bookmarks`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_chats`
--
ALTER TABLE `apt_chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_faqs`
--
ALTER TABLE `apt_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `apt_feedbacks`
--
ALTER TABLE `apt_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_logs`
--
ALTER TABLE `apt_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `apt_messages`
--
ALTER TABLE `apt_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `apt_password_reset_tokens`
--
ALTER TABLE `apt_password_reset_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_payments`
--
ALTER TABLE `apt_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apt_properties`
--
ALTER TABLE `apt_properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apt_property_availability`
--
ALTER TABLE `apt_property_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apt_property_faqs`
--
ALTER TABLE `apt_property_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_units`
--
ALTER TABLE `apt_units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `apt_users`
--
ALTER TABLE `apt_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  ADD CONSTRAINT `apt_application_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`),
  ADD CONSTRAINT `apt_application_requests_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  ADD CONSTRAINT `apt_appointments_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_bookmarks`
--
ALTER TABLE `apt_bookmarks`
  ADD CONSTRAINT `apt_bookmarks_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_bookmarks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_chats`
--
ALTER TABLE `apt_chats`
  ADD CONSTRAINT `apt_chats_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_chats_ibfk_2` FOREIGN KEY (`landlord_id`) REFERENCES `apt_user_information` (`user_id`),
  ADD CONSTRAINT `apt_chats_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_feedbacks`
--
ALTER TABLE `apt_feedbacks`
  ADD CONSTRAINT `apt_feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_logs`
--
ALTER TABLE `apt_logs`
  ADD CONSTRAINT `apt_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_messages`
--
ALTER TABLE `apt_messages`
  ADD CONSTRAINT `apt_messages_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `apt_chats` (`chat_id`),
  ADD CONSTRAINT `apt_messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  ADD CONSTRAINT `apt_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_payments`
--
ALTER TABLE `apt_payments`
  ADD CONSTRAINT `apt_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_properties`
--
ALTER TABLE `apt_properties`
  ADD CONSTRAINT `apt_properties_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  ADD CONSTRAINT `apt_property_amenities_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_availability`
--
ALTER TABLE `apt_property_availability`
  ADD CONSTRAINT `apt_property_availability_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_details`
--
ALTER TABLE `apt_property_details`
  ADD CONSTRAINT `apt_property_details_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_faqs`
--
ALTER TABLE `apt_property_faqs`
  ADD CONSTRAINT `apt_property_faqs_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `apt_properties` (`landlord_id`);

--
-- Constraints for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  ADD CONSTRAINT `apt_property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_locations`
--
ALTER TABLE `apt_property_locations`
  ADD CONSTRAINT `apt_property_locations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  ADD CONSTRAINT `apt_property_rules_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  ADD CONSTRAINT `apt_reservations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`),
  ADD CONSTRAINT `apt_reservations_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `apt_units` (`unit_id`);

--
-- Constraints for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  ADD CONSTRAINT `apt_reviews_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  ADD CONSTRAINT `apt_unavailable_slots_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_units`
--
ALTER TABLE `apt_units`
  ADD CONSTRAINT `apt_units_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  ADD CONSTRAINT `apt_user_images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_user_information`
--
ALTER TABLE `apt_user_information`
  ADD CONSTRAINT `apt_user_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
