/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.6.12-MariaDB-0ubuntu0.22.04.1 : Database - posgpt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nm_barang` varchar(100) DEFAULT NULL,
  `id_barangjns` int(11) DEFAULT NULL,
  `id_barangsat` int(11) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `useradd` int(11) DEFAULT NULL,
  `tgladd` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`kode_barang`,`nm_barang`,`id_barangjns`,`id_barangsat`,`harga_beli`,`harga_jual`,`stok`,`useradd`,`tgladd`) values 
(1,'111','Sabun Mandi',2,2,10000,14000,28,3,'2023-06-02 20:30:02'),
(4,'222','Piring Cantik',4,5,6000,8000,49,3,'2023-06-05 10:24:55'),
(5,'333','Pena Pilot',5,1,20000,24000,26,3,'2023-06-05 10:25:23');

/*Table structure for table `barangjns` */

DROP TABLE IF EXISTS `barangjns`;

CREATE TABLE `barangjns` (
  `id_barangjns` int(11) NOT NULL AUTO_INCREMENT,
  `nm_barangjns` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_barangjns`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangjns` */

insert  into `barangjns`(`id_barangjns`,`nm_barangjns`) values 
(2,'Cair'),
(3,'Kapsul'),
(4,'Kaca'),
(5,'Plastik');

/*Table structure for table `barangsat` */

DROP TABLE IF EXISTS `barangsat`;

CREATE TABLE `barangsat` (
  `id_barangsat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_barangsat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_barangsat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangsat` */

insert  into `barangsat`(`id_barangsat`,`nm_barangsat`) values 
(1,'Lusin'),
(2,'Bungkus'),
(4,'Kardus'),
(5,'Buah'),
(6,'Ekor'),
(7,'Biji');

/*Table structure for table `bulan` */

DROP TABLE IF EXISTS `bulan`;

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL AUTO_INCREMENT,
  `no_bulan` char(3) DEFAULT NULL,
  `nm_bulan` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bulan` */

insert  into `bulan`(`id_bulan`,`no_bulan`,`nm_bulan`) values 
(1,'01','Januari'),
(2,'02','Februari'),
(3,'03','Maret'),
(4,'04','April'),
(5,'05','Mei'),
(6,'06','Juni'),
(7,'07','Juli'),
(8,'08','Agustus'),
(9,'09','September'),
(10,'10','Oktober'),
(11,'11','November'),
(12,'12','Desember');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `no_transaksi` char(35) NOT NULL,
  `grand` double DEFAULT 0,
  `bayar` double DEFAULT 0,
  `kembali` double DEFAULT 0,
  `useradd` int(11) DEFAULT NULL,
  `tgladd` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('blengkap','selesai') DEFAULT 'blengkap',
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi` */

insert  into `transaksi`(`no_transaksi`,`grand`,`bayar`,`kembali`,`useradd`,`tgladd`,`status`) values 
('230604.1455.TRANS.00001',102000,110000,8000,3,'2023-06-04 14:55:47','selesai'),
('230606.1043.TRANS.00001',368000,400000,32000,3,'2023-06-06 10:43:16','selesai'),
('230606.1045.TRANS.00001',68000,100000,32000,3,'2023-06-06 10:45:41','selesai');

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` char(35) DEFAULT NULL,
  `kode_barang` char(35) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`id_detail`,`no_transaksi`,`kode_barang`,`harga`,`qty`,`total`) values 
(1,'230604.1455.TRANS.00001','111',14000,3,42000),
(3,'230604.1455.TRANS.00001','222',8000,4,32000),
(8,'230606.1043.TRANS.00001','111',14000,12,168000),
(9,'230606.1043.TRANS.00001','222',8000,4,32000),
(10,'230606.1043.TRANS.00001','333',24000,7,168000),
(11,'230606.1045.TRANS.00001','111',14000,2,28000),
(12,'230606.1045.TRANS.00001','222',8000,5,40000);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(55) DEFAULT NULL,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id_user`,`nm_user`,`username`,`password`) values 
(2,'Ridwan Kamilsss','ridwan','202cb962ac59075b964b07152d234b70'),
(3,'Firman Santosa','firman','74bfebec67d1a87b161e5cbcf6f72a4a');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
