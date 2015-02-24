/*
SQLyog Community v12.01 (32 bit)
MySQL - 5.6.21 : Database - fooddiary
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


USE `fooddiary_old`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminname` varchar(30) DEFAULT NULL,
  `adminpass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admins` */

/*Table structure for table `default_reasons` */

DROP TABLE IF EXISTS `default_reasons`;

CREATE TABLE `default_reasons` (
  `id` int(11) NOT NULL,
  `reason` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `default_reasons` */

insert  into `default_reasons`(`id`,`reason`) values (1,'Hungry'),(2,'Bored'),(3,'Free food'),(4,'Cheap food'),(5,'Tired'),(6,'Stressed'),(7,'Movie'),(8,'Reward'),(9,'Anxious'),(10,'Insomnia'),(11,'Others eat'),(12,'Will be hungry'),(13,'Feeling empty'),(14,'Special occasion');

/*Table structure for table `diary` */

DROP TABLE IF EXISTS `diary`;

CREATE TABLE `diary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foodName` varchar(50) NOT NULL,
  `foodDescription` text NOT NULL,
  `inputDate` date NOT NULL,
  `inputTime` time DEFAULT NULL,
  `foodCategory` text,
  `why` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `diary` */

insert  into `diary`(`id`,`foodName`,`foodDescription`,`inputDate`,`inputTime`,`foodCategory`,`why`,`user_id`) values (1,'','','0000-00-00',NULL,NULL,NULL,7);

/*Table structure for table `food_types` */

DROP TABLE IF EXISTS `food_types`;

CREATE TABLE `food_types` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `food_types` */

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `verifyCode` (`verifyCode`),
  UNIQUE KEY `passResetCode` (`passResetCode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`userStatus`,`fullName`,`verifyCode`,`verifyExpTime`,`passResetCode`,`passResetExpTime`) values (7,'yndyan','Zile33','yndyan@gmail.com',2,'Dusan Zivkovic',NULL,NULL,NULL,NULL);

/*Table structure for table `users_reasons` */

DROP TABLE IF EXISTS `users_reasons`;

CREATE TABLE `users_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `users_reasons` */

insert  into `users_reasons`(`id`,`reason`,`user_id`) values (1,'Hungry',7),(2,'Bored',7),(3,'Free food',7),(4,'Cheap food',7),(5,'Tired',7),(6,'Stressed',7),(7,'Movie',7),(8,'Reward',7),(9,'Anxious',7),(10,'Insomnia',7),(11,'Others eat',7),(12,'Will be hungry',8),(13,'Feeling empty',8),(14,'Special occasion',8),(15,'Bored',8),(16,'Free food',8);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
