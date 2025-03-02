-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2025 at 10:39 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recommend_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attended_exam`
--

DROP TABLE IF EXISTS `attended_exam`;
CREATE TABLE IF NOT EXISTS `attended_exam` (
  `attempt_id` int NOT NULL AUTO_INCREMENT,
  `Number_of_attempt` int NOT NULL,
  `book_id` int NOT NULL,
  `student_id` int NOT NULL,
  `status` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`attempt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attended_exam`
--

INSERT INTO `attended_exam` (`attempt_id`, `Number_of_attempt`, `book_id`, `student_id`, `status`) VALUES
(13, 1, 23, 2370, 'ATTENDED'),
(7, 1, 22, 2369, 'ATTENDED'),
(14, 1, 3, 2317, 'ATTENDED'),
(9, 1, 26, 12009, 'ATTENDED'),
(10, 1, 11, 12009, 'ATTENDED'),
(12, 1, 3, 2368, 'ATTENDED'),
(15, 1, 28, 2359, 'ATTENDED'),
(16, 1, 32, 7362, 'ATTENDED'),
(17, 1, 1, 2368, 'ATTENDED'),
(18, 1, 38, 2387, 'ATTENDED'),
(19, 1, 37, 2373, 'ATTENDED'),
(20, 1, 47, 7362, 'ATTENDED'),
(21, 1, 53, 24267, 'ATTENDED'),
(22, 1, 23, 24267, 'ATTENDED');

-- --------------------------------------------------------

--
-- Table structure for table `book_details_tab`
--

DROP TABLE IF EXISTS `book_details_tab`;
CREATE TABLE IF NOT EXISTS `book_details_tab` (
  `serial_no` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `book_img` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `author_name` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `category` varchar(25) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `language` varchar(25) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `no_of_copies` int NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_details_tab`
--

