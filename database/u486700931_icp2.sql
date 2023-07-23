-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 05:13 AM
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
-- Database: `u486700931_icp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `career_id` int(11) NOT NULL,
  `career` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`career_id`, `career`, `description`) VALUES
(1, 'ครู', ''),
(2, 'ตำรวจ', ''),
(3, 'ทหาร', ''),
(4, 'แพทย์', ''),
(5, 'วิศวกร', ''),
(6, 'สถาปนิก', ''),
(7, 'นักบิน', ''),
(8, 'นักบัญชี', ''),
(9, 'โปรแกรมเมอร์', ''),
(10, 'นักแปลภาษา', ''),
(11, 'นักออกแบบ', ''),
(12, 'ช่างไม้', ''),
(13, 'ช่างซ่อมรถ', ''),
(14, 'ช่างทำผม', ''),
(15, 'ช่างประปา', ''),
(16, 'พ่อครัว', ''),
(17, 'อาจารย์มหาวิทยาลัย', ''),
(18, 'นักธรณีวิทยา', ''),
(19, 'นักฟิสิกส์', ''),
(20, 'ทันตแพทย์', ''),
(21, 'ช่างภาพ', ''),
(22, 'ศิลปิน', ''),
(23, 'พยาบาล', ''),
(24, 'ผู้ช่วยพยาบาล', ''),
(25, 'วิศวกร', ''),
(26, 'สภาปนิก', ''),
(27, 'นักบิน', ''),
(28, 'นักบัญชี', ''),
(29, 'โปรแกรมเมอร์', ''),
(30, 'นักแปลภาษา', ''),
(31, 'นักออกแบบ', ''),
(32, 'ช่างไม้', ''),
(33, 'ช่างซ่อมรถ', ''),
(34, 'ช่างทำผม', ''),
(35, 'ช่างประปา', ''),
(36, 'พ่อครัว', ''),
(37, 'อาจารย์มหาวิทยาลัย', ''),
(38, 'นักธรณีวิทยา', ''),
(39, 'นักฟิสิกส์', ''),
(40, 'ทันตแพทย์', ''),
(41, 'ดารานักแสดง', ''),
(42, 'นักแสดงแทน', ''),
(43, 'YouTuber', ''),
(44, 'Graphic Designer', ''),
(45, 'Web Designer', ''),
(46, 'บิวตี้บล็อกเกอร์', ''),
(47, 'นักกีฬา', ''),
(48, 'Web Developer', ''),
(49, 'Mobile App Developer', ''),
(50, 'Software Engineer', ''),
(51, 'ที่ปรึกษากฎหมาย', ''),
(52, 'Steamer', '');

-- --------------------------------------------------------

--
-- Table structure for table `career_qualification`
--

CREATE TABLE `career_qualification` (
  `career_qualification_id` int(11) NOT NULL,
  `plan_career_id` int(11) NOT NULL,
  `qualification_id` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `target` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `study_faculty` varchar(50) NOT NULL,
  `university` varchar(50) NOT NULL,
  `disability_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `study_faculty`, `university`, `disability_type`) VALUES
