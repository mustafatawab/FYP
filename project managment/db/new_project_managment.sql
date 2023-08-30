/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.28-MariaDB : Database - project_managment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project_managment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `project_managment`;

/*Table structure for table `evalvations_tbl` */

DROP TABLE IF EXISTS `evalvations_tbl`;

CREATE TABLE `evalvations_tbl` (
  `evalvations_id` int(11) NOT NULL AUTO_INCREMENT,
  `evalvation` varchar(250) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `fyp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`evalvations_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `evalvations_tbl` */

insert  into `evalvations_tbl`(`evalvations_id`,`evalvation`,`semester`,`description`,`fyp`) values (1,'Evaluation1','Fall 2023','This is the is evalvation','FYP 1'),(2,'Evaluation2','Spring 2023','This is the 2nd evalvation','FYP 2');

/*Table structure for table `faculty_tbl` */

DROP TABLE IF EXISTS `faculty_tbl`;

CREATE TABLE `faculty_tbl` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(14) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT '0',
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `faculty_tbl` */

insert  into `faculty_tbl`(`faculty_id`,`name`,`department`,`email`,`phone_no`,`password`,`role`,`status`) values (1,'admin','cs','admin@gmail.com','03103388069','$2y$10$CY0.IfUJiS5P6BgV9lobJOgVCWfekfe41ey46P7/hw2fexmeGzEuu','Coordinator','1'),(2,'Hamid Hussain','cs','hamidhussain@gmail.com','03103388069','$2y$10$Qo6.FsDHpQxo0K249pU1vOrcfjocmRIJwbqJWlZhb2e8C36YbsWES','Supervisor','0'),(3,'Sir Iqbal','cs','iqbal@gmail.com','02345678909','$2y$10$usHm6tMpy4YM2gVf9UDUWuH6t4nYotLEUshgrhw.592N5Hsu8LQke','Supervisor','1'),(4,'Mumtaz Hussian','cs','Mumtaz@gmail.com','931076534567','$2y$10$symsVlrgPq8GoDz6ZL12luV//T8MZnPwLDYsTwd3pQwU760U6LVtC','Supervisor','1'),(5,'Khunrram Shehzad','cs','Shehzad@gmail.com','03103388069','$2y$10$6wSqk4aCfbDFRnNTlPcvmOElgEJF8KeDmg8ECAhwutyWbaCF8aATW','Supervisor','0'),(6,'Saima Abdullah','cs','Saima@gmail.com','03456768788','$2y$10$0Vi.tGOWvoaJvv9XxExtGOsNqW6s.vBN1MrqWKAZTEw9h0aDTXIbG','Supervisor','1'),(7,'Maida Khalid','cs','Maida@gmail.com','034567890987','$2y$10$Cx7HQbMxjrLPu.9vjX3NguVxBeuKc8w9xE/EjvdMmmMD1p8umkSeq','Supervisor','1'),(8,'Tausef','cs','Tausef@gmail.com','03479876','$2y$10$MIdieepK17unUa2P/ROaC.1W0hFJJPkT6S06H/i83CqIFKbg.K4m2','Supervisor','1'),(9,'Nadeem','cs','nadeem@gmail.com','034987657876','$2y$10$SyfDHiUxXW70B.hNLtaH8uhmlqVxvZCi91iQBRMHoS6P4mXQk9tAy','Supervisor','1');

/*Table structure for table `grading_tbl` */

DROP TABLE IF EXISTS `grading_tbl`;

CREATE TABLE `grading_tbl` (
  `grading_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_enrollment_id` int(11) DEFAULT NULL,
  `marks` varchar(50) DEFAULT NULL,
  `status` char(3) DEFAULT '0',
  PRIMARY KEY (`grading_id`),
  KEY `group_enrollment_id` (`group_enrollment_id`),
  CONSTRAINT `grading_tbl_ibfk_1` FOREIGN KEY (`group_enrollment_id`) REFERENCES `group_enrollment_tbl` (`group_enrollment_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `grading_tbl` */

/*Table structure for table `group_enrollment_tbl` */

DROP TABLE IF EXISTS `group_enrollment_tbl`;

CREATE TABLE `group_enrollment_tbl` (
  `group_enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) DEFAULT NULL,
  `group_no` varchar(50) DEFAULT NULL,
  `project_title` varchar(50) DEFAULT NULL,
  `std_a` varchar(250) DEFAULT NULL,
  `std_b` varchar(250) DEFAULT NULL,
  `std_c` varchar(250) DEFAULT NULL,
  `status` char(3) DEFAULT '0',
  PRIMARY KEY (`group_enrollment_id`),
  KEY `supervisor_id` (`faculty_id`),
  KEY `std_id` (`std_a`),
  CONSTRAINT `group_enrollment_tbl_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `group_enrollment_tbl` */

insert  into `group_enrollment_tbl`(`group_enrollment_id`,`faculty_id`,`group_no`,`project_title`,`std_a`,`std_b`,`std_c`,`status`) values (1,3,'G1','FYP Managment System','1','3','2','0'),(2,1,'G1','FYP Managment System','7','5','6','1');

/*Table structure for table `notification_tbl` */

DROP TABLE IF EXISTS `notification_tbl`;

CREATE TABLE `notification_tbl` (
  `noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `notification_tbl` */

insert  into `notification_tbl`(`noti_id`,`title`,`description`,`date`) values (1,'Submition Project','Monday is The Last Day of the Project Submition','22-08-23');

/*Table structure for table `panel_tbl` */

DROP TABLE IF EXISTS `panel_tbl`;

CREATE TABLE `panel_tbl` (
  `panel_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_no` varchar(50) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `evaluator` varchar(255) DEFAULT NULL,
  `evalvations_id` int(11) DEFAULT NULL,
  `dept` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`panel_id`),
  KEY `evalvations_id` (`evalvations_id`),
  CONSTRAINT `panel_tbl_ibfk_1` FOREIGN KEY (`evalvations_id`) REFERENCES `evalvations_tbl` (`evalvations_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `panel_tbl` */

insert  into `panel_tbl`(`panel_id`,`panel_no`,`room`,`evaluator`,`evalvations_id`,`dept`) values (1,'p1','Room 1','3',1,'cs'),(2,'p2','Room 2','8',2,'cs');

/*Table structure for table `result_tbl` */

DROP TABLE IF EXISTS `result_tbl`;

CREATE TABLE `result_tbl` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_enrollment_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `marks` varchar(255) DEFAULT NULL,
  `eval_a_m` varchar(255) DEFAULT '0',
  `eval_b_m` varchar(255) DEFAULT '0',
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `result_tbl` */

insert  into `result_tbl`(`result_id`,`group_enrollment_id`,`faculty_id`,`document`,`marks`,`eval_a_m`,`eval_b_m`) values (2,2,1,'Proposal','20','30','32'),(3,2,1,'SRS','28','32','33');

/*Table structure for table `room_tbl` */

DROP TABLE IF EXISTS `room_tbl`;

CREATE TABLE `room_tbl` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(40) DEFAULT NULL,
  `dept` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `room_tbl` */

insert  into `room_tbl`(`room_id`,`room_name`,`dept`) values (1,'Room 1','ist floor'),(2,'Room 2','ist floor'),(3,'Room 3','2nd floor'),(4,'Room 4','2nd floor lab');

/*Table structure for table `schedule_tbl` */

DROP TABLE IF EXISTS `schedule_tbl`;

CREATE TABLE `schedule_tbl` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `panel_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `etime` time DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `schedule_tbl` */

insert  into `schedule_tbl`(`schedule_id`,`panel_id`,`group_id`,`date`,`stime`,`etime`,`dept`,`faculty_id`) values (1,1,2,'2023-08-23','11:00:00','00:30:00','cs',1);

/*Table structure for table `student_tbl` */

DROP TABLE IF EXISTS `student_tbl`;

CREATE TABLE `student_tbl` (
  `std_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `sap_id` varchar(20) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `contact` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`std_id`),
  KEY `supervisor_id` (`faculty_id`),
  CONSTRAINT `student_tbl_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `student_tbl` */

insert  into `student_tbl`(`std_id`,`name`,`sap_id`,`dept`,`faculty_id`,`contact`) values (1,'Imran','1961113','cs',3,'031033388069'),(2,'Ahmad','1961114','cs',3,'03471906561'),(3,'Mustafa Tawab','1961115','cs',3,'031033388069'),(4,'Osama','1961116','cs',3,'03471906561'),(5,'Imran','1961113','cs',1,'031033388069'),(6,'Ahmad','1961114','cs',1,'031033388069'),(7,'Mustafa Tawab','1961115','cs',1,'03471906561'),(8,'Osama','1961116','cs',1,'0310393494');

/*Table structure for table `supervisor_tbl` */

DROP TABLE IF EXISTS `supervisor_tbl`;

CREATE TABLE `supervisor_tbl` (
  `supervisor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(14) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`supervisor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `supervisor_tbl` */

/*Table structure for table `upload_document_tbl` */

DROP TABLE IF EXISTS `upload_document_tbl`;

CREATE TABLE `upload_document_tbl` (
  `up_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_enrollment_id` int(11) DEFAULT NULL,
  `document_name` varchar(150) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`up_document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `upload_document_tbl` */

insert  into `upload_document_tbl`(`up_document_id`,`group_enrollment_id`,`document_name`,`document`,`faculty_id`) values (1,2,'Proposal','maltab.txt',1),(2,2,'SRS','SRS.txt',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