INSERT INTO `book_details_tab` (`serial_no`, `book_name`, `book_img`, `author_name`, `category`, `language`, `no_of_copies`) VALUES
(1, 'The Fault in our star', 'fault in our star.png', 'john green', 'Novel', 'english', 10),
(2, 'The Financial Expert', 'the financial expert.jpg', 'r.k.narayan', 'Novel', 'english', 2),
(3, 'Oliver Twist', 'oliver.jpg', 'Charles Dickens', 'Novel', 'English', 0),
(4, 'Aadujeevitham', 'Aadujeevitham.jpg', 'Benyamin', 'Novel', 'Malayalam', 2),
(5, 'Randamoozham', 'randamoozham.jpg', 'M T Vasudevan', 'Novel', 'Malayalam', 1),
(6, 'Khasakkinte Itihasam', 'khasak.jpeg', 'O.V Vijayan', 'Novel', 'Malayalam', 0),
(7, 'Ramayana', 'ramayan.jpg', 'Valmiki', 'Ancient', 'Hindi', 10),
(8, 'Alice In Wonderland', 'alice.jpg', 'RH Disney', 'Story', 'English', 5),
(9, 'Think and Grow Rich', 'think and grow rich.jpeg', 'Napoleon Hill', 'Business & Economy', 'English', 3),
(10, 'Crime and Punishment', 'crimeand.jpg', 'Fyodor Dostoevsky', 'Novel', 'Russian', 9),
(11, 'David Copperfield', 'david.jpg', 'Charles Dickens', 'Novel', 'English', 4),
(12, 'Beloved', 'beloved.jpg', 'Toni Morrison', 'Novel', 'English', 1),
(13, 'The Great Gatsby', 'The_Great_Gatsby_Cover_1925_Retouched.jpg', 'Francis Scott Key Fitzgerald', 'Fiction', 'English', 1),
(15, 'The Death of Ivan Ilyich', 'deathofivan.jpg', 'Leo Tolstoy', 'Novel', 'English', 1),
(19, 'Robinson crusoe', 'robinson-crusoe-456.jpg', 'Daniel Defoe', 'Novel', 'English', 2),
(20, 'The Da Vinci Code', '4182WHOHqUL._SY445_SX342_.jpg', 'Dan Brown', 'Novel', 'English', 5),
(21, 'Wings of Fire: An Autobio', '634583.jpg', 'A.P.J. Abdul Kalam', 'Autobiography', 'English', 2),
(22, 'RICH DAD POOR DAD', '51Hfv2MfNGL._SY445_SX342_.jpg', 'Robert Kiyosaki and Sharon Lec', ' Personal finance', 'English', 5),
(23, 'The Power of your subconscious mind', '4199EMP6+8L._SY445_SX342_.jpg', 'Joseph Murphy', 'Self-help book', 'English', 6),
(24, 'Word Power Made Easy', '81e5Foz07yL._SY522_.jpg', 'Norman Lewis', 'Vocabulary', 'English', 1),
(25, 'Here,There and Everywhere ', '81KVRenYv+L._SY522_.jpg', 'Murthy Sudha', 'Novel', 'English', 10),
(26, 'Thinking in Java', 'content.jpg', 'Bruce Eckel', 'Education', 'English', 10),
(27, 'Don Quixote', 'images.jpg', 'Miguel de ', 'Novel', 'English', 12),
(28, 'India that is Bharat', '81qiBQl89PL._SY522_.jpg', 'J sai Deepak', 'politics', 'English', 19),
(29, 'Politics for Beginners', '51w96f4X9cL._SY445_SX342_.jpg', 'Alex Frith', 'politics', 'English', 9),
(30, 'Normal People', '71N9Dy2G5+L._SY522_.jpg', 'Sally Rooney', 'fiction', 'English', 10),
(31, 'TO KILL A MOCKINGBIRD', '81gepf1eMqL._SY522_.jpg', 'Lee', 'fiction', 'English', 14),
(32, 'FALLING IN LOVE AGAIN', '81d561VwU0L._SY522_.jpg', 'Ruskin Bond', 'fiction', 'English', 14),
(33, 'KALPANA CHAWLA A COMPLETE BIOGRAPHY', '71jDK3Yc9HL._SY385_.jpg', 'Abhishek Kumar', 'biography-autobiography', 'English', 18),
(34, 'CHENNAI: A BIOGRAPHY', '81cAtWTgQPL._SY522_.jpg', 'V.sriram', 'biography-autobiography', 'English', 12),
(35, 'A History of Ancient and early medieval India\r\n', '81CY2Y5Ua7L._SY425_.jpg', 'Upinder singh', 'history', 'English', 8),
(36, 'The Penguin History of Early India From the Origins to AD 1300', '51wEDPMXHmL._SY445_SX342_.jpg', 'Romila Thapar', 'history', 'English', 10),
(37, 'Steve Jobs', '81vhsD+QgKL._SY522_.jpg', 'Walter Issacson', 'non-fiction', 'English', 10),
(38, 'Thinking, Fast and Slow', 'content.png', ' Daniel Kahneman', 'non-fiction', 'English', 13),
(39, 'The Diary of a Young Girl', 'content (1).jpg', 'Anne Frank', 'biography-autobiography', 'English', 10),
(40, 'The Monk Who Sold His Ferrari', '411uFSVr9ZL._SY445_SX342_.jpg', ' Robin Sharma', 'novel', 'English', 19),
(41, 'The Psychology of Money', '81Dky+tD+pL._SY522_.jpg', ' Morgan Housel', 'self-help', 'English', 11),
(42, 'The Way of Men', 'download (1).jpg', 'Jack Donovan', 'graphic-novels-comics', 'English', 10),
(43, 'Iron John: A Book About Men', 'download (2).jpg', 'Robert Bly', 'self-help', 'English', 12),
(45, 'The Diary of a Nobody', 'download (4).jpg', 'George Grossmith and Weedon Gr', 'novel', 'English', 12),
(46, 'The Very Hungry Caterpillar', '51Fz6bCgWdS._SX342_SY445_.jpg', 'Eric Carle', 'fiction', 'English', 12),
(47, 'Brown Bear, Brown Bear, What Do You See?', 'download (5).jpg', 'Bill Martin, Jr.', 'fiction', 'English', 11),
(48, 'If You Give a Mouse a Cookie', 'download (6).jpg', ' Laura Numeroff', 'fiction', 'English', 12),
(49, 'Where the Wild Things Are', 'download (7).jpg', 'Maurice Sendak', 'fiction', 'English', 12),
(50, 'Caps for Sale', 'download (8).jpg', 'Esphyr Slobodkina', 'fiction', 'English', 12),
(51, 'The Old Man and the Sea', 'download (3).jpg', 'Ernest Hemingway', 'novel', 'English', 12),
(52, 'A Passage to India', '41uiRGaOxaL._SY445_SX342_.jpg', ' E. M. Forster', 'novel', 'English', 12),
(53, 'Until Love Sets Us Apart: To Love with Love', 'b5ea5cf920d1f6073fda03147ba80541.jpg', 'Aditya Nighhot', 'novel', 'English', 49);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receivers_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sender` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `receivers_name`, `book_name`, `message`, `sender`, `timestamp`) VALUES
(1, 'John Sammuel', 'The Financial Expert', 'Hai Sir The financial expert', 'aravindsreeasok', '2024-08-06 13:12:24'),
(2, 'aravindsreeasok', 'The Financial Expert', 'ok start reading', 'John Sammuel', '2024-08-06 13:13:09'),
(3, 'aravindsreeasok', 'Thinking in Java', 'You should think in java', 'John Sammuel', '2024-08-06 13:54:34'),
(5, 'John Sammuel', 'The Financial Expert', 'yes sir', 'aravindsreeasok', '2024-08-06 14:38:09'),
(6, 'John Sammuel', 'Thinking in Java', 'yes sir i will think in java', 'aravindsreeasok', '2024-08-06 14:38:25'),
(7, 'aravindsreeasok', 'Thinking in Java', 'ok', 'John Sammuel', '2024-08-06 15:02:12'),
(8, 'aravindsreeasok', 'The Financial Expert', 'submit review of the chapter on 15Th aug\r\n', 'John Sammuel', '2024-08-07 01:10:18'),
(9, 'John Sammuel', 'The Financial Expert', 'ok sir\r\n', 'aravindsreeasok', '2024-08-07 01:11:11'),
(10, 'John Sammuel', 'Thinking in Java', 'hwllo', 'aravindsreeasok', '2024-08-07 05:44:18'),
(11, 'aravindsreeasok', 'Thinking in Java', 'okey', 'John Sammuel', '2024-08-07 05:48:48'),
(12, 'aravindsreeasok', 'Think and Grow Rich', 'hey have you completed the book?', 'John Sammuel', '2024-08-16 06:29:23'),
(13, 'John Sammuel', 'Think and Grow Rich', 'No sir ,I have completed 20 pages.\r\n', 'aravindsreeasok', '2024-08-16 06:30:03'),
(14, 'aravindsreeasok', 'Think and Grow Rich', 'ok\r\n', 'John Sammuel', '2024-08-16 06:30:27'),
(15, 'aravindsreeasok', 'Think and Grow Rich', 'no you have stated that i have cmplted 25 ', 'John Sammuel', '2024-08-16 06:39:16'),
(16, 'John Sammuel', 'Think and Grow Rich', 'that;s correct sir\r\n', 'aravindsreeasok', '2024-08-16 07:44:27'),
(17, 'John Sammuel', 'The Power of your subcons', 'hai', 'justin', '2024-08-19 09:43:57'),
(18, 'John Sammuel', 'Don Quixote', 'sir i have cmplted the first 20 pages\r\n', 'aravindsreeasok', '2024-08-21 16:43:02'),
(19, 'aravindsreeasok', 'Don Quixote', 'okey', 'John Sammuel', '2024-08-21 16:47:12'),
(20, 'justin', 'The Power of your subcons', 'should update the daily review\r\n', 'John Sammuel', '2024-08-23 05:15:19'),
(21, 'John Sammuel', 'The Power of your subcons', 'ok sir .I have uploaded the first review after completing 20 page', 'justin', '2024-08-27 08:08:09'),
(22, 'John Sammuel', 'Don Quixote', 'explain 20th page\r\n', 'aravindsreeasok', '2024-08-27 09:07:19'),
(23, 'John Sammuel', 'Don Quixote', 'hey', 'aravindsreeasok', '2024-08-27 09:07:45'),
(24, 'John Sammuel', 'Don Quixote', 'hi\r\n', 'aravindsreeasok', '2024-08-27 09:13:31'),
(25, 'John Sammuel', 'Oliver Twist', 'hello', 'aravindsreeasok', '2024-08-29 08:36:12'),
(26, 'aravindsreeasok', 'TO KILL A MOCKINGBIRD', 'you have choosen a book out from my recommendation.study it well', 'John Sammuel', '2024-09-18 04:42:52'),
(27, 'John Sammuel', 'TO KILL A MOCKINGBIRD', 'ok sir', 'aravindsreeasok', '2024-10-01 08:09:49'),
(28, 'Anu Thomas', 'David Copperfield', 'mam i have uploaded the first daily review of David copper field after completing 10 pages', 'edwinvincent', '2024-10-03 05:33:07'),
(29, 'Anu Thomas', 'Thinking in Java', 'mam i have uploaded first two reviews of the book ', 'edwinvincent', '2024-10-03 05:33:28'),
(30, 'edwinvincent', 'David Copperfield', 'ok upload the next review after completing 25 pages\r\n', 'Anu Thomas', '2024-10-03 05:34:17'),
(31, 'edwinvincent', 'Thinking in Java', 'ok', 'Anu Thomas', '2024-10-03 05:34:43'),
(32, 'John Sammuel', 'The Fault in our star', 'hello', 'aravindsreeasok', '2024-10-12 13:22:30'),
(33, 'aravindsreeasok', 'Oliver Twist', 'yes it good that you have completed the 122 pages of book', 'John Sammuel', '2024-10-18 03:43:55'),
(34, 'aravindsreeasok', 'The Fault in our star', 'good mrng ,please complete the rest of pages\r\n', 'John Sammuel', '2024-10-18 03:44:15'),
(35, 'justin', 'The Power of your subcons', 'update the daily journal soon!', 'John Sammuel', '2024-10-18 03:44:41'),
(36, 'justin', 'The Power of your subcons', 'justin i have seen your exam result you did pretty but try to get full makr all the best my son\r\n', 'John Sammuel', '2024-10-18 06:54:11'),
(37, 'linu', 'Oliver Twist', 'sir i have completed the first 10 pages of the book i have came up with a doubt ', 'alan', '2024-10-21 17:10:53'),
(38, 'alan', 'Oliver Twist', 'ok ask it', 'linu', '2024-10-21 17:11:40'),
(39, 'linu', 'Wings of Fire: An Autobio', 'sir i have finished the book please upload some question for the book so that i can attend the exam', 'alan', '2024-10-21 17:14:59'),
(40, 'alan', 'Wings of Fire: An Autobio', 'ok son i will updated it', 'linu', '2024-10-21 17:15:25'),
(41, 'Gemini', 'India that is Bharat', 'Good mrng miss i have taken the book called india as bharath', 'benoy', '2024-10-22 01:21:00'),
(42, 'John Sammuel', 'FALLING IN LOVE AGAIN', 'hai', 'kalyany', '2024-10-22 01:38:22'),
(43, 'John Sammuel', 'The Da Vinci Code', 'hai', 'kalyany', '2024-10-22 01:38:30'),
(44, 'kalyany', 'The Da Vinci Code', 'hi\r\n', 'linu', '2024-10-22 01:38:53'),
(45, 'linu', 'Ramayana', 'halo\r\n', 'kalyany', '2024-10-22 04:58:44'),
(46, 'John Sammuel', 'India that is Bharat', 'sir i have completed the first 10 pages  of mu book what is the next milestone?', 'jose', '2024-10-22 06:05:16'),
(47, 'jose', 'India that is Bharat', 'complete the next 30 pages and upload the daily journal', 'John Sammuel', '2024-10-22 06:05:56'),
(48, 'jose', 'India that is Bharat', 'good results', 'John Sammuel', '2024-10-22 06:10:41'),
(49, 'linu', 'Politics for Beginners', 'hai sir', 'kalyany', '2024-10-22 13:54:01'),
(50, 'kalyany', 'Politics for Beginners', 'hi', 'linu', '2024-10-22 13:54:58'),
(51, 'John Sammuel', 'Politics for Beginners', 'hai\r\n', 'kalyany', '2024-10-22 14:08:24'),
(52, 'John Sammuel', 'Ramayana', 'hai', 'kalyany', '2024-10-22 14:08:34'),
(53, 'kalyany', 'The Diary of a Young Girl', 'hai kalyany ,please let me know if you have any doubts', 'linu', '2024-10-22 14:34:16'),
(54, 'linu', 'The Diary of a Young Girl', 'ok sir', 'kalyany', '2024-10-22 14:36:25'),
(55, 'linu', 'The Diary of a Young Girl', 'sir i have uploaded the daily journal till 25 pages\r\n', 'kalyany', '2024-10-22 15:11:42'),
(56, 'kalyany', 'The Diary of a Young Girl', 'ok continue with your reading ', 'linu', '2024-10-22 15:13:14'),
(57, 'kalyany', 'FALLING IN LOVE AGAIN', 'good marks!\r\n', 'Gemini', '2024-10-23 08:36:22'),
(58, 'Gemini', 'FALLING IN LOVE AGAIN', 'thanks miss\r\n', 'kalyany', '2024-10-23 08:36:56'),
(59, 'John Sammuel', 'Thinking, Fast and Slow', 'sir please upload the question for the exam\r\n', 'aravindsreeasok', '2024-10-23 12:48:38'),
(60, 'linu', 'Thinking, Fast and Slow', 'hai sir', 'gokul', '2024-10-24 06:43:24'),
(61, 'gokul', 'Thinking, Fast and Slow', 'hai', 'linu', '2024-10-24 06:44:04'),
(62, 'John Sammuel', 'Steve Jobs', 'Hello, Sir i have completed the first 10 pages of the book', 'adhityan', '2024-11-03 04:17:53'),
(63, 'adhityan', 'Steve Jobs', 'Ok ,Continue with you Reading', 'John Sammuel', '2024-11-03 04:19:55'),
(64, 'John Sammuel', 'The Fault in our star', 'hai sir i have a doubt in the 24 page\r\n', 'aravindsreeasok', '2025-01-05 04:23:48'),
(65, 'deepa', 'Here,There and Everywhere', 'Good Morning mam\r\n ', 'hari', '2025-01-05 06:04:14'),
(66, 'albin', 'Until Love Sets Us Apart: To Love with Love', 'write a detailed review for each book', 'linu', '2025-02-11 14:53:42'),
(67, 'linu', 'Until Love Sets Us Apart: To Love with Love', 'ok sir', 'albin', '2025-02-11 14:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `daily_review_tab`
--

DROP TABLE IF EXISTS `daily_review_tab`;
CREATE TABLE IF NOT EXISTS `daily_review_tab` (
  `book_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `serial_no` int NOT NULL,
  `pages_cmplted` int NOT NULL,
  `readers_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `roll_no` int NOT NULL,
  `review_no` int NOT NULL AUTO_INCREMENT,
  `review` varchar(5000) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `review_date` datetime NOT NULL,
  `review_time` timestamp NOT NULL,
  `mentors_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  UNIQUE KEY `review_no` (`review_no`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daily_review_tab`
--

INSERT INTO `daily_review_tab` (`book_name`, `serial_no`, `pages_cmplted`, `readers_name`, `roll_no`, `review_no`, `review`, `review_date`, `review_time`, `mentors_name`) VALUES
('Don Quixote', 27, 20, 'aravindsreeasok', 2368, 17, 'after 20 pages the book tells about the place where the war was started', '2024-08-23 04:12:06', '2024-08-23 05:12:06', 'John Sammuel'),
('Don Quixote', 27, 12, 'aravindsreeasok', 2368, 16, 'this is the first review after the completion of the first 12 page which tells about the war', '2024-08-23 04:06:17', '2024-08-23 05:06:17', 'John Sammuel'),
('Don Quixote', 27, 25, 'aravindsreeasok', 2368, 18, 'describe about the hero', '2024-08-24 16:31:03', '2024-08-24 17:31:03', 'John Sammuel'),
('The Power of your subcons', 23, 20, 'justin', 2369, 19, '\"The Power of Your Subconscious Mind\" by Dr. Joseph Murphy is a classic self-help book that explores the immense influence of the subconscious mind on ones life', '2024-08-27 07:09:42', '2024-08-27 08:09:42', 'John Sammuel'),
('RICH DAD POOR DAD', 22, 42, 'aravindsreeasok', 2368, 99, 'in the first 42 pages of Rich Dad Poor Dad, Robert Kiyosaki introduces two important figures in his life: his \"Poor Dad,\" who is his biological father, and his \"Rich Dad,\" who is his best friends father. Through their different views on money, Kiyosaki shares important lessons. Poor Dad believes in working hard and getting a steady job, while Rich Dad teaches him about the importance of financial education and making smart investments. Kiyosaki highlights how understanding money can lead to financial freedom, showing readers that there is more to success than just traditional schooling', '2024-10-04 16:34:34', '2024-10-04 17:34:34', 'John Sammuel'),
('Until Love Sets Us Apart: To Love with Love', 53, 10, 'albin', 24267, 160, '\"Very good book.\"', '2025-02-11 20:22:42', '2025-02-11 14:52:42', 'linu'),
('Oliver Twist', 3, 10, 'alan', 2317, 110, 'Nice book with amazing content.', '2024-10-21 16:10:06', '2024-10-21 17:10:06', 'linu'),
('Here,There and Everywhere ', 25, 10, 'hari', 1232, 159, '\"Good Book.\"', '2025-01-05 05:05:15', '2025-01-05 06:05:15', 'deepa'),
('Oliver Twist', 3, 25, 'aravindsreeasok', 2368, 28, 'Oliver Twist is an interesting novel. The story follows a boy named Oliver who was born into poverty and struggles with many difficulties. He meets various people who are not kind and faces numerous challenges. Despite the hardships, Oliver shows his strong character and determination.', '2024-08-31 16:27:31', '2024-08-31 17:27:31', 'John Sammuel'),
('The Fault in our star', 1, 58, 'aravindsreeasok', 2368, 101, 'nice', '2024-10-05 04:16:33', '2024-10-05 05:16:33', 'John Sammuel'),
('The Fault in our star', 1, 58, 'aravindsreeasok', 2368, 100, 'good writintg stile', '2024-10-05 04:16:13', '2024-10-05 05:16:13', 'John Sammuel'),
('Oliver Twist', 3, 26, 'aravindsreeasok', 2368, 30, 'Oliver Twist is an interesting novel. The story follows a boy named Oliver, who was born into poverty and struggles with many difficulties. He meets various people who are not kind and faces numerous challenges. Despite the hardships, Oliver shows his strong character and determination.', '2024-08-31 16:31:08', '2024-08-31 17:31:08', 'John Sammuel'),
('Oliver Twist', 3, 39, 'aravindsreeasok', 2368, 31, '\"Excellent book and stunning content.\"', '2024-09-17 02:19:19', '2024-09-17 03:19:19', 'John Sammuel'),
('Oliver Twist', 3, 50, 'aravindsreeasok', 2368, 80, 'very good  book with good writing style', '2024-10-04 15:24:40', '2024-10-04 16:24:40', 'John Sammuel'),
('Oliver Twist', 3, 50, 'aravindsreeasok', 2368, 87, 'Oliver is curious about this new life but quickly learns about the dangers of living on the streets. The story highlights Olivers resilience and the hardships faced by children during this time.', '2024-10-04 15:42:22', '2024-10-04 16:42:22', 'John Sammuel'),
('Thinking in Java', 26, 10, 'edwinvincent', 12009, 53, 'Explain Java in simple language and understanding style.', '2024-10-03 04:31:17', '2024-10-03 05:31:17', 'Anu Thomas'),
('Thinking in Java', 26, 15, 'edwinvincent', 12009, 54, 'Explain the basics of understanding a new language.', '2024-10-03 04:31:58', '2024-10-03 05:31:58', 'Anu Thomas'),
('David Copperfield', 11, 10, 'edwinvincent', 12009, 55, 'An amazing story with beautiful people.', '2024-10-03 04:32:28', '2024-10-03 05:32:28', 'Anu Thomas'),
('Oliver Twist', 3, 122, 'aravindsreeasok', 2368, 98, 'In this section of Oliver Twist, Charles Dickens delves deeper into the dark realities of life for Oliver and the other characters living in Londons underbelly. This part of the narrative illustrates the gripping tension between innocence and corruption, showcasing Olivers struggles as he grapples with the harsh environment that surrounds him', '2024-10-04 16:32:18', '2024-10-04 17:32:18', 'John Sammuel'),
('Oliver Twist', 3, 110, 'aravindsreeasok', 2368, 89, 'after being wrongfully accused of theft, he finds himself in a challenging position as he tries to prove his innocence. During this time, he encounters Mr. Brownlow, a kind-hearted gentleman who takes an interest in him. Oliver begins to experience kindness and compassion for the first time, contrasting sharply with the cruelty he has faced before. This part of the story highlights the themes of social injustice and the struggle between good and evil. Oliver character continues to shine through as he navigates these new challenges, emphasizing his resilience and hope for a better future.', '2024-10-04 15:52:05', '2024-10-04 16:52:05', 'John Sammuel'),
('Oliver Twist', 3, 100, 'aravindsreeasok', 2368, 88, 'Despite being taken in by Fagin and the other pickpockets, Oliver remains innocent and longs for a better life. As he gets caught up in the gangs schemes, he becomes increasingly aware of the darker side of the world around him. The story highlights themes of poverty, crime, and the struggle for survival while emphasizing Olivers kind-hearted nature amidst the harsh realities he faces', '2024-10-04 15:50:51', '2024-10-04 16:50:51', 'John Sammuel'),
('Thinking in Java', 26, 10, 'benson', 2399, 104, 'Improves basic understanding of Java.', '2024-10-19 17:56:13', '2024-10-19 18:56:13', 'Anu Thomas'),
('Oliver Twist', 3, 124, 'aravindsreeasok', 2368, 158, 'Discuss about this character.', '2025-01-05 03:23:04', '2025-01-05 04:23:04', 'John Sammuel'),
('Ramayana', 7, 10, 'kalyany', 7362, 118, 'It is a very devotional book with amazing stories.', '2024-10-22 04:03:23', '2024-10-22 05:03:23', 'linu'),
('India that is Bharat', 28, 10, 'jose', 2359, 120, 'Discuss politics very easily.', '2024-10-22 05:04:48', '2024-10-22 06:04:48', 'John Sammuel'),
('Thinking, Fast and Slow', 38, 12, 'aravindsreeasok', 2368, 129, 'The author introduces two modes of thinking that dominate human cognition: System 1 and System 2. System 1 is fast, automatic, and intuitive, operating effortlessly and instinctively, guiding us through daily decisions and judgments. System 2, on the other hand, is slower, more deliberate, and logical, engaging when we need to concentrate, analyze, or solve complex problems. Kahneman sets the stage by explaining how these systems often interact, with System 1 making quick decisions and System 2 stepping in when more careful thought is required. However, this division also leads to errors, as the reliance on quick judgments can result in cognitive biases. The opening pages begin to unpack the implications of these systems for decision-making in various aspects of life', '2024-10-22 14:08:06', '2024-10-22 15:08:06', 'John Sammuel'),
('Thinking, Fast and Slow', 38, 10, 'aravindsreeasok', 2368, 128, 'Very nice book.', '2024-10-22 14:07:23', '2024-10-22 15:07:23', 'John Sammuel'),
('The Diary of a Young Girl', 39, 10, 'kalyany', 7362, 124, 'The first ten pages of The Diary of Anne Frank introduce us to Anne, a lively and intelligent 13-year-old Jewish girl living in Amsterdam during World War II. She begins her diary by describing her life, her family, and her experiences at school, as well as her birthday when she received the diary as a gift. Anne expresses her thoughts and feelings openly, giving readers a glimpse of her vibrant personality. She also discusses the increasing restrictions imposed on Jews by the Nazis, setting the stage for the difficult circumstances that will follow. These pages capture her youthful optimism despite the growing darkness around her', '2024-10-22 13:32:56', '2024-10-22 14:32:56', 'linu'),
('The Diary of a Young Girl', 39, 12, 'kalyany', 7362, 130, 'Anne continues to share her thoughts and experiences as a young Jewish girl living under the increasing restrictions imposed by the Nazi regime. She describes her interactions with her family and friends, highlighting the normalcy of her life before the war contrasted with the growing sense of danger around her. Anne reflects on her school life, expressing her frustrations with teachers and her desire for independence, while also revealing her deepening introspection', '2024-10-22 14:10:46', '2024-10-22 15:10:46', 'linu'),
('Steve Jobs', 37, 10, 'adhityan', 2373, 157, 'I completed the first ten pages of the book.', '2024-11-03 03:14:46', '2024-11-03 04:14:46', 'John Sammuel'),
('Thinking, Fast and Slow', 38, 10, 'parthiv', 9019, 133, 'Very good content.', '2024-10-22 14:33:31', '2024-10-22 15:33:31', 'Gemini'),
('Thinking, Fast and Slow', 38, 10, 'gokul', 2387, 156, 'Good book\r\n\r\nCorrected Text: Good book.', '2024-10-24 05:42:24', '2024-10-24 06:42:24', 'linu'),
('A History of Ancient and early medieval India\r\n', 35, 10, 'aravindsreeasok', 2368, 138, 'Nice book.', '2024-10-22 14:50:58', '2024-10-22 15:50:58', 'John Sammuel'),
('FALLING IN LOVE AGAIN', 32, 10, 'kalyany', 7362, 155, 'The story begins with an air of nostalgia, as the protagonist reflects on a past relationship that once seemed perfect but has since faded into memory. The narrative sets a contemplative tone, focusing on the emotions of loss, regret, and the longing for connection', '2024-10-23 07:32:04', '2024-10-23 08:32:04', 'Gemini'),
('Politics for Beginners', 29, 0, 'parthiv', 9019, 144, 'nice book', '2024-10-22 14:58:41', '2024-10-22 15:58:41', 'Gemini'),
('Politics for Beginners', 29, 10, 'parthiv', 9019, 145, 'good', '2024-10-22 14:58:52', '2024-10-22 15:58:52', 'Gemini'),
('Politics for Beginners', 29, 10, 'parthiv', 9019, 146, 'good', '2024-10-22 14:59:26', '2024-10-22 15:59:26', 'Gemini'),
('The Psychology of Money', 41, 10, 'aravindsreeasok', 2368, 154, 'Good book with amazing content.', '2024-10-22 15:13:56', '2024-10-22 16:13:56', 'John Sammuel'),
('The Way of Men', 42, 10, 'parthiv', 9019, 153, 'Describe how a man should be.', '2024-10-22 15:10:13', '2024-10-22 16:10:13', 'Gemini'),
('The Death of Ivan Ilyich', 15, 10, 'parthiv', 9019, 150, 'Good book.', '2024-10-22 15:07:46', '2024-10-22 16:07:46', 'Gemini'),
('The Death of Ivan Ilyich', 15, 12, 'parthiv', 9019, 151, 'nice', '2024-10-22 15:07:52', '2024-10-22 16:07:52', 'Gemini'),
('The Death of Ivan Ilyich', 15, 12, 'parthiv', 9019, 152, 'nice', '2024-10-22 15:07:57', '2024-10-22 16:07:57', 'Gemini');

-- --------------------------------------------------------

--
-- Table structure for table `exam_mark_tab`
--

DROP TABLE IF EXISTS `exam_mark_tab`;
CREATE TABLE IF NOT EXISTS `exam_mark_tab` (
  `exam_no` int NOT NULL AUTO_INCREMENT,
  `student_name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `student_id` int NOT NULL,
  `book_id` int NOT NULL,
  `total_mark` int NOT NULL,
  `obtained_mark` int NOT NULL,
  `mentor_name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`exam_no`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exam_mark_tab`
--

INSERT INTO `exam_mark_tab` (`exam_no`, `student_name`, `student_id`, `book_id`, `total_mark`, `obtained_mark`, `mentor_name`) VALUES
(12, 'aravindsreeasok', 2368, 3, 1, 0, 'John Sammuel'),
(13, 'alan', 2317, 3, 1, 0, 'linu'),
(14, 'jose', 2359, 28, 1, 1, ''),
(15, 'kalyany', 7362, 32, 1, 1, 'Gemini'),
(16, 'aravindsreeasok', 2368, 1, 1, 1, 'John Sammuel'),
(17, 'gokul', 2387, 38, 1, 1, 'linu'),
(18, 'adhityan', 2373, 37, 3, 3, 'John Sammuel');

-- --------------------------------------------------------

--
-- Table structure for table `login_tab`
--

DROP TABLE IF EXISTS `login_tab`;
CREATE TABLE IF NOT EXISTS `login_tab` (
  `username` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `roll_no` int NOT NULL,
  `phoneno` varchar(12) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `role` varchar(10) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_tab`
--

INSERT INTO `login_tab` (`username`, `roll_no`, `phoneno`, `email`, `password`, `role`) VALUES
('aravindsreeasok', 2368, '7736783189', 'aravind9946580@gmail.com', '12345', 'user'),
('John Sammuel', 9090, '7510855640', 'john2004@gmail.com', '12345', 'mentor'),
('admin', 111, '123456789', 'admin2004@gmail.com', '12345', 'admin'),
('gokul', 2387, '7745120987', 'gokul@gmail.com', '12345', 'user'),
('sudha', 1290, '9916527099', 'sudha@gmail.com', '12345', 'mentor'),
('Gemini', 9092, '7768783189', 'gemini@gmail.com', '12345', 'mentor'),
('parthiv', 9019, '2231567909', 'parthiv2004@gmail.com', '12345', 'user'),
('kalyany', 7362, '1151369700', 'kalyany2004@gmail.com', '12345', 'user'),
('jose', 2359, '8301821614', 'jose2004@gmail.com', '12345', 'user'),
('benoy', 2103, '5526091099', 'benoy2004@gmail.com', '12345', 'user'),
('linu', 2487, '9912450977', 'linu@gmail.com', '12345', 'mentor'),
('alan', 2317, '7712740987', 'alan2004@gmail.com', '12345', 'user'),
('adhityan', 2373, '9924357923', 'adhi@gmail.com', '12345', 'user'),
('deepa', 912, '9946534380', 'deepa@gmail.com', '12345', 'mentor'),
('hari', 1232, '7712563489', 'hari2004@gmail.com', '12345', 'user'),
('albin', 24267, '6623115678', 'albin2004@gmail.com', '12345', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `mentor_student_tab`
--

DROP TABLE IF EXISTS `mentor_student_tab`;
CREATE TABLE IF NOT EXISTS `mentor_student_tab` (
  `student_name` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `student_rollno` int NOT NULL,
  `mentor_name` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `combine_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`combine_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mentor_student_tab`
--

INSERT INTO `mentor_student_tab` (`student_name`, `student_rollno`, `mentor_name`, `combine_id`) VALUES
('nikhil', 2390, 'Gemini', 19),
('Alfina', 2362, 'John Sammuel', 12),
('Justin', 2369, 'John Sammuel', 10),
('aravindsreeasok', 2368, 'John Sammuel', 11),
('benson', 2399, 'Anu Thomas', 22),
('edwinvincent', 12009, 'John Sammuel', 24),
('jose', 2359, 'John Sammuel', 33),
('benoy', 2103, 'Gemini', 28),
('kalyany', 7362, 'Gemini', 40),
('parthiv', 9019, 'Gemini', 39),
('gokul', 2387, 'linu', 42),
('adhityan', 2373, 'John Sammuel', 43),
('hari', 1232, 'deepa', 44),
('albin', 24267, 'linu', 45);

-- --------------------------------------------------------

--
-- Table structure for table `questions_tab`
--

DROP TABLE IF EXISTS `questions_tab`;
CREATE TABLE IF NOT EXISTS `questions_tab` (
  `id` int NOT NULL AUTO_INCREMENT,
  `serialno` int NOT NULL,
  `question_text` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `correct_option` tinyint NOT NULL,
  `mentors_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions_tab`
--

INSERT INTO `questions_tab` (`id`, `serialno`, `question_text`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `mentors_name`) VALUES
(2, 27, 'What is the name of Don Quixotes loyal squire?', 'Sancho Panza', 'Rocinante', 'Dulcinea', 'Samson Carrasco', 1, 'John Sammuel'),
(3, 27, 'In \"Don Quixote,\" what does Don Quixote mistakenly believe windmills to be?', 'Giants', 'Dragons', 'Castles', 'Knights', 1, 'John Sammuel'),
(4, 27, ' What is the name of Don Quixotes horse?', 'Rocinante', 'Babieca', 'Pegasus', 'Bucephalus', 1, 'John Sammuel'),
(5, 23, 'How can positive affirmations influence your subconscious mind and impact your daily life?', 'They have no effect on your subconscious mind', 'They help to reinforce negative beliefs', 'They can reprogram your subconscious mind to support positive changes in behavior and thinking', 'They only work when you say them out loud', 3, 'John Sammuel'),
(6, 23, 'What role does visualization play in accessing the power of your subconscious mind?', 'Visualization is just daydreaming and has no real impact', 'Visualization helps you vividly imagine goals, which can activate the subconscious mind to work towards them', 'Visualization only works when you are asleep', 'Visualization prevents you from achieving your goals', 2, 'John Sammuel'),
(7, 23, 'How can limiting beliefs stored in your subconscious mind affect your success?', 'They have no impact on your success', 'They can sabotage your efforts by creating mental barriers that prevent you from achieving your goals', 'They always help you achieve success', 'They make you more determined to succeed', 2, 'John Sammuel'),
(8, 25, 'What is the main theme of the book Here, There, and Everywhere?', 'Adventure and Exploration', 'Love and Relationships', 'Friendship and Loyalty', 'Science Fiction and Fantasy', 3, 'John Sammuel'),
(9, 25, 'Who is the protagonist of the story?', ' Alex', ' Emma', 'Sarah', 'John', 2, 'John Sammuel'),
(10, 25, 'What lesson does the protagonist learn by the end of the story?', 'The importance of wealth', 'The value of family and friends', 'The necessity of power and control', 'The futility of dreams', 2, 'John Sammuel'),
(11, 22, 'What is the key difference in mindset between Rich Dad and Poor Dad?', 'Investing', 'Saving', 'Spending', 'Working', 1, 'John Sammuel'),
(12, 22, 'According to the book, what is the main reason people struggle financially?', 'Liabilities', 'Income', ' Debt', 'Expenses', 1, 'John Sammuel'),
(15, 25, 'What is the primary theme explored in \"Here, There, and Everywhere\" by Sruthy Murthy?', 'Adventure and Exploration', 'Personal Growth and Self-Discovery', 'Historical Events and Their Impact', 'Romantic Relationships and Their Challenges', 2, 'John Sammuel'),
(17, 31, 'What is the name of the town where the story of To Kill a Mockingbird takes place?', 'Maycomb', 'Finland', 'England', 'JunComb', 1, 'John Sammuel'),
(21, 3, 'What is the name of the cruel and abusive man who runs the workhouse where Oliver Twist is raised?', 'Bumble', 'Johny', 'Sam', 'Twist', 1, 'John Sammuel'),
(22, 11, 'What is the name of the town where David Copperfield is born?', 'canterburry', 'cardberry', 'Castles', 'Bucephalus', 1, 'Anu Thomas'),
(23, 26, 'What design pattern is used extensively throughout \"Thinking in Java\" to illustrate the concept of polymorphism? ', 'The Factory Method', 'Triangle Method', 'Bottom up approach ', 'Top down approach', 1, 'Anu Thomas'),
(24, 1, ' What is the name of the Amsterdam caf? where Hazel and Gus have their first romantic encounter?', 'oranjee', 'aplle', 'aprilla', 'templathe', 1, 'John Sammuel'),
(25, 28, 'According to J Sai Deepak in \"India that is Bharat,\" what is the primary reason for the decline of Indian civilization', 'Rise of western coloniesm', 'rise of industralism', 'lack of education', 'racism', 1, 'John Sammuel'),
(26, 32, 'What is the name of the young boy who befriends the narrator in \"Falling in Love Again\"', 'joey', 'john', 'sammuel', 'colei', 1, 'Gemini'),
(27, 38, 'What is the name of the cognitive system described by Kahneman that operates automatically, effortlessly, and quickly?', 'System 1', 'System 2', 'System 3', 'none of the above', 1, 'linu'),
(28, 37, 'In which year was Steve Jobs born?', '1955', '19976', '1945', '1954', 1, 'John Sammuel'),
(29, 37, 'What company did Steve Jobs co-found with Steve Wozniak?', 'Apple', 'Pixar', 'ABC', 'Microsoft', 1, 'John Sammuel'),
(30, 37, 'Which animated movie studio did Steve Jobs purchase and later sell to Disney?', 'Pixar', 'DreamWorks', 'Blue Sky Studios', 'Illumination', 1, 'John Sammuel'),
(31, 47, ' What animal is seen looking at the bird in Bill Martin Jr.s Brown Bear, Brown Bear, What Do You See?', 'Cat', 'Fox', 'Lion', 'tiger', 1, 'Gemini'),
(32, 53, ' What is the central theme of the book \"Until Love Sets Us Apart: To Love with Love\"?', 'The complexities of love and relationships', 'friendship', 'Love', 'Brotherhood', 1, 'linu');

-- --------------------------------------------------------

--
-- Table structure for table `read_tab`
--

DROP TABLE IF EXISTS `read_tab`;
CREATE TABLE IF NOT EXISTS `read_tab` (
  `read_no` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `readers_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `mentor_name` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `serial_no` int NOT NULL,
  `pages_read` int NOT NULL,
  `read_status` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`read_no`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `read_tab`
--

INSERT INTO `read_tab` (`read_no`, `book_name`, `readers_name`, `mentor_name`, `serial_no`, `pages_read`, `read_status`) VALUES
(84, 'Until Love Sets Us Apart: To Love with Love', 'albin', 'linu', 53, 10, 'finished'),
(71, 'The Way of Men', 'parthiv', 'Gemini', 42, 10, 'To read'),
(67, 'Oliver Twist', 'parthiv', 'Gemini', 3, 0, 'To read'),
(16, 'Oliver Twist', 'aravindsreeasok', 'John Sammuel', 3, 124, 'finished'),
(85, 'The Power of your subconscious mind', 'albin', 'linu', 23, 0, 'finished'),
(72, 'The Psychology of Money', 'aravindsreeasok', 'John Sammuel', 41, 10, 'To read'),
(63, 'The Fault in our star', 'aravindsreeasok', 'John Sammuel', 1, 0, 'finished'),
(50, 'India that is Bharat', 'jose', 'John Sammuel', 28, 10, 'finished'),
(77, 'Brown Bear, Brown Bear, What Do You See?', 'kalyany', 'Gemini', 47, 0, 'finished'),
(76, 'FALLING IN LOVE AGAIN', 'kalyany', 'Gemini', 32, 0, 'finished'),
(57, 'Thinking, Fast and Slow', 'parthiv', 'Gemini', 38, 10, 'To read'),
(83, 'Here,There and Everywhere ', 'hari', 'deepa', 25, 10, 'finished'),
(82, 'Steve Jobs', 'adhityan', 'John Sammuel', 37, 10, 'finished'),
(44, 'India that is Bharat', 'benoy', 'Gemini', 28, 0, 'To read'),
(81, 'Thinking, Fast and Slow', 'gokul', 'linu', 38, 10, 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `recommend_tab`
--

DROP TABLE IF EXISTS `recommend_tab`;
CREATE TABLE IF NOT EXISTS `recommend_tab` (
  `rec_no` int NOT NULL AUTO_INCREMENT,
  `student_name` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `roll_no` int NOT NULL,
  `book_name` varchar(1000) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `serialno` int NOT NULL,
  `recommenders_name` varchar(150) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  PRIMARY KEY (`rec_no`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recommend_tab`
--

INSERT INTO `recommend_tab` (`rec_no`, `student_name`, `roll_no`, `book_name`, `serialno`, `recommenders_name`) VALUES
(40, 'aravindsreeasok', 2368, 'Thinking, Fast and Slow', 38, 'John Sammuel'),
(14, 'aravindsreeasok', 2368, 'RICH DAD POOR DAD', 22, 'John Sammuel'),
(15, 'aravindsreeasok', 2368, 'Oliver Twist', 3, 'John Sammuel'),
(16, 'aravindsreeasok', 2368, 'Don Quixote', 27, 'John Sammuel'),
(50, 'albin', 24267, 'The Power of your subconscious mind', 23, 'linu'),
(21, 'aravindsreeasok', 2368, 'HereThere and Everywhere ', 25, 'John Sammuel'),
(48, 'hari', 1232, 'Here,There and Everywhere ', 25, 'deepa'),
(49, 'albin', 24267, 'Until Love Sets Us Apart: To Love with Love', 53, 'linu'),
(47, 'adhityan', 2373, 'Steve Jobs', 37, 'John Sammuel'),
(46, 'gokul', 2387, 'Thinking, Fast and Slow', 38, 'linu'),
(45, 'kalyany', 7362, 'FALLING IN LOVE AGAIN', 32, 'Gemini'),
(44, 'parthiv', 9019, 'Thinking, Fast and Slow', 38, 'Gemini'),
(39, 'jose', 2359, 'India that is Bharat', 28, 'John Sammuel');

-- --------------------------------------------------------

--
-- Table structure for table `request_tab`
--

DROP TABLE IF EXISTS `request_tab`;
CREATE TABLE IF NOT EXISTS `request_tab` (
  `request_no` int NOT NULL AUTO_INCREMENT,
  `request_datetime` datetime NOT NULL,
  `serial_no` int NOT NULL,
  `book_name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `ownername` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `requester_name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `request_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`request_no`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `request_tab`
--

INSERT INTO `request_tab` (`request_no`, `request_datetime`, `serial_no`, `book_name`, `ownername`, `requester_name`, `request_status`) VALUES
(246, '2024-08-01 07:16:09', 3, 'Oliver Twist', 'aravindsreeasok', 'aravindsreeasok', 0),
(245, '2024-07-28 02:03:20', 22, 'RICH DAD POOR DAD', 'sonu', 'aravindsreeasok', 0),
(234, '2024-07-16 10:46:59', 1, 'The Fault in our star', 'AravindAsokan', 'sonu', 1),
(233, '2024-07-16 10:46:41', 21, 'Wings of Fire: An Autobio', 'sonu', 'Tony mathew', 1),
(232, '2024-07-16 03:03:48', 15, 'The Death of Ivan Ilyich', 'John Sammuel', 'Tony mathew', 1),
(231, '2024-07-16 03:01:42', 20, 'The Da Vinci Code', 'Tony mathew', 'aravindsreeasok', 1),
(230, '2024-07-16 02:58:04', 4, 'Aadujeevitham', 'AravindAsokan', 'Tony mathew', 1),
(229, '2024-07-15 08:20:31', 1, 'The Fault in our star', 'AravindAsokan', 'Tony mathew', 0),
(241, '2024-07-17 11:25:42', 22, 'RICH DAD POOR DAD', 'sonu', 'aravindsreeasok', 0),
(242, '2024-07-18 04:36:20', 12, 'Beloved', 'aravindsreeasok', 'John Sammuel', 0),
(243, '2024-07-18 06:49:49', 3, 'Oliver Twist', 'aravindsreeasok', 'Tony mathew', 1),
(244, '2024-07-18 07:08:11', 20, 'The Da Vinci Code', 'Tony mathew', 'aravindsreeasok', 1),
(225, '2024-07-15 06:04:03', 6, 'Khasakkinte Itihasam', 'AravindAsokan', 'aravindsreeasok', 1),
(224, '2024-07-14 13:17:01', 15, 'The Death of Ivan Ilyich', 'John Sammuel', 'aravindsreeasok', 0),
(223, '2024-07-14 11:45:26', 11, 'David Copperfield', 'aravindsreeasok', 'aravindsreeasok', 0),
(222, '2024-07-14 11:22:39', 13, 'The Great Gatsby', 'aravindsreeasok', 'aravindsreeasok', 0),
(221, '2024-07-14 11:22:36', 4, 'Aadujeevitham', 'AravindAsokan', 'aravindsreeasok', 1),
(240, '2024-07-16 14:25:41', 19, 'Robinson crusoe', 'Tony mathew', 'aravindsreeasok', 0),
(219, '2024-07-14 10:58:55', 19, 'Robinson crusoe', 'Tony mathew', 'aravindsreeasok', 0),
(218, '2024-07-14 10:58:44', 2, 'the financial expert', 'aravindsreeasok', 'aravindsreeasok', 0),
(217, '2024-07-14 10:57:58', 10, 'Crime and Punishment', 'AravindAsokan', 'aravindsreeasok', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review_tab`
--

DROP TABLE IF EXISTS `review_tab`;
CREATE TABLE IF NOT EXISTS `review_tab` (
  `review_no` int NOT NULL AUTO_INCREMENT,
  `serial_no` int NOT NULL,
  `student_name` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `student_rollno` int NOT NULL,
  `bookname` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `review` varchar(300) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`review_no`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review_tab`
--

INSERT INTO `review_tab` (`review_no`, `serial_no`, `student_name`, `student_rollno`, `bookname`, `review`) VALUES
(3, 31, 'aravindsreeasok', 2368, 'TO KILL A MOCKINGBIRD', 'To Kill a Mockingbird is an incredibly moving story that tackles serious issues like racism and justice through the eyes of a young girl. I loved how Scouts perspective made me think about right and wrong in a new way. The characters felt so real, especially Atticus Finch, who is a true hero!'),
(2, 1, 'aravindsreeasok', 2368, 'The Fault in our star', 'One of the best book with an unexpected twist'),
(4, 26, 'aravindsreeasok', 2368, 'Thinking in Java', 'Amazing Book '),
(5, 1, 'justin', 2369, 'The Fault in our star', 'Good Book with Amazing Twist'),
(6, 3, 'justin', 2369, 'Oliver Twist', 'Very Nice Book'),
(7, 3, 'aravindsreeasok', 2368, 'Oliver Twist', 'Very Nice Story '),
(8, 3, 'alfina', 2362, 'Oliver Twist', 'Nice Content'),
(9, 34, 'aravindsreeasok', 2368, 'CHENNAI: A BIOGRAPHY', 'nice book'),
(10, 25, 'aravindsreeasok', 2368, 'HereThere and Everywhere ', 'Inspirational book recommend for everyone'),
(11, 22, 'alan', 2317, 'RICH DAD POOR DAD', 'rich dad poor dad is a very good book that show us how to handle money with care '),
(12, 4, 'jose', 2359, 'Aadujeevitham', 'One of the best survival novels '),
(13, 8, 'jose', 2359, 'Alice In Wonderland', 'One of the best survival novels '),
(14, 8, 'jose', 2359, 'Alice In Wonderland', 'one of the best stories'),
(15, 12, 'jose', 2359, 'Beloved', 'good story'),
(16, 34, 'jose', 2359, 'CHENNAI: A BIOGRAPHY', 'a very traditional story tellimg book'),
(17, 27, 'jose', 2359, 'Don Quixote', 'war based story'),
(18, 32, 'jose', 2359, 'FALLING IN LOVE AGAIN', 'best romantic story'),
(19, 25, 'jose', 2359, 'Here,There and Everywhere ', 'Motivational story'),
(20, 10, 'jose', 2359, 'Crime and Punishment', 'Thriller story'),
(21, 37, 'jose', 2359, 'Steve Jobs', 'Inspirational book'),
(22, 5, 'jose', 2359, 'Randamoozham', 'nice book with amazing story related to mahabharatha'),
(23, 29, 'jose', 2359, 'Politics for Beginners', 'explains politics in simple language'),
(24, 26, 'jose', 2359, 'Thinking in Java', 'Explains java in simple terms'),
(25, 41, 'aravindsreeasok', 2368, 'The Psychology of Money', 'Explain how to handle money ');

-- --------------------------------------------------------

--
-- Table structure for table `staff_login_tab`
--

DROP TABLE IF EXISTS `staff_login_tab`;
CREATE TABLE IF NOT EXISTS `staff_login_tab` (
  `staffname` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `staffphone` varchar(13) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `staffemail` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `staffage` varchar(10) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `staffno` varchar(10) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `staffpassword` varchar(15) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`staffno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff_login_tab`
--

INSERT INTO `staff_login_tab` (`staffname`, `staffphone`, `staffemail`, `staffage`, `staffno`, `staffpassword`) VALUES
('Aravind Sree Asokan', '7736783189', 'aravind773678@gmail.com', '20', '777', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `student_answers_tab`
--

DROP TABLE IF EXISTS `student_answers_tab`;
CREATE TABLE IF NOT EXISTS `student_answers_tab` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_option` int NOT NULL,
  `submission_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_answers_tab`
--

INSERT INTO `student_answers_tab` (`id`, `student_id`, `question_id`, `selected_option`, `submission_time`) VALUES
(46, 2368, 21, 3, '2024-10-18 06:43:51'),
(45, 2368, 12, 1, '2024-10-05 11:42:59'),
(44, 2368, 11, 1, '2024-10-05 11:42:54'),
(43, 12009, 22, 2, '2024-10-03 05:42:14'),
(42, 12009, 23, 2, '2024-10-03 05:37:33'),
(41, 2368, 21, 1, '2024-10-03 04:20:05'),
(40, 2369, 12, 1, '2024-09-28 03:52:59'),
(39, 2369, 11, 1, '2024-09-28 03:52:55'),
(47, 2370, 5, 3, '2024-10-18 06:53:07'),
(48, 2370, 7, 2, '2024-10-18 06:53:12'),
(49, 2370, 6, 4, '2024-10-18 06:53:16'),
(50, 2317, 21, 3, '2024-10-21 17:12:25'),
(51, 2359, 25, 1, '2024-10-22 06:08:49'),
(52, 7362, 26, 1, '2024-10-23 08:35:07'),
(53, 2368, 24, 1, '2024-10-23 12:44:45'),
(54, 2387, 27, 1, '2024-10-24 06:46:59'),
(55, 2373, 28, 1, '2024-11-03 04:34:39'),
(56, 2373, 29, 1, '2024-11-03 04:34:45'),
(57, 2373, 30, 1, '2024-11-03 04:34:50'),
(58, 7362, 31, 1, '2025-02-11 13:21:32'),
(59, 24267, 32, 1, '2025-02-11 14:57:19'),
(60, 24267, 5, 2, '2025-02-11 14:59:37'),
(61, 24267, 6, 2, '2025-02-11 15:01:53'),
(62, 24267, 7, 1, '2025-02-11 15:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `student_details_tab`
--

DROP TABLE IF EXISTS `student_details_tab`;
CREATE TABLE IF NOT EXISTS `student_details_tab` (
  `student_rollno` int NOT NULL,
  `student_img` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL DEFAULT 'default',
  `student_name` varchar(30) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `offical_name` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `student_mail` varchar(70) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `age` int NOT NULL,
  `location` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `disability` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `interest` varchar(400) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `mentor_name` varchar(40) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`student_rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_details_tab`
--

INSERT INTO `student_details_tab` (`student_rollno`, `student_img`, `student_name`, `offical_name`, `student_mail`, `age`, `location`, `disability`, `interest`, `mentor_name`) VALUES
(2368, 'wallpaperflare.com_wallpaper (17).jpg', 'aravindsreeasok', 'Aravind Sree Asokan', 'aravind9946580@gmail.com', 19, 'Thrissur', 'visual', 'Biography', 'John Sammuel'),
(9019, 'default.png', 'parthiv', 'Parthiv Suresh', 'parthiv2004@gmail.com', 20, 'Vazhoor', 'visual', 'Science,Novel', 'Gemini'),
(2359, 'WhatsApp Image 2024-10-22 at 04.59.49_527642b0.jpg', 'jose', 'Josekutty', 'jose2004@gmail.com', 20, 'Parapuzha', 'learning', 'Politics,Novel', 'John Sammuel'),
(7362, 'default.png', 'kalyany', 'Kalyany S nair', 'kalyany2004@gmail.com', 20, 'Vazhoor', 'learning', '', 'Gemini'),
(2103, 'default.png', 'benoy', 'Benoy', 'benoy2004@gmail.com', 22, 'Kodungoor', 'visual', '', 'Gemini'),
(2317, 'default.png', 'alan', 'Alan Satheesh', 'alan2004@gmail.com ', 20, 'Edakunnam', 'physical', 'Politics,Novel', ''),
(2387, 'default.png', 'gokul', 'Gokul', 'gokul@gmail.com', 20, 'Kottayam', 'visual', 'Politics,Novel', 'linu'),
(2373, 'default.png', 'adhityan', 'Adhityan', 'adhi@gmail.com', 22, 'Kottayam', 'visual', 'Politics,Novel', 'John Sammuel'),
(1232, 'default.png', 'hari', 'Hari', 'hari2004@gmail.com', 21, 'Kottayam', 'learning', '', 'deepa'),
(24267, 'default.png', 'albin', 'Albin Mathews', 'albin2004@gmail.com', 19, 'Kottayam', 'physical', 'Politics,Novel', 'linu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