(1, 'Veerachai', 'วิทยาการคอมพิวเตอร์', 'มหาวิทยาลัยเชียงใหม่', 'การเห็น'),
(2, 'chanikaarn', 'การบริหารจัดการ', 'มหาวิทยาลัยเชียงใหม่', 'การได้ยิน'),
(5, 'Veerachai Karewkhort', 'วิทยาการคอมพิวเตอร์', 'มหาวิทยาลัยเชียงใหม่', 'ไม่บกพร่อง'),
(6, 'วีรชัย แก้วขอด', 'วิทยาการคอมพิวเตอร์', 'มหาวิทยาลัยแม่โจ้', 'ไม่บกพร่อง');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `institution_id` varchar(30) NOT NULL,
  `faculty_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `institution_id`, `faculty_name`) VALUES
(1, '1', 'ผลิตกรรมการเกษตร'),
(2, '1', 'วิศวกรรมและอุตสาหกรรมเกษตร'),
(3, '1', 'วิทยาศาสตร์'),
(4, '1', 'วิทยาลัยบริหารศาสตร์'),
(5, '1', 'บริหารธุรกิจ'),
(6, '1', 'พัฒนาการท่องเที่ยว'),
(7, '1', 'เทคโนโลยีการประมงและทรัพยากรทางน้ำ'),
(8, '1', 'เศรษฐศาสตร์'),
(9, '1', 'ศิลปศาสตร์'),
(10, '1', 'สถาปัตยกรรมศาสตร์ และการออกแบบสิ่งแวดล้อม '),
(11, '1', 'สารสนเทศและการสื่อสาร '),
(12, '1', 'สัตวศาสตร์และเทคโนโลยี '),
(13, '1', 'วิทยาลัยพลังงานทดแทน '),
(14, '1', 'มหาวิทยาลัยแม่โจ้-แพร่ เฉลิมพระเกียรติ '),
(15, '1', 'มหาวิทยาลัยแม่โจ้-ชุมพร'),
(16, '2', 'การสื่อสารมวลชน'),
(17, '2', 'เกษตรศาสตร์'),
(18, '2', 'ทันตแพทยศาสตร์'),
(19, '2', 'เทคนิคการแพทย์'),
(20, '2', 'นิติศาสตร์'),
(21, '2', 'บริหารธุรกิจ'),
(22, '2', 'พยาบาลศาสตร์'),
(23, '2', 'แพทยศาสตร์'),
(24, '2', 'เภสัชศาสตร์'),
(25, '2', 'มนุษยศาสตร์'),
(26, '2', 'รัฐศาสตร์และรัฐประศาสนศาสตร์'),
(27, '2', 'วิจิตรศิลป์'),
(28, '2', 'วิทยาศาสตร์'),
(29, '2', 'วิศวกรรมศาสตร์'),
(30, '2', 'ศึกษาศาสตร์'),
(31, '2', 'เศรษฐศาสตร์'),
(32, '2', 'สถาปัตยกรรมศาสตร์'),
(33, '2', 'สังคมศาสตร์'),
(34, '2', 'สัตวแพทยศาสตร์'),
(35, '2', 'อุตสาหกรรมเกษตร'),
(36, '3', 'ครุศาสตร์'),
(37, '3', 'มนุษยศาสตร์และสังคมศาสตร์'),
(38, '3', 'วิทยาศาสตร์และเทคโนโลยี'),
(39, '3', 'วิทยาการจัดการ'),
(40, '3', 'เทคโนโลยีการเกษตร'),
(41, '3', 'วิทยาลัยนานาชาติ'),
(42, '3', 'วิทยาลัยแม่ฮ่องสอน');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(500) NOT NULL,
  `goal_description` varchar(500) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(500) NOT NULL,
  `level_description` varchar(1000) NOT NULL,
  `weigth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_name`, `level_description`, `weigth`) VALUES
(1, 'Must-Have', 'จำเป็นต้องมี', 3),
(2, 'Nice-to-Have', 'ควรจะมี', 2),
(3, 'Optional', 'ทางเลือก', 1);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `major_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_id`, `degree_id`, `major_name`) VALUES
(1, 1, 'เกษตรศาสตร์'),
(2, 1, 'พืชสวน'),
(3, 1, 'พืชไร่'),
(4, 1, 'อารักขาพืช'),
(5, 1, 'ปฐพีศาสตร์'),
(6, 1, 'การส่งเสริมและสื่อสารเกษตร'),
(7, 1, 'เกษตรเคมี'),
(8, 1, 'การพัฒนาภูมิสังคมอย่างยั่งยืน'),
(9, 1, 'วิทยาการสมุนไพร'),
(10, 1, 'การจัดการและพัฒนาทรัพยากร'),
(11, 4, 'วิศวกรรมเกษตร'),
(12, 4, 'วิศวกรรมอาหาร'),
(13, 4, 'วิทยาศาสตร์และเทคโนโลยีการอาหาร'),
(14, 4, 'เทคโนโลยีหลังการเก็บเกี่ยว'),
(15, 4, 'เทคโนโลยียางและพอลิเมอร์'),
(16, 7, 'วิทยาการคอมพิวเตอร์'),
(17, 7, 'คณิตศาสตร์'),
(18, 7, 'เทคโนโลยีชีวภาพ'),
(19, 7, 'เคมี'),
(20, 7, 'สถิติและการจัดการสารสนเทศ'),
(21, 7, 'เทคโนโลยีสารสนเทศ'),
(24, 7, 'วัสดุศาสตร์'),
(25, 7, 'ฟิสิกส์ประยุกต์'),
(26, 7, 'นวัตกรรมเคมีอุตสาหกรรม'),
(27, 10, 'รัฐประศาสนศาสตร์'),
(28, 10, 'รัฐศาสตร์'),
(29, 13, 'การเงิน'),
(30, 13, 'การจัดการ'),
(31, 13, 'การบัญชี'),
(32, 13, 'การตลาด'),
(33, 13, 'ระบบสารสนเทศ'),
(34, 16, 'การท่องเที่ยวและการโรงแรม'),
(35, 19, 'ประมง'),
(36, 22, 'เศรษฐศาสตร์'),
(37, 25, 'นิเทศศาสตร์บูรณาการ'),
(38, 25, 'ภาษาอังกฤษ'),
(39, 28, 'ภูมิสถาปัตยกรรมศาสตร์'),
(40, 28, 'สถาปัตยกรรมศาสตร์'),
(41, 28, 'เทคโนโลยีภูมิทัศน์'),
(42, 31, 'การสื่อสารดิจิทัล'),
(43, 34, 'สัตวศาสตร์'),
(44, 37, 'พลังงานทดแทน'),
(45, 40, 'เทคโนโลยีชีวภาพ'),
(46, 40, 'เกษตรศาสตร์'),
(47, 40, 'วนศาสตร์'),
(48, 40, 'การบัญชี'),
(49, 40, 'การตลาด'),
(50, 40, 'การท่องเที่ยวและโรงแรม'),
(51, 40, 'รัฐศาสตร์'),
(52, 40, 'สังคมศาสตร์และพฤติกรรมศาสตร์'),
(53, 40, 'สัตวศาสตร์'),
(54, 43, 'ประมง'),
(55, 43, 'การบริการ พาณิชยการและธุรการ'),
(56, 43, 'การท่องเที่ยวและการโรงแรม'),
(57, 43, 'การปกครอง'),
(58, 43, 'เกษตรศาสตร์'),
(59, 2, 'พัฒนาทรัพยากรและส่งเสริมการเกษตร'),
(60, 2, 'พืชไร่'),
(61, 2, 'พืชสวน'),
(62, 2, 'พัฒนาภูมิสังคมอย่างยั่งยืน'),
(63, 2, 'การใช้ที่ดินและการจัดการทรัพยากรธรรมชาติอย่างยั่งยืน'),
(64, 5, 'วิทยาศาสตร์และเทคโนโลยีการอาหาร'),
(65, 5, 'วิศวกรรมเกษตร'),
(66, 5, 'วิศวกรรมอาหาร'),
(67, 6, 'วิศวกรรมอาหาร'),
(68, 8, 'เคมีประยุกต์'),
(69, 8, 'วิทยาศาสตร์และเทคโนโลยีนาโน'),
(70, 8, 'เทคโนโลยีชีวภาพ'),
(71, 8, 'เทคโนโลยีสิ่งแวดล้อม'),
(72, 8, 'พันธุศาสตร์'),
(73, 8, 'นวัตกรรมเทคโนโลยีดิจิทัล'),
(74, 9, 'เทคโนโลยีชีวภาพ'),
(75, 9, 'เคมีประยุกต์'),
(76, 9, 'พันธุศาสตร์'),
(77, 11, 'การบริหารสาธารณะ'),
(78, 12, 'บริหารศาสตร์'),
(79, 14, 'บริการธุรกิจ'),
(80, 14, 'การบัญชี'),
(81, 15, 'บริหารธุรกิจ'),
(82, 17, 'พัฒนาการท่องเที่ยว'),
(83, 18, 'พัฒนาการท่องเที่ยว'),
(84, 19, 'นวัตกรรมการจัดการธุรกิจประมง'),
(85, 19, 'การประมงและนวัตกรรมการผลิตสัตว์น้ำ'),
(86, 20, 'เทคโนโลยีการประมงและทรัพยากรทางน้ำ'),
(87, 21, 'เทคโนโลยีการประมงและทรัพยากรทางน้ำ'),
(88, 22, 'เศรษฐศาสตร์ระหว่างประเทศ'),
(89, 22, 'เศรษฐศาสตร์ดิจิทัลและการสหกรณ์'),
(90, 22, 'เศรษฐศาสตร์เกษตรและสิ่งแวดล้อม'),
(91, 23, 'เศรษฐศาสตร์ประยุกต์'),
(92, 24, 'เศรษฐศาสตร์ประยุกต์'),
(93, 26, 'การพัฒนาสุขภาพชุมชน'),
(94, 29, 'การออกแบบและวางแผนสิ่งแวดล้อม'),
(95, 29, 'การวางผังเมืองและสภาพแวดล้อม'),
(96, 35, 'สัตวศาสตร์'),
(97, 36, 'สัตวศาสตร์'),
(98, 37, 'วิศวกรรมการอนุรักษ์พลังงาน (ต่อเนื่อง)'),
(99, 37, 'วิศวกรรมฟาร์มอัจฉริยะและนวัตกรรมการเกษตร (ต่อเนื่อง)'),
(100, 38, 'วิศวกรรมพลังงานทดแทน'),
(101, 39, 'วิศวกรรมพลังงานทดแทน');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `full_name`, `email`, `password`, `status`) VALUES
(1, 'Veerachai', 'Veerachai0603@gmail.com', '1234', 'admin'),
(2, 'chanikaarn', 'chanikaarn.nn6@gmail.com', '1234', 'admin'),
(5, 'Veerachai Karewkhort', 'veerachai0604@gmail.com', '1234', 'admin'),
(6, 'วีรชัย แก้วขอด', 'Mju6204101372@mju.ac.th', '1234', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `perform`
--

CREATE TABLE `perform` (
  `perform_id` int(11) NOT NULL,
  `perform_name` varchar(1000) NOT NULL,
  `perform_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `perform`
