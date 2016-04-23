/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.10-MariaDB : Database - nitrition_guide
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nitrition_guide` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `nitrition_guide`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(30) DEFAULT NULL,
  `cat_image` varchar(100) DEFAULT NULL,
  `cat_level` int(10) DEFAULT NULL,
  `cat_description` varchar(200) DEFAULT NULL,
  `fg_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(100) NOT NULL,
  `comment_user_id` int(100) NOT NULL,
  `comment_content` text,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`,`comment_post_id`,`comment_user_id`),
  KEY `comment_post_id` (`comment_post_id`),
  KEY `comment_user_id` (`comment_user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_code` varchar(2) NOT NULL COMMENT 'example: sy',
  `country_name` varchar(50) DEFAULT NULL COMMENT 'مثال: سوريا',
  PRIMARY KEY (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `country` */

/*Table structure for table `food_categories` */

DROP TABLE IF EXISTS `food_categories`;

CREATE TABLE `food_categories` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_title` varchar(30) DEFAULT NULL COMMENT 'عنوان',
  `fc_image` varchar(50) DEFAULT NULL COMMENT 'رابط صورة مرفوعة',
  `fc_level` int(5) DEFAULT NULL COMMENT 'لترتيب التصنيفات',
  `fc_author_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`fc_id`),
  KEY `fc_author_id` (`fc_author_id`),
  CONSTRAINT `food_categories_ibfk_1` FOREIGN KEY (`fc_author_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `food_categories` */

insert  into `food_categories`(`fc_id`,`fc_title`,`fc_image`,`fc_level`,`fc_author_id`) values (4,'الخبز والحبوب','1461402768.jpg',1,1),(5,'الفواكه والخضار','1461402812.jpg',2,1),(6,'تصنيف تجريبي 2','1461402786.jpg',1,1),(7,'تصنيف تجريبي 3','1461402829.jpg',4,1);

/*Table structure for table `food_stuffs` */

DROP TABLE IF EXISTS `food_stuffs`;

CREATE TABLE `food_stuffs` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_title` varchar(50) DEFAULT NULL COMMENT 'المادة الغذائية',
  `f_size` float DEFAULT NULL COMMENT 'الحجم',
  `f_weight` float DEFAULT NULL COMMENT 'الوزن',
  `f_calories` float DEFAULT NULL COMMENT 'السعرات الحرارية',
  `f_proteins` float DEFAULT NULL COMMENT 'البروتينات',
  `f_fats` float DEFAULT NULL COMMENT 'الدهون',
  `f_carbohydrates` float DEFAULT NULL COMMENT 'الكربوهيدرات',
  `f_fibers` float DEFAULT NULL COMMENT 'الألياف',
  `f_cholesterol` float DEFAULT NULL COMMENT 'الكوليسترول',
  `f_calcium` float DEFAULT NULL COMMENT 'الكالسيوم',
  `f_iron` float DEFAULT NULL COMMENT 'الحديد',
  `f_sodium` float DEFAULT NULL COMMENT 'الصوديوم',
  `f_image` varchar(200) DEFAULT NULL,
  `f_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`),
  KEY `f_category_id` (`f_category_id`),
  CONSTRAINT `food_stuffs_ibfk_1` FOREIGN KEY (`f_category_id`) REFERENCES `food_categories` (`fc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `food_stuffs` */

/*Table structure for table `options` */

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(1) NOT NULL DEFAULT '1',
  `site_name` varchar(250) DEFAULT NULL,
  `site_tags` varchar(200) DEFAULT NULL,
  `site_description` varchar(200) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `options` */

insert  into `options`(`id`,`site_name`,`site_tags`,`site_description`,`facebook`,`twitter`,`youtube`) values (1,'الدليل الغذائي الإلكتروني','','تعريف على العناصر الغذائية ومواصفاتها والهرم الغذائي ونصائح غذائية','http://facebook.com/nitrition_guide','http://twitter.com/nitrition_guide','http://youtube.com/nitrition_guide');

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `page_id` int(10) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(200) DEFAULT NULL,
  `page_content` longtext,
  `page_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page_author_id` int(10) DEFAULT NULL,
  `page_level` int(10) DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `page_author_id` (`page_author_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`page_author_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `pages` */

insert  into `pages`(`page_id`,`page_title`,`page_content`,`page_created_at`,`page_updated_at`,`page_author_id`,`page_level`) values (5,'الهرم الغذائي','<p>محتوى صفحة الهرم الغذائي<br></p>','2016-04-21 21:36:31','0000-00-00 00:00:00',1,5);

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(10) NOT NULL AUTO_INCREMENT,
  `post_cat_id` int(10) DEFAULT NULL,
  `post_title` varchar(250) DEFAULT NULL,
  `post_tags` varchar(250) DEFAULT NULL,
  `post_content` tinytext,
  `post_image` varchar(100) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_author_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_cat_id` (`post_cat_id`),
  KEY `post_author_id` (`post_author_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_cat_id`) REFERENCES `categories` (`cat_id`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`user_country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

/*Table structure for table `statistics` */

DROP TABLE IF EXISTS `statistics`;

CREATE TABLE `statistics` (
  `visti_date` datetime DEFAULT NULL,
  `visit_ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `statistics` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(10) DEFAULT NULL COMMENT 'admin or member',
  `user_name` varchar(30) DEFAULT NULL,
  `user_birthDate` date DEFAULT NULL COMMENT 'تاريخ الميلاد ومنه نشتق العمر',
  `user_email` varchar(30) DEFAULT NULL,
  `user_password` varchar(30) DEFAULT NULL,
  `user_photo` varchar(200) DEFAULT NULL,
  `user_gender` varchar(10) DEFAULT NULL,
  `user_phone_number` varchar(30) DEFAULT NULL,
  `user_about` varchar(250) DEFAULT NULL,
  `user_registeration_date` timestamp NULL DEFAULT NULL,
  `user_ip` varchar(100) DEFAULT NULL COMMENT 'من الآي بي ممكن أن نكتشف البلد',
  `user_country` varchar(2) DEFAULT NULL COMMENT 'example: sy, eg, lb, ...',
  PRIMARY KEY (`user_id`),
  KEY `user_country_id` (`user_country`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_country`) REFERENCES `country` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_role`,`user_name`,`user_birthDate`,`user_email`,`user_password`,`user_photo`,`user_gender`,`user_phone_number`,`user_about`,`user_registeration_date`,`user_ip`,`user_country`) values (1,'admin','زهير طه','1984-03-21','admin@tahasoft.com','123',NULL,'mail','0933960103','مطور ويب','2016-04-21 16:59:30',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
