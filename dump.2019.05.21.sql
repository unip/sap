/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - k_mysap_suhud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(15) DEFAULT NULL,
  `nama_pemilik` varchar(30) NOT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `no_spbu` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kapasitas` int(50) DEFAULT NULL,
  `jenis_tersedia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`id_customer`,`id_user`,`nama_pemilik`,`nama_perusahaan`,`no_spbu`,`alamat`,`email`,`phone`,`lokasi`,`kapasitas`,`jenis_tersedia`) values 
(2,6,'Julius M','C-Corp','137.266.3693.665','Jl. Kemayoran','coba@coba.com','0274-797422','Jl. Batu Sari',15000,'Premium, Pertalite'),
(3,7,'Coba saja','Coba Saja Group','137.266.3693.700','Jl. Kemuning Mungkid Kidul Magelang Jawa Tengah','max@max.com','0272-797422','Jl. Kemuning Mungkid Kidul Magelang Jawa Tengah',20000,'Pertamax, Pertalite, Premium');

/*Table structure for table `loading_order` */

DROP TABLE IF EXISTS `loading_order`;

CREATE TABLE `loading_order` (
  `id_lo` int(200) NOT NULL AUTO_INCREMENT,
  `no_referensi` varchar(100) DEFAULT NULL,
  `pemesanan` int(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `berkas` text,
  PRIMARY KEY (`id_lo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `loading_order` */

insert  into `loading_order`(`id_lo`,`no_referensi`,`pemesanan`,`tanggal`,`berkas`) values 
(7,'3456-5689-55668',8,'2019-05-21','LO-7.pdf'),
(9,'3456-5689-55669',7,'2019-05-21','LO-9.pdf');

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(100) NOT NULL AUTO_INCREMENT,
  `typeBBM` int(10) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `customer` int(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `pemesanan` */

insert  into `pemesanan`(`id_pemesanan`,`typeBBM`,`qty`,`customer`,`tanggal`,`status`) values 
(5,3,1500000,2,'2019-05-20 13:33:18',0),
(6,3,1500000,2,'2019-05-20 15:14:53',0),
(7,1,1500000,2,'2019-05-20 15:15:06',1),
(8,1,150000,3,'2019-05-20 23:16:16',1),
(10,1,220000,3,'2019-05-20 23:27:24',0);

/*Table structure for table `typebbm` */

DROP TABLE IF EXISTS `typebbm`;

CREATE TABLE `typebbm` (
  `id_typeBBM` int(10) NOT NULL AUTO_INCREMENT,
  `gas_type` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  PRIMARY KEY (`id_typeBBM`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `typebbm` */

insert  into `typebbm`(`id_typeBBM`,`gas_type`,`price`) values 
(1,'Premium','7000'),
(3,'Pertalite','7800');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`level`,`status`) values 
(1,'admin','admin',0,'active'),
(6,'marto','123456',1,'active'),
(7,'coba','123456',1,'active');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
