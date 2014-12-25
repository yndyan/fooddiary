/*
SQLyog Community v12.01 (32 bit)
MySQL - 5.5.36 : Database - fooddiary
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fooddiary` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fooddiary`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminname` varchar(30) DEFAULT NULL,
  `adminpass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admins` */

/*Table structure for table `food_types` */

DROP TABLE IF EXISTS `food_types`;

CREATE TABLE `food_types` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `food_types` */

/*Table structure for table `intake_reasons` */

DROP TABLE IF EXISTS `intake_reasons`;

CREATE TABLE `intake_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `intake_reasons` */

insert  into `intake_reasons`(`id`,`reason`,`user_id`) values (1,'Hungry',7),(2,'Bored',7),(3,'Free food',7),(4,'Cheap food',7),(5,'Tired',7),(6,'Stressed',7),(7,'Movie',7),(8,'Reward',7),(9,'Anxious',7),(10,'Insomnia',7),(11,'Others eat',7),(12,'Will be hungry',8),(13,'Feeling empty',8),(14,'Special occasion',8),(15,'Bored',8),(16,'Free food',8);

/*Table structure for table `meals_diary` */

DROP TABLE IF EXISTS `meals_diary`;

CREATE TABLE `meals_diary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foodDescription` varchar(100) NOT NULL,
  `inputDate` date NOT NULL,
  `inputTime` time DEFAULT NULL,
  `intake_reason_id` int(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `meals_diary` */

insert  into `meals_diary`(`id`,`foodDescription`,`inputDate`,`inputTime`,`intake_reason_id`,`user_id`) values (1,'','0000-00-00',NULL,NULL,7);

/*Table structure for table `meals_diary_food_types` */

DROP TABLE IF EXISTS `meals_diary_food_types`;

CREATE TABLE `meals_diary_food_types` (
  `id` int(11) NOT NULL,
  `food_type_id` int(11) DEFAULT NULL,
  `meal_diary_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `meals_diary_food_types` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userStatus` tinyint(2) DEFAULT NULL,
  `fullName` varchar(30) DEFAULT NULL,
  `verifyCode` varchar(34) DEFAULT NULL,
  `verifyExpTime` int(11) DEFAULT NULL,
  `passResetCode` varchar(34) DEFAULT NULL,
  `passResetExpTime` int(11) DEFAULT NULL,
  `reasons_public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `verifyCode` (`verifyCode`),
  UNIQUE KEY `passResetCode` (`passResetCode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`userStatus`,`fullName`,`verifyCode`,`verifyExpTime`,`passResetCode`,`passResetExpTime`,`reasons_public`) values (7,'yndyan','Zile33','yndyan@gmail.com',2,'Dusan Zivkovic',NULL,NULL,NULL,NULL,0),(8,'dusan','Zile33','zivkovicdushan@gmail.com',2,'moja malenkost',NULL,NULL,NULL,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