--

INSERT INTO `perform` (`perform_id`, `perform_name`, `perform_value`) VALUES
(1, 'ระดับ 1: รู้จักทักษะเล็กน้อย', 1),
(2, 'ระดับ 2: เคยเรียนทักษะมาบ้าง', 2),
(3, 'ระดับ 3: เคยใช้ทักษะเป็นครั้งคราว', 3),
(4, 'ระดับ 4: ได้ใช้ทักษะประจําหรือในงาน', 4),
(5, 'ระดับ 5: ปัจจุบันสามารถสอนทักษะนี้แก่ผู้อื่นได้\r\n', 5),
(6, 'Yes: ได้พัฒนาตนเอง', 3),
(7, 'No: ไม่ได้พัฒนาตนเอง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `planId` int(11) NOT NULL,
  `qa_plan_career_id` int(11) NOT NULL,
  `doing` varchar(1000) NOT NULL,
  `leaning` varchar(1000) NOT NULL,
  `plan_start_date` varchar(50) NOT NULL,
  `plan_end_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`planId`, `qa_plan_career_id`, `doing`, `leaning`, `plan_start_date`, `plan_end_date`) VALUES
(27, 88, 'ศึกษาเพิ่มเติมจากYoutube', 'ศึกษาYoutube', '12/03/2566', '13/04/2566');

-- --------------------------------------------------------

--
-- Table structure for table `plan_career`
--

CREATE TABLE `plan_career` (
  `Plan_Career_id` int(11) NOT NULL,
  `Employee_id` int(11) NOT NULL,
  `career_id` int(20) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_career`
--

INSERT INTO `plan_career` (`Plan_Career_id`, `Employee_id`, `career_id`, `Description`) VALUES
(154, 1, 9, ''),
(155, 1, 1, ''),
(156, 1, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `qa_plan_career`
--

CREATE TABLE `qa_plan_career` (
  `qa_plan_career_id` int(11) NOT NULL,
  `plan_career_id` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `level_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_plan_career`
--

INSERT INTO `qa_plan_career` (`qa_plan_career_id`, `plan_career_id`, `qualification_id`, `target_id`, `level_id`) VALUES
(79, 145, 1, 2, 1),
(80, 149, 2, 1, 1),
(81, 149, 1, 2, 1),
(83, 150, 1, 4, 1),
(84, 151, 10, 2, 1),
(88, 154, 2, 2, 1),
(89, 155, 1, 1, 1),
(90, 156, 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `qualificationId` int(11) NOT NULL,
  `qualification_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`qualificationId`, `qualification_name`) VALUES
(1, 'การใช้ภาษาอังกฤษ'),
(2, 'มีความรู้ในการเขียนโค้ดและใช้งานภาษาของคอมพิวเตอร์'),
(3, 'มีความรู้,ความเข้าใจองค์ประกอบในการถ่ายภาพ'),
(4, 'มีความรู้ในคณิตศาสตร์'),
(5, 'มีความรู้ในการซ่อมรถ'),
(6, 'มีความรู้ในการตัดและออกแบบทรงผม'),
(7, 'เข้าใจรสชาติอาหารและสามารถรังสรรค์เมนูอาหาร'),
(8, 'มีความรู้ในการใช้งานภาษาได้หลากหลายภาษา'),
(9, 'มีความคิดสร้างสรรค์'),
(10, 'เป็นบุคคลที่มีสภาพร่างกายและจิตใจ แข็งแรง อยู่ในเกณฑ์ปกติ , '),
(11, 'ความคิดริเริ่มสร้างสรรค์มีจินตนาการในการออกแบบ'),
(12, 'ภาษาอังกฤษในการสื่อสารได้ดี'),
(13, 'ความรู้ทางด้านวิทยาศาสตร์'),
(14, 'ความรู้ทางวิทยาการแพทย์'),
(15, 'รักการทำอาหาร รักความสะอาด ถูกสุขลักษณะอนามัย'),
(16, 'ความรู้ทางด้านสังคมศาสตร์และมนุษยศาสตร์'),
(17, 'ความรู้ในงานการประปาอย่างเหมาะสมแก่การปฏิบัติงานในหน้าที่'),
(18, 'ความสนใจด้านวิทยาศาสตร์ธรรมชาติ'),
(19, 'ความสามารถพื้นฐานในการออกภาคสนามเป็นเวลายาวนาน อาทิ การตั้งแคมป์ พายเรือ'),
(20, 'ผู้มีความรู้ความสามารถ มีความเชี่ยวชาญ และมีผลงานดีเด่นเป็นที่ยอมรับของวงการศิลปะแขนงนั้น');

-- --------------------------------------------------------

--
-- Table structure for table `self_assessment`
--

CREATE TABLE `self_assessment` (
  `self_assessment_id` int(11) NOT NULL,
  `qa_plan_career_id` int(11) NOT NULL,
  `self_assessment_date` varchar(50) NOT NULL,
  `perform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `self_assessment`
--

INSERT INTO `self_assessment` (`self_assessment_id`, `qa_plan_career_id`, `self_assessment_date`, `perform_id`) VALUES
(17, 89, '03/03/2567', 2),
(18, 88, '14/03/2566', 3);

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `target_id` int(11) NOT NULL,
  `target_name` varchar(1000) NOT NULL,
  `target_value` int(11) NOT NULL,
  `target_description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`target_id`, `target_name`, `target_value`, `target_description`) VALUES
(1, ' รู้จักทักษะเล็กน้อย', 1, ''),
(2, 'เคยเรียนและใช้ทักษะมาบ้าง', 2, ''),
(3, 'เคยใช้ทักษะเป็นครั้งคราว', 3, ''),
(4, 'ได้ใช้ทักษะประจําหรือในงาน', 4, ''),
(5, 'ปัจจุบันสามารถสอนทักษะนี้แก่ผู้อื่นได้', 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`career_id`);

--
-- Indexes for table `career_qualification`
--
ALTER TABLE `career_qualification`
  ADD PRIMARY KEY (`career_qualification_id`),
  ADD KEY `plan_career_id` (`plan_career_id`,`qualification_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
  ADD PRIMARY KEY (`perform_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planId`),
  ADD KEY `qa_plan_career_id` (`qa_plan_career_id`);

--
-- Indexes for table `plan_career`
--
ALTER TABLE `plan_career`
  ADD PRIMARY KEY (`Plan_Career_id`),
  ADD KEY `Employee_id` (`Employee_id`,`career_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `qa_plan_career`
--
ALTER TABLE `qa_plan_career`
  ADD PRIMARY KEY (`qa_plan_career_id`),
  ADD KEY `plan_career_id` (`plan_career_id`,`qualification_id`),
  ADD KEY `plan_career_id_2` (`plan_career_id`,`qualification_id`),
  ADD KEY `qualification_id` (`qualification_id`),
  ADD KEY `target_id` (`target_id`,`level_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `plan_career_id_3` (`plan_career_id`),
  ADD KEY `plan_career_id_4` (`plan_career_id`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`qualificationId`);

--
-- Indexes for table `self_assessment`
--
ALTER TABLE `self_assessment`
  ADD PRIMARY KEY (`self_assessment_id`),
  ADD KEY `qa_plan_career_id` (`qa_plan_career_id`,`perform_id`),
  ADD KEY `perform_id` (`perform_id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`target_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `career_qualification`
--
ALTER TABLE `career_qualification`
  MODIFY `career_qualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22223;

--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `perform`
--
ALTER TABLE `perform`
  MODIFY `perform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `planId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `plan_career`
--
ALTER TABLE `plan_career`
  MODIFY `Plan_Career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `qa_plan_career`
--
ALTER TABLE `qa_plan_career`
  MODIFY `qa_plan_career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `qualificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `self_assessment`
--
ALTER TABLE `self_assessment`
  MODIFY `self_assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career_qualification`
--
ALTER TABLE `career_qualification`
  ADD CONSTRAINT `career_qualification_ibfk_1` FOREIGN KEY (`plan_career_id`) REFERENCES `plan_career` (`Plan_Career_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`qa_plan_career_id`) REFERENCES `qa_plan_career` (`qa_plan_career_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_career`
--
ALTER TABLE `plan_career`
  ADD CONSTRAINT `plan_career_ibfk_1` FOREIGN KEY (`career_id`) REFERENCES `career` (`career_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_career_ibfk_2` FOREIGN KEY (`Employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_career_ibfk_3` FOREIGN KEY (`Plan_Career_id`) REFERENCES `qa_plan_career` (`plan_career_id`);

--
-- Constraints for table `qa_plan_career`
--
ALTER TABLE `qa_plan_career`
  ADD CONSTRAINT `qa_plan_career_ibfk_1` FOREIGN KEY (`qualification_id`) REFERENCES `qualification` (`qualificationId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qa_plan_career_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qa_plan_career_ibfk_3` FOREIGN KEY (`target_id`) REFERENCES `target` (`target_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `self_assessment`
--
ALTER TABLE `self_assessment`
  ADD CONSTRAINT `self_assessment_ibfk_1` FOREIGN KEY (`perform_id`) REFERENCES `perform` (`perform_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `self_assessment_ibfk_2` FOREIGN KEY (`qa_plan_career_id`) REFERENCES `qa_plan_career` (`qa_plan_career_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
