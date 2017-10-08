/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - warungtenda
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`warungtenda` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `warungtenda`;

/*Table structure for table `makanan` */

DROP TABLE IF EXISTS `makanan`;

CREATE TABLE `makanan` (
  `makananid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `persediaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`makananid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `makanan` */

insert  into `makanan`(`makananid`,`nama`,`harga`,`gambar`,`keterangan`,`persediaan`) values (1,'Nasi Uduk','5000','nasiuduk.jpg',NULL,87),(2,'Ayam Goreng','11000','ayamgoreng.jpg',NULL,64),(3,'Ayam Bakar','13000','ayambakar.jpg',NULL,92),(4,'Pecel Lele','9000','pecellele.jpg',NULL,95),(5,'Nasi Putih','4000','nasiputih.jpg',NULL,83);

/*Table structure for table `meja` */

DROP TABLE IF EXISTS `meja`;

CREATE TABLE `meja` (
  `mejaid` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `tersedia` int(11) DEFAULT '1',
  PRIMARY KEY (`mejaid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `meja` */

insert  into `meja`(`mejaid`,`nomor`,`keterangan`,`tersedia`) values (1,1,NULL,0),(2,2,NULL,0),(3,3,NULL,0),(4,4,NULL,1),(5,5,NULL,0),(6,6,NULL,1),(7,7,NULL,0),(8,8,NULL,1),(9,9,NULL,0),(10,10,NULL,0);

/*Table structure for table `nota` */

DROP TABLE IF EXISTS `nota`;

CREATE TABLE `nota` (
  `notaid` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `mejaid` int(11) DEFAULT NULL,
  PRIMARY KEY (`notaid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `nota` */

insert  into `nota`(`notaid`,`nomor`,`tanggal`,`mejaid`) values (15,'171007.23:05.1','2017-10-07',1),(16,'171007.23:06.9','2017-10-07',9),(17,'171007.23:58.10','2017-10-07',10),(18,'171008.00:42.2','2017-10-08',2),(19,'171008.00:43.3','2017-10-08',3),(20,'171008.00:48.5','2017-10-08',5),(21,'171008.00:49.7','2017-10-08',7),(22,'171008.04:49.1','2017-10-08',1);

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `pesananid` int(11) NOT NULL AUTO_INCREMENT,
  `makananid` int(11) DEFAULT NULL,
  `jumlahpesan` int(11) DEFAULT NULL,
  `notaid` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`pesananid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `pesanan` */

insert  into `pesanan`(`pesananid`,`makananid`,`jumlahpesan`,`notaid`,`subtotal`) values (1,1,2,15,'10000'),(2,5,2,15,'8000'),(3,2,10,16,'110000'),(4,1,2,17,'10000'),(5,3,2,17,'26000'),(6,1,1,18,'5000'),(7,2,1,18,'11000'),(8,3,2,19,'26000'),(9,5,4,19,'16000'),(10,3,1,20,'13000'),(11,5,1,20,'4000'),(12,1,5,21,'25000'),(13,1,1,22,'5000'),(14,3,1,22,'13000');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
