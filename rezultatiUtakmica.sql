/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - rezultatiutakmica
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rezultatiutakmica` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `rezultatiutakmica`;

/*Table structure for table `rezultat` */

DROP TABLE IF EXISTS `rezultat`;

CREATE TABLE `rezultat` (
  `prviTimId` int(11) NOT NULL,
  `drugiTimId` int(11) NOT NULL,
  `prviTimSetova` int(11) NOT NULL,
  `drugiTimSetova` int(11) NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`prviTimId`,`drugiTimId`,`datum`),
  KEY `fk_drugiTim` (`drugiTimId`),
  CONSTRAINT `fk_drugiTim` FOREIGN KEY (`drugiTimId`) REFERENCES `tim` (`timId`),
  CONSTRAINT `fk_prviTim` FOREIGN KEY (`prviTimId`) REFERENCES `tim` (`timId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rezultat` */

insert  into `rezultat`(`prviTimId`,`drugiTimId`,`prviTimSetova`,`drugiTimSetova`,`datum`) values 
(1,2,2,1,'2022-11-27'),
(1,3,2,0,'2022-11-19'),
(2,4,2,0,'2022-12-04'),
(2,6,2,1,'2022-11-20'),
(3,5,2,1,'2022-12-04'),
(4,3,1,2,'2022-11-27'),
(4,6,2,0,'2022-12-11'),
(5,7,2,0,'2022-11-27'),
(7,3,0,2,'2022-12-11');

/*Table structure for table `tim` */

DROP TABLE IF EXISTS `tim`;

CREATE TABLE `tim` (
  `timId` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) NOT NULL,
  `odigranih` int(11) DEFAULT 0,
  `pobeda` int(11) DEFAULT 0,
  `poraza` int(11) DEFAULT 0,
  `osvojenihSetova` int(11) DEFAULT 0,
  `izgubljenihSetova` int(11) DEFAULT 0,
  `bodova` int(11) DEFAULT 0,
  PRIMARY KEY (`timId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tim` */

insert  into `tim`(`timId`,`ime`,`odigranih`,`pobeda`,`poraza`,`osvojenihSetova`,`izgubljenihSetova`,`bodova`) values 
(1,'Fakultet organizacionih nauka',2,2,0,4,1,5),
(2,'Elektrotehnicki fakultet',3,2,1,5,3,6),
(3,'Fakultet sporta i fizickog vaspitanja',4,3,1,6,4,7),
(4,'ATUSS',3,1,2,3,4,4),
(5,'Stomatoloski fakultet',2,1,1,3,2,4),
(6,'Medicinski fakultet',2,0,2,1,4,1),
(7,'Ekonomski fakultet',2,0,2,0,4,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
